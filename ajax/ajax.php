<?php
$post_url = $_POST['url'];
$new_url = null;
$parsed = parse_url( $post_url );
if ( empty( $parsed['scheme'] ) && empty( $parsed['host'] ) ) {
    $new_url = 'https://' . $parsed['path'];
} elseif ( empty( $parsed['scheme'] ) ) {
    // $new_url = 'https://' . ltrim( $new_url, '/' );
    $new_url = 'https://' . $parsed['host'] . $parsed['path'];
}
if ( !empty( $parsed['query'] ) ) {
	$new_url = rtrim( $new_url, '?'.$parsed['query'] );
}

// if parse_url fails
if ( !$new_url ) {
	$url_r = explode( '?', $post_url );
	$new_url = $url_r[0];
}

$json = null;
$new_url2 = rtrim( $new_url, '/' ). "/?__a=1";
$json = file_get_contents($new_url2);

if ( !$json ) {
	$sites_html = file_get_contents($new_url);
	$html = new DOMDocument();
	@$html->loadHTML($sites_html);
	$img_src = null;
	$video_src = null;
	$flag = true;
	$pvt = 0;
	if ( $html->getElementsByTagName('title') == 'Instagram' ) {
		$pvt = 1;
	} else {
		//Get all meta tags and loop through them.
		foreach( $html->getElementsByTagName('meta') as $meta ) {
		    //If the property attribute of the meta tag is og:image
		    if( $meta->getAttribute('property')=='og:image' ) { 
		        //Assign the value from content attribute to $meta_og_image
		        $img_src = $meta->getAttribute('content');
		    }
		    if( $meta->getAttribute('name')=='medium' && $meta->getAttribute('content')=='video' ) {
		    	$flag = true;
		    }
			//If the property attribute of the meta tag is og:video
		    if( $meta->getAttribute('property')=='og:video' && $flag ) {
		        //Assign the value from content attribute to $meta_og_video
		        $video_src = $meta->getAttribute('content');
		        break;
		    }
		}
	}
	if ( $video_src ) {
		echo json_encode( ["check" => false , "instagram" => [ "media" => [ "private" => $pvt , "video_url" => $video_src , "display_src" => $img_src ] ] ] );
	} else {
		echo json_encode( ["check" => false , "instagram" => [ "media" => [ "private" => $pvt , "display_src" => $img_src ] ] ] );
	}
} else {
	echo '{"check": true, "instagram": '.$json.'}';
}