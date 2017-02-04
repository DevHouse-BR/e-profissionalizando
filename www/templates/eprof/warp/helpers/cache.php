<?php
/**
* @package   Warp Theme Framework
* @file      cache.php
* @version   5.5.0
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2010 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

/*
	Class: WarpHelperCache
		Cache helper class, combines css/js files
*/
class WarpHelperCache extends WarpHelper {
    
	/*
		Function: processStylesheets
			Combine multiple stylesheets to a cache file

		Parameters:
			$stylesheets - Stylesheet files

		Returns:
			Mixed
	*/	
	function processStylesheets($stylesheets, $compress_mode = 1) {

		// get cache
		$path   =& $this->getHelper('path');
		$system =& $this->getHelper('system');
		$cache  = new WarpCacheStylesheets($system);
		$result = $cache->process($stylesheets, $compress_mode);

		if ($result && $result['new']) {

			// compress cached stylesheet
			$compressor = $this->getHelper('stylecompressor');
			$content = $compressor->process(file_get_contents($result['file']));
			file_put_contents($result['file'], $content);

			// copy gzip file
			copy($path->path('warp:gzip/css.php'), $cache->cache_path.'/css.php');
		}
		
		return $result['urls'];
	}

	/*
		Function: processJavascripts
			Combine multiple javascripts to a cache file

		Parameters:
			$javascripts - Javascript files

		Returns:
			Mixed
	*/	
	function processJavascripts($javascripts, $compress_mode = 1) {

		// get cache
		$path   = $this->getHelper('path');
		$system = $this->getHelper('system');
		$cache  = new WarpCacheJavascripts($system);
		$result = $cache->process($javascripts, $compress_mode);
		
		if ($result && $result['new']) {
      
			// compress cached javascript
			$compressor = $this->getHelper('scriptcompressor');
			$content = $compressor->process(file_get_contents($result['file']));
			file_put_contents($result['file'], $content);

			// copy gzip file
			copy($path->path('warp:gzip/js.php'), $cache->cache_path.'/js.php');
		}
						
		return $result['urls'];
	}

}

class WarpCache extends WarpObject {

	/* base path */
	var $base_path;

	/* base url */
	var $base_url;

	/* cache path */
	var $cache_path;

	/* cache time */
	var $cache_time;

	/* cache file name */
	var $cache_name;

	/* cache gzip name */
	var $cache_gzip;
	
	/* system */
	var $system;

	function __construct(&$system) {

		// init vars
		$this->base_path  = $system->path;
		$this->base_url   = $system->url;		
		$this->cache_path = $system->cache_path;
		$this->cache_time = $system->cache_time;
		
		$this->system     =& $system;
	}

	function process($files, $compress_mode = 1) {
        
		// init vars
		$urls  		= array();
		$files 		= $this->_getFiles($files);
		
		$cache_id   = md5(implode(';', $files['cache']));
		$cache_file = $this->cache_path.'/'.sprintf($this->cache_name, $cache_id);
		$cache_url  = str_replace('\\', '/', str_replace($this->base_path, '', $cache_file));
		$cache_gzip = str_replace('\\', '/', str_replace($this->base_path, '', $this->cache_path.'/'.sprintf($this->cache_gzip, $cache_id)));
		$cache_new  = false;

		// set cache true, if cache file already exists
		$cache = is_file($cache_file) && (time() - filemtime($cache_file)) < $this->cache_time;

		// process files and create cache, if cache does not exists
		if (!$cache) {
			if (count($files['cache'])) {
				// create cache directory
				$this->_createDirectory($this->cache_path);

				// build cache file
				$cache = $this->_buildCache($files['cache'], $cache_file);
				$cache_new = true;
			}
		}
		
		if (count($files['nocache'])) {
			foreach($files['nocache'] as $f=>$p) $urls[] = $f;
		}
								
		$urls[] = $this->system->warp->path->url("site:".($compress_mode == 2 ? $cache_gzip : $cache_url));
		
		// return cache id, url and file
		if ($cache) {
			return array('file' => $cache_file, 'new' => $cache_new, 'urls' => $urls);
		}

		return null;
	}
	
	function _buildCache($files, $cache_file) {

		// init vars
		$data = '';

		// get file data
		foreach ($files as $file => $filepath) {
			$data .= file_get_contents($filepath)."\n\n"; 
		}
		
	    // create cache file
	    return file_put_contents($cache_file, $data);
	}
	
