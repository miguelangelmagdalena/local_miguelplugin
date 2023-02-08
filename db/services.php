<?php

$functions = [
    // The name of your web service function, as discussed above.
    'local_miguelplugin_get_user' => [
        // The name of the namespaced class that the function is located in.
        'classname'   => 'local_miguelplugin\external\plugin',

        'methodname' => 'get_user',
        // A brief, human-readable, description of the web service function.
        'description' => 'Obtiene un usuario',

        // Options include read, and write.
        'type'        => 'read',

        // Whether the service is available for use in AJAX calls from the web.
        'ajax'        => false,

        // An optional list of services where the function will be included.
        'services'    => [
            // A standard Moodle install includes one default service:
            // - MOODLE_OFFICIAL_MOBILE_SERVICE.
            // Specifying this service means that your function will be available for
            // use in the Moodle Mobile App.
            MOODLE_OFFICIAL_MOBILE_SERVICE,
        ],
    ]
];

$services = [
    'servicemiguelplugin' => [
        'functions' => ['local_miguelplugin_get_user', 'core_user_get_users'],
        'restricteduser' => 0,
        'enable' => 1
    ]
];