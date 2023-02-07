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

defined('MOODLE_INTERNAL') || die();

/**
 * Execute miguelplugin upgrade from the given old version
 *
 * @param    int $oldversion
 * @return   bool
 */

function xmldb_local_miguelplugin_upgrade( $oldversion ){
    

    if ($oldversion < 2022020300) {

        global $DB;

        $dbman = $DB->get_manager(); // Loads ddl manager and xmldb classes.

        // Define field direccion to be added to local_miguelplugin.
        $table = new xmldb_table('local_miguelplugin');
        $field = new xmldb_field('direccion', XMLDB_TYPE_CHAR, '200', null, null, null, null, 'edad');

        // Conditionally launch add field direccion.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Miguelplugin savepoint reached.
        upgrade_plugin_savepoint(true, 2022020300, 'local', 'miguelplugin');
    }

    return true;
}

