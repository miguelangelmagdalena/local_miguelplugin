<?php

namespace local_miguelplugin\observer;

global $CFG;

class user_loggedin {
    public static function user_logged($event){
        var_dump($event);
        exit;
    }
}