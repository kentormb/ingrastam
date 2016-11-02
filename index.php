<?php

// session_start();

// $config['site']['debug_mode'] = 0;
// include("library/params.php");
// $db->execute("set names 'UTF8'");

if(isset($_GET['p']) && $_GET['p'] != ''){
    $p = $_GET['p'];
}
else{
    $p = 'home';
}

if(file_exists("template/prerender/$p.php")){
    include_once( "template/prerender/$p.php" );
}
// else{
//     include_once( 'template/prerender/home.php' );
// }

include_once( "template/header.php" );

if(file_exists('template/body/'.$p.'.php')){
    include_once( 'template/body/'.$p.'.php' );
}
else{
    include_once( 'template/body/404.php' );
}

include_once( "template/footer.php" );

?>