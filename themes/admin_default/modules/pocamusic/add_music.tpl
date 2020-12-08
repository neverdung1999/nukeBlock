<!-- BEGIN: main -->

<form action="{ACTION}" method="POST" class="confirm-reload" name="add_music" enctype="multipart/form-data">
    <input id="is_save" name="save" type="hidden" value="1" />
    <input type="hidden" value="{ISCOPY}" name="copy" />
    <div class="row">
        <div class="col-sm-24 col-md-18">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <colgroup>
                        <col class="w200" />
                        <col />
                    </colgroup>
                    <tbody>
                        <tr>
                            <td class="text-right"> {LANG.tenbaihat} <sup class="required">(*)</sup></td>
                            <td>
                                <input class="w300 form-control pull-left" type="text" value="" name="tenbaihat"
                                    id="idtenbaihat" maxlength="250" />&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right"> {LANG.tencasi} <sup class="required">(*)</sup></td>
                            <td>
                                <select class="form-control w300" name="cars">
                                    <!-- BEGIN: loop -->
                                    <option value="{TEST.IDCASI}">{TEST.TENCASI}</option>
                                    <!-- END: loop -->
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right"> {LANG.tentheloai} <sup class="required">(*)</sup></td>
                            <td>
                                <select class="form-control w300" name="cars1">
                                    <!-- BEGIN: loop1 -->
                                    <option value="{TEST1.IDTHELOAI}">{TEST1.TENTHELOAI}</option>
                                    <!-- END: loop1 -->
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">{LANG.part} <sup class="required">(*)</sup></td>
                            <td>
                                Select audio to upload:
                                <input type="file" name="media">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">{LANG.img} <sup class="required">(*)</sup></td>
                            <td>
                                Select image to upload:
                                <input type="file" name="image">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">{LANG.publish} <sup class="required">(*)</sup></td>
                            <td>
                                <input type="checkbox" id="idpublish" name="publish" value="1">
                                <label> Phát hành </label><br>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row text-center"><input type="submit" name="dongy" value="{LANG.save}" class="btn btn-primary" />
    </div>
</form>

<br><br>

<table id="customers">
    <thead>
        <tr>
            <th style="text-align: center;">
                {LANG.stt}
            </th>
            <th style="text-align: center;">
                {LANG.tentheloai}
            </th>
            <th style="text-align: center;">
                {LANG.tencasi}
            </th>
            <th style="text-align: center;">
                {LANG.tenbaihat}
            </th>
            <th style="text-align: center;">
                {LANG.thoigianthem}
            </th>
            <th style="text-align: center;">
                {LANG.thoigianupdate}
            </th>
            <th style="text-align: center;">
                {LANG.music}
            </th>
            <th style="text-align: center;">
                {LANG.namemusic}
            </th>
            <th style="text-align: center;">
                {LANG.img}
            </th>
            <th style="text-align: center;">
                {LANG.trangthai}
            </th>
            <th style="text-align: center;">
                {LANG.edit}
            </th>
            <th style="text-align: center;">
                {LANG.delete}
            </th>
        </tr>
    </thead>
    <tbody>
        <!-- BEGIN: loopp -->
        <tr>
            <td>
                {SONG.IDBAIHAT}
            </td>
            <td>
                {SONG.TENTHELOAI}
            </td>
            <td>
                {SONG.TENCASI}
            </td>
            <td>
                {SONG.TENBAIHAT}
            </td>
            <td>
                {SONG.ADDTIME}
            </td>
            <td>
                {SONG.UPDATETIME}
            </td>
            <td class="w50">
                <audio controls>
                    <source src="{NV_URL}/music/{SONG.PART}" type="audio/mpeg">
                </audio>
            </td>
            <td>
                {SONG.PART}
            </td>
            <td>
                <img src="{NV_URL}/image/{SONG.IMAGE}" alt="Girl in a jacket" width="100" height="100">
            </td>
            <td>
                {PUBLISH}
            </td>
            <td class="text-center">
                <a href="{ROW1.link_edit}" title="Chỉnh sửa"><em class="fa fa-edit fa-lg">&nbsp;</em></a>
            </td>
            <td>
                <a href="{ROW.link_delete}" onclick="alert('Xóa bài hát thành công');" title="Xóa"><em
                        class="fa fa-trash-o fa-lg">&nbsp;</em></a>
            </td>
        </tr>
        <!-- END: loopp -->
    </tbody>
</table>

<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>
<!-- END: main -->