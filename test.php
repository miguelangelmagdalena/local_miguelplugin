<?php

require_once(dirname(__FILE__, 3) . '/config.php');

/** @var moodle_database $DB */
/** @var moodle_page $PAGE */
/** @var core_renderer $OUTPUT */
global $PAGE, $OUTPUT, $CFG, $COURSE, $DB, $USER;

$context = context_system::instance();
$plugin_url = new moodle_url('/local/miguelplugin/test.php');

$call = new \local_miguelplugin\observer\user_loggedin;
$call::user_logged($event);