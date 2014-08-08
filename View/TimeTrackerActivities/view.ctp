<div class="timeTrackerActivities view">
<h2><?php echo __('Time Tracker Activity'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($timeTrackerActivity['TimeTrackerActivity']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($timeTrackerActivity['TimeTrackerActivity']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($timeTrackerActivity['User']['id'], array('controller' => 'users', 'action' => 'view', $timeTrackerActivity['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($timeTrackerActivity['TimeTrackerCustomer']['name'], array('controller' => 'time_tracker_customers', 'action' => 'view', $timeTrackerActivity['TimeTrackerCustomer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($timeTrackerActivity['TimeTrackerCategory']['name'], array('controller' => 'time_tracker_categories', 'action' => 'view', $timeTrackerActivity['TimeTrackerCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Duration'); ?></dt>
		<dd>
			<?php echo h($timeTrackerActivity['TimeTrackerActivity']['duration']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($timeTrackerActivity['TimeTrackerActivity']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($timeTrackerActivity['TimeTrackerActivity']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($timeTrackerActivity['TimeTrackerActivity']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Time Tracker Activity'), array('action' => 'edit', $timeTrackerActivity['TimeTrackerActivity']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Time Tracker Activity'), array('action' => 'delete', $timeTrackerActivity['TimeTrackerActivity']['id']), array(), __('Are you sure you want to delete # %s?', $timeTrackerActivity['TimeTrackerActivity']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Time Tracker Activities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Time Tracker Activity'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Time Tracker Customers'), array('controller' => 'time_tracker_customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Time Tracker Customer'), array('controller' => 'time_tracker_customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Time Tracker Categories'), array('controller' => 'time_tracker_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Time Tracker Category'), array('controller' => 'time_tracker_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
