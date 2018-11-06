<?php
function hmac($key, $data, $hash = 'md5', $blocksize = 64)
{
	if (strlen($key)>$blocksize)
	{
	  $key = pack('H*', $hash($key));
	}
	$key  = str_pad($key, $blocksize, chr(0));
	$ipad = str_repeat(chr(0x36), $blocksize);
	$opad = str_repeat(chr(0x5c), $blocksize);
	return $hash(($key^$opad) . pack('H*', $hash(($key^$ipad) . $data)));
}


function pw_encode($password)
{
  $seed = substr('00' . dechex(mt_rand()), -3) .
  substr('00' . dechex(mt_rand()), -3) .
  substr('0' . dechex(mt_rand()), -2);
  return hmac($seed, $password, 'md5', 64) . $seed;
}


function pw_check($password, $stored_value)
{
  $seed = substr($stored_value, 32, 8);
  return hmac($seed, $password, 'md5', 64) . $seed==$stored_value;
}?>
