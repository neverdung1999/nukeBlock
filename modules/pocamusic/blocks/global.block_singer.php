<?php

if (!defined('NV_MAINFILE')) die('Stop!!!');

if (!nv_function_exists('global_singer')) {
    function global_singer($block_config) {
        global $global_config, $module_data, $db;
        $html = new XTemplate('module.block_singer.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $block_config['module']);

        $data = array();

        $baihat = NV_PREFIXLANG . '_' . $module_data . '_baihat';
        $casi = NV_PREFIXLANG . '_' . $module_data . '_casi';
        $theloai = NV_PREFIXLANG . '_' . $module_data . '_theloai';

        $sql = 'SELECT ' . $baihat . '.idBaihat, ' . $casi . '.TenCasi, ' . $theloai . '.tenTheLoai, ' . $baihat . '.tenBaihat, '
            . $baihat . '.add_time, ' . $baihat . '.update_time, ' . $baihat . '.part, ' . $baihat . '.img, ' . $baihat . '.publish ' .
            'FROM ' . $baihat .
            ' INNER JOIN ' . $casi . ' ON ' . $baihat . '.idCasi = ' . $casi . '.idCasi ' .
            ' INNER JOIN ' . $theloai . ' ON ' . $baihat . '.idTheloai = ' . $theloai . '.IdTheLoai ORDER BY idBaihat ASC';
        // die($sql);

        try {
            $query = $db->query($sql);
            while (list($idBaihat, $TenCasi, $tenTheLoai, $tenBaihat, $add_time, $update_time, $part, $img, $publish) = $query->fetch(3)) {
                $data[] = array(
                    "IDBAIHAT" => $idBaihat,
                    "TENCASI" => $TenCasi,
                    "TENTHELOAI" => $tenTheLoai,
                    "TENBAIHAT" => $tenBaihat,
                    "ADDTIME" => gmdate("Y/m/d H:i:s", $add_time),
                    "UPDATETIME" =>  gmdate("Y/m/d H:i:s", $update_time),
                    "PART" => $part,
                    "IMAGE" => $img,
                    "PUBLISH" => $publish
                );
            }
        } catch (PDOException $e) {
            trigger_error($e->getMessage());
        }

        foreach($data as $Song) {
            $html->assign('SONG',$Song);
            $html->parse('main.loopSong');
        }

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