<?php 
/*
*      Robo Gallery     
*      Version: 1.2
*      By Robosoft
*
*      Contact: https://robosoft.co/robogallery/ 
*      Created: 2015
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php
*
*      Copyright (c) 2014-2016, Robosoft. All rights reserved.
*      Available only in  https://robosoft.co/robogallery/ 
*/
if ( ! defined( 'ABSPATH' ) ) exit;

class Robo_Gallery_Settings {

	private $active_tab = '';

	function __construct(){
		$this->init();
	}


	function init(){
		$this->hooks();
	}

	function hooks(){
		
		add_action( 'admin_init', array( $this, 'settings') );
		add_action('admin_menu', array( $this, 'menu') ) ;
	}

	function menu(){
		add_submenu_page( 'edit.php?post_type=robo_gallery_table', 'Settings Robo Gallery', 'Settings', 'manage_options', 'robo-gallery-settings', array( $this, 'page') );
	}


	function settings(){
		register_setting( 'robo_gallery_settings_comp', ROBO_GALLERY_PREFIX.'categoryShow' );
		register_setting( 'robo_gallery_settings_comp', ROBO_GALLERY_PREFIX.'jqueryVersion' );
		register_setting( 'robo_gallery_settings_comp', ROBO_GALLERY_PREFIX.'fontLoad' );
		register_setting( 'robo_gallery_settings_comp', ROBO_GALLERY_PREFIX.'delay' );
		register_setting( 'robo_gallery_settings_comp', ROBO_GALLERY_PREFIX.'debugEnable' );
		register_setting( 'robo_gallery_settings_comp', ROBO_GALLERY_PREFIX.'expressPanel' );

		register_setting( 'robo_gallery_settings_post', ROBO_GALLERY_PREFIX.'postShowText' );
		register_setting( 'robo_gallery_settings_post', ROBO_GALLERY_PREFIX.'cloneBlock' );
		
		register_setting( 'robo_gallery_settings_seo', ROBO_GALLERY_PREFIX.'seo' );
		
	}

	function tabs( ){
		echo '
		<h2 class="nav-tab-wrapper">
		    <a href="edit.php?post_type=robo_gallery_table&page=robo-gallery-settings&tab=comp" class="nav-tab '.( $this->active_tab == 'comp' ? 'nav-tab-active' : '' ).'">
		    	'.__('Compatibility Settings', 'robo-gallery').'
		    </a>
		    <a href="edit.php?post_type=robo_gallery_table&page=robo-gallery-settings&tab=post" class="nav-tab '.( $this->active_tab == 'post' ? 'nav-tab-active' : '' ).'">
		    	'.__('Create Post Settings', 'robo-gallery').'
		    </a>
		    <a href="edit.php?post_type=robo_gallery_table&page=robo-gallery-settings&tab=seo" class="nav-tab '.( $this->active_tab == 'seo' ? 'nav-tab-active' : '' ).'">
		    	'.__('SEO Optimization', 'robo-gallery').'
		    </a>
		</h2>';
	}



	function enqueue(){
		wp_enqueue_style ( 	'robosoft-gallery-about', ROBO_GALLERY_URL.'css/admin/about.css', array( ), ROBO_GALLERY_VERSION );		
	}


	function page(){
		
		$this->enqueue();

		$this->active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'comp';

		echo '
		<div class="wrap">
			<h1>'.__('Robo Gallery', 'robo-gallery').'</h1>';

		$this->tabs();

		echo '<form method="post" action="options.php?tab='.$this->active_tab.'">';

			
			
			settings_errors();
			
			echo '<table class="form-table">';

		    if( $this->active_tab == 'comp' ) {
		    	settings_fields( 'robo_gallery_settings_comp' ); 
				do_settings_sections( 'robo_gallery_settings_comp' ); 
		        $this->compOptions();
		    } elseif( $this->active_tab == 'post' ) {
		    	settings_fields( 'robo_gallery_settings_post' ); 
				do_settings_sections( 'robo_gallery_settings_post' ); 
		        $this->postOptions();
		    } else {
		    	settings_fields( 'robo_gallery_settings_seo' ); 
				do_settings_sections( 'robo_gallery_settings_seo' ); 
		        $this->seoOptions();
		    } 
		    
		    echo '</table>';

			submit_button();

		echo '
			</form>
		</div>
		<div class="rbs_about_string2">Copyright &copy; 2014 - 2017 <a href="https://robosoft.co/robogallery">RoboSoft</a> All Rights Reserved</div>';

	}



