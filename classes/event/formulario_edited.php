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

namespace local_miguelplugin\event;

global $CFG;
 
class formulario_edited extends \core\event\base{
    protected function init() {
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    public function get_description() {
        if(!empty($this->other['username']) && !empty ($this->other['registro'])){
            return 'Usuario '.$this->other['username'].' ha editado un registro '.
                $this->other['registro'].' en local_miguelplugin';
        }
        return 'Usuario ha editado registro en local_miguelplugin';
    }

    public static function get_name() {
        return 'Edicion en miguelplugin ';
    }

    public function get_url() {
        if(!empty($this->other['username']) && !empty ($this->other['registro'])){
            return new \moodle_url('/local/miguelplugin/pages/formulario.php', array('id' => $this->other['registro']));
        }
        return new \moodle_url('/local/miguelplugin/pages/formulario.php');
    }
}
