<?php
// This file is part of Moodle Miguel Plugin
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version information
 *
 * @package    local_miguelplugin
 * @author     Miguel Magdalena  
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(__FILE__, 4).'/config.php');

require_login();

/** @var moodle_page $PAGE */
global $PAGE, $OUTPUT, $CFG;



$courseid = optional_param("courseid", 0, PARAM_INT);
$course = get_course($courseid);

$plugin_url = new moodle_url('/local/miguelplugin/pages/formulario.php', array('courseid' => $courseid));
$context = context_course::instance($courseid);

$PAGE->set_context($context);
$PAGE->set_course($course);
$PAGE->set_url($plugin_url);
$PAGE->set_heading('Prueba formulario');

$form = new \local_miguelplugin\form\course(null,["coursename" => $course->shortname]);

if ( $form->is_cancelled()){

    redirect($CFG->wwwroot);

}

/** @var core_renderer $OUTPUT */
echo $OUTPUT->header();

echo "Hola mundo ".$course->fullname." ";

if ( $data = $form->get_data()){

    var_dump($data);

} else {

    $form->display();

}


echo $OUTPUT->footer();