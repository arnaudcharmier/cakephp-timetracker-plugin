<div class="timeTrackerActivities form">
<?php if(!empty($activitiesUserByDate)){ ?>
    <fieldset>
        <legend><?php echo __('My Times Trackers Activities'); ?></legend>
        <table class="table table-hover list table-condensed table-striped">
            <thead>
                <tr>
                    <th><?php echo __("ID"); ?></th>
                    <th><?php echo __("Date"); ?></th>
                    <th><?php echo __("Category"); ?></th>
                    <th><?php echo __("Duration"); ?></th>
                    <th class="hidden-phone hidden-tablet"><?php echo  __("Created"); ?></th>
                    <th class="hidden-phone hidden-tablet"><?php echo __("Modified"); ?></th>
                    <th class="text-center"><?php echo __("Actions"); ?></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($activitiesUserByDate as $activityUserByDate): ?>
                <tr>
                    <td><?php echo h($activityUserByDate['TimeTrackerActivity']['id']); ?>&nbsp;</td>
                    <td><?php echo h($activityUserByDate['TimeTrackerActivity']['date']); ?>&nbsp;</td>
                    <td><?php echo $this->Html->link($activityUserByDate['TimeTrackerCategory']['name'],
                    array('controller' => 'time_tracker_categories', 'action' => 'view', $activityUserByDate['TimeTrackerCategory']['id'])); ?></td>
                    <td><?php echo h($activityUserByDate['TimeTrackerActivity']['duration']); ?>&nbsp;</td>
                    <td class="hidden-phone hidden-tablet"><?php echo h($activityUserByDate['TimeTrackerActivity']['created']); ?>&nbsp;</td>
                    <td class="hidden-phone hidden-tablet"><?php echo h($activityUserByDate['TimeTrackerActivity']['modified_humanized']); ?>&nbsp;</td>
                    <td class="text-center">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $activityUserByDate['TimeTrackerActivity']['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $activityUserByDate['TimeTrackerActivity']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $activityUserByDate['TimeTrackerActivity']['id']), array(), __('Are you sure you want to delete # %s?', $activityUserByDate['TimeTrackerActivity']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </fieldset>
<?php } ?>
<?php echo $this->Form->create('TimeTrackerActivity'); ?>
    <fieldset>
        <legend><?php echo __('Add Time Tracker Activity'); ?></legend>
    <?php
        if(!empty($dateFilter)){
            echo $this->Form->input('date', array('type' => 'hidden', 'value' => $dateFilter));
        } else {
            echo $this->Form->input('date', array('type' => 'text', 'placeholder' => '0000-00-00'));
        }
        echo $this->Form->input('time_tracker_customer_id', array('label' => 'Customer', 'empty' => __('Choose a customer')));
        echo $this->Form->input('time_tracker_category_id', array('label' => 'Category', 'empty' => __('Choose a category')));
        echo $this->Form->input('duration', array('type' => 'text', 'placeholder' => "00:00:00"));
        echo $this->Form->input('comment');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Time Tracker Activities'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Time Tracker Customers'), array('controller' => 'time_tracker_customers', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Time Tracker Customer'), array('controller' => 'time_tracker_customers', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Time Tracker Categories'), array('controller' => 'time_tracker_categories', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Time Tracker Category'), array('controller' => 'time_tracker_categories', 'action' => 'add')); ?> </li>
    </ul>
</div>
