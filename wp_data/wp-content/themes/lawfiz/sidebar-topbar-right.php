<?php
/**
 *
 * @package lawfiz
 */


if ( ! is_active_sidebar( 'topbar-right' ) ) :
	return;
endif;

?>
<div class="right-sidebar-wrapper">
	<?php dynamic_sidebar( 'topbar-right' ); ?>
</div>

