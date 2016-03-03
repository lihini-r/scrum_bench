<?php
/**
 * @package custom-dashboard-widgets
 * @version 1.0
 */
/*
Plugin Name: Custom Dashboard Widgets
Plugin URI: http://wordpress.org/plugins
Description: Customize Your Dashboard Main Page, New Layouts, you can simplisity customize your dashboard links to access quickly to your dashboard pages.
You can add new row (access link), edit rows and delete row.
Version: 1.0
Author: AboZain,o7abeeb,unitOne
Author URI: http://unitone.ps
tags: Dashboard, Widget, Layout, layouts, widgets,Arabic ,arabic , posts, links, settings, plugins, dashboard layout, dashboard widgets, custom dashboard, customize dashboard, custom, customize
*/


add_action( 'admin_menu', 'cdw_reg_menu' );

function cdw_reg_menu(){
	add_options_page( __('Dashboard Widgets', 'DashboardWidgets'), __('Dashboard Widgets', 'DashboardWidgets'), 'administrator', 'dashboard-widgets', 'cdw_DashboardWidgets'); 
}


# Load plugin text domain
add_action( 'init', 'cdw_plugin_textdomain' );
# Text domain for translations
function cdw_plugin_textdomain() {
    $domain = 'DashboardWidgets';
    $locale = apply_filters( 'plugin_locale', get_locale(), $domain );
    load_textdomain( $domain, WP_LANG_DIR.'/'.$domain.'/'.$domain.'-'.$locale.'.mo' );
    load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}
