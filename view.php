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

require_once(__DIR__ . '/../../config.php');
require_login();

/** @var moodle_database $DB */
/** @var core_renderer $OUTPUT */
global $PAGE, $OUTPUT, $CFG, $DB;

$context = context_system::instance();
$plugin_url = new moodle_url('/local/miguelplugin/view.php');
$config = get_config('local_miguelplugin');

require_capability('local/user_custom_report:managereport', $context);

$PAGE->set_url($plugin_url);
$PAGE->set_context($context);

$data = $DB->get_records('local_miguelplugin', array('nombre' => 'Miguel', 'edad' => 25));
$data2 = $DB->get_record('local_miguelplugin', array('nombre' => 'Miguel'));
$data3 = $DB->get_records_sql("select * from {local_miguelplugin}");
$data4 = $DB->get_records_select('local_miguelplugin', 'nombre = ? or nombre = ?', ['Pepe','Miguel'], 'id', 'nombre,apellido');

//Objeto
$datainsert = new stdClass();
$datainsert->nombre = "Juan";
$datainsert->apellido = "Martinez";

//Obejeto 2
$datainsert2 = (object)[
    "nombre" => "Carlos",
    "apellido" => "Romero",
    "direccion" => "calle false 123"
];

//$insert = $DB->insert_record('local_miguelplugin', $datainsert2);

$dataupdate = (object)[
    "id" => 2,
    "nombre" => "Juanito",
    "apellido" => "Perales",
];
//$update = $DB->update_record('local_miguelplugin', $dataupdate);

//$delete =  $DB->delete_records('local_miguelplugin',["nombre" => "Carlos"]);

echo $OUTPUT->header();

var_dump($data4);

if (has_capability('local/user_custom_report:managereport', $context)){
    echo "Tengo permisos";
} else {
    echo "No tengo permisos";
}

#echo html_writer::div($config->lista, 'lista', array('data-list' => '1,2'));
echo html_writer::div('i', 'test', array('class' => 'testi'));

echo "Hola mundo";

echo $OUTPUT->footer();