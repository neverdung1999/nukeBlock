<?php

if (!defined('NV_MAINFILE')) die('Stop!!!');

if (!nv_function_exists('global_singer')) {
    function global_singer($block_config) {
        global $global_config;
        $html = new XTemplate('block.singer.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $block_config['module']);
        $html->assign('BLOCK_CONFIG', $block_config);
        $html->parse('main');
        return $html->text('main');
    }

    function singers() {
        global $module,$data_block;
        $html = new XTemplate('global.config_block_singer.tpl', NV_ROOTDIR . '/modules/' . $module . '/blocks');
        $html->assign('DATA_BLOCK', $data_block);
        $html->parse('main');
        return $html->text('main');
    }

    function singers_submit() {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config'] = array();
        $return['config']['aaaa']= $nv_Request->get_int('config_numrow', 'post', 0);
        return $return;
    }
}

if (defined('NV_SYSTEM')) {
    $content = global_singer($block_config);
}