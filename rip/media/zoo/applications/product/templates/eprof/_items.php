<?php
/**
* @package   ZOO Component
* @file      _items.php
* @version   2.0.0 May 2010
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2010 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>
<style type="text/css">
	div.pos-media{
		padding-left:3px !important;
		padding-right:3px !important;
		padding-top:2px !important;
		padding-bottom:2px !important;
		border:solid 1px #c8cbcd;
		margin-top:0px !important;
		margin-left:0px !important;
		margin-right:0px !important;
		margin-bottom:2px !important;
		background-color:#eeeff0;
		float:none !important;
	}
	div.pos-media a{
		margin:0px;
	}
	div.pos-description div{
		margin:0px !important;
	}
	div.pos-description div div p{
		font-size:11px;
		line-height:115% !important;
		margin: 4px 0px 0px 0px !important;
	}
	h2.pos-title{
		font-size:14px !important;
		line-height: 15px !important;
		margin: 0px 0px 0px 0px !important;
	}
	p.pos-links{
		color: #dd8604;
		font-weight: bold;
		margin: 5px 0px 0px 0px !important;
		border-top:1px dotted #c8cbcd;
		padding-top:4px;
	}
	a[rel=carrinho] {
	   background-image: url('images/carrinho.png');
	   background-repeat: no-repeat;
	   padding-left:20px;
	}
</style>
<div class="items <?php if ($itemstitle) echo 'has-box-title'; ?>">

	<?php if ($itemstitle) : ?>
	<h1 class="box-title"><span><span><?php echo $itemstitle; ?></span></span></h1>
	<?php endif; ?>

	<div class="box-t1">
		<div class="box-t2">
			<div class="box-t3"></div>
		</div>
	</div>
	
	<div class="box-1">
		<?php
		
			// init vars
			$i = 0;
			$columns = $this->params->get('template.items_cols', 2);
			reset($this->items);
			
			// render rows
			while((list($key, $item) = each($this->items)) || ($i % $columns != 0)) {
				if ($i % $columns == 0) echo ($i > 0 ? '</div><div class="row">' : '<div class="row first-row">');
				$first = ($i % $columns == 0) ? ' first-item' : null;
				echo '<div class="width'.intval(100 / $columns).$first.'">'.$this->partial('item', compact('item')).'</div>';
				$i++;
			}
			echo '</div>';

		?>
		
		<?php echo $this->partial('pagination'); ?>
		
	</div>

	<div class="box-b1">
		<div class="box-b2">
			<div class="box-b3"></div>
		</div>
	</div>										

</div>