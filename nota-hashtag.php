<?php
/*
Plugin Name: Nota con HashTag Plugin
Plugin URI: https://github.com/danyjavierb/nota-hashtag
Description: Plugin para agregar un hashtag de twitter a una entrada de wordpress y ver los 20 últimos twits en la vista de la entrada.
Version: 1.0
Text Domain: nota-hashtag-textdomain
Author: Dany Bautista
Author URI: http://www.danybau.com
License: GPL2
*/

if (!class_exists("Nota_Hashtag") ) {

  class Nota_Hashtag {


    public function __construct(){

      add_action('save_post', array(&$this, 'guardar_post'));
      add_action('add_meta_boxes', array(&$this, 'agregar_meta_boxes'));
      add_action( 'wp_enqueue_scripts', array(&$this, 'agregar_scripts') );
      add_action( 'wp_enqueue_scripts', array(&$this, 'agregar_estilos') );

    }


    public function agregar_scripts () {

      wp_register_script('hashtag_client', plugins_url('hashtag_client.js', __FILE__), array('jquery'),'1.1', true);
      wp_enqueue_script('hashtag_client');

    }
    public function agregar_estilos () {

    wp_register_style( 'estilos_twitter', plugins_url('twitter.css', __FILE__), array(), '1.0', 'all' );
wp_enqueue_style( 'estilos_twitter' );


    }



    public function guardar_post($post_id)
    {
      //  esatus de guardado

      $is_revision = wp_is_post_revision( $post_id );
      $is_autosave = wp_is_post_autosave( $post_id );
      $is_valid_nonce = ( isset( $_POST[ 'hashtag_nonce' ] ) && wp_verify_nonce( $_POST[ 'hashtag_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

      // cancelacion dependiendo estatus basado en http://tommcfarlin.com/save-custom-post-meta-refactored/
      if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
          return;
      }

      // chequear valos de meta dato
      if( isset( $_POST[ 'meta-hashtag' ] ) ) {
          update_post_meta( $post_id, 'meta-hashtag', sanitize_text_field( $_POST[ 'meta-hashtag' ] ) );
      }



    }

    public function agregar_meta_boxes()
    {

      add_meta_box(
      "hashtag",
      __( 'HashTag relacionado con entrada', 'nota-hashtag-textdomain' ),
    	array(&$this, 'hashtag_callback'),
       "post"
        );
    }


/**
 * Visualizacion meta box
 */
   public function hashtag_callback($post) {
    wp_nonce_field( basename( __FILE__ ), 'hashtag_nonce' );
    $hashtag_stored_meta = get_post_meta( $post->ID );
    ?>

    <p>
        <label for="meta-text" class="hashtag-row-title"><?php _e( 'HashTag', 'nota-hashtag-textdomain' )?></label>
        <input type="text" name="meta-hashtag" id="meta-hashtag" value="<?php if ( isset (   $hashtag_stored_meta['meta-hashtag'] ) ) echo $hashtag_stored_meta['meta-hashtag'][0]; else {echo "#"; } ?>" />
    </p>

    <?php
}



  }





}

if(class_exists('Nota_Hashtag'))
{

  //instacia plugin

 $nota_hashtag = new Nota_Hashtag();
}
