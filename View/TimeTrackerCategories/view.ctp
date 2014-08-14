<div class="timeTrackerCategories view">
<h2><?php echo __('Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCategory['TimeTrackerCategory']['id']); ?>
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCategory['TimeTrackerCategory']['name']); ?>
		</dd>
		<?php if(!empty($timeTrackerCategory['TimeTrackerCategory']['comment'])) { ?>
			<dt><?php echo __('Comment'); ?></dt>
			<dd>
				<?php echo h($timeTrackerCategory['TimeTrackerCategory']['comment']); ?>
			</dd>
		<?php } ?>
		<?php if(isset($timeTrackerCategoryParent['TimeTrackerCategory']['name'])) { ?>
			<dt><?php echo __('Parent Category'); ?></dt>
			<dd>
				<?php echo $this->Html->link($timeTrackerCategoryParent['TimeTrackerCategory']['name'], array('controller' => 'time_tracker_categories', 'action' => 'view', $timeTrackerCategoryParent['TimeTrackerCategory']['id'])); ?>
			</dd>
		<?php } ?>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCategory['TimeTrackerCategory']['created']); ?>
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($timeTrackerCategory['TimeTrackerCategory']['modified']); ?>
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
	<?php if (!empty($timeTrackerActivities)): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('User'); ?></th>
		<th><?php echo __('Customer'); ?></th>
		<th><?php echo __('Duration'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($timeTrackerActivities as $timeTrackerActivity): ?>
		<tr>
			<td><?php echo $timeTrackerActivity['TimeTrackerActivity']['id']; ?></td>
			<td><?php echo $timeTrackerActivity['TimeTrackerActivity']['date']; ?></td>
			<td><?php echo $timeTrackerActivity['User']['firstname'] . ' ' . $timeTrackerActivity['User']['lastname']; ?></td>
			<td><?php echo $timeTrackerActivity['TimeTrackerCustomer']['name']; ?></td>
			<td><?php echo $timeTrackerActivity['TimeTrackerActivity']['duration']; ?></td>
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
	<h3><?php echo __('Related Categories Child'); ?></h3>
	<?php if (!empty($timeTrackerCategoryChildren)): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($timeTrackerCategoryChildren as $timeTrackerCategoryChild):  ?>
		<tr>
			<td><?php echo $timeTrackerCategoryChild['TimeTrackerCategory']['id']; ?></td>
			<td><?php echo $timeTrackerCategoryChild['TimeTrackerCategory']['name']; ?></td>
			<td><?php echo $timeTrackerCategoryChild['TimeTrackerCategory']['created']; ?></td>
			<td><?php echo $timeTrackerCategoryChild['TimeTrackerCategory']['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'time_tracker_categories', 'action' => 'view', $timeTrackerCategoryChild['TimeTrackerCategory']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'time_tracker_categories', 'action' => 'edit', $timeTrackerCategoryChild['TimeTrackerCategory']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'time_tracker_categories', 'action' => 'delete', $timeTrackerCategoryChild['TimeTrackerCategory']['id']), array(), __('Are you sure you want to delete # %s?', $timeTrackerCategoryChild['TimeTrackerCategory']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
