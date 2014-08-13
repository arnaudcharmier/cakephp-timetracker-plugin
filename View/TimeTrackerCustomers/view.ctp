<div class="timeTrackerCustomers view">
<h2><?php echo __('Customer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCustomer['TimeTrackerCustomer']['id']); ?>
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCustomer['TimeTrackerCustomer']['name']); ?>
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCustomer['TimeTrackerCustomer']['comment']); ?>
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCustomer['TimeTrackerCustomer']['created']); ?>
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCustomer['TimeTrackerCustomer']['modified']); ?>
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Customer'), array('action' => 'edit', $timeTrackerCustomer['TimeTrackerCustomer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Customer'), array('action' => 'delete', $timeTrackerCustomer['TimeTrackerCustomer']['id']), array(), __('Are you sure you want to delete # %s?', $timeTrackerCustomer['TimeTrackerCustomer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Activities'), array('controller' => 'time_tracker_activities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activity'), array('controller' => 'time_tracker_activities', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Activities'); ?></h3>
	<?php if (!empty($timeTrackerActivities)): ?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Date'); ?></th>
			<th><?php echo __('User'); ?></th>
			<th><?php echo __('Category'); ?></th>
			<th><?php echo __('Duration'); ?></th>
			<th><?php echo __('Comment'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th><?php echo __('Modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($timeTrackerActivities as $timeTrackerActivity): ?>
			<tr>
				<td><?php echo $timeTrackerActivity['TimeTrackerActivity']['id']; ?></td>
				<td><?php echo $timeTrackerActivity['TimeTrackerActivity']['date']; ?></td>
				<td><?php echo $timeTrackerActivity[Configure::read('user.model')]['firstname'] . ' ' . $timeTrackerActivity[Configure::read('user.model')]['lastname']; ?></td>
				<td><?php echo $timeTrackerActivity['TimeTrackerCategory']['name']; ?></td>
				<td><?php echo $timeTrackerActivity['TimeTrackerActivity']['duration']; ?></td>
				<td><?php echo $timeTrackerActivity['TimeTrackerActivity']['comment']; ?></td>
				<td><?php echo $timeTrackerActivity['TimeTrackerActivity']['created']; ?></td>
				<td><?php echo $timeTrackerActivity['TimeTrackerActivity']['modified']; ?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'time_tracker_activities', 'action' => 'view', $timeTrackerActivity['TimeTrackerActivity']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'time_tracker_activities', 'action' => 'edit', $timeTrackerActivity['TimeTrackerActivity']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'time_tracker_activities', 'action' => 'delete', $timeTrackerActivity['TimeTrackerActivity']['id']), array(), __('Are you sure you want to delete # %s?', $timeTrackerActivity['TimeTrackerActivity']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
</div>
<div class="related">
	<h3><?php echo __('Number of hours worked per day'); ?></h3>
	<?php if (!empty($activitiesCustomerByDay)): ?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Day'); ?></th>
			<th><?php echo __('Number of hours worked'); ?></th>
		</tr>
		<?php foreach ($activitiesCustomerByDay as $date => $number): ?>
			<tr>
				<td><?php echo $date; ?></td>
				<td><?php echo $number; ?></td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
</div>
<div class="related">
	<h3><?php echo __('Number of hours worked per user'); ?></h3>
	<?php if (!empty($activitiesCustomerByUser)): ?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('User'); ?></th>
			<th><?php echo __('Number of hours worked'); ?></th>
		</tr>
		<?php foreach ($activitiesCustomerByUser as $user => $number): ?>
			<tr>
				<td><?php echo $user; ?></td>
				<td><?php echo $number; ?></td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
</div>
<div class="related">
	<h3><?php echo __('Number of hours worked per category'); ?></h3>
	<?php if (!empty($activitiesCustomerByCategory)): ?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Category'); ?></th>
			<th><?php echo __('Number of hours worked'); ?></th>
		</tr>
		<?php foreach ($activitiesCustomerByCategory as $cat => $number): ?>
			<tr>
				<td><?php echo $cat; ?></td>
				<td><?php echo $number; ?></td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
</div>