<?php
    //$html = file_get_html('http://www.nerkh.co/');//MMM1
    //foreach($html->find('td[id=MMM1]') as $e) 
    //echo $e->innertext . '<br>';
?>
<section class="container">
	<nav>
		<ul>
			<li id='reg'>Register</li>
			<li id='log'>LogIn</li>
			<li><a href="https://github.com/mahbube/greenwebTest" target="_blank">Fork me on GitHub</a></li>
			<div class="clear"></div>
		</ul>
	</nav>
	<div class="msg">
		<p><?php echo $err_log ; ?></p>
		<p><?php echo $err_reg ; ?></p>
	</div>
	<section class="content">
		<div class="form_container">
			<div class="login">
				<div class="ttl_form title">LogIn</div>
				<div class="form" >
					<form action="" method="post" onsubmit="return chkValidate(this)">
						<input type="text" name='us' placeholder="Username" class='us' onblur="return validate(this,'notEmpty','Enter Username','4')" />
						<span class="us_msg" ></span>
						<input type="password" name='ps' placeholder="Password" class='ps' onblur="return validate(this,'notEmpty','Enter Password','6')"/>
						<span class="ps_msg" ></span>
						<br/><input type="submit" name='login' value='LogIn' />
					</form>
				</div>
			</div>
			<div class="register">
				<div class="ttl_form title">Register</div>
				<div class="form">
					<form action="" method="post" onsubmit="return chkValidate(this)">
						<input type="text" name='us' placeholder="Username" class='usn' onblur="return validate(this,'notEmpty','Choose a Username by at least 4 character','4')"/>
						<span class="usn_msg" ></span>
						<input type="password" name='ps' placeholder="Password" class='psw' id='passConf'onblur="return validate(this,'notEmpty','Choose a Password by atleast 6 character','6')" />
						<span class="psw_msg" ></span>
						<input type="password" name='con_ps' placeholder="Confirm Password" class='copsw' onblur="return validate(this,'confirm','Dont matche','6','12' ,'passConf')" />
						<span class="copsw_msg" ></span>
						<input type="email" name='email' placeholder="Email"  class='mail' onblur="return validate(this,'email','Enter a valid email','3')"/>
						<span class="mail_msg" ></span>
						<br/><input type="submit" value='Register' name='register' id='reg_submit'>						
					</form>
				</div>
			</div>
		</div>
	</section>
</section>