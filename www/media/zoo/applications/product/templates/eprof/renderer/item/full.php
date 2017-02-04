<?php
/**
* @package   ZOO Component
* @file      full.php
* @version   2.0.0 May 2010
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2010 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>


<style type="text/css">
	.yoo-zoo img {
		float: left;
		margin-right: 10px;
		margin-bottom: 6px;
	}
	div.pos-specification ul{
		class="checkbox"
	}
</style>
<script type="text/javascript">	
	/* Load Event fires when the whole page is loaded, included all images */
	window.addEvent('domready', function() {
		var el = $E('div.pos-description div.element-text');
		el.innerHTML = '<h3 style="color: #ea8603">' + el.innerHTML.replace('<h3>', '').replace('</h3>', ' ') + '</h3>';
		
		el = $E('div.pos-description').getChildren();
		el[2].innerHTML = '<span style="font-weight:bold; color: green">' + el[2].innerHTML + '</span><div style="clear:both"></div>';
		
		el = $E('div.pos-specification ul').className = 'checkbox';
		
		/*var total = $time() - startTime;
		$('log_res').innerHTML += '<p class="result"><strong>Load</strong> has now finished loading the whole page, including all images. <br /> Loading process took <strong>' + total + '</strong>ms.</p>';*/
	});
</script>



<?php if ($this->checkPosition('top')) : ?>
<div class="pos-top">

	<div class="box-t1">
		<div class="box-t2">
			<div class="box-t3"></div>
		</div>
	</div>
	
	<div class="box-1">
		<?php echo $this->renderPosition('top', array('style' => 'block')); ?>
	</div>
	
	<div class="box-b1">
		<div class="box-b2">
			<div class="box-b3"></div>
		</div>
	</div>

</div>
<?php endif; ?>

<div class="floatbox">

	<div class="box-t1">
		<div class="box-t2">
			<div class="box-t3"></div>
		</div>
	</div>
	
	<div class="box-1">

		<?php if ($this->checkPosition('media')) : ?>
		<div class="pos-media <?php echo 'media-'.$view->params->get('template.item_media_alignment'); ?>">
			<?php echo $this->renderPosition('media', array('style' => 'block')); ?>
		</div>
		<?php endif; ?>
	
		<?php if ($this->checkPosition('title')) : ?>
		<h1 class="pos-title"><?php echo $this->renderPosition('title'); ?></h1>
		<?php endif; ?>
	
		<?php if ($this->checkPosition('description')) : ?>
		<div class="pos-description">
			<?php echo $this->renderPosition('description', array('style' => 'block')); ?>
		</div>
		<?php endif; ?>
	
		<?php if ($this->checkPosition('specification')) : ?>
		<div class="pos-specification">
			<h3><?php echo JText::_('Specifications'); ?></h3>
			<ul>
				<?php echo $this->renderPosition('specification', array('style' => 'list')); ?>
			</ul>
		</div>
		<?php endif; ?>
	
		<?php if ($this->checkPosition('bottom')) : ?>
		<div class="pos-bottom">
			<?php echo $this->renderPosition('bottom', array('style' => 'block')); ?>
		</div>
		<?php endif; ?>
		
		<?php if ($this->checkPosition('related')) : ?>
		<div class="pos-related">
			<?php echo $this->renderPosition('related', array('style' => 'block')); ?>
		</div>
		<?php endif; ?>
	
	</div>
	
	<div class="box-b1">
		<div class="box-b2">
			<div class="box-b3"></div>
		</div>
	</div>
	
</div>

<?php if ($item->getApplication()->isCommentsEnabled() && ($item->isCommentsEnabled() || $item->getCommentsCount(1))) : ?>
<div class="feedack">

	<div class="box-t1">
		<div class="box-t2">
			<div class="box-t3"></div>
		</div>
	</div>
	
	<div class="box-1">
		<?php echo CommentHelper::renderComments($view, $item);  ?>
	</div>
	
	<div class="box-b1">
		<div class="box-b2">
			<div class="box-b3"></div>
		</div>
	</div>

</div>
<?php endif; ?>