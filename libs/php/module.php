<?php

// Module funcs ....

defined('ACCESS') or die('Restricted access !');

require_once('db.php');
require_once('simple_html_dom.php');


$cache =  new Cache_Lite($cache_options);
$cache_id = str_replace('/','%',$_SERVER['REQUEST_URI']);

function initilize(){
	global $caching_enabled;
	session_start();
	send_header();
	ob_start();
	
	db_connect();
}

function send_header(){
	global $filetype;
	
	header ( 'Cache-Control: public' );
	header ( 'Pragma: public' );
	header_remove ( 'Expires' );
	
	if($filetype=='css'){
		header('Content-Type: text/css');
	}elseif($filetype=='js'){
		header('Content-Type: text/javascript');
	}else{
		header('Content-Type: text/html');
	}
}

function check_cache(){
	global $cache;
	global $cache_id;
	global $caching_enabled;
	
	if(!$caching_enabled) return false;
	
	if( $contents = $cache->get($cache_id) ){
		send($contents);
		finilize(false);
	}
}

function compress($contents,$compress_level=9){
	global $cache;
	global $cache_id;
	global $gzip_enabled;
	global $caching_enabled;
	
	
	if(!$gzip_enabled) return $contents;
	
	if (substr_count ( $_SERVER ['HTTP_ACCEPT_ENCODING'], 'deflate' )) {
		header ( "Content-Encoding: deflate" );
		$cache_newid=$cache_id.'deflate';
		if($caching_enabled && $data=$cache->get($cache_newid)){
			return $data;
		}else{
			$data = gzdeflate ( $contents, $compress_level );
			$cache->save($data);
			return $data;
		}
	} elseif (substr_count ( $_SERVER ['HTTP_ACCEPT_ENCODING'], 'gzip' )) {
		header ( "Content-Encoding: gzip" );
		$cache_newid=$cache_id.'gzip';
		if($caching_enabled && $data=$cache->get($cache_newid)){
			return $data;
		}else{
			$data = gzencode ( $contents, $compress_level );
			$cache->save($data);
			return $data;
		}
	}else{
		return $contents;
	}
}

function check_midified($contents){
	$etag = md5 ( $contents );
	if (trim ( $_SERVER ['HTTP_IF_NONE_MATCH'] ) == $etag) { // agare etag ghabli ba jadide barabar bood
		header ( "HTTP/1.1 304 Not Modified" );
		death ();
	}else{
		header("Etag: $etag");
	}
}

/*register */
function reg_user($us,$ps,$email){
	$insert=true ;
	$pass=md5($ps);
	$chk_us=db_get_rows('users'," username='$us' AND password='$pass' ") ;
	if($chk_us) {
		$msg='This Username & Password is repeated,PLZ choose sth else';
		$insert=false ;
	}
	$chk_em=db_get_rows('users'," email='$email' ") ;
	if($chk_em){
		$msg .='This Email Adress is repeated, so u registered befor';
		$insert=false ;
	}
	if($insert){
		db_query("INSERT INTO users VALUES('','$us','$pass','$email')");
		$msg='Register Succesfully. Now LogIn';
	}
	return $msg ;
}
/* login */
function checklogin(){
	if($_SESSION['login']==1){
		return true ;
	}else{
		return false ;
	}
}

function dologout(){
	//$_SESSION['login']=0;
	//$_SESSION = array();
	unset($_SESSION);
	//setcookie(session_name(),'',-1);
	session_destroy();
}


function dologin(){	
	$_SESSION['login']=1;
}

function login_user($us,$ps){
	$pass=md5($ps);
	$chk=db_get_rows('users'," username='$us' AND password='$pass' ") ;
	if( $chk ){
		dologin();
		return true;
	}	
	return false;
}
/*end logim */
/* get info */
function getInfo(){
	$date=date('y-m-d');
	$time=date("G:i:s");
	$source_site = file_get_html('http://www.nerkh.co/');
	foreach($source_site->find('td[id=MMM1]') as $element) 
			$cost=$element->innertext ;
	$slct=db_get_rows('gold',"id=(SELECT MAX(id) FROM gold)");
	if($slct){
		foreach ($slct as $value) {
			if($value['cost'] != $cost )	db_query("INSERT INTO gold VALUES('','$cost','$date','$time')") ;
		}
	}else 	db_query("INSERT INTO gold VALUES('','$cost','$date','$time')") ;// insert 1st rows
}
/* end get info */
function finilize($cacheing=true){
	global $cache;
	global $caching_enabled;
	//database close
	// gzip ..
	$contents = ob_get_clean ();
	
	db_close();
	
	if($caching_enabled && $cacheing) $cache->save($contents);

	check_midified($contents);

	$contents = compress($contents);
	
	$len = strlen ( $contents );
	header ( "Content-length: $len" );

	death($contents);
	
}