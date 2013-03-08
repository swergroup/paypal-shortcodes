<?php

class PaypalShortcodesTests extends WP_UnitTestCase {

    function setUp(){
        parent::setUp();
        $this->plugin = $GLOBALS['swer-paypal-shortcodes'];
    }

    function testPluginInit(){
        $this->assertFalse( null == $this->plugin );
    }

	function testShortcode(){
		$attributes = array(
			'type' => 'paynow',
			'name' => 'Item #1',
			'amount' => '20'
			);

		$results = $this->plugin->swer_paypal_shortcode( $attributes );

		$expect = array(
			'<input type="hidden" name="item_name" value="Item #1">',
			'<input type="hidden" name="amount" value="20">',
			'src="https://www.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif"',
			'<input type="hidden" name="add" value="1">'
			);

		foreach( $expect as $k=>$string ):
			$this->assertContains( $string, $results, 'Shortcode [paynow] #'.$k.' does not work as expected' );
		endforeach;

		$attributes2 = array(
			'type' => 'add',
			'name' => 'Item #1',
			'amount' => '20'
			);
		$results2 = $this->plugin->swer_paypal_shortcode( $attributes2 );

		$expect2 = array(
			'<input type="hidden" name="item_name" value="Item #1">',
			'<input type="hidden" name="amount" value="20">',
			'src="https://www.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif"',
			'<input type="hidden" name="add" value="1">'
			);

		foreach( $expect2 as $k2=>$string2 ):
			$this->assertContains( $string2, $results2, 'Shortcode [add] #'.$k2.' does not work as expected' );
		endforeach;

	}


}
