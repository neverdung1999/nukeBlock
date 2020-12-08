<?php

if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}
require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';
$xtpl = new XTemplate('edit_song.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$page_title = $lang_module['edit_music_content'];
$action = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;

$id = $nv_Request->get_int('listid', 'get', 0);
$idInput = $nv_Request->get_int('idInput', 'post', 0);
$path = $nv_Request->get_string('path', 'post', '');
$pathImg = $nv_Request->get_string('img', 'post', '');
$showSong = showDataSong($id);

foreach ($showSong as $song) {
    if ($song['PUBLISH'] != 0) {
        $xtpl->assign('CHECKED', 'checked');
    }
    if ($song['PUBLISH'] == 1) {
        $xtpl->assign('PUBLISH', 'Hiển thị');
    } else {
        $xtpl->assign('PUBLISH', 'Ẩn');
    }
    $xtpl->assign('SONG', $song);
}

$getAllSinger = getAllSinger();
$getAllCat = getAllCat();

foreach ($getAllSinger as $test) {
    $xtpl->assign('TEST', $test);
    $xtpl->parse('main.loop');
}

foreach ($getAllCat as $test) {
    $xtpl->assign('TEST1', $test);
    $xtpl->parse('main.loop1');
}

$a = $value['idtheloai'] = $nv_Request->get_int('cat', 'post', 0);
$b = $value['idcasi'] = $nv_Request->get_int('singer', 'post', 0);
$c = $value['tenbaihat'] = $nv_Request->get_string('tenbaihat', 'post', '');
$f = $value['publish'] = $nv_Request->get_int('publish', 'post', 0);



if ($idInput != 0) {


    if (!file_exists($_FILES['media']['tmp_name']) || !is_uploaded_file($_FILES['media']['tmp_name']) == UPLOAD_ERR_NO_FILE) {
        $d = $value['part'] = $path;
    } else {
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

    if (!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name']) == UPLOAD_ERR_NO_FILE) {
        $e = $value['img'] = $pathImg;
    } else {
        $file_name = $_FILES["image"]["name"];
        $file_type = $_FILES["image"]["type"];
        $tmp_name = $_FILES["image"]["tmp_name"];
        $file_size = $_FILES["image"]["size"];

        $ext = explode(".", $file_name);
        $file_ext = strtolower(end($ext));

        $array_ext = array("jpg", "png" , "jpeg");
        if (!in_array($file_ext, $array_ext)) {
            Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        } else {
            move_uploaded_file($tmp_name, NV_ROOTDIR . '/uploads/' . $module_file . '/image/' . $file_name);
            $e = $value['img'] = $file_name;
        }
    }

    if ($f != 1) {
        $f = 0;
    } else {
        $f = 1;
    }

    editSong($idInput, $a, $b, $c, $d, $e, $f);
    Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main');
}


$xtpl->assign('UPLOADS_DIR_USER', NV_UPLOADS_DIR . '/' . $module_upload);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('ACTION', $action);
$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
