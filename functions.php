<?php
/**
 * ucredit functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ucredit
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ucredit_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on ucredit, use a find and replace
		* to change 'ucredit' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'ucredit', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'ucredit' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'ucredit_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Allow SVG
	 */
	add_action('upload_mimes', function ($mimes) {
		$mimes['svg-xml'] = 'image/svg+xml';
		$mimes['svg'] = 'image/svg';
		return $mimes;
	});

	// Add Image Sizes
	add_image_size( 'about', 366, 303, true );

	/**
	 * Custom Navigation Walker for Sub-menus
	 */
	class Ucredit_Walker_Nav_Menu extends Walker_Nav_Menu {
		function start_lvl(&$output, $depth = 0, $args = null) {
			$indent = str_repeat("\t", $depth);
			$submenu = ($depth > 0) ? ' sub-menu' : '';
			$output .= "\n$indent<ul class=\"sub-menu$submenu\">\n";
		}

		function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
			$indent = ($depth) ? str_repeat("\t", $depth) : '';

			$li_attributes = '';
			$class_names = $value = '';

			$classes = empty($item->classes) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			// Add sub-menu indicator class
			if ($args->walker->has_children) {
				$classes[] = 'has-submenu';
			}

			$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
			$class_names = ' class="' . esc_attr($class_names) . '"';

			$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
			$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

			$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
			$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
			$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
			$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

			$item_output = $args->before;
			$item_output .= '<a' . $attributes . '>';

			// Add sub-menu indicator for items with children
			if ($args->walker->has_children) {
				$item_output .= '<span class="submenu-indicator"></span>';
			}

			$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;

			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
		}
	}

	/**
	 * Custom Comment Callback Function
	 */
	function ucredit_comment_callback( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<article class="comment-body">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
						<div class="comment-author-info">
							<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
							<span class="comment-date">
								<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
									<?php
									/* translators: 1: comment date, 2: comment time */
									printf( __( '%1$s ב%2$s', 'ucredit' ), get_comment_date(), get_comment_time() );
									?>
								</a>
							</span>
						</div>
					</div>

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'התגובה שלך ממתינה לאישור.', 'ucredit' ); ?></em>
					<?php endif; ?>
				</footer>

				<div class="comment-content">
					<?php comment_text(); ?>
				</div>

				<div class="comment-actions">
					<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					<?php edit_comment_link( __( 'ערוך', 'ucredit' ), ' ' ); ?>
				</div>
			</article>
		<?php
	}

	/**
	 * REST API for Posts Filtering
	 */
	function ucredit_register_posts_rest_route() {
		register_rest_route('ucredit/v1', '/posts', array(
			'methods' => 'GET',
			'callback' => 'ucredit_get_filtered_posts',
			'permission_callback' => '__return_true',
			'args' => array(
				'search' => array(
					'default' => '',
					'sanitize_callback' => 'sanitize_text_field',
				),
				'category' => array(
					'default' => '',
					'sanitize_callback' => 'sanitize_text_field',
				),
				'sort' => array(
					'default' => 'date-desc',
					'sanitize_callback' => 'sanitize_text_field',
				),
				'page' => array(
					'default' => 1,
					'sanitize_callback' => 'absint',
				),
				'per_page' => array(
					'default' => 12,
					'sanitize_callback' => 'absint',
				),
			),
		));
	}
	add_action('rest_api_init', 'ucredit_register_posts_rest_route');

	function ucredit_get_filtered_posts($request) {
		$search = $request->get_param('search');
		$category = $request->get_param('category');
		$sort = $request->get_param('sort');
		$page = $request->get_param('page');
		$per_page = $request->get_param('per_page');

		// Build query args
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => $per_page,
			'paged' => $page,
		);

		// Search
		if (!empty($search)) {
			$args['s'] = $search;
		}

		// Category
		if (!empty($category)) {
			$args['category_name'] = $category;
		}

		// Sorting
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

		$query = new WP_Query($args);
		$posts = array();
		$total_posts = $query->found_posts;
		$total_pages = $query->max_num_pages;

		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();

				// Get post data
				$post_data = array(
					'id' => get_the_ID(),
					'title' => get_the_title(),
					'excerpt' => has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 25, '...'),
					'permalink' => get_permalink(),
					'date' => get_the_date('d/m/Y'),
					'date_iso' => get_the_date('Y-m-d'),
					'featured_image' => has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'medium_large') : null,
					'categories' => wp_get_post_categories(get_the_ID(), array('fields' => 'names')),
					'category_slugs' => wp_get_post_categories(get_the_ID(), array('fields' => 'slugs')),
				);

				$posts[] = $post_data;
			}
			wp_reset_postdata();
		}

		return array(
			'success' => true,
			'posts' => $posts,
			'total_posts' => $total_posts,
			'total_pages' => $total_pages,
			'current_page' => $page,
			'per_page' => $per_page,
		);
	}

	/**
	 * Custom Comment Form Function
	 */
	function ucredit_comment_form() {
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$html_req = ( $req ? " required='required'" : '' );

		$fields = array(
			'author' => '<div class="comment-form-row"><div class="comment-form-field comment-form-author"><label for="author">' . __( 'שם', 'ucredit' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $html_req . ' /></div>',
			'email'  => '<div class="comment-form-field comment-form-email"><label for="email">' . __( 'אימייל', 'ucredit' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label><input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $html_req . ' /></div></div>',
			'url'    => '<div class="comment-form-row"><div class="comment-form-field comment-form-url"><label for="url">' . __( 'אתר אינטרנט', 'ucredit' ) . '</label><input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div>',
		);

		$comments_args = array(
			'fields'               => $fields,
			'comment_field'        => '<div class="comment-form-row"><div class="comment-form-field comment-form-comment"><label for="comment">' . __( 'תגובה', 'ucredit' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required="required"></textarea></div></div>',
		'class_submit'         => 'comment-submit',
		'label_submit'         => __( 'שלח תגובה', 'ucredit' ),
		'title_reply'          => __( 'השאר תגובה', 'ucredit' ),
		/* translators: %s: comment author name */
		'title_reply_to'       => __( 'השאר תגובה ל%2$s', 'ucredit' ),
		'title_reply_before'   => '<h4 id="reply-title" class="comment-reply-title">',
			'title_reply_after'    => '</h4>',
			'cancel_reply_link'    => __( 'ביטול תגובה', 'ucredit' ),
			'comment_notes_before' => '<p class="comment-notes">' . __( 'כתובת האימייל שלך לא תפורסם. שדות חובה מסומנים ב *', 'ucredit' ) . '</p>',
			'comment_notes_after'  => '',
		);

		comment_form( $comments_args );
	}

	/**
	 * Custom Breadcrumbs Function
	 */
	function ucredit_breadcrumbs() {
		$separator = ' / ';
		$home_title = __('בית', 'ucredit');

		// Start breadcrumb
		echo '<div class="article-breadcrumbs">';

		// Home link
		echo '<a href="' . home_url() . '">' . $home_title . '</a>';

		if (is_single() && get_post_type() === 'post') {
			echo '<span class="breadcrumb-separator">' . $separator . '</span>';
			echo '<span class="current-page">' . get_the_title() . '</span>';
		} elseif (is_page()) {
			echo '<span class="breadcrumb-separator">' . $separator . '</span>';
			echo '<span class="current-page">' . get_the_title() . '</span>';
		} elseif (is_category()) {
			echo '<span class="breadcrumb-separator">' . $separator . '</span>';
			echo '<span class="current-page">' . single_cat_title('', false) . '</span>';
		} elseif (is_tag()) {
			echo '<span class="breadcrumb-separator">' . $separator . '</span>';
			echo '<span class="current-page">' . single_tag_title('', false) . '</span>';
		} elseif (is_search()) {
			echo '<span class="breadcrumb-separator">' . $separator . '</span>';
			echo '<span class="current-page">' . __('חיפוש', 'ucredit') . ': ' . get_search_query() . '</span>';
		} elseif (is_404()) {
			echo '<span class="breadcrumb-separator">' . $separator . '</span>';
			echo '<span class="current-page">' . __('דף לא נמצא', 'ucredit') . '</span>';
		}

		echo '</div>';
	}

	/**
	 * Remove WordPress Meta Generator
	 */
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'start_post_rel_link', 10);
	remove_action('wp_head', 'parent_post_rel_link', 10);
	remove_action('wp_head', 'wp_shortlink_wp_head', 10);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
	remove_action('wp_head', 'print_emoji_detection_script', 7);
}
add_action( 'after_setup_theme', 'ucredit_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ucredit_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'ucredit' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'ucredit' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'ucredit_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ucredit_scripts() {
	wp_enqueue_style( 'ucredit-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'ucredit-style', 'rtl', 'replace' );

	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-validate', get_template_directory_uri() . '/assets/js/jquery.validate.min.js');
	wp_enqueue_script( 'ucredit-script', get_template_directory_uri() . '/assets/js/script.min.js', array('jquery'), _S_VERSION, true );

	if (is_singular( 'recipes' )) {
		wp_enqueue_script( 'js-pdf', 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js', '', _S_VERSION, false );
	}


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_localize_script('ucredit-script', 'ucredit', [
		'ajax_url' => admin_url('admin-ajax.php'),
		'site_url' => get_home_url(),
		'translations' => [
			'search' => __('חיפוש', 'ucredit'),
			'category' => __('קטגוריה', 'ucredit'),
			'error_loading_posts' => __('שגיאה בטעינת המאמרים. נסה שוב מאוחר יותר. ', 'ucredit'),
		],
	]);
}
add_action( 'wp_enqueue_scripts', 'ucredit_scripts' );

/**
 * Actions.
 */
require get_template_directory() . '/inc/actions.php';

/**
 * ACF functionality.
 */
require get_template_directory() . '/inc/acf.php';

/**
 * Custom functionality.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * AJAX functionality.
 */
require get_template_directory() . '/inc/ajax.php';

/**
 * Loan Calculator Settings.
 */
require get_template_directory() . '/inc/loan-calculator-settings.php';

/**
 * Shortcodes functionality.
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Blocks - ucredit-banner
 */
require get_stylesheet_directory() . '/inc/blocks/ucredit-banner/ucredit-banner.php';

/**
 * Global Conversion Tracking Script
 * Adds Contact.org tracking script before closing body tag
 */
function ucredit_global_tracking_script() {
	?>
	<script src="https://backoffice.contact.org.il/contact.js" async charset="utf-8" integrity="sha384-5lQn5V8FQGbRB1lzDA5x7CAnNeGR3kIcBOW4+iT5+/8ZTwaG5okF4ZxzkYzO1CLM" crossorigin="anonymous"></script>
	<script>(window._cntct_wdgts=window._cntct_wdgts || []).push('f024ad')</script>
	<?php
}
add_action( 'wp_footer', 'ucredit_global_tracking_script' );