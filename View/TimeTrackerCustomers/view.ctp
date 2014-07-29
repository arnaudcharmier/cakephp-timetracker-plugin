<div class="timeTrackerCustomers view">
<h2><?php echo __('Time Tracker Customer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCustomer['TimeTrackerCustomer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCustomer['TimeTrackerCustomer']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCustomer['TimeTrackerCustomer']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCustomer['TimeTrackerCustomer']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCustomer['TimeTrackerCustomer']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Time Tracker Customer'), array('action' => 'edit', $timeTrackerCustomer['TimeTrackerCustomer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Time Tracker Customer'), array('action' => 'delete', $timeTrackerCustomer['TimeTrackerCustomer']['id']), array(), __('Are you sure you want to delete # %s?', $timeTrackerCustomer['TimeTrackerCustomer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Time Tracker Customers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Time Tracker Customer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Time Tracker Activities'), array('controller' => 'time_tracker_activities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Time Tracker Activity'), array('controller' => 'time_tracker_activities', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Time Tracker Activities'); ?></h3>
	<?php if (!empty($timeTrackerCustomer['TimeTrackerActivity'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Time Tracker Customer Id'); ?></th>
		<th><?php echo __('Time Tracker Category Id'); ?></th>
		<th><?php echo __('Duration'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($timeTrackerCustomer['TimeTrackerActivity'] as $timeTrackerActivity): ?>
		<tr>
			<td><?php echo $timeTrackerActivity['id']; ?></td>
			<td><?php echo $timeTrackerActivity['date']; ?></td>
			<td><?php echo $timeTrackerActivity['user_id']; ?></td>
			<td><?php echo $timeTrackerActivity['time_tracker_customer_id']; ?></td>
			<td><?php echo $timeTrackerActivity['time_tracker_category_id']; ?></td>
			<td><?php echo $timeTrackerActivity['duration']; ?></td>
			<td><?php echo $timeTrackerActivity['comment']; ?></td>
			<td><?php echo $timeTrackerActivity['created']; ?></td>
			<td><?php echo $timeTrackerActivity['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'time_tracker_activities', 'action' => 'view', $timeTrackerActivity['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'time_tracker_activities', 'action' => 'edit', $timeTrackerActivity['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'time_tracker_activities', 'action' => 'delete', $timeTrackerActivity['id']), array(), __('Are you sure you want to delete # %s?', $timeTrackerActivity['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Time Tracker Activity'), array('controller' => 'time_tracker_activities', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
