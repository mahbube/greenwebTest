<?php

// Main site controller and algorithm ....

defined('ACCESS') or die('Restricted access !');

require_once('Cache/Lite.php');
require_once('module.php');
require_once('view.php');

$req = $_GET['req'];
if($req=='') go2url( SITE_PATH.'home.html');

$filename=strtolower( $_GET['filename'] );
$filetype=strtolower( $_GET['filetype'] );

initilize();

$page_title = ucwords( str_replace('-',' ',$req) );


/****************** register user ****************/ 
if( isset($_POST['register']) ){
	$caching_enabled=false;
	if( strlen($_POST['us'])>3 && strlen($_POST['ps'])>5 && strlen($_POST['email'])>5 && strlen($_POST['con_ps'])>5 && $_POST['ps']==$_POST['con_ps']){
		$err_reg=reg_user($_POST['us'],$_POST['ps'],$_POST['email']);
	}else{
		$err_reg = "Error in data validation";
	}
	
}
/******************* end register ******************/
/******************* login *************************/
if( isset($_POST['login']) ){
	$caching_enabled=false;
	if( strlen($_POST['us'])>3 && strlen($_POST['ps'])>5 ){
		$us=mysql_real_escape_string($_POST['us']);
		$ps=mysql_real_escape_string($_POST['ps']);
		$log_done=login_user($us,$ps);
		if(!$log_done) 	$err_log="Invalid Username & Password" ;
		else 	go2url( SITE_PATH.'internal/general.html');
	}else{
		$err_log = "Error in data validation";
	}
	
}
/***************** end login ***********************/
/***************** gen optional list **************/
if(isset($_POST['opt_list'])){
	$st=$_POST['start'];
	$mylist_arr=db_get_rows('gold',"date >= '$st'");
	$mylist_cost.=genarate_list_cost($mylist_arr);
}
/***************** end gen optional list **************/
check_cache();

if($req=='file'){
	if( $file = @file_get_contents("./libs/$filetype/$filename.$filetype") ){
		send($file);
		finilize();
	}else{
		$req = '404er';
		header('Content-Type: text/html');
	}
	
}elseif($req=='internal'){
	if(!checklogin())	go2url( SITE_PATH.'home.html');
	else{
		if($_GET['list']=='general'){
			getInfo();
			$data_arr=db_get_rows('gold');
			$list_cost=genarate_list_cost($data_arr);
		}elseif($_GET['list']=='optional'){
			$data_arr=db_get_rows('gold','1','date','GROUP BY date');
			$list_cost=generate_form_list($data_arr);
		}
	}

}elseif($req=='logout'){
	dologout();
	go2url( SITE_PATH.'home.html');
}
include('template.php');

finilize();
