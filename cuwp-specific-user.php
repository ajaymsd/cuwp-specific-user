<?php 
/*
 * Plugin Name:       CUWP-Specific User Condition
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Plugin to add Specific User Condition for Checkout-Upsell
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ajay Mathesh
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:      CUWP-Specific User
 * Domain Path:       /languages
 */
defined('ABSPATH') or exit;
use CUW\App\Controllers\Controller;


function init() {
     add_filter('cuw_conditions',function($conditions){
	      require 'UserHandler.php';
          $conditions['specific_user'] = array(
              'name' => __("Specific User", 'checkout-upsell-woocommerce'),
              'group' => __("User", 'checkout-upsell-woocommerce'),
              'handler' => new UserHandler(),
              'campaigns' => ['pre_purchase', 'post_purchase'],
          );
          return $conditions;
        });
}
add_action( 'cuw_after_init', 'init' );



if(class_exists( 'CUW\App\Controllers\Admin\Ajax')){
	add_filter('cuw_ajax_auth_request_handlers',function($con){
		return array_merge($con,['list_users'=>function(){
			$query = Controller::app()->input->get('query', '', 'post');
			$userlist=get_users([ 'search' => $query ]);
			return array_map(function ($user) {
				return [
					'id' => (string) $user->ID,
					'text' => $user->display_name,
				];
			}, $userlist);
		}]);
	});
}








