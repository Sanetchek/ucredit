<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ucredit
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-K9PXHXF2K5"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-K9PXHXF2K5');
	</script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<div id="preloader" class="preloader"></div>

	<?php if (!is_page_template('templates/landing-1.php')) : ?>
		<header id="masthead" class="header">
			<div class="header__wrap">

				<div class="header__logo_wrap">
					<a href="/" class="site-branding">
						<?php
							$logo = get_field('logo', 'option');
						?>

						<?php if ($logo) : ?>
							<?= wp_get_attachment_image($logo, 'medium', '', ['class' => 'header__logo']) ?>
						<?php else : ?>
							<img src="<?= assets('img/logo.svg') ?>" alt="" class="header__logo">
						<?php endif; ?>
					</a><!-- .site-branding -->

					<div id="burger-menu" class="burger-menu">
						<div class="bar1"></div>
						<div class="bar2"></div>
						<div class="bar3"></div>
					</div>
				</div>

				<nav class="main-navigation">
					<div class="main-navigation__wrap">
						<?php
						wp_nav_menu(
							array(
								'theme_location' 	=> 'menu-1',
								'menu_id'        	=> 'primary-menu',
								'container'				=> '',
								'walker'					=> new Ucredit_Walker_Nav_Menu(),
							)
						);
						?>

						<?php
							$modal = get_field('header_popup', 'option') ? ' modal-show' : '';
							$link = get_field('header_link', 'option');
						?>

						<?php if ($link) : ?>
							<a href="<?= $link['url'] ?>" class="btn btn__blue<?= $modal ?>"><?= $link['title'] ?></a>
						<?php endif; ?>
					</div>
				</nav><!-- #site-navigation -->

			</div>
		</header><!-- #masthead -->
	<?php endif; ?>
