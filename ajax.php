<?php
$url_r = explode( '?', $_POST['url'] );
$sites_html = file_get_contents($url_r[0]);
$html = new DOMDocument();
@$html->loadHTML($sites_html);
$src = null;
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
	        $src = $meta->getAttribute('content');
	    }
	    if( $meta->getAttribute('name')=='medium' && $meta->getAttribute('content')=='video' ) {
	    	$flag = true;
	    }
		//If the property attribute of the meta tag is og:video
	    if( $meta->getAttribute('property')=='og:video' && $flag ) { 
	        //Assign the value from content attribute to $meta_og_video
	        $src = $meta->getAttribute('content');
	        break;
	    }
	}
}
echo json_encode(["private" => $pvt , "source" => $src]);