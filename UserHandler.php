<?php

use CUW\App\Modules\Conditions\Base;
defined('ABSPATH') or exit;



class UserHandler extends Base {
	    //Function to Check Condition
		public function check( $condition, $data ) {
			if ( ! isset( $condition['values']) || ! isset( $condition['method'] ) ) {
				return false;
			}
			if ( is_user_logged_in() ) {
				$current_user    = get_current_user_id();
				$current_user_id = ! empty( $current_user ) ? array( $current_user ) : [];
				return self::checkLists( $condition['values'], $current_user_id, $condition['method'] );
			} else {
				return false;
			}
		}

		//Function to load a template
		public function template( $data = [], $print = false ) {
			ob_start();
			extract( $data );
			include 'View.php';
			$view = ob_get_clean();
			if ( $print ) {
				echo $view;
			}
			return $view;
		}

}