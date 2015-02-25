<?php
/* For licensing terms, see /license.txt */
/**
 * Config the plugin
 * @author Daniel Alejandro Barreto Alva <daniel.barreto@beeznest.com>
 * @package chamilo.plugin.advanced_subscription
 */

define('TABLE_ADVANCED_SUBSCRIPTION_QUEUE', 'plugin_advanced_subscription_queue');

define('ADVANCED_SUBSCRIPTION_ACTION_STUDENT_REQUEST', 0);
define('ADVANCED_SUBSCRIPTION_ACTION_SUPERIOR_APPROVE', 1);
define('ADVANCED_SUBSCRIPTION_ACTION_SUPERIOR_DISAPPROVE', 2);
define('ADVANCED_SUBSCRIPTION_ACTION_SUPERIOR_SELECT', 3);
define('ADVANCED_SUBSCRIPTION_ACTION_ADMIN_APPROVE', 4);
define('ADVANCED_SUBSCRIPTION_ACTION_ADMIN_DISAPPROVE', 5);
define('ADVANCED_SUBSCRIPTION_ACTION_STUDENT_REQUEST_NO_BOSS', 6);
define('ADVANCED_SUBSCRIPTION_ACTION_REMINDER_STUDENT', 7);
define('ADVANCED_SUBSCRIPTION_ACTION_REMINDER_SUPERIOR', 8);
define('ADVANCED_SUBSCRIPTION_ACTION_REMINDER_SUPERIOR_MAX', 9);
define('ADVANCED_SUBSCRIPTION_ACTION_REMINDER_ADMIN', 10);

define('ADVANCED_SUBSCRIPTION_QUEUE_STATUS_NO_QUEUE', -1);
define('ADVANCED_SUBSCRIPTION_QUEUE_STATUS_START', 0);
define('ADVANCED_SUBSCRIPTION_QUEUE_STATUS_BOSS_DISAPPROVED', 1);
define('ADVANCED_SUBSCRIPTION_QUEUE_STATUS_BOSS_APPROVED', 2);
define('ADVANCED_SUBSCRIPTION_QUEUE_STATUS_ADMIN_DISAPPROVED', 3);
define('ADVANCED_SUBSCRIPTION_QUEUE_STATUS_ADMIN_APPROVED', 10);

define('ADVANCED_SUBSCRIPTION_TERMS_MODE_POPUP', 0);
define('ADVANCED_SUBSCRIPTION_TERMS_MODE_REJECT', 1);



require_once __DIR__ . '/../../main/inc/global.inc.php';
