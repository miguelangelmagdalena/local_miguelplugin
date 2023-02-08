<?php

namespace local_miguelplugin\external;

global $CFG;

require_once($CFG->libdir . '/externallib.php');

class plugin extends \external_api
{
    public static function get_user_parameters()
    {
        return new \external_function_parameters(
            array(
                'ids' => new \external_multiple_structure(
                    new \external_value(PARAM_INT)
                )
            )
        );
    }

    public static function get_user($ids)
    {
        $params = self::validate_parameters(
            self::get_user_parameters(),
            array('ids' => $ids)
        );

        global $DB;
        $users = [];

        foreach ($params['ids'] as $id) {
            $record = $DB->get_record('local_miguelplugin', array('id' => $id));
            $users[] = $record->nombre;
        }

        return $users;
    }

    public static function get_user_returns()
    {
        return new \external_multiple_structure(
            new \external_value(PARAM_RAW)
        );
    }
}
