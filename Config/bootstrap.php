<?php
App::import('Lib', 'TimeTracker.TimeUtil');

// Number of hours in a workday
Configure::write('hoursInWorkDay', '08:00:00');

// Name of the model that manages your users
Configure::write('user.model', 'User');

// Name of the table that manages your users
Configure::write('user.table', 'users');

// Name of the table that manages your users
Configure::write('user.firstname', 'firstname');
Configure::write('user.lastname', 'lastname');
Configure::write('user.name', Configure::read('user.model') . '.' . Configure::read('user.firstname') . ' ' . Configure::read('user.model') . '.'. Configure::read('user.lastname'));