	function compOptions(){
		 ?>
			<tr>
				<th scope="row"><?php _e('Categories Manager', 'robo-gallery'); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span><?php _e('Show'); ?></span></legend>
						<label title='<?php _e('Show'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'categoryShow'; ?>' value='0' <?php if( !get_option(ROBO_GALLERY_PREFIX.'categoryShow', '') ) echo " checked='checked'"; ?> /> <?php _e('Show'); ?>
						</label><br />
						<label title='<?php _e('Hide'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'categoryShow'; ?>' value='1' <?php if( get_option(ROBO_GALLERY_PREFIX.'categoryShow')==1 ) echo " checked='checked'"; ?>  /> <?php _e('Hide'); ?>
						</label><br />			
					</fieldset>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('jQuery Version', 'robo-gallery'); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span><?php _e('jQuery Version', 'robo-gallery'); ?></span></legend>
						<label title='<?php _e('Default'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'jqueryVersion'; ?>' value='build' <?php if( get_option(ROBO_GALLERY_PREFIX.'jqueryVersion', 'build')=='build' ) echo " checked='checked'";?> /> <?php _e('Default'); ?>
						</label><br />
						<label title='<?php _e('Alternative', 'robo-gallery'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'jqueryVersion'; ?>' value='robo' <?php if( get_option(ROBO_GALLERY_PREFIX.'jqueryVersion')=='robo' ) echo " checked='checked'";?>  /> <?php _e('Alternative', 'robo-gallery'); ?>
						</label>
						<p class="description">[for the case if you have jQuery version conflicts on page]</p>
						<br />
						<label title='<?php _e('Forced include', 'robo-gallery'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'jqueryVersion'; ?>' value='forced' <?php if( get_option(ROBO_GALLERY_PREFIX.'jqueryVersion')=='forced' ) echo " checked='checked'";?>  /> <?php _e('Forced include', 'robo-gallery'); ?>
						</label>
						<p class="description">[ for the case when Your theme do not use Wordpress API ]</p>
					</fieldset>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Font Awesome', 'robo-gallery'); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span><?php _e('Font Awesome', 'robo-gallery'); ?></span></legend>
						<label title='<?php _e('Load'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'fontLoad'; ?>' value='on' <?php if( get_option(ROBO_GALLERY_PREFIX.'fontLoad', 'on')=='on' ) echo " checked='checked'";?> /> <?php _e('Load'); ?>
						</label><br />
						<label title='<?php _e('Don\'t load', 'robo-gallery'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'fontLoad'; ?>' value='off' <?php if( get_option(ROBO_GALLERY_PREFIX.'fontLoad')=='off' ) echo " checked='checked'";?>  /> <?php _e('Don\'t load', 'robo-gallery'); ?>
						</label>
						<p class="description">[ <?php _e('for the case if Your theme already have awesome fonts loaded', 'robo-gallery'); ?>' ]</p>
					</fieldset>
				</td>
			</tr>
			
			<tr>
				<th scope="row"><?php _e('Size Calculations Delay', 'robo-gallery'); ?></th>
				<td>
					<input name="<?php echo ROBO_GALLERY_PREFIX.'delay'; ?>" id="<?php echo ROBO_GALLERY_PREFIX.'delay'; ?>" value="<?php echo (int) get_option(ROBO_GALLERY_PREFIX.'delay', '1000'); ?>" class="small-text" type="text"> ms.
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Debug'); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span><?php _e('Enable'); ?></span></legend>
						<label title='<?php _e('Enable'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'debugEnable'; ?>' value='1' <?php if( get_option(ROBO_GALLERY_PREFIX.'debugEnable')==1 ) echo " checked='checked'"; ?> /> <?php _e('Enable'); ?>
						</label><br />
						<label title='<?php _e('Disable'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'debugEnable'; ?>' value='0' <?php if( !get_option(ROBO_GALLERY_PREFIX.'debugEnable', '') ) echo " checked='checked'"; ?>  /> <?php _e('Disable'); ?>
						</label><br />			
					</fieldset>
				</td>
			</tr>

			<tr>
				<th scope="row"><?php _e('Express panel', 'robo-gallery'); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span><?php _e('Enable'); ?></span></legend>
						<label title='<?php _e('Enable'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'expressPanel'; ?>' value='1' <?php if( get_option(ROBO_GALLERY_PREFIX.'expressPanel')==1 ) echo " checked='checked'"; ?> /> <?php _e('Enable'); ?>
						</label><br />
						<label title='<?php _e('Disable'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'expressPanel'; ?>' value='0' <?php if( !get_option(ROBO_GALLERY_PREFIX.'expressPanel', '') ) echo " checked='checked'"; ?>  /> <?php _e('Disable'); ?>
						</label><br />			
					</fieldset>
				</td>
			</tr>
		<?php
	}


