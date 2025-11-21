<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ucredit
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<div class="container">
		<?php
		// You can start editing here -- including this comment!
		if ( have_comments() ) :
			?>
			<div class="comments-header">
				<h3 class="comments-title">
					<?php
					$ucredit_comment_count = get_comments_number();
					if ( '1' === $ucredit_comment_count ) {
						printf(
							/* translators: 1: title. */
							esc_html__( 'תגובה אחת על &ldquo;%1$s&rdquo;', 'ucredit' ),
							'<span>' . wp_kses_post( get_the_title() ) . '</span>'
						);
					} else {
						printf(
							/* translators: 1: comment count number, 2: title. */
							esc_html( _nx( '%1$s תגובה על &ldquo;%2$s&rdquo;', '%1$s תגובות על &ldquo;%2$s&rdquo;', $ucredit_comment_count, 'comments title', 'ucredit' ) ),
							number_format_i18n( $ucredit_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							'<span>' . wp_kses_post( get_the_title() ) . '</span>'
						);
					}
					?>
				</h3>
			</div><!-- .comments-header -->

			<div class="comments-navigation">
				<?php the_comments_navigation(); ?>
			</div>

			<div class="comments-list-wrapper">
				<ol class="comment-list">
					<?php
					wp_list_comments(
						array(
							'style'      => 'ol',
							'short_ping' => true,
							'avatar_size' => 60,
							'callback'   => 'ucredit_comment_callback',
						)
					);
					?>
				</ol><!-- .comment-list -->
			</div>

			<div class="comments-navigation">
				<?php the_comments_navigation(); ?>
			</div>

			<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() ) :
				?>
				<div class="comments-closed">
					<p class="no-comments"><?php esc_html_e( 'התגובות סגורות.', 'ucredit' ); ?></p>
				</div>
				<?php
			endif;

		endif; // Check for have_comments().

		// Custom comment form
		ucredit_comment_form();
		?>
	</div>
</div><!-- #comments -->
