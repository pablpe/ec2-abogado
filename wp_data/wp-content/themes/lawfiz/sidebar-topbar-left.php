<?php
/**
 *
 * @package lawfiz
 */


if ( ! is_active_sidebar( 'topbar-left' ) ) :
	return;
endif;

?>
<div class="left-sidebar-wrapper">
	<?php dynamic_sidebar( 'topbar-left' ); ?>
</div>