	function postOptions(){
		?>
			<tr>
				<th scope="row"><?php _e('Text Block', 'robo-gallery'); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span><?php _e('Show Text', 'robo-gallery'); ?></span></legend>
						<label title='<?php _e('Show'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'postShowText'; ?>' value='0' <?php if( !get_option(ROBO_GALLERY_PREFIX.'postShowText', '') ) echo " checked='checked'"; ?> /> <?php _e('Show'); ?>
						</label><br />
						<label title='<?php _e('Hide'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'postShowText'; ?>' value='1' <?php if( get_option(ROBO_GALLERY_PREFIX.'postShowText')=='1' ) echo " checked='checked'"; ?>  /> <?php _e('Hide'); ?>
						</label><br />			
					</fieldset>
				</td>
			</tr>

			<tr>
				<th scope="row"><?php _e('Clone Block', 'robo-gallery'); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span><?php _e('Show Clone Block', 'robo-gallery'); ?></span></legend>
						<label title='<?php _e('Show'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'cloneBlock'; ?>' value='0' <?php if( !get_option(ROBO_GALLERY_PREFIX.'cloneBlock', '') ) echo " checked='checked'"; ?> /> <?php _e('Show'); ?>
						</label><br />
						<label title='<?php _e('Hide'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'cloneBlock'; ?>' value='1' <?php if( get_option(ROBO_GALLERY_PREFIX.'cloneBlock')=='1' ) echo " checked='checked'"; ?>  /> <?php _e('Hide'); ?>
						</label><br />			
					</fieldset>
				</td>
			</tr>
		<?php
	}


	function seoOptions(){
		?>
			<tr>
				<th scope="row"><?php _e('Add SEO content', 'robo-gallery'); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span><?php _e('Enable [thumbs]', 'robo-gallery'); ?></span></legend>
						<label title='<?php _e('Enable [thumbs]', 'robo-gallery'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'seo'; ?>' value='2' <?php if( get_option(ROBO_GALLERY_PREFIX.'seo')=='2' ) echo " checked='checked'"; ?> /> <?php _e('Enable [thumbs]', 'robo-gallery'); ?>
						</label><br />

						<legend class="screen-reader-text"><span><?php _e('Enable [thumbs + link]', 'robo-gallery'); ?></span></legend>
						<label title='<?php _e('Enable [thumbs + link]', 'robo-gallery'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'seo'; ?>' value='1' <?php if( get_option(ROBO_GALLERY_PREFIX.'seo')=='1' ) echo " checked='checked'"; ?> /> <?php _e('Enable [thumbs + link]', 'robo-gallery'); ?>
						</label><br />

						<label title='<?php _e('Disable'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'seo'; ?>' value='0' <?php if( !get_option(ROBO_GALLERY_PREFIX.'seo', '') ) echo " checked='checked'"; ?>  /> <?php _e('Disable', 'robo-gallery'); ?>
						</label><br />			
					</fieldset>
				</td>
			</tr>

		<?php
	}

}
		
$settings = new Robo_Gallery_Settings();