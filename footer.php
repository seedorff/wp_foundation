</div><!-- /row -->
<footer class="row">
	<?php if ( dynamic_sidebar('Footer') ) : elseif( current_user_can( 'edit_theme_options' ) ) : ?>

	<h5><?php _e( 'No widgets found.', 'foundaton' ); ?></h5>
	<p><?php printf( __( 'Add some %s now...', 'foundation' ), '<a href=" '. get_admin_url( '', 'widgets.php' ) .' ">widgets</a>' ); ?></p>

<?php endif; ?>
</footer>
<?php wp_footer(); ?>
</body>
</html>