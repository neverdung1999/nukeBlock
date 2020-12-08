<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 24-06-2011 10:35
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}

$page_title = $lang_module['add_cat_content'];
require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';
$xtpl = new XTemplate('add_cat.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$action = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;

$number = 0;
$getAllCat = getAllCat();
$CatName = array();

foreach ($getAllCat as $getCat) {
    $number += 1;
    $xtpl->assign('NUMBER', $number);
    $xtpl->assign('TEST1', $getCat);
    $link_delete = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=delete_cat&amp;listid=' . $getCat['IDTHELOAI'] . '&amp;checkss=' . md5($global_config['sitekey'] . session_id());
    $link_edit = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=edit_cat&amp;listid=' . $getCat['IDTHELOAI'] . '&amp;checkss=' . md5($global_config['sitekey'] . session_id());
    $xtpl->assign('ROW', $link_delete);
    $xtpl->assign('ROW1', $link_edit);
    $CatName[] = $getCat['TENTHELOAI'];
    $xtpl->parse('main.loop1');
}

$value['tentheloai'] = nv_substr($nv_Request->get_title('tentheloai', 'post', ''), 0, 250);

if ($value['tentheloai'] != null || !in_array('Rock', $CatName)) {
    if (in_array('Rock', $CatName)) {
        Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    }
    if ($value['tentheloai'] != null) {
        insertCat($value['tentheloai']);
        Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    }
}

$xtpl->assign('LANG', $lang_module);
$xtpl->assign('ACTION', $action);
$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
