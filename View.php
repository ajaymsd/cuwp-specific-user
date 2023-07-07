
<?php
defined('ABSPATH') or exit;

          $key = isset($key) ? (int) $key : '{key}';
          $method = isset($condition['method']) && !empty($condition['method']) ? $condition['method'] : '';
          $values = isset($condition['values']) && !empty($condition['values']) ? array_flip($condition['values']) : [];    //Getting the values
          foreach ($values as $id => $index) {
	            $userdata = get_user_by( 'ID', $id);
	            if ( is_object( $userdata ) && isset($userdata->display_name)){
	                    $values[ $id ] = $userdata->display_name;    //Finding display name of each user and storing it in $values with a key
                }
          }
?>


<div class="condition-method flex-fill">
    <select class="form-control" name="conditions[<?php echo esc_attr($key); ?>][method]" data-list="">
        <option value="in_list" <?php if ($method == 'in_list') echo "selected"; ?>><?php esc_html_e("In list", 'checkout-upsell-woocommerce'); ?></option>
        <option value="not_in_list" <?php if ($method == 'not_in_list') echo "selected"; ?>><?php esc_html_e("Not in list", 'checkout-upsell-woocommerce'); ?></option>
    </select>
</div>
<div class="condition-values w-75 ml-2">
    <select multiple class="select2-list" name="conditions[<?php echo esc_attr($key); ?>][values][]" data-list="users"
            data-placeholder=" <?php esc_html_e("Search Users", 'checkout-upsell-woocommerce'); ?>">
	    <?php foreach ($values as $id => $displayname) { ?>
            <option value="<?php echo esc_attr($id); ?>" selected><?php echo esc_html($displayname); ?></option>
	    <?php } ?>
    </select>
</div>

