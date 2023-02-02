<?php

namespace local_miguelplugin\form;

global $CFG;

require_once($CFG->libdir.'/formslib.php');

class course extends \moodleform{

    public function definition(){

        $mform = $this->_form;

        $mform->addElement('text', 'name', 'Nombre');

        $mform->setType('name', PARAM_TEXT);
        
        $mform->setDefault('name','Miguel');

        $this->add_action_buttons(true,'Accionar');
    }
}
