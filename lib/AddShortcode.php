
<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

require_once('Shortcode.php');

/**
 * 注册短代码
 */

//[link-item]
function shortcode_linkitem($atts, $content = '') {
    $args = shortcode_atts( array(
        'href' => '',
        'title' => '',
        'img' => '',
        'name' => '',
    ), $atts );

    return '<a href="'.$args['href'].'" title="'.$args['title'].'" target="_blank"><div class="link-item"><img class="link-avatar" src="'.$args['img'].'"><span class="link-name">'.$args['name'].'</span></div></a>';
}
add_shortcode('link-item', 'shortcode_linkitem');

function parseShortcode($content) {
    return do_shortcode($content);
}
