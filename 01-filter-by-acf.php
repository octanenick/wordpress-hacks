add_action('pre_get_posts', 'custom_filter_posts_by_custom_field');

function custom_filter_posts_by_custom_field($query) {
    global $pagenow;
    // Check if we are on the admin panel and on the edit.php page for the desired post type
    if (is_admin() && $pagenow == 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] == 'your_post_type') {
        // Check if the custom field value is set in the query string
        if (isset($_GET['custom_field_value'])) {
            $custom_field_value = $_GET['custom_field_value'] == 'true' ? 1 : 0; // Convert string to boolean
            // Modify the query to filter posts based on the custom field value
            $meta_query = array(
                array(
                    'key'     => 'your_custom_field', // Change 'your_custom_field' to the actual name of your custom field
                    'value'   => $custom_field_value,
                    'compare' => '=',
                    'type'    => 'BOOLEAN' // Assuming your custom field stores boolean values
                )
            );
            $query->set('meta_query', $meta_query);
        }
    }
}
