<div class="timeTrackerCustomers form">
<?php echo $this->Form->create('TimeTrackerCustomer'); ?>
	<fieldset>
		<legend><?php echo __('Add Time Tracker Customer'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Time Tracker Customers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Time Tracker Activities'), array('controller' => 'time_tracker_activities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Time Tracker Activity'), array('controller' => 'time_tracker_activities', 'action' => 'add')); ?> </li>
	</ul>
</div>
