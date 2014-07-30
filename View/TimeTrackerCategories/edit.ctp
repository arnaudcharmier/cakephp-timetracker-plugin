<div class="timeTrackerCategories form">
<?php echo $this->Form->create('TimeTrackerCategory'); ?>
	<fieldset>
		<legend><?php echo __('Edit Time Tracker Category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('parent_id', array('options' => $parentTimeTrackerCategories, 'empty' => array(0 => __('Choice'))));
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('TimeTrackerCategory.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('TimeTrackerCategory.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Time Tracker Categories'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Time Tracker Categories'), array('controller' => 'time_tracker_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Time Tracker Category'), array('controller' => 'time_tracker_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Time Tracker Activities'), array('controller' => 'time_tracker_activities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Time Tracker Activity'), array('controller' => 'time_tracker_activities', 'action' => 'add')); ?> </li>
	</ul>
</div>
