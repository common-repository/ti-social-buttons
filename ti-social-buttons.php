<?php 
/*
Plugin name: TI Social Buttons
Author: Ankit Tiwari
Version: 2.1
Description: A simple and minimal plugin to add faceboon and twitter buttons at the end of pages and posts
Author: Ankit Tiwari
Author URI: http://artofcoding.in.
*/

require_once 'inc/pages.php';
add_filter ( 'the_content', 'ti_social_buttons', 1 );

function ti_social_buttons( $content )
{
  $show_on_pages = get_option('ti_show_on_pages');
  $show_on_posts = get_option('ti_show_on_posts');
  $show_on_front = get_option('ti_show_on_front');

  if (is_page() && !$show_on_pages){
    return $content;
  }

  if (is_single() && !$show_on_posts){
    return $content;
  }

  if (is_front_page() && ! $show_on_front){
    return $content;
  }

  $url = get_permalink(get_queried_object_id());
	$twitter_html = '<div> <div style="float:left;position:relative;top:4px;margin-right:10px">';
	$twitter_html .= '<a href="https://twitter.com/share" class="twitter-share-button" data-via="techinceptum" data-related="techinceptum">Tweet</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script>';
  $twitter_html .= '</div>';
  $fb_html = '<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>';

$fb_html .= '<div class="fb-like" data-href="'.$url.'" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div></div>';

$fb_comment = '<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7&appId=363169884071553";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>
<div class="fb-comments" data-href="'.$url.'" data-numposts="5"></div>';
return $content . $twitter_html . $fb_html . $fb_comment;
}
