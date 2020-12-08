<!-- BEGIN: main -->


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


<form action="{ACTION}" method="POST" class="confirm-reload" name="add_music" enctype="multipart/form-data">
  <input id="is_save" type="hidden" name="idInput" value="{SONG.IDBAIHAT}" />
  <input id="is_save" type="hidden" name="path" value="{SONG.PART}" />
  <input id="is_save" type="hidden" name="img" value="{SONG.IMAGE}" />
  <input type="hidden" value="{ISCOPY}" name="copy" />
  <div class="row">
    <div class="col-sm-24 col-md-18">
      <div class="table-responsive">
        <table class="table" id="customers">
          <colgroup>
            <col class="w200" />
            <col />
          </colgroup>
          <thead>
            <th class="text-center">
              <b>Danh mục</b>
            </th>
            <th class="text-center">
              <b>Dữ liệu chọn</b>
            </th>
            <th class="text-center">
              <b>Thông tin bài hát hiện tại</b>
            </th>
          </thead>
          <tbody>
            <tr>
              <td class="text-left"> {LANG.tenbaihat}</td>
              <td>
                <input class="w300 form-control pull-left" type="text" value="{SONG.TENBAIHAT}" name="tenbaihat"
                  id="idtenbaihat" maxlength="250" />&nbsp;
              </td>
              <td>
                <b>Tên bài hát hiện tại: {SONG.TENBAIHAT} </b>
              </td>
            </tr>
            <tr>
              <td class="text-left"> {LANG.tencasi} <sup class="required">(*)</sup></td>
              <td>
                <select class="form-control w300" name="singer">
                  <!-- BEGIN: loop -->
                  <option value="{TEST.IDCASI}">{TEST.TENCASI}</option>
                  <!-- END: loop -->
                </select>
              </td>
              <td>
                <b>Ca sĩ hiện tại: {SONG.TENCASI}</b>
              </td>
            </tr>
            <tr>
              <td class="text-left"> {LANG.tentheloai} <sup class="required">(*)</sup></td>
              <td>

                <select class="form-control w300" name="cat">
                  <!-- BEGIN: loop1 -->
                  <option value="{TEST1.IDTHELOAI}">{TEST1.TENTHELOAI}</option>
                  <!-- END: loop1 -->
                </select>
              </td>
              <td>
                <b>Thể loại hiện tại: {SONG.TENTHELOAI}</b>
              </td>
            </tr>
            <tr>
              <td class="text-left">{LANG.part}</td>
              <td>
                Lựa chọn file media upload (Định danh .mp3)
                <input type="file" name="media">
              </td>
              <td>
                <b> Thông tin file media hiện tai: {SONG.PART} </b> <br><br>
              </td>
            </tr>
            <tr>
              <td class="text-left">{LANG.img}</td>
              <td>
                Lựa chọn file image upload (Định danh .jpg, .png)
                <input type="file" name="image">
              </td>
              <td>
                <b> Thông tin file image hiện tại: {SONG.IMAGE} </b> <br><br>
              </td>
            </tr>
            <tr>
              <td class="text-left">{LANG.publish}</sup></td>
              <td>
                <input type="checkbox" name="publish" value="1" {CHECKED}>
                <label> Phát hành </label><br>
              </td>
              <td>
                <b>
                  Trạng thái: {PUBLISH}
                </b>
              </td>
            </tr>
          </tbody>
        </table>
        <b style="color: red;"><sup class="required">(*)</sup> Lưu ý: các mục này sẽ không được lưu lại dữ liệu thông
          tin trước đó.</b>
      </div>
    </div>
  </div>
  <div class="row text-center"><input type="submit" name="dongy" value="{LANG.save}" class="btn btn-primary" />
  </div>
</form>
<!-- END: main -->