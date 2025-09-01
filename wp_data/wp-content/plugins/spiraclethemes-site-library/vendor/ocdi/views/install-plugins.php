<?php
/**
 * The install plugins page view.
 *
 * @package ocdi
 */

namespace OCDI;

$plugin_installer = new PluginInstaller();
?>

<div class="ocdi ocdi--install-plugins">

	<?php echo wp_kses_post( ViewHelpers::plugin_header_output() ); ?>

	<div class="ocdi__content-container">

		<div class="ocdi__admin-notices js-ocdi-admin-notices-container"></div>

		<div class="ocdi__content-container-content">
			<div class="ocdi__content-container-content--main">
				<div class="ocdi-install-plugins-content">
					<div class="ocdi-install-plugins-content-header">
						<h2><?php esc_html_e( 'Install Recommended Plugins', 'one-click-demo-import' ); ?></h2>
						<p>
							<?php esc_html_e( 'Want to use the best plugins for the job? Here is the list of awesome plugins that will help you achieve your goals.', 'one-click-demo-import' ); ?>
						</p>
					</div>
					<div class="ocdi-install-plugins-content-content">
					</div>
					<div class="ocdi-install-plugins-content-footer">
						<a href="<?php echo esc_url( $this->get_plugin_settings_url() ); ?>" class="button"><img src="<?php echo esc_url( OCDI_URL . 'assets/images/icons/long-arrow-alt-left-blue.svg' ); ?>" alt="<?php esc_attr_e( 'Back icon', 'one-click-demo-import' ); ?>"><span><?php esc_html_e( 'Go Back' , 'one-click-demo-import' ); ?></span></a>
						<a href="#" class="button button-primary js-ocdi-install-plugins"><?php esc_html_e( 'Install & Activate' , 'one-click-demo-import' ); ?></a>
					</div>
				</div>
			</div>
			<div class="ocdi__content-container-content--side">
				<?php echo wp_kses_post( ViewHelpers::small_theme_card() ); ?>
			</div>
		</div>

	</div>
</div>
