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

global $PAGE, $OUTPUT, $CFG;
$context = context_system::instance();
$plugin_url = new moodle_url('/local/miguelplugin/view.php');

require_login();

require_capability('local/user_custom_report:managereport', $context);

$PAGE->set_url($plugin_url);

$PAGE->set_context($context);

/** @var core_renderer $OUTPUT */
echo $OUTPUT->header();

echo "Hola mundo";

echo $OUTPUT->footer();