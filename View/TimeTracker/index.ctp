<div class="timeTrackerActivities index">
	<h1>Welcome to the plugin Timetracker</h1>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Customers'), array('controller' => 'time_tracker_customers', 'action' => 'index')); ?></li>
	<li><?php echo $this->Html->link(__('Categories'), array('controller' => 'time_tracker_categories', 'action' => 'index')); ?></li>
	<li><?php echo $this->Html->link(__('Activities'), array('controller' => 'time_tracker_activities', 'action' => 'index')); ?></li>
	</ul>
</div>