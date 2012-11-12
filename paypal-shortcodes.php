<?php
/*
Plugin Name: Paypal Shortcode
Plugin URI: http://wordpress.org/extend/plugins/paypal-shortcodes/
Description:  
Author: SWERgroup
Version: 0.2
Author URI: http://swergroup.com/

Copyright (C) 2007+ Paolo Tresso / SWERgroup (http://swergroup.com/)

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

define("PAYPAL_MAIL","email@example.org");			// your Paypal email address
define("CURRENCY","EUR");							// your Paypal currency (EUR, USD) 
define("ALT_ADD","Add to cart (Paypal)");			// alternate text for "Add to cart" image
define("ALT_VIEW","View Paypal cart");				// alternate text for "View cart" image




if( ! array_key_exists( 'swer-paypal-shortcodes', $GLOBALS ) ) { 
    class SWER_paypal_shortcodes{

        function __construct(){
            add_shortcode('paypal', 'pps_paypal_shortcode');
        }
     
        // [paypal type="add" name="Item Name" amount="12.99"]
        // [paypal type="view"]
        function pps_paypal_shortcode($atts) {

            $a = shortcode_atts( array(
               'type' => 'paynow',
               'name' => '',
               'amount' => ''
               ), $atts );


        switch($atts['type']):
        	case "paynow":
        	$code = '
                <form name="EFTcart" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_xclick" />
        		<input type="hidden" name="business" value="'.PAYPAL_MAIL.'">
        		<input type="hidden" name="currency_code" value="'.CURRENCY.'">
        		<input type="hidden" name="item_name" value="'.$atts['name'].'">
        		<input type="hidden" name="amount" value="'.$atts['amount'].'">

                <input type="hidden" name="no_shipping" value="2" />
                <input type="hidden" name="no_note" value="1" />
                <input type="hidden" name="bn" value="IC_Sample" />

        		<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="'.ALT_ADD.'">
        		<input type="hidden" name="add" value="1">
        		</form>';
        	break;

        	case "add":	
        	case "view":
        	$code = '
        		<form name="_xclick" target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
        		<input type="hidden" name="cmd" value="_cart">
        		<input type="hidden" name="business" value="'.PAYPAL_MAIL.'">
        		<input type="image" src="https://www.paypal.com/en_US/i/btn/view_cart_new.gif" border="0" name="submit" alt="'.ALT_VIEW.'">
        		<input type="hidden" name="display" value="1">
        		</form>
        	';
        	break;	
        endswitch;
        return $code;	
        }
     
        
    }
    $GLOBALS['swer-paypal-shortcodes'] = new SWER_paypal_shortcodes();
}

?>