=== Paypal Shortcodes ===
Contributors: swergroup, pixline
Donate link: http://pixline.net/wordpress-plugins/
Tags: paypal, shortcode, integration
Requires at least: 2.5
Tested up to: 3.4.2
Stable tag: trunk

This plugin allow to insert Paypal buttons in your posts or pages, with a shortcode like [paypal type="add|view"].

== Description ==

This plugin allow to insert Paypal buttons in your posts or pages, just using a shortcode.
This plugin don't have a management panel at this time, you'll need to edit paypal-shortcodes.php and follow the comments.

Currently supported:
* Add to cart
* View cart

= Usage =

[paypal type="add" name="Item Name vol. 1" amount="12.99"]

This shortcode will print the "Add to cart" image, which will add "Item Name vol. 1" (priced 12.99) to your paypal cart. 

[paypal type="view"]

This shortcode will print the "View cart" image.


== Changelog ==

* 0.1		(16/05/2008) first release

= Credits = 

This plugin is GPL&copy; 2008 Paolo Tresso / [Pixline](http://pixline.net/)

== Installation ==

1. Download the plugin Zip archive.
1. Upload `paypal-shortcodes` folder to your `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Edit paypal-shortcode.php and define your settings.
1. Enjoy :-)