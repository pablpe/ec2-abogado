<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lawfiz
 */

?>
	</div>
	<!-- Begin Footer Section -->
	<footer id="footer" class="lawfiz-footer" itemscope itemtype="https://schema.org/WPFooter">
		<div class="container footer-widgets">
			<div class="row">
				<div class="footer-widgets-wrapper">
	                <?php get_sidebar( 'footer' ); ?>
	            </div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container copyrights">
				<div class="row">
					<div class="footer-copyrights-wrapper">
						<?php
							/**
							 * Hook - lawfiz_action_footer.
							 *
							 * @hooked lawfiz_footer_copyrights - 10
							 */
							do_action( 'lawfiz_action_footer' );
						?>
					</div>
				</div>
			</div>
		</div>
    </footer>
	<?php wp_footer(); ?>
</body>