<?php

    /*
    ***************************************************************************
        DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
        Version 1, December 2015

        Copyright (C) 2015 Christian Becher | phaziz.com <christian@phaziz.com>

        Everyone is permitted to copy and distribute verbatim or modified
        copies of this license document, and changing it is allowed as long
        as the name is changed.

        DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
        TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION

        0. YOU JUST DO WHAT THE FUCK YOU WANT TO!

	    +++ Visit http://phaziz.com +++
    ***************************************************************************
    */

	class EncodeAndVerify
	{
		public function encode($PASSWORD,$SALT,$COST = 6)
		{
			return password_hash($PASSWORD, PASSWORD_BCRYPT,
				array
				(
					'cost' => $COST,
					'salt' => $SALT
				)
			);
		}
	
		public function verify($PASSWORD,$HASHED)
		{
			if(password_verify($PASSWORD,$HASHED))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	$USERNAME 			= 'User';
	$PASSWORD 			= 'Password';
	$SALT 				= mcrypt_create_iv(22,MCRYPT_DEV_URANDOM);

	$ENCODER 			= new EncodeAndVerify();
	$USERNAME_ENCODED 	= $ENCODER -> encode($USERNAME, $SALT);
	$PASSWORD_ENCODED 	= $ENCODER -> encode($PASSWORD, $SALT);

?>
<!doctype html>
<html class="no-js" lang="en">
	    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Uh Oh &amp; Welcome!</title>
        <link rel="stylesheet" href="css/foundation.min.css">
        <script src="js/vendor/modernizr.js"></script>
        <style>
			h1{font-size: 1.5em;font-weight: 100;margin-top: 25px;margin-bottom: 25px;}
			h1.strngr{font-size: 1.5em;font-weight: 300;margin-top: 25px;margin-bottom: 25px;}
        </style>
    </head>
    <body>

		<div class="row">
			<div class="small-12 large-12 text-center columns"><h1 class="strngr">ENCODING &amp; TESTING SENSITIV HASHED USER DATA</h1></div>
		</div>
		<div class="row">
			<div class="small-12 large-3 columns"><div data-alert class="alert-box secondary">Username:</div></div>
			<div class="small-12 large-9 columns"><div data-alert class="alert-box secondary"><strong><?php echo $USERNAME; ?></strong></div></div>
		</div>
		<div class="row">
			<div class="small-12 large-3 columns"><div data-alert class="alert-box secondary">Password:</div></div>
			<div class="small-12 large-9 columns"><div data-alert class="alert-box secondary"><strong><?php echo $PASSWORD; ?></strong></div></div>
		</div>
		<div class="row">
			<div class="small-12 large-12 columns"><h1 class="strngr">ENCODED USER DATA</h1></div>
		</div>
		<div class="row">
			<div class="small-12 large-3 columns"><div data-alert class="alert-box secondary">Username:</div></div>
			<div class="small-12 large-9 columns"><div data-alert class="alert-box secondary"><?php echo $USERNAME_ENCODED; ?></div></div>
		</div>
		<div class="row">
			<div class="small-12 large-3 columns"><div data-alert class="alert-box secondary">Password:</div></div>
			<div class="small-12 large-9 columns"><div data-alert class="alert-box secondary"><?php echo $PASSWORD_ENCODED; ?></div></div>
		</div>
		<div class="row">
			<div class="small-12 large-12 columns"><h1 class="strngr">TEST EXPECTED TRUE</h1></div>
		</div>
		<div class="row">
			<div class="small-12 large-3 columns"><div data-alert class="alert-box secondary">Username <strong><?php echo $USERNAME; ?></strong>:</div></div>
			<div class="small-12 large-9 columns">
				<?php 
				
					if($ENCODER -> verify($USERNAME,$USERNAME_ENCODED))
					{
						echo '<div data-alert class="alert-box success">TRUE</div>';
					}
					else
					{
						echo '<div data-alert class="alert-box alert">FALSE</div>';
					}

				?>
			</div>
		</div>
		<div class="row">
			<div class="small-12 large-3 columns"><div data-alert class="alert-box secondary">Password <strong><?php echo $PASSWORD; ?></strong>:</div></div>
			<div class="small-12 large-9 columns">
				<?php 
				
					if($ENCODER -> verify($PASSWORD,$PASSWORD_ENCODED))
					{
						echo '<div data-alert class="alert-box success">TRUE</div>';
					}
					else
					{
						echo '<div data-alert class="alert-box alert">FALSE</div>';
					}

				?>
			</div>
		</div>
		<div class="row">
			<div class="small-12 large-12 columns"><h1 class="strngr">TEST EXPECTED FALSE</h1></div>
		</div>
		<div class="row">
			<div class="small-12 large-3 columns"><div data-alert class="alert-box secondary">Username <strong><?php echo $USERNAME . 'ErroR'; ?></strong>:</div></div>
			<div class="small-12 large-9 columns">
				<?php 
				
					if($ENCODER -> verify($USERNAME . 'ErroR', $USERNAME_ENCODED))
					{
						echo '<div data-alert class="alert-box success">TRUE</div>';
					}
					else
					{
						echo '<div data-alert class="alert-box alert">FALSE</div>';
					}

				?>
			</div>
		</div>
		<div class="row">
			<div class="small-12 large-3 columns"><div data-alert class="alert-box secondary">Password <strong><?php echo $PASSWORD . 'ErroR'; ?></strong>:</div></div>
			<div class="small-12 large-9 columns">
				<?php 
				
					if($ENCODER -> verify($PASSWORD . 'ErroR', $PASSWORD_ENCODED))
					{
						echo '<div data-alert class="alert-box success">TRUE</div>';
					}
					else
					{
						echo '<div data-alert class="alert-box alert">FALSE</div>';
					}

				?>
			</div>
		</div>

        <script src="js/vendor/jquery.js"></script>
        <script src="js/foundation.min.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>