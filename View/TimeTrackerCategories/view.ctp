<div class="timeTrackerCategories view">
<h2><?php echo __('Category'); ?></h2>
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
		<dt><?php echo __('Parent Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($timeTrackerCategory['ParentTimeTrackerCategory']['name'], array('controller' => 'time_tracker_categories', 'action' => 'view', $timeTrackerCategory['ParentTimeTrackerCategory']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Edit Category'), array('action' => 'edit', $timeTrackerCategory['TimeTrackerCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Category'), array('action' => 'delete', $timeTrackerCategory['TimeTrackerCategory']['id']), array(), __('Are you sure you want to delete # %s?', $timeTrackerCategory['TimeTrackerCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'time_tracker_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Category'), array('controller' => 'time_tracker_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Activities'), array('controller' => 'time_tracker_activities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activity'), array('controller' => 'time_tracker_activities', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Activities'); ?></h3>
	<?php if (!empty($timesTrackerActivities)): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('User'); ?></th>
		<th><?php echo __('Customer'); ?></th>
		<th><?php echo __('Duration'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($timesTrackerActivities as $timeTrackerActivity): ?>
		<tr>
			<td><?php echo $timeTrackerActivity['TimeTrackerActivity']['id']; ?></td>
			<td><?php echo $timeTrackerActivity['TimeTrackerActivity']['date']; ?></td>
			<td><?php echo $timeTrackerActivity['User']['firstname'] . ' ' . $timeTrackerActivity['User']['lastname']; ?></td>
			<td><?php echo $timeTrackerActivity['TimeTrackerCustomer']['name']; ?></td>
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

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Activity'), array('controller' => 'time_tracker_activities', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Categories Child'); ?></h3>
	<?php if (!empty($timeTrackerCategoryChild)): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($timeTrackerCategoryChild as $childTimeTrackerCategory):  ?>
		<tr>
			<td><?php echo $childTimeTrackerCategory['TimeTrackerCategory']['id']; ?></td>
			<td><?php echo $childTimeTrackerCategory['TimeTrackerCategory']['name']; ?></td>
			<td><?php echo $childTimeTrackerCategory['TimeTrackerCategory']['comment']; ?></td>
			<td><?php echo $childTimeTrackerCategory['TimeTrackerCategory']['created']; ?></td>
			<td><?php echo $childTimeTrackerCategory['TimeTrackerCategory']['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'time_tracker_categories', 'action' => 'view', $childTimeTrackerCategory['TimeTrackerCategory']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'time_tracker_categories', 'action' => 'edit', $childTimeTrackerCategory['TimeTrackerCategory']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'time_tracker_categories', 'action' => 'delete', $childTimeTrackerCategory['TimeTrackerCategory']['id']), array(), __('Are you sure you want to delete # %s?', $childTimeTrackerCategory['TimeTrackerCategory']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Category'), array('controller' => 'time_tracker_categories', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
