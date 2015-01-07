# HashSensitiveUserDateAndVerify

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

	$USERNAME = 'User';
	$PASSWORD = 'Password';
	$SALT = mcrypt_create_iv(22,MCRYPT_DEV_URANDOM);

	$ENCODER = new EncodeAndVerify();
	$USERNAME_ENCODED = $ENCODER -> encode($USERNAME, $SALT);
	$PASSWORD_ENCODED = $ENCODER -> encode($PASSWORD, $SALT);
