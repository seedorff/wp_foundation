<?php get_header(); ?>
	
	<div class="large-12 columns" id="slider">
		<div class="slick">

			<?php
		    $the_query = new WP_Query(array( 
		    	'post_type' => "slider", 
		        'posts_per_page' => 5
		        )); 
		    	while ( $the_query->have_posts() ) : 
		       		$the_query->the_post();
		     ?>

		    <div class="item">
		        <?php the_post_thumbnail();?>
		    </div><!-- item -->
		    
		    <?php endwhile; 
	       	wp_reset_postdata();
		    ?>

		</div><!-- slick -->
	</div>

	<script type="text/javascript">
		
		$(document).ready(function(){
			$('.slick').slick({
			  autoplay: true,
			  lazyLoad: true,
			  dots: true,
			  infinite: false,
			  speed: 300,
			  touchMove: false,
			  slidesToScroll: 1,
			  slidesToShow: 1,
			  infinite: true
			});
		});

	</script>

    <!-- Main Content -->
    <div class="large-9 columns" role="main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

				<?php if ( has_post_thumbnail()) : ?>
				   <a href="<?php the_permalink(); ?>" class="th" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('thumbnail'); ?></a>
				 <?php endif; ?>

				<?php the_content(); ?>

			<?php endwhile; ?>

		<?php else : ?>

			<h2><?php _e('No posts.', 'foundation' ); ?></h2>
			<p class="lead"><?php _e('Sorry about this, I couldn\'t seem to find what you were looking for.', 'foundation' ); ?></p>
			
		<?php endif; ?>

    </div>
    <!-- End Main Content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>