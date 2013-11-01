<?php get_header(); ?>
<!-- Main Content -->
    <div class="large-9 columns" role="main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header>
						<hgroup>
							<h3><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'foundation' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
							<h6><?php _e('Written by', 'foundation' );?> <?php the_author_link(); ?> on <?php the_time(get_option('date_format')); ?></h6>
						</hgroup>
					</header>

					<?php if ( has_post_thumbnail()) : ?>
					<a href="<?php the_permalink(); ?>" class="th" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail(); ?></a>
					<?php endif; ?>
					
					<?php the_content(); ?>

					<footer>

						<p><?php wp_link_pages(); ?></p>

						<h6><?php _e('Posted Under:', 'foundation' );?> <?php the_category(', '); ?></h6>
						<?php the_tags('<span class="radius secondary label">','</span><span class="radius secondary label">','</span>'); ?>

						<?php get_template_part('author-box'); ?>
						<?php comments_template(); ?>

					</footer>

				</article>

				<hr />


			<?php endwhile; ?>
			
		<?php endif; ?>

    </div>
    <!-- End Main Content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>