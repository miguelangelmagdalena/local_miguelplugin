<?php

defined('MOODLE_INTERNAL') || die();

global $CFG;

if ($hassiteconfig) { //needs this condition or there is error on login page

    $ADMIN->add('localplugins', new admin_category('local_miguelplugin_settings', new lang_string('pluginname', 'local_miguelplugin')));
    $settingspage = new admin_settingpage('managelocalmiguelplugin', 'test');

    if ($ADMIN->fulltree) {
        $settingspage->add(new admin_setting_configcheckbox(
            'local_miguelplugin/showinnavigation',
            'test',
            'test2',
            1
        ));
    }

    $ADMIN->add('localplugins', $settingspage);

    //##
    $tab = new theme_boost_admin_settingspage_tabs('tab', 'config plugin');
    $settings = new admin_settingpage('local_miguelplugin', get_string('pluginname', 'local_miguelplugin'));
    $settings->add(new admin_setting_configtext(
        'local_miguelplugin/name',
        'Nombre',
        'Information about this option',
        100,
        PARAM_INT
    ));

    $settings->add(new admin_setting_configmultiselect(
        'local_miguelplugin/lista',
        'lista',
        'Lista',
        [],
        array(1 => 'pepito', 2 => 'pablito')
    ));

    $tab->add($settings);
    $page = new admin_settingpage('pagina2', 'pagina2');
    $page->add(new admin_setting_configtextarea('local_miguelplugin/texto', 'texto', 'descripción del texto', ''));
    $page->add(new admin_setting_configselect_with_lock('local_miguelplugin/cosa', 'cosito', '', 
        ['value' => 0, 'locked' => true], 
        [0 =>  'option1', 2 => 'option2']));
    $tab->add($page);

    $ADMIN->add('localplugins', $tab);

    $customadmin = new admin_externalpage(
        'local_miguelplugin/paginaexterna',
        'Pagina externa',
        $CFG->wwwroot.'/local/miguelplugin/view.php'
    );
    $settingpage = new admin_category('padre', 'pagina padre');
    $childpage = new admin_settingpage('hijo', 'pagina hija');

    $ADMIN->add('localplugins', $settingpage);
    $ADMIN->add('padre', $customadmin);

}