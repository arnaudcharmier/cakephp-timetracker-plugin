<div class="timeTrackerActivities index">
	<h2><?php echo __('Time Tracker Activities'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('time_tracker_customer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('time_tracker_category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('duration'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($timeTrackerActivities as $timeTrackerActivity): ?>
	<tr>
		<td><?php echo h($timeTrackerActivity['TimeTrackerActivity']['id']); ?>&nbsp;</td>
		<td><?php echo h($timeTrackerActivity['TimeTrackerActivity']['date']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($timeTrackerActivity['User']['id'], array('controller' => 'users', 'action' => 'view', $timeTrackerActivity['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($timeTrackerActivity['TimeTrackerCustomer']['name'], array('controller' => 'time_tracker_customers', 'action' => 'view', $timeTrackerActivity['TimeTrackerCustomer']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($timeTrackerActivity['TimeTrackerCategory']['name'], array('controller' => 'time_tracker_categories', 'action' => 'view', $timeTrackerActivity['TimeTrackerCategory']['id'])); ?>
		</td>
		<td><?php echo h($timeTrackerActivity['TimeTrackerActivity']['duration']); ?>&nbsp;</td>
		<td><?php echo h($timeTrackerActivity['TimeTrackerActivity']['comment']); ?>&nbsp;</td>
		<td><?php echo h($timeTrackerActivity['TimeTrackerActivity']['created']); ?>&nbsp;</td>
		<td><?php echo h($timeTrackerActivity['TimeTrackerActivity']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $timeTrackerActivity['TimeTrackerActivity']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $timeTrackerActivity['TimeTrackerActivity']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $timeTrackerActivity['TimeTrackerActivity']['id']), array(), __('Are you sure you want to delete # %s?', $timeTrackerActivity['TimeTrackerActivity']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Time Tracker Activity'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Time Tracker Customers'), array('controller' => 'time_tracker_customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Time Tracker Customer'), array('controller' => 'time_tracker_customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Time Tracker Categories'), array('controller' => 'time_tracker_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Time Tracker Category'), array('controller' => 'time_tracker_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
