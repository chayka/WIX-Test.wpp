<?php
/**
 * Plugin Name: WIX-Test
 * Plugin URI: git@github.com:/chayka/WIX-test.git
 * Description: MVC/OOP WP Plugin built with Chayka framework
 * Version: 0.0.1
 * Author: Boris Mossounov <borix@tut.by>
 * Author URI: https://github.com/chayka/
 * License: proprietary
 */

require_once 'vendor/autoload.php';

if(!class_exists("Chayka\\WP\Plugin")){
    add_action( 'admin_notices', function () {
?>
    <div class="error">
        <p>Chayka Framework functionality is not available</p>
    </div>
<?php
	});
}else{
    require_once dirname(__FILE__).'/Plugin.php';
	add_action('init', array("Chayka\\WIXTest\\Plugin", "init"));
}
