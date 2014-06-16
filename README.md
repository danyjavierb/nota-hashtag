nota-hashtag
============

Plugin para agregar un hashtag de twitter a una entrada de wordpress y ver los 20 últimos twits en la vista de la entrada.

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

Instrucciones:

Instalar, agregar en lugar deseado de la plantilla de post individual:

	<div data-type="hashtag" data-ruta="<?php echo plugins_url("nota-hashtag"); ?>" data-rel="<?php echo  get_post_meta($post->ID, "meta-hashtag", true);?>"  ><?php echo  get_post_meta($post->ID, "meta-hashtag", true);?></div>
