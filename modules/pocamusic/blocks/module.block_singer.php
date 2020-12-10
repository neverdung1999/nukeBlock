<?php

if (!defined('NV_MAINFILE')) die('Stop!!!');

if (!function_exists('nv_filter_product')) {

    function nv_filter_product($block_config)
    {
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

    function nv_block_input_singer()
    {
        global $data_block, $module;
        $html = new XTemplate('module.block_singer.tpl', NV_ROOTDIR . '/modules/' . $module . '/blocks');
        $html->assign('DATA_BLOCK', $data_block);
        $html->parse('main');
        return $html->text('main');
    }

    function nv_block_input_singer_submit()
    {
        global $nv_Request;
        $html = array();
        $html['error'] = array();
        $html['data'] = array();
        $html['data']['singerName'] = $nv_Request->get_string('singerName', 'post', '');
        return $html;
    }
}


$content = nv_filter_product($block_config);
