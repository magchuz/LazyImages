<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://akmal.web.id
 * @since      1.0.0
 *
 * @package    Lazyimages
 * @subpackage Lazyimages/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Lazyimages
 * @subpackage Lazyimages/public
 * @author     magchuz <magchuz@pm.me>
 */
class Lazyimages_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->lazy_options = get_option($this->plugin_name);

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Lazyimages_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Lazyimages_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/lazyimages-public.js', array( 'jquery' ), $this->version, false );

	}
    // Add post/page slug
    public function add_class( $content ) {

        $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
        $document = new DOMDocument();
        libxml_use_internal_errors(true);
        $document->loadHTML(utf8_decode($content));

        $imgs = $document->getElementsByTagName('img');
        foreach ($imgs as $img) {
			//GET EXISTING CLASS
			$existing_class = $img->getAttribute('class');
			$existing_src = $img->getAttribute('src');
			$existing_srcset = $img->getAttribute('srcset');
			$existing_size = $img->getAttribute('sizes');

			//REMOVE ATTRIBUTE
			$img->removeAttribute('srcset');
			$img->removeAttribute('sizes');
			//SET ATTRIBUTE
			$img->setAttribute('class', "lazy $existing_class");
			$img->setAttribute('data-src', "$existing_src");
			$img->setAttribute('src', "data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=");
			$img->setAttribute('data-srcset', "$existing_srcset");
			$img->setAttribute('data-sizes', "$existing_size");

        }

        $html = $document->saveHTML();
        return $html;
}


}
