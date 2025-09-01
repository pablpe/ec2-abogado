<?php
/**
 *
 * @package lawfiz
 */

//Return if the first widget area has no widgets
if ( !is_active_sidebar( 'footer-1' ) ) {
	return;
} ?>

<?php //user selected widget columns

	$lawfiz_widget_num = esc_html(get_theme_mod('lawfiz_footer_widgets', '4'));
	
	if ($lawfiz_widget_num == '4') :
		$col1 ='col-md-3';
		$col2 ='col-md-3';
		$col3 ='col-md-3';
		$col4 ='col-md-3';
	elseif ($lawfiz_widget_num == '3') :
		$col1 ='col-md-4';
		$col2 ='col-md-4';
		$col3 ='col-md-4';
		
	elseif ($lawfiz_widget_num == '2') :
		 $col1 ='col-md-6';
		 $col2 ='col-md-6';
	else :
		$col1 ='col-md-12';
	endif;
?>
		
<?php 
	if ( is_active_sidebar( 'footer-1' ) && ( $lawfiz_widget_num == '4' || $lawfiz_widget_num == '3' || $lawfiz_widget_num == '2' || $lawfiz_widget_num == '1')) :
		?>
			<div class="widget-column <?php echo esc_attr($col1); ?>">
				<?php dynamic_sidebar( 'footer-1'); ?>
			</div>
		<?php
	endif;
	if ( is_active_sidebar( 'footer-2' ) && ( $lawfiz_widget_num == '4' || $lawfiz_widget_num == '3' || $lawfiz_widget_num == '2')) :
		?>
			<div class="widget-column <?php echo esc_attr($col2); ?>">
				<?php dynamic_sidebar( 'footer-2'); ?>
			</div>
		<?php
	endif;
	if ( is_active_sidebar( 'footer-3' ) && ( $lawfiz_widget_num == '4' || $lawfiz_widget_num == '3' )) :
		?>
			<div class="widget-column <?php echo esc_attr($col3); ?>">
				<?php dynamic_sidebar( 'footer-3'); ?>
			</div>
		<?php
	endif;
	if ( is_active_sidebar( 'footer-4' ) && ( $lawfiz_widget_num == '4' )) :
		?>
			<div class="widget-column <?php echo esc_attr($col4); ?>">
				<?php dynamic_sidebar( 'footer-4'); ?>
			</div>
		<?php
	endif;
?>