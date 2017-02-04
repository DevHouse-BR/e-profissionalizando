<?php
/**
* @package   ZOO Component
* @file      item.php
* @version   2.0.0 May 2010
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2010 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// include assets css/js
if (strtolower(substr($GLOBALS['mainframe']->getTemplate(), 0, 3)) != 'yoo') {
	JHTML::stylesheet('reset.css', 'media/zoo/assets/css/');
}
JHTML::stylesheet('zoo.css.php', $this->template->getURI().'/assets/css/');

$css_class = $this->application->getGroup().'-'.$this->template->name;

?>

<div id="yoo-zoo" class="yoo-zoo <?php echo $css_class; ?> <?php echo $css_class.'-'.$this->item->alias; ?>">

	<?php if ($this->item->type == 'author') : ?>
		<div class="author"><?php echo $this->renderer->render('item.author.full', array('view' => $this, 'item' => $this->item)); ?></div>
	<?php else: ?>
		<div class="item"><?php echo $this->renderer->render('item.full', array('view' => $this, 'item' => $this->item)); ?></div>
	<?php endif; ?>

</div>