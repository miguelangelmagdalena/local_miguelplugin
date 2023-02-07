<?php

$observers = array(
    array(
        'eventname'   => '\core\event\user_loggedin',
        'callback'    => '\local_miguelplugin\observer\user_loggedin::user_logged',
        'priority'    => 200,
        'internal'    => false,
    )
);