//////////////////////////
function cdw_DashboardWidgets(){
	echo '<link rel="stylesheet" type="text/css" href="'.plugins_url( 'dw_style.css', __FILE__ ).'" />';

	?>
	
        <div class="wrap">
            <?php screen_icon('edit-pages'); ?>
			<h2><?php _e('Dashboard Widgets', 'DashboardWidgets') ?></h2>
            <h4><?php _e('Customize Your Dashboard Main Page, New Layouts, you can simplisity customize your dashboard links to access quickly to your dashboard pages. You can add new row (access link), edit rows and delete row. ', 'DashboardWidgets') ?></h4>
			<p><a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/"> 
			<?php _e('You can Choose the icons from this link ', 'DashboardWidgets') ?>  </a></p>
	
			<?php if(isset($_POST['data']) && isset($_POST['submit'])){
				
				$data = $_POST['data'];
						update_option('dashboard-widgets', $data);		
				echo '<br /> <br /> <h2 style="
				  color: green;
				  background-color: white;
				  height: 15px;
				  width: 95%;
				  padding: 20px;">'.__('Saved Successfully', 'DashboardWidgets').'</h2>';
			}else{
				$data =  get_option('dashboard-widgets'); 
				if(empty($data)  || isset($_POST['reset_default']) ){
					$data = cdw_get_default_data();
					if(isset($_POST['reset_default'])){
						 update_option('dashboard-widgets', $data);	
					}
				}
			
			} ?>
	
            <form method="post" action="">
				<?php settings_fields( 'disable-settings-group' ); ?>
            	<?php do_settings_sections( 'disable-settings-group' );  ?>
			<br/>
			<table class="table table-bordered">
				<tr>
					<th width="20%"> <?php _e('Title', 'DashboardWidgets') ?> </th>
					<th width="20%">  <?php _e('icon', 'DashboardWidgets') ?>  </th>
					<th width="20%">  <?php _e('link', 'DashboardWidgets') ?> </th>
					<th width="5%"> <?php _e('Active', 'DashboardWidgets') ?>  </th>
					<th > <?php _e('Administrator', 'DashboardWidgets') ?>  </th>
					<th > <?php _e('Editor', 'DashboardWidgets') ?>  </th>
					<th > <?php _e('Author', 'DashboardWidgets') ?>  </th>
					<th > <?php _e('Contributor', 'DashboardWidgets') ?>  </th>
					<th > <?php _e('Remove', 'DashboardWidgets') ?>  </th>
				</tr>
			<?php foreach($data as $k=>$item){  ?>
			<tr data-id="<?= $k ?>">
				<td><input type="text" name="data[<?= $k ?>][title]"  value="<?php echo $item['title'] ?>" /></td>
				<td><input type="text" name="data[<?= $k ?>][icon]" value="<?php echo $item['icon']  ?>" /></td>
				<td><input type="text" name="data[<?= $k ?>][link]" value="<?php echo $item['link']  ?>" /></td>
				<td><input type="checkbox" name="data[<?= $k ?>][status]" value="checked"  <?php echo $item['status']  ?>/></td>
				<td><input type="checkbox" name="data[<?= $k ?>][administrator]" value="checked"  <?php echo $item['administrator']  ?>/></td>
				<td><input type="checkbox" name="data[<?= $k ?>][editor]" value="checked"  <?php echo $item['editor']  ?>/></td>
				<td><input type="checkbox" name="data[<?= $k ?>][author]" value="checked"  <?php echo $item['author']  ?>/></td>
				<td><input type="checkbox" name="data[<?= $k ?>][contributor]" value="checked"  <?php echo $item['contributor']  ?>/></td>
				<td><a href="javascript:void(0);" class="remCF"><i class="fa fa-times"></i></a></td>
			</tr>
			<?php } ?>
			</table>
				<div class="add-new"><a href="javascript:void(0);" class="addCF"><i class="fa fa-plus"></i><?php _e('Add Row', 'DashboardWidgets') ?></a></div>
                <?php submit_button(); ?>
				<p class="submit">
					<input type="submit" name="reset_default" class="button button-danger def-button" value="<?php _e('Set Defaults', 'DashboardWidgets') ?>">
				</p>
            </form>
        </div>	
		
		<br/>

<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script>
$(document).ready(function(){
	$(".addCF").click(function(){
		var key = $(".table tr:last-child").data('id');
		key = key+1;
		$(".table").append('<tr data-id="'+key+'"><td><input type="text" name="data['+key+'][title]" value="Title" /></td><td><input type="text" name="data['+key+'][icon]" value="fa fa-wordpress" /></td><td><input type="text" name="data['+key+'][link]" value="Link" /></td><td><input type="checkbox" name="data['+key+'][status]" value="checked"  checked/></td><td><input type="checkbox" name="data['+key+'][administrator]" value="checked"  checked/></td><td><input type="checkbox" name="data['+key+'][editor]" value="checked"  checked/></td><td><input type="checkbox" name="data['+key+'][author]" value="checked" /></td><td><input type="checkbox" name="data['+key+'][contributor]" value="checked" /></td><td><a href="javascript:void(0);" class="remCF"><i class="fa fa-times"></i></a></td></tr>');
		});
		$(".table").on('click','.remCF',function(){
			$(this).parent().parent().remove();
		});
});
</script>
				
		<?php
}

///////////////// Delete Default Widgets ////////////////
remove_action( 'welcome_panel', 'wp_welcome_panel' );
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
function remove_dashboard_widgets() {
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']);
}
////////////////////////////////////////////////////////////

