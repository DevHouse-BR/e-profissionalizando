<?php
/**
* @package   ZOO Component
* @file      _items.php
* @version   2.0.3 July 2010
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2010 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
				
// init vars
$i       = 0;
$columns = array();
$column  = 0;
$row     = 0;
$rows    = ceil(count($this->items) / $this->params->get('template.items_cols'));

// create columns
foreach($this->items as $item) {

	if ($this->params->get('template.items_order')) {
		// order down
		if ($row >= $rows) {
			$column++;
			$row  = 0;
			$rows = ceil((count($this->items) - $i) / ($this->params->get('template.items_cols') - $column));
		}
		$row++;
		$i++;
	} else {
		// order across
		$column = $i++ % $this->params->get('template.items_cols');
	}

	if (!isset($columns[$column])) {
		$columns[$column] = '';
	}

	$columns[$column] .= $this->partial('item', compact('item'));
}

// render columns
$count = count($columns);
if ($count) {
	echo '<div class="items items-col-'.$count.'">';
	for ($j = 0; $j < $count; $j++) {
		$first = ($j == 0) ? ' first' : null;
		$last  = ($j == $count - 1) ? ' last' : null;
		echo '<div class="width'.intval(100 / $count).$first.$last.'">'.$columns[$j].'</div>';
	}
	echo '</div>';
}

// render pagination
echo $this->partial('pagination');