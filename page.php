<?php get_header(); ?>

    <!-- Main Content -->
    <div class="large-9 columns" role="main">
    	hej
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<h2><?php the_title(); ?></h2>
				<?php the_content(); ?>
			<?php endwhile; ?>

		<?php else : ?>

			<h2><?php _e('No content.', 'foundation' ); ?></h2>
			<p class="lead"><?php _e('Sorry no content found.', 'foundation' ); ?></p>
			
		<?php endif; ?>

    </div>
    <!-- End Main Content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>