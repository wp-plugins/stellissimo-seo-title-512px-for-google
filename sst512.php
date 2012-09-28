<?php
/*
Plugin Name: Stellissimo SEO Title 512px for Google
Plugin URI: http://www.stellissimoseo.com
Description: Measure the width of the title in pixel and display all the title in the Google's Serp, for very SEO title.
Author: Daniele Della Corte
Version: 1.0
Author URI: http://www.stellissimoseo.com
License: GPL v3

Stellissimo SEO Title 512px for Google
Copyright (C) 2012, Daniele Della Corte - info@marketingseoagency.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * Chiamo la classe 
 */
function call_SST512() 
{
    return new SST512();
}
if ( is_admin() )
    add_action( 'load-post.php', 'call_SST512' );

/** 
 * La classe non è acqua :)
 */
class SST512
{
    const LANG = 'sst512_textdomain';

    public function __construct()
    {
        add_action( 'add_meta_boxes', array( &$this, 'add_sst512_meta_box' ) );
    }

    /**
     * Il meta box generale per pagine e articoli
     */
    public function add_sst512_meta_box()
    {
        add_meta_box( 
             'sst512_meta_box_name'
            ,__( 'Stellissimo SEO Title 512px', self::LANG )
            ,array( &$this, 'render_meta_box_content' )
            ,'post' 
            ,'advanced'
            ,'high'
        );
  
        add_meta_box( 
             'sst512_meta_box_name'
            ,__( 'Stellissimo SEO Title 512px', self::LANG )
            ,array( &$this, 'render_meta_box_content' )
            ,'page' 
            ,'advanced'
            ,'high'
        );
    }

    /**
     * Il box che contiene il risultato finale. Prendo il titolo dell'articolo o della pagina e attraverso lo script misuro la lunghezza in pixel.
     */
    public function render_meta_box_content() 
    {
     		$title = get_the_title($post->post_title);
	        
        echo  '<canvas id="myCanvas" width="512" height="150">
Il tuo browser non supporta il tag canvas HTML5.</canvas>
<p>Nei risultati di Google, ovvero in serp, vengono mostrati solo i primi 512px del title della tua pagina web, ottimizzalo al meglio controllando che non superi tale valore.</p> 
<script type="text/javascript">
	var c=document.getElementById("myCanvas");
	var ctx=c.getContext("2d");
	ctx.font="medium Arial";
	var txt="'.$title.'"
	ctx.fillText("Lunghezza in pixel: " + ctx.measureText(txt).width,10,50);
	ctx.fillText(txt,10,100);
</script>';
    }
}
?>