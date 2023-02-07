<?php
// This file is part of Moodle User Custom Report Plugin
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
 * @created    06/01/2023
 * @package    local_miguelplugin
 * @copyright  Miguel Magdalena}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 defined('MOODLE_INTERNAL') || die();

// Any plugin can append actions to this list by implementing a callback
// <component>_bulk_user_actions() which returns an array of action_link.
// Each new action's key should have a frankenstyle prefix to avoid clashes.
// See MDL-38511 for more details.
// Reference moodle/admin/user/user_bulk_form.php (bulk_user_actions)
function local_miguelplugin_bulk_user_actions() {
    $ret = array();
    $ret[] = new action_link(
        new moodle_url( '/local/miguelplugin/pages/formulario.php' ),
        'Ir a local_miguelplugin',
        new component_action('click', '')
    );
    return $ret;
}

function local_miguelplugin_extend_navigation(global_navigation $nav) {
    
    //Nav menu in the page
    /*if (isloggedin()) {
        $context = context_system::instance();
        if (has_capability('local/miguelplugin:viewpage', $context)) {

            $node = $nav->add(
                get_string('pluginname', 'local_miguelplugin'),
                new moodle_url('/local/miguelplugin/pages/formulario.php'),
                navigation_node::TYPE_CUSTOM,
                null,
                'local_miguelplugin',
                new pix_icon('i/settings', get_string('pluginname', 'local_miguelplugin'))
            );

            $node->showinflatnavigation = true;
        }
    }*/

    //Otra forma
    global $COURSE;
    //if (isloggedin()) {
        if ($COURSE->id > SITEID){ //Para mostrarlo dentro de la navegacion de cursos
            $node = \navigation_node::create(
                get_string('pluginname', 'local_miguelplugin'),
                new moodle_url('/local/miguelplugin/pages/formulario.php'),
                navigation_node::TYPE_CUSTOM,
                'Formulario',
                'local_miguelplugin',
                new \pix_icon('i/settings', get_string('pluginname', 'local_miguelplugin'))
            );
            $node->showinflatnavigation = true;
            $nav->add_node($node);
        }

        $inicio = $nav->find('home', \navigation_node::TYPE_SETTING);
        $node = \navigation_node::create(
            'Formulario miguelplugin',
            new moodle_url('/local/miguelplugin/pages/formulario.php'),
            navigation_node::TYPE_CUSTOM,
            'Formulario',
            'local_miguelplugin2',
            new \pix_icon('i/settings', 'Formulario miguelplugin')
        );
        $node->showinflatnavigation = true;
        if (isloggedin()) {
            $inicio->add_node($node);
        }
    //
}

//Agrega un elemento al www.moodle.test/course/admin.php?courseid=1
function local_miguelplugin_extend_navigation_frontpage(\navigation_node $frontpage, $course, $coursecontext ){
    $frontpage->add('item custom');
}