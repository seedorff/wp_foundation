<?php get_header(); ?>

    <!-- Main Content -->
    <div class="large-12 columns collapse main" role="main">
    	
    	<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h2 class="archive-title"><?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?></h2>
			</header><!-- .archive-header -->
			<div class="description">
				<?php echo term_description(); ?>
			</div>
			<?php /* The loop */ ?>
			<div class="stream">

				<?php while ( have_posts() ) : the_post(); ?>
				<div class="large-12 columns">
					<div class="article-wrap">

						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
						<?php 
						if ( has_post_thumbnail() ) {
							 the_post_thumbnail();
						}
						else {
							echo 'No thumbnail found';
						}
						?> 
						</a>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					</div>
				</div>
				<?php endwhile; ?>

			</div>
		<?php else : ?>

			
		<?php endif; ?>

    </div>
    <!-- End Main Content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>