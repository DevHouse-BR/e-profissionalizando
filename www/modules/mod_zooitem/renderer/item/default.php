<?php
/**
* @package   ZOO Item Module
* @file      default.php
* @version   2.0.0 May 2010
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2010 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$media_position = $params->get('media_position', 'top');

$menu_item = $params->get('menu_item', 0)

?>

<?php if (($media_position == 'top' || $media_position == 'left' || $media_position == 'right') && $this->checkPosition('media')) : ?>
<div class="media media-<?php echo $media_position; ?>">
	<?php echo $this->renderPosition('media', array('menu_item' => $menu_item)); ?>
</div>
<?php endif; ?>

<h3 class="title"><a href="<?php echo JRoute::_($item->href); ?>"><?php echo $item->name; ?></a></h3>

<?php if ($this->checkPosition('meta')) : ?>
<p class="meta">
	<?php echo $this->renderPosition('meta', array('menu_item' => $menu_item)); ?>
</p>
<?php endif; ?>

<?php if (($media_position == 'middle') && $this->checkPosition('media')) : ?>
<div class="media media-<?php echo $media_position; ?>">
	<?php echo $this->renderPosition('media', array('menu_item' => $menu_item)); ?>
</div>
<?php endif; ?>

<?php if ($this->checkPosition('description')) : ?>
<div class="description">
	<?php echo $this->renderPosition('description', array('menu_item' => $menu_item)); ?>
</div>
<?php endif; ?>

<?php if (($media_position == 'bottom') && $this->checkPosition('media')) : ?>
<div class="media media-<?php echo $media_position; ?>">
	<?php echo $this->renderPosition('media', array('menu_item' => $menu_item)); ?>
</div>
<?php endif; ?>