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

require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';

$xtpl = new XTemplate('add_music.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$page_title = $lang_module['add_music_content'];
$action = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
$xtpl->assign('NV_URL', NV_BASE_SITEURL . 'uploads/' . $module_file);

$getAllSinger = getAllSinger();
$getAllCat = getAllCat();
$allMusic = getAllMusic();
$number = 1;

foreach ($getAllSinger as $test) {
    $xtpl->assign('TEST', $test);
    $xtpl->parse('main.loop');
}

foreach ($getAllCat as $test) {
    $xtpl->assign('TEST1', $test);
    $xtpl->parse('main.loop1');
}

foreach ($allMusic as $song) {
    $xtpl->assign('SONG', $song);
    $xtpl->assign('NUMBER', $number++);
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

$a = $value['idcasi'] = $nv_Request->get_int('cars', 'post', 0);
$b = $value['idtheloai'] = $nv_Request->get_int('cars1', 'post', 0);
$c = $value['tenbaihat'] = nv_substr($nv_Request->get_title('tenbaihat', 'post', ''), 0, 250);
$f = $value['publish'] = $nv_Request->get_int('publish', 'post', 0);

if (isset($_FILES["media"])) {
    $file_name = $_FILES["media"]["name"];
    $file_type = $_FILES["media"]["type"];
    $tmp_name = $_FILES["media"]["tmp_name"];
    $file_size = $_FILES["media"]["size"];

    $ext = explode(".", $file_name);
    $file_ext = strtolower(end($ext));

    $array_ext = array("mp3");
    if (!in_array($file_ext, $array_ext)) {
        Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    } else {
        move_uploaded_file($tmp_name, NV_ROOTDIR . '/uploads/' . $module_file . '/music/' . $file_name);
        $d = $value['part'] = $file_name;
    }
}

if (isset($_FILES["image"])) {
    $file_name = $_FILES["image"]["name"];
    $file_type = $_FILES["image"]["type"];
    $tmp_name = $_FILES["image"]["tmp_name"];
    $file_size = $_FILES["image"]["size"];

    $ext = explode(".", $file_name);
    $file_ext = strtolower(end($ext));

    $array_ext = array("jpg", "png");
    if (!in_array($file_ext, $array_ext)) {
        die("111");
        Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    } else {
        move_uploaded_file($tmp_name, NV_ROOTDIR . '/uploads/' . $module_file . '/image/' . $file_name);
        $e = $value['img'] = $file_name;
    }
}

if ($value['tenbaihat'] != null && $value['part'] != null) {

    if ($f != 1) {
        $f = 0;
    } else {
        $f = 1;
    }

    insertSong($a, $b, $c, $d, $e, $f);
    Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
}

$xtpl->assign('UPLOADS_DIR_USER', NV_UPLOADS_DIR . '/' . $module_upload);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('ACTION', $action);
$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
