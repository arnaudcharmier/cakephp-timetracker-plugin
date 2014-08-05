<div class="timeTrackerActivities form">
<?php echo $this->Form->create('TimeTrackerActivity'); ?>
    <fieldset>
        <legend><?php echo __('Add Time Tracker Activity'); ?></legend>
    <?php
        echo $this->Form->input('date');
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
