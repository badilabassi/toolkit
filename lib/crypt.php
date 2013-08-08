<?php

namespace Kirby\Toolkit;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * Crypt
 * 
 * Encodes and decodes strings with different encryption methods
 * 
 * @package   Kirby Toolkit 
 * @author    Bastian Allgeier <bastian@getkirby.com>, Arno Richter <oelna@oelna.de>
 * @link      http://getkirby.com
 * @copyright Bastian Allgeier, Arno Richter
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Crypt {
	
	// all available encryption modes
	static public $encryption = array(
		'rijndael-128',
		'rijndael-256',
		'blowfish',
		'twofish',
		'des'
	);

	/**
	 * Encodes a string
	 * 
	 * @param string $text
	 * @param string $key An optional encryption key
	 * @param string $mode Check out the $encryption array for available modes
	 * @return string
	 */
	static public function encode($text, $key = null, $mode = 'blowfish') {

		// check for mcrypt support
		if(!function_exists('mcrypt_get_iv_size')) raise('The mcrypt extension is missing');

		// all modes are lowercase so we try to avoid errors here
		$mode = strtolower($mode);

		// check for a valid encryption mode
		if(!in_array($mode, static::$encryption))   raise('Invalid encryption mode: ' . $mode);

		$size   = mcrypt_get_iv_size($mode, MCRYPT_MODE_ECB);
		$iv     = mcrypt_create_iv($size, MCRYPT_RAND);
		$result = mcrypt_encrypt($mode, c::get('crypt.salt', '-') . $key, $text, MCRYPT_MODE_ECB, $iv);
		
		return trim($result);

	}

	/**
	 * Decodes a string
	 * 
	 * @param string $text
	 * @param string $key An optional encryption key
	 * @param string $mode Check out the $encryption array for available modes
	 * @return string
	 */
	static public function decode($text, $key = null, $mode = 'blowfish') {

		// check for mcrypt support
		if(!function_exists('mcrypt_get_iv_size')) raise('The mcrypt extension is missing');

		// all modes are lowercase so we try to avoid errors here
		$mode = strtolower($mode);

		// check for a valid encryption mode
		if(!in_array($mode, static::$encryption)) raise('Invalid encryption mode: ' . $mode);

		$size   = mcrypt_get_iv_size($mode, MCRYPT_MODE_ECB);
		$iv     = mcrypt_create_iv($size, MCRYPT_RAND);
		$result = mcrypt_decrypt($mode, c::get('crypt.salt', '-') . $key, $text, MCRYPT_MODE_ECB, $iv);
		
		return trim($result);

	}

}