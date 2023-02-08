<?php

namespace local_miguelplugin\task;

class print_hello extends \core\task\scheduled_task {
    public function get_name ()
    {
        return get_string('schedulename', 'local_miguelplugin');
    }
    public function execute()
    {
        $last = $this->get_last_run_time();
        echo '<pre>';
        var_dump('Hola mundo ', userdate($last));
        throw new \moodle_exception('error');
        echo '</pre>';
    } 
}