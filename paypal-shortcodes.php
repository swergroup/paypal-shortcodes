<?php
/*
Plugin Name: Paypal Shortcode
Plugin URI: http://wordpress.org/extend/plugins/paypal-shortcodes/
Description:  
Author: SWERgroup
Version: 0.3
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


if( ! array_key_exists( 'swer-paypal-shortcodes', $GLOBALS ) ) { 
    class SWER_paypal_shortcodes{

        function __construct(){
            add_shortcode('paypal', array( $this, 'swer_paypal_shortcode') );
            add_action( 'admin_init', array( &$this, '_admin_init' ) );
        }

        function _admin_init(){
            add_settings_section( 'swer_paypal_shortcode', 'PayPal Shortcode', array( &$this, 'options_header'), 'writing');

            add_settings_field( 'swer_paypal_email', 'Email', array( &$this, 'options_paypal_email'), 'writing', 'swer_paypal_shortcode');
            register_setting( 'writing', 'swer_paypal_email' );

            add_settings_field( 'swer_paypal_currency', 'Currency', array( &$this, 'options_paypal_currency'), 'writing', 'swer_paypal_shortcode');
            register_setting( 'writing', 'swer_paypal_currency' );
            
            add_settings_field( 'swer_paypal_text_add', 'ADD Text', array( &$this, 'options_paypal_text_add'), 'writing', 'swer_paypal_shortcode');
            register_setting( 'writing', 'swer_paypal_text_add' );

            add_settings_field( 'swer_paypal_text_view', 'VIEW Text', array( &$this, 'options_paypal_text_view'), 'writing', 'swer_paypal_shortcode');
            register_setting( 'writing', 'swer_paypal_text_view' );
        }


        function options_header(){
            echo 'Add Item: <code>[paypal type="add" name="Item Name" amount="12.99"]</code>. View Items: <code>[paypal type="view"]</code>';
        }


        function options_paypal_email(){
            $mail = get_option( 'swer_paypal_email' );
            $value = ($mail!='') ? $mail : '';
            echo '<input type="text" name="swer_paypal_email" id="swer_paypal_email" value="'.$value.'"/>';
        }

        function options_paypal_currency(){
            $mail = get_option( 'swer_paypal_currency' );
            $value = ($mail!='') ? $mail : '';
            echo '<input type="text" name="swer_paypal_currency" id="swer_paypal_currency" value="'.$value.'"/>';
        }

        function options_paypal_text_add(){
            $text = get_option( 'swer_paypal_text_add' );
            $value = ( $text!=='' ) ? $text : '';
            echo '<input type="text" name="swer_paypal_text_add" id="swer_paypal_text_add" value="'.$value.'"/>';
        }

        function options_paypal_text_view(){
            $text = get_option( 'swer_paypal_text_view' );
            $value = ( $text!=='' ) ? $text : '';
            echo '<input type="text" name="swer_paypal_text_view" id="swer_paypal_text_view" value="'.$value.'"/>';
        }



     
        // [paypal type="add" name="Item Name" amount="12.99"]
        // [paypal type="view"]
        function swer_paypal_shortcode($atts) {

            extract( shortcode_atts( array(
               'type' => 'paynow',
               'name' => '',
               'amount' => ''
               ), $atts ) );


        switch( $type ):

        	case "add":	
        	case "paynow":
        	$code = '
                <form name="paypal-cart" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_xclick" />
        		<input type="hidden" name="business" value="'.get_option('swer_paypal_email',true).'">
        		<input type="hidden" name="currency_code" value="'.get_option('swer_paypal_currency',true).'">
        		<input type="hidden" name="item_name" value="'.$name.'">
        		<input type="hidden" name="amount" value="'.$amount.'">

                <input type="hidden" name="no_shipping" value="2" />
                <input type="hidden" name="no_note" value="1" />
                <input type="hidden" name="bn" value="IC_Sample" />

        		<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="'.get_option('swer_paypal_text_add',true).'">
        		<input type="hidden" name="add" value="1">
        		</form>';
        	break;

        	case "view":
        	$code = '
        		<form name="_xclick" target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
        		<input type="hidden" name="cmd" value="_cart">
        		<input type="hidden" name="business" value="'.get_option('swer_paypal_email',true).'">
        		<input type="image" src="https://www.paypal.com/en_US/i/btn/view_cart_new.gif" border="0" name="submit" alt="'.get_option('swer_paypal_text_view',true).'">
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