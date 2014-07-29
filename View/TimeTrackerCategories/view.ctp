<div class="timeTrackerCategories view">
<h2><?php echo __('Time Tracker Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCategory['TimeTrackerCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCategory['TimeTrackerCategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCategory['TimeTrackerCategory']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Time Tracker Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($timeTrackerCategory['ParentTimeTrackerCategory']['name'], array('controller' => 'time_tracker_categories', 'action' => 'view', $timeTrackerCategory['ParentTimeTrackerCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lft'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCategory['TimeTrackerCategory']['lft']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rght'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCategory['TimeTrackerCategory']['rght']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCategory['TimeTrackerCategory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCategory['TimeTrackerCategory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Time Tracker Category'), array('action' => 'edit', $timeTrackerCategory['TimeTrackerCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Time Tracker Category'), array('action' => 'delete', $timeTrackerCategory['TimeTrackerCategory']['id']), array(), __('Are you sure you want to delete # %s?', $timeTrackerCategory['TimeTrackerCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Time Tracker Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Time Tracker Category'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Time Tracker Categories'), array('controller' => 'time_tracker_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Time Tracker Category'), array('controller' => 'time_tracker_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Time Tracker Activities'), array('controller' => 'time_tracker_activities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Time Tracker Activity'), array('controller' => 'time_tracker_activities', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Time Tracker Activities'); ?></h3>
	<?php if (!empty($timeTrackerCategory['TimeTrackerActivity'])): ?>
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
	<?php foreach ($timeTrackerCategory['TimeTrackerActivity'] as $timeTrackerActivity): ?>
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
<div class="related">
	<h3><?php echo __('Related Time Tracker Categories'); ?></h3>
	<?php if (!empty($timeTrackerCategory['ChildTimeTrackerCategory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Lft'); ?></th>
		<th><?php echo __('Rght'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($timeTrackerCategory['ChildTimeTrackerCategory'] as $childTimeTrackerCategory): ?>
		<tr>
			<td><?php echo $childTimeTrackerCategory['id']; ?></td>
			<td><?php echo $childTimeTrackerCategory['name']; ?></td>
			<td><?php echo $childTimeTrackerCategory['comment']; ?></td>
			<td><?php echo $childTimeTrackerCategory['parent_id']; ?></td>
			<td><?php echo $childTimeTrackerCategory['lft']; ?></td>
			<td><?php echo $childTimeTrackerCategory['rght']; ?></td>
			<td><?php echo $childTimeTrackerCategory['created']; ?></td>
			<td><?php echo $childTimeTrackerCategory['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'time_tracker_categories', 'action' => 'view', $childTimeTrackerCategory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'time_tracker_categories', 'action' => 'edit', $childTimeTrackerCategory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'time_tracker_categories', 'action' => 'delete', $childTimeTrackerCategory['id']), array(), __('Are you sure you want to delete # %s?', $childTimeTrackerCategory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Time Tracker Category'), array('controller' => 'time_tracker_categories', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
