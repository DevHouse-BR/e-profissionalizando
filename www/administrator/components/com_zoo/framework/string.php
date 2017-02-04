<?php
/**
* @package   ZOO Component
* @file      string.php
* @version   2.0.0 May 2010
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2010 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

class YString extends JString {
	
	public static function truncate($text, $length = 30, $truncate_string = '...') {
	
		if ($text == '') {
			return '';
		}

		if (self::strlen($text) > $length) {
			$length -= min($length, strlen($truncate_string));
			$text  = preg_replace('/\s+?(\S+)?$/', '', substr($text, 0, $length + 1));

			return self::substr($text, 0, $length) . $truncate_string;

		} else {
			return $text;
		} 
	} 

	
}