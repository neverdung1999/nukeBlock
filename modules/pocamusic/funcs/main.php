<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Apr 20, 2010 10:47:41 AM
 */

if (!defined('NV_IS_MOD_MUSIC')) {
    die('Stop!!!');
}

require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';

$page_title = $lang_module['main_content'];
$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
// $action = NV_LANG_DATA . '/' . $module_name . '&amp;' . NV_OP_VARIABLE . '=sort';
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);

$allMusic = getIdPublishShow();
$allSinger = getAllSinger();
$xtpl->assign('allMusic', $allMusic);

//truyen id qua function deleteSong
$id = $nv_Request->get_int('listid', 'get', 0);
deleteSong($id);

foreach ($allMusic as $song) {
    $xtpl->assign('SONG', $song);
    $link_delete = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=delete_music&amp;listid=' . $song['IDBAIHAT'] . '&amp;checkss=' . md5($global_config['sitekey'] . session_id());
    $link_edit = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=edit_music&amp;listid=' . $song['IDBAIHAT'] . '&amp;checkss=' . md5($global_config['sitekey'] . session_id());
    $xtpl->assign('ROW', $link_delete);
    $xtpl->assign('ROW1', $link_edit);
    if ($song['PUBLISH'] == 1) {
        $xtpl->assign('PUBLISH', 'Hiển thị');
    } else {
        $xtpl->assign('PUBLISH', 'Ẩn');
    }
    $xtpl->parse('main.loopp');
}

foreach ($allSinger as $singer) {
    $xtpl->assign('SINGER', $singer);
    $xtpl->parse('main.loopSinger');
}

$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
$xtpl->assign( 'NV_UPLOADS_DIR', NV_UPLOADS_DIR );
$xtpl->assign('LANG', $lang_module);
$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
