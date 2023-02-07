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

require_once($CFG->libdir.'/tablelib.php');

/** @var moodle_database $DB */
/** @var moodle_page $PAGE */
/** @var core_renderer $OUTPUT */
global $PAGE, $OUTPUT, $CFG, $DB;

$pagina = optional_param('page', 0, PARAM_INT);
$download = optional_param('download', '', PARAM_ALPHA);

$url = new moodle_url('/local/miguelplugin/pages/table.php');
$context = context_system::instance();

// Page config
$PAGE->set_context($context);
$PAGE->set_url($url);
$PAGE->set_heading('Prueba formulario');

$datos = [
    [
        'id' => 1,
        'nombre' => 'Daniel',
        'apellido' => 'Arriola',
        'edad' => 37
    ],
    [
        'id' => 2,
        'nombre' => 'Diego',
        'apellido' => 'Reynoso',
        'edad' => 26
    ],
    [
        'id' => 3,
        'nombre' => 'Jose',
        'apellido' => 'Araujo',
        'edad' => 37
    ],
    [
        'id' => 4,
        'nombre' => 'Daniel',
        'apellido' => 'Arriola',
        'edad' => 1
    ],
    [
        'id' => 5,
        'nombre' => 'Diego',
        'apellido' => 'Reynoso',
        'edad' => 2
    ],
    [
        'id' => 6,
        'nombre' => 'Jose',
        'apellido' => 'Araujo',
        'edad' => 3
    ],
    [
        'id' => 7,
        'nombre' => 'Daniel',
        'apellido' => 'Arriola',
        'edad' => 4
    ],
    [
        'id' => 8,
        'nombre' => 'Diego',
        'apellido' => 'Reynoso',
        'edad' => 5
    ],
    [
        'id' => 9,
        'nombre' => 'Jose',
        'apellido' => 'Araujo',
        'edad' => 6
    ],
    [
        'id' => 10,
        'nombre' => 'Daniel',
        'apellido' => 'Arriola',
        'edad' => 4
    ],
    [
        'id' => 11,
        'nombre' => 'Diego',
        'apellido' => 'Reynoso',
        'edad' => 5
    ],
    [
        'id' => 12,
        'nombre' => 'Jose',
        'apellido' => 'Araujo',
        'edad' => 6
    ],
    [
        'id' => 13,
        'nombre' => 'Daniel',
        'apellido' => 'Arriola',
        'edad' => 4
    ],
    [
        'id' => 14,
        'nombre' => 'Diego',
        'apellido' => 'Reynoso',
        'edad' => 5
    ]
];

$paginator = 5;

$table = new flexible_table('reporte');
$table->define_baseurl($url);
$table->pagesize($paginator, count($datos));
$table->define_columns(['id', 'nombre', 'apellido', 'edad']);
$table->define_headers(['Id', 'Nombre', 'Apellido', 'Edad']);
$table->downloadable = true;
$table->is_collapsible = true;
$table->is_sortable = true;
$table->is_downloading($download, 'reportecustom', 'reportexcel');

$datospagina = array_chunk($datos, $paginator);

if ( $table->is_downloading() ) {
    $datosamostrar = $datos;
} else {
    $datosamostrar = $datospagina[$pagina];
}



if (!$table->is_downloading()) {
    echo $OUTPUT->header();
}

$table->setup();
$table->format_and_add_array_of_rows($datosamostrar);

if (!$table->is_downloading()) {
    echo $OUTPUT->footer();
}