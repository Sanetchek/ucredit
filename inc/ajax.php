<?php
/**
 * AJAX handlers for the ucredit theme
 *
 * @package ucredit
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Render a single post HTML using PHP template
 */
function ucredit_render_post_html($post_data) {
    // Start output buffering to capture the template output
    ob_start();

    // Set up post data for the template
    global $post;
    $original_post = $post;
    $post = (object) $post_data;
    setup_postdata($post);

    // Include the AJAX post template
    get_template_part('template-parts/content', 'ajax-post');

    // Get the buffered content and clean up
    $html = ob_get_clean();

    // Restore the original post data
    $post = $original_post;
    if ($original_post) {
        setup_postdata($original_post);
    }

    return $html;
}

/**
 * AJAX handler for filtering posts
 */
function ucredit_ajax_filter_posts() {
    // Verify nonce for security
    if (!wp_verify_nonce($_POST['nonce'], 'ucredit_filter_nonce')) {
        wp_send_json_error('Security check failed');
        return;
    }

    // Get filter parameters
    $search = sanitize_text_field($_POST['search'] ?? '');
    $category = sanitize_text_field($_POST['category'] ?? '');
    $sort = sanitize_text_field($_POST['sort'] ?? 'date-desc');
    $page = intval($_POST['page'] ?? 1);
    $posts_per_page = 12;

    // Validate parameters
    if ($page < 1) {
        $page = 1;
    }

    // Validate sort parameter
    $valid_sorts = array('date-desc', 'date-asc', 'title-asc', 'title-desc');
    if (!in_array($sort, $valid_sorts)) {
        $sort = 'date-desc';
    }

    // Build query arguments
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged' => $page,
        'meta_query' => array(),
        'tax_query' => array(),
    );

    // Add search
    if (!empty($search)) {
        $args['s'] = $search;
    }

    // Add category filter
    if (!empty($category)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $category,
        );
    }

    // Add sorting
    switch ($sort) {
        case 'date-asc':
            $args['orderby'] = 'date';
            $args['order'] = 'ASC';
            break;
        case 'title-asc':
            $args['orderby'] = 'title';
            $args['order'] = 'ASC';
            break;
        case 'title-desc':
            $args['orderby'] = 'title';
            $args['order'] = 'DESC';
            break;
        default: // date-desc
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
    }

    // Run the query
    $query = new WP_Query($args);

    // Check if query was successful
    if (is_wp_error($query)) {
        wp_send_json_error('Database query failed');
        return;
    }

    $response = array(
        'success' => true,
        'posts' => array(),
        'has_more' => false,
        'total_posts' => $query->found_posts,
        'current_page' => $page,
    );

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            // Prepare post data
            $title = get_the_title();
            $content = get_the_content();
            $excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words($content, 25, '...');
            $categories = wp_get_post_categories(get_the_ID(), array('fields' => 'names'));
            if (empty($categories) || !is_array($categories)) {
                $categories = array();
            }

            // Ensure categories are strings and not too long
            $categories = array_map(function($cat) {
                $cat = strval($cat);
                if (strlen($cat) > 50) {
                    $cat = substr($cat, 0, 50) . '...';
                }
                return $cat;
            }, $categories);

            // Remove empty categories
            $categories = array_filter($categories, function($cat) {
                return !empty($cat) && $cat !== '...';
            });

            $permalink = get_permalink();
            if (empty($permalink) || !is_string($permalink)) {
                $permalink = '#';
            }

            // Ensure permalink URL is valid
            if (!empty($permalink) && $permalink !== '#' && !filter_var($permalink, FILTER_VALIDATE_URL)) {
                $permalink = '#';
            }

            // Ensure permalink URL is not too long
            if (strlen($permalink) > 500) {
                $permalink = '#';
            }

            $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
            if (empty($featured_image) || !is_string($featured_image)) {
                $featured_image = '';
            }

            // Ensure featured image URL is valid
            if (!empty($featured_image) && !filter_var($featured_image, FILTER_VALIDATE_URL)) {
                $featured_image = '';
            }

            // Ensure featured image URL is not too long
            if (strlen($featured_image) > 500) {
                $featured_image = '';
            }

            $date = get_the_date('d/m/Y');
            if (empty($date) || !is_string($date)) {
                $date = __('אין תאריך', 'ucredit');
            }

            $date_iso = get_the_date('Y-m-d');
            if (empty($date_iso) || !is_string($date_iso)) {
                $date_iso = '';
            }

            // Ensure date format is correct
            if (!empty($date) && $date !== __('אין תאריך', 'ucredit') && !preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date)) {
                $date = __('אין תאריך', 'ucredit');
            }

            if (!empty($date_iso) && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date_iso)) {
                $date_iso = '';
            }

            // Ensure date strings are not too long
            if (strlen($date) > 20) {
                $date = __('אין תאריך', 'ucredit');
            }

            if (strlen($date_iso) > 20) {
                $date_iso = '';
            }

            $post_id = get_the_ID();
            if (empty($post_id) || !is_numeric($post_id)) {
                $post_id = 0;
            }

            // Ensure post ID is positive
            if ($post_id < 0) {
                $post_id = 0;
            }

            $post_data = array(
                'ID' => $post_id,
                'post_title' => $title,
                'post_excerpt' => $excerpt,
                'permalink' => $permalink,
                'date' => $date,
                'date_iso' => $date_iso,
                'categories' => $categories,
                'featured_image' => $featured_image,
            );

            // Render the post HTML using PHP template
            try {
                $post_data['html'] = ucredit_render_post_html($post_data);
                $response['posts'][] = $post_data;
            } catch (Exception $e) {
                // Log error and continue with next post
                error_log('Error rendering post HTML: ' . $e->getMessage());
                continue;
            }
        }

        wp_reset_postdata();

        // Check if there are more posts
        $response['has_more'] = ($page * $posts_per_page) < $query->found_posts;
    } else {
        // No posts found
        $response['message'] = __('לא נמצאו תוצאות תואמות לסינון שלך.', 'ucredit');
    }

    // Send JSON response
    wp_send_json($response);
}

// Hook up the AJAX actions
add_action('wp_ajax_ucredit_filter_posts', 'ucredit_ajax_filter_posts');
add_action('wp_ajax_nopriv_ucredit_filter_posts', 'ucredit_ajax_filter_posts');

/**
 * Enqueue AJAX script with localized data
 */
function ucredit_enqueue_ajax_script() {
    wp_localize_script('ucredit-script', 'ucredit_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ucredit_filter_nonce'),
    ));
}

add_action('wp_enqueue_scripts', 'ucredit_enqueue_ajax_script');
