<?php
/**
 *
 * @package lawfiz
 */


if ( ! is_active_sidebar( 'woosidebar' ) ) :
	return;
endif;

?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'woosidebar' ); ?>
</aside><!-- #secondary -->

