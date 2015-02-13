<?php

// this file contains all settings pages and options

function rri_settings_page() {
	global $rri_options;

	$ip_addresses  = ! empty( $rri_options['ips'] )          ? $rri_options['ips']          : '';
	$redirect_url  = ! empty( $rri_options['redirect_url'] ) ? $rri_options['redirect_url'] : '';
	?>
	<div class="wrap">
		<div id="upb-wrap" class="upb-help">
			<h2>Restrict Roles by IP</h2>
			<?php
			if ( ! isset( $_REQUEST['updated'] ) )
				$_REQUEST['updated'] = false;
			?>
			<?php if ( false !== $_REQUEST['updated'] ) : ?>
			<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
			<?php endif; ?>
			<form method="post" action="options.php">

				<?php settings_fields( 'rri_settings_group' ); ?>
				
				<h4>Enable</h4>
				<p>
					<input id="rri_settings[enable]" name="rri_settings[enable]" type="checkbox" value="1" <?php checked( true, isset( $rri_options['enable'] ) ); ?>/>
					<label class="description" for="rri_settings[enable]"><?php _e( 'Enable IP Restrictions Mode?' ); ?></label>
				</p>
				
				<h4>IP Addresses</h4>
				<p>
					<label class="description" for="rri_settings[ips]"><?php _e( 'Enter the IP addresses that should have access to the site, one per line' ); ?></label><br/>
					<textarea id="rri_settings[ips]" style="width: 400px; height: 150px;" name="rri_settings[ips]" type="text"><?php echo esc_html( $ip_addresses );?></textarea>
				</p>

				<h4>Redirect URL</h4>
				<p>
					<input id="rri_settings[redirect_url]" name="rri_settings[redirect_url]" type="text" value="<?php echo esc_attr( $redirect_url );?>" />
					<label class="description" for="rri_settings[redirect_url]"><?php _e( 'URL to send users without IP access' ); ?></label><br/>
				</p>
				
				<!-- save the options -->
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save Options' ); ?>" />
				</p>
								
				
			</form>
		</div><!--end sf-wrap-->
	</div><!--end wrap-->
		
	<?php
}

// register the plugin settings
function rri_register_settings() {
	register_setting( 'rri_settings_group', 'rri_settings' );
}
add_action( 'admin_init', 'rri_register_settings' );


function rri_settings_menu() {

	// add settings page
	add_submenu_page('options-general.php', 'Restrict Roles by IP', 'Restrict Roles by IP','manage_options', 'restrict-roles-by-ip', 'rri_settings_page');
}
add_action( 'admin_menu', 'rri_settings_menu' );