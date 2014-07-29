<div class="timeTrackerCategories index">
	<h2><?php echo __('Time Tracker Categories'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lft'); ?></th>
			<th><?php echo $this->Paginator->sort('rght'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($timeTrackerCategories as $timeTrackerCategory): ?>
	<tr>
		<td><?php echo h($timeTrackerCategory['TimeTrackerCategory']['id']); ?>&nbsp;</td>
		<td><?php echo h($timeTrackerCategory['TimeTrackerCategory']['name']); ?>&nbsp;</td>
		<td><?php echo h($timeTrackerCategory['TimeTrackerCategory']['comment']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($timeTrackerCategory['ParentTimeTrackerCategory']['name'], array('controller' => 'time_tracker_categories', 'action' => 'view', $timeTrackerCategory['ParentTimeTrackerCategory']['id'])); ?>
		</td>
		<td><?php echo h($timeTrackerCategory['TimeTrackerCategory']['lft']); ?>&nbsp;</td>
		<td><?php echo h($timeTrackerCategory['TimeTrackerCategory']['rght']); ?>&nbsp;</td>
		<td><?php echo h($timeTrackerCategory['TimeTrackerCategory']['created']); ?>&nbsp;</td>
		<td><?php echo h($timeTrackerCategory['TimeTrackerCategory']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $timeTrackerCategory['TimeTrackerCategory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $timeTrackerCategory['TimeTrackerCategory']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $timeTrackerCategory['TimeTrackerCategory']['id']), array(), __('Are you sure you want to delete # %s?', $timeTrackerCategory['TimeTrackerCategory']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Time Tracker Category'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Time Tracker Categories'), array('controller' => 'time_tracker_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Time Tracker Category'), array('controller' => 'time_tracker_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Time Tracker Activities'), array('controller' => 'time_tracker_activities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Time Tracker Activity'), array('controller' => 'time_tracker_activities', 'action' => 'add')); ?> </li>
	</ul>
</div>