function cdw_get_default_data(){
	echo '<link rel="stylesheet" type="text/css" href="'.plugins_url( 'dw_style.css', __FILE__ ).'" />';

				$items = $item = array();
				$item['title'] = __('View Site');
				$item['icon'] = 'fa fa-home';
				$item['link'] = 'site_url';
				$item['status'] = 'checked';
				$item['administrator'] = 'checked';
				$item['editor'] = 'checked';
				$item['author'] = 'checked';
				$item['contributor'] = 'checked';
				$item['order'] = 0;
				$items[] = $item;

				$item['title'] = __('Profile');
				$item['icon'] = 'fa fa-user';
				$item['link'] = 'profile.php';
				$item['status'] = 'checked';
				$item['administrator'] = 'checked';
				$item['editor'] = 'checked';
				$item['author'] = 'checked';
				$item['contributor'] = 'checked';
				$item['order'] = 0;
				$items[] = $item;
				 
				$item['title'] = __('Posts');
				$item['icon'] = 'fa fa-pencil-square-o';
				$item['link'] = 'edit.php';
				$item['status'] = 'checked';
				$item['administrator'] = 'checked';
				$item['editor'] = 'checked';
				$item['author'] = 'checked';
				$item['contributor'] = 'checked';
				$item['order'] = 0;
				$items[] = $item;
					
				$item['title'] = __('Media');
				$item['icon'] = 'fa fa-picture-o';
				$item['link'] = 'upload.php';
				$item['status'] = 'checked';
				$item['administrator'] = 'checked';
				$item['editor'] = 'checked';
				$item['author'] = 'checked';
				$item['contributor'] = '';
				$item['order'] = 0;
				$items[] = $item;
				
				$item['title'] = __('Users');
				$item['icon'] = 'fa fa-users';
				$item['link'] = 'users.php';
				$item['status'] = 'checked';
				$item['administrator'] = 'checked';
				$item['editor'] = '';
				$item['author'] = '';
				$item['contributor'] = '';
				$item['order'] = 0;
				$items[] = $item;
				
				$item['title'] = __('Pages');
				$item['icon'] = 'fa fa-th';
				$item['link'] = 'edit.php?post_type=page';
				$item['status'] = 'checked';
				$item['administrator'] = 'checked';
				$item['editor'] = 'checked';
				$item['author'] = '';
				$item['contributor'] = '';
				$item['order'] = 0;
				$items[] = $item;
				
				$item['title'] = __('Plugins');
				$item['icon'] = 'fa fa-plug';
				$item['link'] = 'plugins.php';
				$item['status'] = 'checked';
				$item['administrator'] = 'checked';
				$item['editor'] = '';
				$item['author'] = '';
				$item['contributor'] = '';
				$item['order'] = 0;
				$items[] = $item;
				
				$item['title'] = __('Settings');
				$item['icon'] = 'fa fa-cogs';
				$item['link'] = 'options-general.php';
				$item['status'] = 'checked';
				$item['administrator'] = 'checked';
				$item['editor'] = '';
				$item['author'] = '';
				$item['contributor'] = '';
				$item['order'] = 0;
				$items[] = $item;
			return $items;
}

/////////////// Add Custome Widget //////////////////////
function custom_dashboard_widget(){
	echo '<link rel="stylesheet" type="text/css" href="'.plugins_url( 'dw_style.css', __FILE__ ).'" />';

    echo '<h4>'.__('Welcome To your Dashboard', 'DashboardWidgets').'</h4>';

    global $current_user; // Use global
    get_currentuserinfo(); // Make sure global is set, if not set it.
    $website_url = get_bloginfo('url');
    $admin_url = site_url()."/wp-admin/";
    $widget_button_class = "main_bashboard_widget_button";
    
		$data =  get_option('dashboard-widgets'); 
		if(empty($data)){
			$data = cdw_get_default_data();
		}
		foreach($data as $item){ 
			if($item['status'] != 'checked') continue;
			$userRole = ($current_user->roles);
			$role = $userRole[0];
			if(!isset($item[$role]) ||  ($item[$role] != 'checked') ) continue;
						
				$link =($item['link'] != 'site_url')? $admin_url.$item['link'] : home_url();
				echo '<div class="'.$widget_button_class.'">
					<a href="'.$link.'">
						<i class="'.$item['icon'].'"></i>
						<h3>'.__($item['title']).'</h3>
					</a>
				</div>';
		}
    echo '</div>';
}
function add_custom_dashboard_widget(){
	echo '<link rel="stylesheet" type="text/css" href="'.plugins_url( 'dw_style.css', __FILE__ ).'" />';

    wp_add_dashboard_widget('custom_dashboard_widget','لوحة التحكم','custom_dashboard_widget','rc_mdm_configure_my_rss_box');
}
add_action('wp_dashboard_setup', 'add_custom_dashboard_widget');

?>
