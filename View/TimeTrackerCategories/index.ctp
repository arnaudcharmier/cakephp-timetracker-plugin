<div class="timeTrackerCategories index">
	<h2><?php echo __('Time Tracker Categories'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
					<th><?php echo __('id'); ?></th>
					<th><?php echo __('name'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($timeTrackerCategories as $timeTrackerCategoryId => $timeTrackerCategoryName): ?>
				<tr>
					<td><?php echo h($timeTrackerCategoryId); ?>&nbsp;</td>
					<td><?php echo h($timeTrackerCategoryName); ?>&nbsp;</td>
					<td class="actions">
						<?php echo $this->Html->link(__('Move Up'), array('action' => 'moveup', $timeTrackerCategoryId)); ?>
						<?php echo $this->Html->link(__('Move Down'), array('action' => 'movedown', $timeTrackerCategoryId)); ?>
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $timeTrackerCategoryId)); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $timeTrackerCategoryId), array(), __('Are you sure you want to delete # %s?', $timeTrackerCategoryId)); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Time Tracker Category'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Time Tracker Categories'), array('controller' => 'time_tracker_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Time Tracker Category'), array('controller' => 'time_tracker_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Time Tracker Activities'), array('controller' => 'time_tracker_activities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Time Tracker Activity'), array('controller' => 'time_tracker_activities', 'action' => 'add')); ?> </li>
	</ul>
</div>
