<?php

// View funcs ....

defined('ACCESS') or die('Restricted access !');

function send($data){
	echo $data;
}

function death($data){
	if(strlen($data)>0) send($data);
	die();
}

function go2url($url){
	header("Location: $url");
	death();
}

/*generate general list of cost */
function genarate_list_cost($arr){
	$html="<div class='list'>
				<table>
					<tr class='ttl_tbl'>
						<td>Cost</td>
						<td>Date</td>
						<td>Time</td>
					</tr>";
	
	foreach($arr as $list){
		// if($list['date']>'2013-02-25') $a='ok';
		// else $a='nok';
		$html.="<tr>
					<td>$list[cost]</td>
					<td>$list[date]</td>
					<td>$list[time]</td>
				</tr>";
	}
	
	$html.='</table></<div>';

	return $html;
}
/*generate form tu make uptional list */
function generate_form_list($arr){
	foreach ($arr as $list) {
		$options.="<option>$list[date]</option>" ;
	}
	$html.="<div class='myform'>
				<form action='' method='post'>
					<p class=title>show list </p>
					from:<select name='start'>$options</select> to now
					<p class='center'><input type='submit' name='opt_list' value='show info' /></p>
			</form></div><br/>";
	return $html ;
}
