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

require_once(dirname(__FILE__, 4) . '/config.php');

require_login();

require_once($CFG->libdir . '/tablelib.php');

/** @var moodle_database $DB */
/** @var moodle_page $PAGE */
/** @var core_renderer $OUTPUT */
global $PAGE, $OUTPUT, $CFG, $COURSE, $DB, $USER;

/*
$courseid = optional_param('courseid', 0, PARAM_INT);
if( empty($courseid) ){ $courseid = 2; }
$course = get_course($courseid);

$plugin_url = new moodle_url('/local/miguelplugin/pages/formulario.php', array('courseid' => $courseid));
$context = context_course::instance($courseid);*/

$id = optional_param('id', 0, PARAM_INT);
$download = optional_param('download', '', PARAM_ALPHA);
$delete = optional_param('delete', 0, PARAM_INT);
$confirm = optional_param('confirm', 0, PARAM_INT);

$url = new moodle_url('/local/miguelplugin/pages/formulario.php', array('id' => $id));
$context = context_system::instance();

// Page config
$PAGE->set_context($context);
$PAGE->set_url($url);
$PAGE->set_heading('Prueba formulario');

//Import JS
$PAGE->requires->js_call_amd('local_miguelplugin/main', 'init', 
    [['username' => $USER->username, 'id' => $USER->id]]);
//$PAGE->requires->js_call_amd('local_miguelplugin/alert', 'showalert');

//Formulario
$form = new \local_miguelplugin\form\course(null, ['id' => $id]);

if ($form->is_cancelled()) {
    redirect($CFG->wwwroot);
}

//Sql query
$select = "id, nombre, apellido, edad, direccion, 'edit' as edit, 'delete' as borrar";
$from = '{local_miguelplugin}';
$where = '1=1';

//Table definintion
$table = new \local_miguelplugin\table\custom('miguelpluginreport');
$table->define_baseurl($url);
$table->set_sql($select, $from, $where);
$table->define_columns(['nombre', 'apellido', 'edad', 'direccion', 'edit', 'borrar']);
$table->define_headers(['Nombre', 'Apellido', 'Edad', 'Direccion', 'Edit', 'Borrar']);
$table->downloadable = true;
$table->is_downloading($download, 'reportecustom', 'reportexcel');

if (!$table->is_downloading()) {
    // Start print page
    echo $OUTPUT->header();

    $data = $form->get_data();
    if ($data) {

        $exist = $DB->record_exists('local_miguelplugin', ['id' => $data->id]);
        if ($exist) {
            $update = $DB->update_record('local_miguelplugin', $data);
            $event = \local_miguelplugin\event\formulario_edited::create(
                array(
                    'context' => $context,
                    'other' => [
                        'username' => $USER->username,
                        'registro' => $data->id
                    ]
                )
            );
            $event->trigger();
        } else {
            $insert = $DB->insert_record('local_miguelplugin', $data);
        }
    }

    if(empty($delete)){
        $form->display();
        echo $OUTPUT->render_from_template('local_miguelplugin/tabla', []);
    }
    if(!empty($confirm)){
        echo $OUTPUT->notification(sprintf('El registro con id %d ha sido borrado', $confirm));
        $DB->delete_records('local_miguelplugin', array('id' => $confirm));
    }

    if(empty($delete)){
        $table->out(5,false);
    } else {
        $registro = $DB->get_record('local_miguelplugin', array('id' => $delete));
        echo $OUTPUT->confirm(
            'Esta seguro de borrar al usuario ' . $registro->nombre . '?',
            new moodle_url('/local/miguelplugin/pages/formulario.php', array('confirm' => $registro->id)),
            new moodle_url('/local/miguelplugin/pages/formulario.php')
        );
    }



    /*
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
    */
}




if (!$table->is_downloading()) {
    echo $OUTPUT->footer();
}
// End print page