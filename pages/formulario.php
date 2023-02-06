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

/** @var moodle_database $DB */
/** @var moodle_page $PAGE */
global $PAGE, $OUTPUT, $CFG, $COURSE, $DB;

/*
$courseid = optional_param('courseid', 0, PARAM_INT);
if( empty($courseid) ){ $courseid = 2; }
$course = get_course($courseid);

$plugin_url = new moodle_url('/local/miguelplugin/pages/formulario.php', array('courseid' => $courseid));
$context = context_course::instance($courseid);*/

$id = optional_param('id', 0, PARAM_INT);

$plugin_url = new moodle_url('/local/miguelplugin/pages/formulario.php', array('id' => $id));
$context = context_system::instance();


$PAGE->set_context($context);
$PAGE->set_url($plugin_url);
$PAGE->set_heading('Prueba formulario');

$form = new \local_miguelplugin\form\course(null, ['id' => $id]);

if ( $form->is_cancelled()){

    redirect($CFG->wwwroot);

}

/** @var core_renderer $OUTPUT */
echo $OUTPUT->header();

$data = $form->get_data();
if ( $data ) {

    $exist = $DB->record_exists('local_miguelplugin', ['id' => $id]);
    if ( $exist ){
        $update = $DB->update_record('local_miguelplugin', $data);
    } else {
        $insert = $DB->insert_record('local_miguelplugin', $data);
    }
    
}

$form->display();

$usuarios = $DB->get_records('local_miguelplugin');

foreach ( $usuarios as $usuario) {
    echo html_writer::span($usuario->nombre). ' | ';
    echo html_writer::span($usuario->apellido). ' | ';
    echo html_writer::span($usuario->edad). ' | ';
    echo html_writer::span($usuario->direccion). ' | ';
    echo html_writer::span(
        html_writer::link(new moodle_url('/local/miguelplugin/pages/formulario.php', array('id' => $usuario->id)), 'editar')
    );
    echo html_writer::tag('br','');
}

echo $OUTPUT->footer();