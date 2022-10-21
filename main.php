<?php
/*
* Plugin Name: DevsSpace
* Plugin URI: https://DevsSpace.com
* Author: DevsSpace.com
* Authot URI: https://DevsSpace.com
* Description: Simple Basic Plugin
 * Version: 1.0.0
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: devsspace-plugin
*/



if (!defined('WPINC')) {
   die;
}

if (!defined('WPAC_PLUGIN_VERSION')) {
   define('WPAC_PLUGIN_VERSION', '1.0.0');
}

if (!defined('WPAC_PLUGIN_DIR')) {
   define('WPAC_PLUGIN_DIR', plugin_dir_url(__FILE__));
}


add_action('admin_menu', 'add_admin_page');
function add_admin_page()
{
   add_menu_page(
      'DevsSpace',
      'DavsSpace',
      'manage_options',
      'my-plugin',
      'admin_page_html',
   );
}



function admin_page_html()
{
   
include "index.php";
   // check user capabilities
   if (!current_user_can('manage_options')) {
      return;
   }
   $default_tab = null;
   $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
?> <div class="wrap">
      <?php
      ?>
      <br>
      <h1><?php
            echo esc_html(get_admin_page_title());
            ?></h1>
      <nav class="nav-tab-wrapper">
         <a href="?page=my-plugin" class="nav-tab <?php
                                                   if ($tab === null) :
                                                   ?>nav-tab-active<?php
                                                                  endif;
                                                                     ?>">Home</a>
         <a href="?page=my-plugin&tab=settings" class="nav-tab <?php if ($tab === 'settings') : ?>nav-tab-active<?php endif; ?> ">Settings</a>

         <a href="?page=my-plugin&tab=tools" class="nav-tab <?php if ($tab === 'tools') : ?>nav-tab-active<?php endif; ?>">Tools</a>
      </nav>
      <div class="tab-content">
         <?php
         switch ($tab):
            case 'settings': {
         ?>



                  <form class="woocommerce-EditAccountForm edit-account" action="" method="post">
                     <h3>General Settings</h3>
                     <p><label for="ip" style="font-size: 14px; margin-right: 5px;">Show Ip Address:</label> <input id="ip" type="checkbox" name="mc4wp-subscribe" value="1" /></p>

                     <p><label for="country" style="font-size: 14px; margin-right: 5px;">Show Country Name: </label><input type="checkbox" id="country" name="mc4wp-subscribe" value="1" /></p>

                     <p><label for="city" style="font-size: 14px; margin-right: 5px;">Show City Name:</label> <input type="checkbox" id="city" name="mc4wp-subscribe" value="1" /></p>

                     <p><label for="timeZone" style="font-size: 14px; margin-right: 5px;">Show TimeZone:</label> <input type="checkbox" id="timeZone" name="mc4wp-subscribe" value="1" /></p>

                     <p><label for="region" style="font-size: 14px; margin-right: 5px;">Show Region Name:</label> <input type="checkbox" id="region" name="mc4wp-subscribe" value="1" /></p>

                     <p><label for="postal" style="font-size: 14px; margin-right: 5px;">Show Postal Code:</label> <input type="checkbox" id="postal" name="mc4wp-subscribe" value="1" /></p>

                     <p><label for="isp" style="font-size: 14px; margin-right: 5px;">Show ISP Organization:</label> <input type="checkbox" id="isp" name="mc4wp-subscribe" value="1" /></p>

                     <p><label for="userAgent" style="font-size: 14px; margin-right: 5px;">Show User Agent:</label> <input type="checkbox" id="userAgent" name="mc4wp-subscribe" value="1" /></p>

                     <p><label for="hostName" style="font-size: 14px; margin-right: 5px;">Show Host Name:</label> <input type="checkbox" id="hostName" name="mc4wp-subscribe" value="1" /></p>
                     <br>
                     <button style="margin-top: 5px; padding: 8px 15px;color:#fff;border-radius: 3px;background:#135e96; border:1.5px solid #135e96;cursor: pointer;">Save Changes</button>
                  </form>


               <?php
                  break;
               }
            case 'tools': { ?>
                  <h2>Tools will be available soon...</h2>
                  <h2>Short Code</h2>
                  <label style="cursor: initial;">Copy the short code and paste it where you want to show the output</label>
                  <div style="width: 550px;display: flex; justify-content: space-between; align-items: center; margin-top: 1rem; padding: 1rem 1.5rem; background: #fff; border-radius: 10px;" class="shortcode">
                     <input type="text" id="short_code" style="font-size: 25px;border: 0; outline: 0; background: transparent;" value="[display_myip_block]" readonly />
                     <button id="btnCopy" style="padding: 5px 20px;font-size: 22px; color:#fff;border-radius: 3px;background:#135e96; border:1.5px solid #135e96;cursor: pointer;">Copy</button>
                  </div>
               <?php
                  break;
               }
            default: {
               ?>
                  <!-- <h2>Go to the settings tab to customize the options</h2> -->
                  <br>
         <?php
               }
               break;
         endswitch;
         ?>
      </div>
   </div>
   <script>
      let text = document.getElementById("short_code");
      let btnCopy = document.getElementById("btnCopy");
      btnCopy.addEventListener("click", () => {
         text.select();
         text.setSelectionRange(0, 99999);
         document.execCommand("copy");
         alert("Shortcode coppied !");
      });
   </script>
<?php
}
?>