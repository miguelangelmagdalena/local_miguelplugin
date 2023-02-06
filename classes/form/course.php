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

namespace local_miguelplugin\form;


global $CFG;

require_once($CFG->libdir.'/formslib.php');

class course extends \moodleform{

    public function definition()
    {
        /** @var moodle_database $DB */
        global $DB;

        $mform = $this->_form;
        $custom = $this->_customdata;
        $usuarioid = $custom['id'];
        $userobject = $DB->get_record('local_miguelplugin', ['id' => $usuarioid]);
        

        $mform->addElement('text', 'nombre', 'Nombre');
        $mform->setType('nombre', PARAM_RAW);

        $mform->addElement('text', 'apellido', 'Apellido');
        $mform->setType('apellido', PARAM_RAW);
        
        $mform->addElement('text', 'edad', 'Edad');
        $mform->setType('edad', PARAM_RAW);
        
        $mform->addElement('text', 'direccion', 'Direccion');
        $mform->setType('direccion', PARAM_RAW);
        
        $mform->addElement('hidden', 'id');
        $mform->setDefault('id',$usuarioid);
        $mform->setType('id', PARAM_INT);

        if ( !empty($userobject) ) { 
            $mform->setDefault('nombre', $userobject->nombre);
            $mform->setDefault('apellido', $userobject->apellido);
            $mform->setDefault('edad', $userobject->edad);
            $mform->setDefault('direccion', $userobject->direccion);
        }

        $this->add_action_buttons(true,'Accionar');
    }

    public function validation($data, $files)
    {
        $errors = [];
        if (!is_numeric($data['edad'])) {
            $errors['edad'] = 'Debe ser númerica';
        }

        if (empty($data['nombre'])) {
            $errors['nombre'] = 'Este campo es obligatorio';
        }

        if (empty($data['apellido'])) {
            $errors['apellido'] = 'Este campo es obligatorio';
        }

        return $errors;
    }
}
