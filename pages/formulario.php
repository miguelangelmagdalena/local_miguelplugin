<?php

require_once(dirname(__FILE__, 4).'/config.php');

require_login();
/** @var moodle_page $PAGE */
global $PAGE, $OUTPUT, $CFG;
$context = context_system::instance();
$plugin_url = new moodle_url('/local/miguelplugin/pages/formulario.php');

$PAGE->set_context($context);
$PAGE->set_url($plugin_url);
$PAGE->set_heading('Prueba formulario');

$form = new \local_miguelplugin\form\course();

/** @var core_renderer $OUTPUT */
echo $OUTPUT->header();

echo "Hola mundo";

$form->display();

echo $OUTPUT->footer();