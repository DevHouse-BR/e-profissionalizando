<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php $form = @$this->form; ?>
<?php $row = @$this->row; ?>

<form action="<?php echo JRoute::_( @$form['action'] ) ?>" method="post" class="adminform" name="adminForm" enctype="multipart/form-data" >

	<fieldset>
		<legend><?php echo JText::_('Form'); ?></legend>
			<table class="admintable">
                <tr>
                    <td style="width: 100px; text-align: right;" class="key">
                        <?php echo JText::_( 'Date' ); ?>:
                    </td>
                    <td>
                        <?php echo JHTML::calendar( @$row->datetime, "datetime", "datetime", '%Y-%m-%d %H:%M:%S' ); ?>
                    </td>
                </tr>
				<tr>
					<td style="width: 100px; text-align: right;" class="key">
						<?php echo JText::_( 'Subject' ); ?>:
					</td>
					<td>
					    <?php echo ScoutSelect::subject( @$row->subject_id, 'subject_id' ); ?>
					</td>
				</tr>
                <tr>
                    <td style="width: 100px; text-align: right;" class="key">
                        <?php echo JText::_( 'Verb' ); ?>:
                    </td>
                    <td>
                        <?php echo ScoutSelect::verb( @$row->verb_id, 'verb_id' ); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px; text-align: right;" class="key">
                        <?php echo JText::_( 'Object' ); ?>:
                    </td>
                    <td>
                        <?php echo ScoutSelect::object( @$row->object_id, 'object_id' ); ?>
                    </td>
                </tr>
			</table>
			<input type="hidden" name="id" value="<?php echo @$row->log_id; ?>" />
			<input type="hidden" name="task" value="" />
	</fieldset>
</form>