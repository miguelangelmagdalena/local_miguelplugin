<?php

namespace local_miguelplugin\table;

use html_writer;

global $CFG;
include_once($CFG->libdir.'/tablelib.php');

class custom extends \table_sql {
    /*public function col_direccion ($row){

        if ($this->is_downloading()) {
            return 'pepito';
        }
        return '<a href="https://google.com">'.$row->edad.'</a>';

    }*/

    public function col_edit ($row){

        if ($this->is_downloading()) {
            return '';
        }
        return html_writer::link( 
            new \moodle_url('/local/miguelplugin/pages/formulario.php', 
            array('id' => $row->id)), 
            'editar'
        );

    }

    public function col_borrar ($row){

        if ($this->is_downloading()) {
            return '';
        }
        return html_writer::link( 
            new \moodle_url('/local/miguelplugin/pages/formulario.php', 
            array('delete' => $row->id)), 
            'borrar'
        );

    }

}