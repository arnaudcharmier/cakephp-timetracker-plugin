<div class="timeTrackerCategories form">
<?php echo $this->Form->create('TimeTrackerCategory'); ?>
	<fieldset>
		<legend><?php echo __('Add Time Tracker Category'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('comment');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('lft');
		echo $this->Form->input('rght');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Time Tracker Categories'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Time Tracker Categories'), array('controller' => 'time_tracker_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Time Tracker Category'), array('controller' => 'time_tracker_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Time Tracker Activities'), array('controller' => 'time_tracker_activities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Time Tracker Activity'), array('controller' => 'time_tracker_activities', 'action' => 'add')); ?> </li>
	</ul>
</div>
