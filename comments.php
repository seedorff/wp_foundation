<?php
if ( post_password_required() )
	return;
?>

<div>

	<?php if ( have_comments() ) : ?>
	<hr>
		<h4 class="comments-title">
			<?php
				printf( _n( '1 reply to &ldquo;%2$s&rdquo;', '%1$s replies to &ldquo;%2$s&rdquo;', get_comments_number(), 'foundation' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h4>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'foundation_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'foundation' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'foundation' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'foundation' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'foundation' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php if ( comments_open() ) : ?>
	<div class="panel">
		<?php comment_form(); ?>
	</div>
	<?php endif; ?>

</div><!-- #comments .comments-area -->