	function _getFiles($files) {
        
		// init vars
		$array   = array('cache'=>array(),'nocache'=>array());
		$pattern = '/^.*'.str_replace('/', '\/', $this->base_url).'(.*)/';
		
		foreach ($files as $file) {

			// get files real path in filesystem
			if ($this->base_url && preg_match($pattern, $file, $matches) > 0) {
				$path = $this->base_path.$matches[1];
			} else {
				$path = $this->base_path.$file;
			}

			// add to array, if file exists
			$array[(is_file($path) ? 'cache':'nocache')][$file] = $path;
		}

		return $array;
	}
	
	function _createDirectory($path, $mode = 0755, $recursive = true) {

		// compatibility for PHP4
		if (version_compare(PHP_VERSION, '5.0', '<')) {

			if ($recursive) {
				is_dir(dirname($path)) || $this->_createDirectory(dirname($path), $mode, $recursive);
			}

		    return is_dir($path) || @mkdir($path, $mode);
		}
		
	    return is_dir($path) || @mkdir($path, $mode, $recursive);
	}

}

class WarpCacheStylesheets extends WarpCache {
	
	function __construct($system) {
		parent::__construct($system);

		// init vars
		$this->cache_name = 'css-%s.css';
		$this->cache_gzip = 'css.php?id=%s';

	}

	function _buildCache($files, $cache_file) {

		// init vars
		$data  = '';

		// get stylesheet data
		foreach ($files as $file => $filepath) {
			$contents = WarpCacheStylesheets::_loadFile($filepath, false);

			// return the path to where this CSS file originated from
			WarpCacheStylesheets::_buildPath(null, dirname($file).'/');

			// prefix all paths within this CSS file, ignoring external and absolute paths
			$data .= preg_replace_callback('/url\([\'"]?(?![a-z]+:|\/+)([^\'")]+)[\'"]?\)/i', array('WarpCacheStylesheets', '_buildPath'), $contents);
		}

	    // move @import rules to the top
	    $regexp = '/@import[^;]+;/i';
	    preg_match_all($regexp, $data, $matches);
	    $data = preg_replace($regexp, '', $data);
	    $data = implode('', $matches[0]) . $data;

	    // create cache file
	    return file_put_contents($cache_file, $data);
	}

	function _buildPath($matches, $base = null) {
		static $_base;

		// store base path for preg_replace_callback
		if (isset($base)) {
			$_base = $base;
		}

		// prefix with base and remove '../' segments where possible
		$path = $_base.$matches[1];

		$last = '';
		while ($path != $last) {
			$last = $path;
			$path = preg_replace('`(^|/)(?!\.\./)([^/]+)/\.\./`', '$1', $path);
		}
		
		return 'url('. $path .')';
	}

	function _loadFile($file) {
		$contents = null;

		if (file_exists($file)) {
			// load the local CSS stylesheet
			$contents = file_get_contents($file); 

			// change to the current stylesheet's directory
			$cwd = getcwd();
			chdir(dirname($file));

			// replaces @import commands with the actual stylesheet content
			// this happens recursively but omits external files
			$contents = preg_replace_callback('/@import\s*(?:url\()?[\'"]?(?![a-z]+:)([^\'"\()]+)[\'"]?\)?;/', array('WarpCacheStylesheets', '_loadFileRecursive'), $contents);

			// remove multiple charset declarations for standards compliance (and fixing Safari problems)
			$contents = preg_replace('/^@charset\s+[\'"](\S*)\b[\'"];/i', '', $contents);

			// change back directory.
			chdir($cwd);
		}

		return $contents;
	}

	function _loadFileRecursive($matches) {
		$filename = $matches[1];

		// load the imported stylesheet and replace @import commands in there as well
		$file = WarpCacheStylesheets::_loadFile($filename);

		// if not current directory, alter all url() paths, but not external
		if (dirname($filename) != '.') {
			$file = preg_replace('/url\([\'"]?(?![a-z]+:|\/+)([^\'")]+)[\'"]?\)/i', 'url('.dirname($filename).'/\1)', $file);	
		}
		
		return $file;
	}	

}

class WarpCacheJavascripts extends WarpCache {
	
	function __construct($system) {
		parent::__construct($system);

		// init vars
		$this->cache_name = 'js-%s.js';
		$this->cache_gzip = 'js.php?id=%s';
	
	}

}