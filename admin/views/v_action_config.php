<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo $titleAction;?>
            </header>
            <div class="panel-body" style = "width:800px">
                <div class="adv-table editable-table ">
                    <!--content-->
                    <label style="color: red">Chú ý: Re-Up channel hoặc playlist chỉ nên tạo một cấu hình cho một kênh!!!</label>
                    <form class="form-horizontal tasi-form" method="post" action="<?php echo BASE_PATH; ?>/admin/controller/c_config.php?controller=config&action=add_config"  id="configForm" enctype="multipart/form-data">
                        <section class="panel">
                            <div hidden class="panel-body">
                                <input type="submit" id="default-next-0" class="button-next btn btn-info" name="add" value="Lưu"/>
                            </div>
                        </section>
                        <section class="panel" >
                            <input type="hidden" name="IDConfig" value="<?php if ($ID != 0){ echo $ID;}?>">
                            <div class="panel-body" >
                                <div class="tab-content" >
                                    <div id="info" class="tab-pane active" >
                                        <!--   Chọn kênh-->
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label>Chọn kênh</label>
                                                <div class="col-lg-12">
                                                    <select class="form-control m-bot15" id="ChannelIDADD" name="ChannelIDADD">
                                                        <?php
                                                        foreach ($arr_channel as $channel) {
                                                            ?>
                                                            <option value="<?php echo $channel["ChannelID"]?>"><?php echo $channel["ChannelName"]?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <select class="form-control m-bot15" id="ChannelReupMusic" name="ChannelReupMusic" style="display: none">
                                                        <?php
                                                        foreach ($arr_channelReupMusic as $channelReupMusic) {
                                                            ?>
                                                            <option value="<?php echo $channelReupMusic["ChannelID"]?>"><?php echo $channelReupMusic["ChannelName"]?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  End Chọn kênh:-->

                                        <div class="form-group">
                                            <!--   Thêm Link hoặc Keyword:-->
                                            <div class="col-sm-12">
                                                <label>Thêm Link hoặc Keyword</label>
                                                <div class="col-lg-12">
                                                    <label class="checkbox-inline">
                                                        <input type="radio" name="ReupFromLinkAdd" id="ReupFromLinkAdd" onclick="checkInputVideo()"  checked=checked value="1" > Reup Từ Link (Channel hoặc Video)
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="radio" name="ReupFromLinkAdd" id="ReupFromPLL" onclick="checkInputVideo()"   value="1" > Reup Từ Link (Playlist)
                                                    </label>
                                                    <label class="checkbox-inline" style="display: none">
                                                        <input type="radio" name="ReupFromLinkAdd" id="ReupFromKeyWord" onclick="checkInputVideo()"  value="2" > Reup Theo Keyword
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="radio" name="ReupFromLinkAdd" id="ReupMusic"  onclick="checkInputVideo()" value="3" > Reup Nhạc
                                                    </label>
                                                    <label class="checkbox-inline" style="display: none">
                                                        <input type="radio" name="ReupFromLinkAdd" id="CreateVideo"  onclick="checkInputVideo()" value="4" > Tạo nhạc
                                                    </label>
                                                </div>
                                                <input hidden value="Submit" onclick = ChangeRadiobutton()>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <div class="col-lg-12">
                                                    <span id="reup_lable" style="color: #eb0708">Vui lòng điền <strong>Link Channel</strong>Hoặc <strong>Link Video</strong> đầy đủ dạng ID. Ví dụ: https://www.youtube.com/channel/UCANLZYMidaCbLQFWXBC95Jg </span>
                                                </div>
                                                <div  class="col-lg-6">
                                                    <textarea id="url" name="url" class="form-control tat" rows="8"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div  id="UploadImage" style="display: none ; margin: 0;" >
                                                    <label for="ImageAdd">Nhập ảnh</label>
                                                    <input type="file" accept=".jpg" id="ImageAdd" name="ImageAdd" onchange="readURL(this);"> <br>
                                                    <img id="blah" src="../img/ytb_thumb.jpg"  width="300px" height="150px" />
                                                </div> <br>
<!--                                                <div  id="UploadAudio" style="display: none">-->
<!--                                                    <label for="ImageAdd">Nhập file nhạc</label>-->
<!--                                                    <input type="file" id="AudioAdd" name="AudioAdd">-->
<!--                                                </div>-->
<!--                                                <input type="checkbox" id="SetThumbnail" name="SetThumbnail">-->
                                            </div>
                                        </div>
                                        <div class="form-group  col-lg-12" id="thumbnail" >
                                          <div class=" col-lg-12">
                                            <label class="checkbox-inline" >
                                                <input type="checkbox" onclick="checkInputVideo()" checked name="SetThumbnail" id="SetThumbnail"  class="ck-filter-chil2" value="1080">Set Thumbnail
                                            </label>
                                          </div>
                                        </div>
                                        <!-- filter-->
                                        <div class="form-group" id="filterVideo">
                                            <div  class="col-lg-12">
                                                <div  class="col-lg-12">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="FilterVideoAdd" id="FilterVideoAdd"  onclick="checkfilter()" value="1">Lọc video  </label>
                                                    <div id="filter_link"   class="col-lg-12" style="display:block;">
                                                        <div id="div_filter_res" style="display: none" >
                                                            <label class="checkbox-inline" >
                                                                <input type="checkbox" name="FilterQualityMode" id="FilterMode"  onclick="checkfilter()"  class="ck-filter-chil1" value="1">Lọc chất lượng của video
                                                            </label>
                                                            <div id="filterQuality" style="display: none" onclick="checkfilter()">
                                                                <label class="checkbox-inline">
                                                                    <input type="radio" name="FilterQuality" id="FilterQuality"    class="ck-filter-chil2" value="480">SD
                                                                </label>
                                                                <label class="checkbox-inline">
                                                                    <input type="radio" name="FilterQuality" id="FilterQuality"  class="ck-filter-chil2" value="720">HD
                                                                </label>
                                                                <label class="checkbox-inline">
                                                                    <input type="radio" name="FilterQuality" id="FilterQuality"  class="ck-filter-chil2" value="1080">FullHD
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="ck_filter_time" style="display: none"   >
                                                            <label class="checkbox-inline"  onclick="checkfilter()" >
                                                                <input type="checkbox" name="FilterTimeMode"  class="ck-filter-chil1" onclick="checkfilter()" id="filtertimeck" value="2">Lọc theo độ dài của videos
                                                            </label>
                                                            <div id="div_filter_time"  style="display: none" >
                                                                <label class="checkbox-inline">
                                                                    <input type="radio" name="FilterTime" id="ck_filter_time_value" class="ck-filter-chil2" value="3"> lớn hơn 4p
                                                                </label>
                                                                <label class="checkbox-inline">
                                                                    <input type="radio" name="FilterTime" id="ck_filter_time_value"  class="ck-filter-chil2" value="2"> từ : 4p đến: 20p
                                                                </label>
                                                                <label class="checkbox-inline">
                                                                    <input type="radio" name="FilterTime" id="ck_filter_time_value"  class="ck-filter-chil2" value="1"> lớn hơn 20p
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="AdvanceFilter"  style="display: none"  >
                                                            <label class="checkbox-inline"  onclick="checkfilter()" >
                                                                <input type="checkbox" name="FilterAdvance"  class="ck-filter-chil1" onclick="checkfilter()" id="filteradvance" value="3">Lọc theo thời gian hoặc views
                                                            </label>
                                                            <div id="div_filter_advance"  style="display: none" >
                                                                <label class="checkbox-inline">
                                                                    <input type="radio" name="filterAdvanceValue" id="filterAdvanceValue" onclick="checkfilter()" class="ck-filter-chil2" value="0"> Video mới nhất của kênh

                                                                </label>
                                                                <label class="checkbox-inline">
                                                                    <input type="radio" name="filterAdvanceValue" id="filterVideoViews"  onclick="checkfilter()" class="ck-filter-chil2" value="5"> Video có lượng views nhiều nhất                                                                </label> <br>
                                                                    <input type="text" name="FilterViewValue" id="FilterViewValue"  style="margin: auto"  value="" class="col-md-4" placeholder="nhập số views cần lọc" >
                                                                </label>

                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  End Thêm Link hoặc Keyword:-->

                                        <!-- Tiêu Đề-->
                                        <div class="form-group">
                                            <div  class="col-lg-12">
                                                <label>Tiêu Đề: </label>  (tối đa là 100 kí tự) <br>
                                            </div>
                                            <div class="col-lg-12" id="ReplaceTitleByPart" >
                                                <label class="checkbox-inline"><input type="radio" name="TitleReplaceMode" id="ck_add_local_title" onclick="checkTitle()" value="1" > Thay thế từng phần
                                                </label>
                                                <div  class="col-lg-12" id = "part_replacetilte" style = "display:none;margin-left: 50px">
                                                    <label class="checkbox-inline"><input type="checkbox" name="TitleReplacePost" id="ck_add_first_title" onclick="checkTitle()" value="1"> Thêm vào đầu
                                                    </label>
                                                    <div id="box_add_first_title" class="col-lg-12" >
                                                        <input type="text" name="AddTitleFirst" id="text_add_first_title" placeholder="Normal or Spin title: I {love|hate|like} youtube!" class="form-control m-bot15">
                                                    </div>
                                                    <label class="checkbox-inline"><input type="checkbox" name="TitleReplacePost" id="ck_add_last_title" onclick="checkTitle()" value="2"> Thêm vào cuối
                                                    </label>
                                                    <div id="box_add_last_title" class="col-lg-12" >
                                                        <input type="text" name="AddTitleEnd" id="text_add_last_title"  placeholder="Normal or Spin title: I {love|hate|like} youtube!" class="form-control m-bot15">
                                                    </div>
                                                    <label class="checkbox-inline"><input type="checkbox" name="TitleReplacePost" id="ck_add_replace_title" onclick="checkTitle()" value="3"> Thay thế </label>
                                                    <div id="box_add_replace_title"  class="col-lg-12">
                                                        <input type="text" name="ReplaceTitleFrom" id="text_add_replace_titleA"  class="form-control m-bot15">  Bằng: <input type="text" name="ReplaceTitleTo" id="text_add_replace_titleB" placeholder="Normal or Spin title: I {love|hate|like} youtube!"  class="form-control m-bot15">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12" id = "all_replacetilte">
                                                <label class="checkbox-inline"><input type="radio" name="TitleReplaceMode" id="ck_add_all_title"  onclick="checkTitle();" value="2"> Thay thế toàn bộ</label>
                                                <div id="box_add_all_title"  class="col-lg-12"  style = "display:none;margin-left:50px">
                                                    <input type="text" name="ReplaceAllTitle"  id="text_add_all_title" onKeyup="CheckForm(1);"  placeholder="Normal or Spin title: I {love|hate|like} youtube!" class="form-control m-bot15">
                                                </div>
                                            </div>

<!--                                            <div class="col-lg-12" id="box_spin_title" style = "margin-left: 20px">-->
<!--                                                <input type="checkbox" name="TranslateTitleTo" id="ck_spin_title" value="1">Tiêu đề thông minh <br>-->
<!--                                                <span style = "margin-left: 20px">Ngôn ngữ: </span><select class="inAutoReup input_select" name="TranslateTitleTo">-->
<!--                                                    --><?php //echo $TranslateLanguage;?>
<!--                                                </select><br>-->
<!--                                            </div>-->

                                        </div>
                                        <!-- End Tiêu Đề-->

                                        <!-- Mô Tả-->
                                        <div class="form-group">
                                            <div  class="col-lg-12">
                                                <label>Mô tả: </label>  (tối đa 5000 kí tự)
                                            </div>
                                            <div  class="col-lg-12" id="ReplaceDesByPart">
                                                <label class="checkbox-inline">
                                                    <input type="radio" name="ReplaceDesMode" id="ck_add_local_des" onclick = "checkDes();" value="1"> Thay thế từng phần </label> <br>
                                                <div  class="col-lg-12" id = "part_replaceDes" style = "display:none;margin-left: 50px">
                                                    <label class="checkbox-inline"><input type="checkbox" name="AddDesFirst" id="ck_add_first_des" value="1"> Thêm vào đầu
                                                    </label>
                                                    <div id="box_add_first_des" class="col-lg-12">
                                                        <textarea type="text" name="AddDesFirst" class="form-control tat" id="text_add_first_des" rows="5" placeholder="Normal or Spin Des: I {love|hate|like} youtube!"></textarea>
                                                    </div>
                                                    <label class="checkbox-inline"><input type="checkbox" name="ReplaceDesContent" id="ck_add_last_des" value="2"> Thêm vào cuối </label>
                                                    <div id="box_add_last_des" class="col-lg-12">
                                                        <textarea type="text" name="AddDesEnd" class="form-control tat" id="text_add_last_des" rows="5" placeholder="Normal or Spin Des: I {love|hate|like} youtube!"></textarea>
                                                    </div>
                                                    <input type="checkbox" name="ReplacePost" id="ck_add_replace_des" value="3"> Thay thế </label>
                                                    <div id="box_add_replace_des"  class="col-lg-12">
                                                        <input type="text" name="ReplaceDesFrom" id="ReplaceDesFrom" class="form-control m-bot15">  Bằng: <input type="text" name="ReplaceDesTo" id="ReplaceDesTo" placeholder="Normal or Spin title: I {love|hate|like} youtube!"  class="form-control m-bot15">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12" id = "all_replacedes">
                                                <label class="checkbox-inline">
                                                    <input type="radio" name="ReplaceDesMode" id="ck_add_all_des" value="1"  onclick = "checkDes();"> Thay thế toàn bộ </label>
                                                <div id="box_add_all_des" class="col-lg-12" style = "display:none;margin-left: 50px">
                                                    <textarea type="text" name="ReplaceDesAll" class="form-control tat" onKeyup="CheckForm(2);" id="text_add_all_des" rows="8" placeholder="Normal or Spin Des: I {love|hate|like} youtube!"></textarea><br>
                                                </div>
                                            </div>

                                            <div class="col-lg-12" id="box_spin_des" style = "margin-left: 20px">
<!--                                                <input type="checkbox" name="TranslateDes" id="ck_spin_des" value="1">Mô tả thông minh <br>-->
<!--                                                <span style = "margin-left: 20px">Ngôn ngữ: </span>-->
<!--                                                <select class="inAutoReup input_select" name="TranslateDesTo">-->
<!--                                                    --><?php //echo $TranslateLanguage;?>
<!--                                                </select><br>-->
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="ReplaceLink" checked id="ReplaceLinkInDes" value="1"> Loại bỏ Link trong mô tả </label>
                                                </div>
                                            </div>


                                        <!-- End Mô Tả-->

                                        <!-- Thẻ Tag-->
                                        <div  class="form-group">
                                            <div class="col-lg-12">
                                                <label>Thẻ Tag: </label> (tối đa 500 kí tự)
                                            </div>
                                            <div class="col-lg-12" id="ReplaceTagByPart">
                                                <label class="checkbox-inline">
                                                    <input type="radio" name="ReplaceTagMode" id="ck_add_local_tag" onclick = "checkTag();"value="1"> Thay thế từng phần </label>
                                                <div  class="col-lg-12" id = "part_replacetag" style = "display:none;margin-left: 50px">
                                                    <label class="checkbox-inline"><input type="checkbox" name="ReplaceTagPost" id="ck_add_first_tag" value="1"> Thêm vào đầu </label>
                                                    <div id="box_add_first_tag" class="col-lg-12">
                                                        <input type="text" name="AddTagFirst" class="form-control" id="text_add_first_tag" placeholder="Normal or Spin tag: I {love|hate|like} youtube!">
                                                    </div>
                                                    <label class="checkbox-inline"><input type="checkbox" name="ReplaceTagPost" id="ck_add_last_tag" value="2"> Thêm vào cuối </label>
                                                    <div id="box_add_last_tag"  class="col-lg-12">
                                                        <input type="text" name="AddTagEnd" class="form-control" id="text_add_last_tag" placeholder="Normal or Spin tag: I {love|hate|like} youtube!" >
                                                    </div>
                                                    <input type="checkbox" name="ReplaceTag" id="ck_add_replace_title" value="3"> Thay thế </label>
                                                    <div id="box_add_replace_title"  class="col-lg-12">
                                                        <input type="text" name="ReplaceTagFrom" id="ReplaceTagFrom" class="form-control m-bot15">  Bằng: <input type="text" name="ReplaceTagTo" id="ReplaceDesTo" placeholder="Normal or Spin title: I {love|hate|like} youtube!"  class="form-control m-bot15">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12" id = "all_replacetag">
                                                <label class="checkbox-inline">
                                                    <input type="radio" name="ReplaceTagMode" id="ck_add_all_tag" onclick = "checkTag();" value="2"> Thay thế toàn bộ </label>
                                                <div id="box_add_all_tag" class="col-lg-12" style = "display:none;margin-left: 50px">
                                                    <textarea type="text" name="AddTagAll" class="form-control tat" onKeyup="CheckForm(3);" id="text_add_all_tag" rows="8" placeholder="Normal or Spin tag: I {love|hate|like} youtube!"></textarea>
                                                    <br>
                                                </div>
                                            </div>
<!--                                            <div class="col-lg-12" id="box_spin_tag" style = "margin-left: 20px">-->
<!--                                                <input type="checkbox" name="TranslateTag" id="ck_spin_title" value="1">Thẻ Tag thông minh <br>-->
<!--                                                <div id="box_spin_tag">-->
<!--                                                    <span style = "margin-left: 20px">Ngôn ngữ: </span>-->
<!--                                                    <select class="inAutoReup input_select" name="TranslateTagTo">-->
<!--                                                        --><?php //echo $TranslateLanguage;?>
<!--                                                    </select>-->
<!--                                                </div>-->
<!--                                            </div>-->
                                        </div>
                                        <!-- End Thẻ Tag-->

                                        <!-- Chức năng nâng cao-->
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <label>Chức Năng Nâng Cao:</label>
                                            </div>
                                            <div class="col-lg-12" style = "margin-left: 50px">
                                                <input type="checkbox" name="is_videointro" id="is_videointro" value="1"> Thêm Video Intro
                                                <div id="active_videointro" style="display: block;">
                                                    <label class="checkbox-inline">
                                                        <input type="radio" name="radioVideoIntro" id="addIntroFirst" value="1"> Thêm vào đầu </label>
                                                    <label class="checkbox-inline">
                                                        <input type="radio" name="radioVideoIntro" id="addIntroEnd" value="2"> Thêm vào cuối</label>
                                                    <input type="text" name="addIntro" id="addIntro" class="form-control" placeholder="Điền link video intro của bạn">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Chức năng nâng cao-->

                                        <!-- Trạng Thái-->
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Trạng Thái: </label>
                                            </div>
                                            <div class="col-sm-12" style = "margin-left: 50px">
                                                <select class="form-control input_select" id="PrivacyStatusAdd"  onchange="privacyStatusChange()" name="PrivacyStatusAdd">
                                                    <option value="public">Công Khai</option>                                                    
                                                    <option value="private">Riêng Tư</option>
                                                </select>
                                            </div> <br>
                                            <div class="col-sm-12" style="display: none" id="publishTime" hidden>
                                                <label> Đặt lịch publish video</label>
                                                <input id="TimeToPublishVideo" name="TimeToPublishVideo" class="form-control" type="datetime-local">
                                            </div>
                                        </div>
                                        <!-- End Trạng Thái-->

                                        <!-- Danh Mục-->
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label >Danh Mục: </label>
                                            </div>
                                            <div class="col-sm-12" style = "margin-left: 50px">
                                                <select class="form-control input_select" id="CategoryAdd" name="CategoryAdd">
                                                    <option value="1">Mặc Định</option>
                                                    <option value="1">Film Animation </option>
                                                    <option value="29">Nonprofits Activism </option>
                                                    <option value="28">Science Technology </option>
                                                    <option value="27">Education </option>
                                                    <option value="26">Howto Style </option>
                                                    <option value="25">News Politics </option>
                                                    <option value="24">Entertainment </option>
                                                    <option value="23">Comedy </option>
                                                    <option value="22">People Blogs </option>
                                                    <option value="20">Gaming </option>
                                                    <option value="19">Travel Events </option>
                                                    <option value="15">Pets Animals </option>
                                                    <option value="10">Music </option>
                                                    <option value="2">Autos Vehicles </option>
                                                    <option value="17">Sports </option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- End Danh Dục-->

                                        <!--  Vị trí-->
                                        <div class="form-group" hidden>
                                            <div class="col-sm-12">
                                                <label>Vị trí</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <select class="form-control m-bot15" id="VideoPositionAdd" name="VideoPositionAdd">
                                                    <option value="0">Mặc Định</option>
                                                    <option value="47.268553;;-119.973526">United States 3 </option>
                                                    <option value="35.67261;;139.73997">Japan </option>
                                                    <option value="51.51897;;0.10736">United Kingdom </option>
                                                    <option value="55.755498;;37.581723">Russia </option>
                                                    <option value="37.540802;;126.986742">Korea </option>
                                                    <option value="29.278917;;1.611679">Algeria </option>
                                                    <option value="-36.317036;;-63.356976">Argentina </option>
                                                    <option value="-23.181625;;133.812724">Australia </option>
                                                    <option value="40.365420;;47.580232">Azerbaijan </option>
                                                    <option value="26.102927;;50.553392">Bahrain </option>
                                                    <option value="26.080727;;50.557512">Belarus </option>
                                                    <option value="50.600412;;4.476336">Belgium </option>
                                                    <option value="-11.309567;;-52.210494">Brazil </option>
                                                    <option value="42.977344;;25.481375">Bulgaria </option>
                                                    <option value="58.798258;;-107.267344">Canada </option>
                                                    <option value="-33.914746;;-71.546688">Chile </option>
                                                    <option value="5.815813;;-74.420950">Colombia </option>
                                                    <option value="45.352085;;15.214619">Croatia </option>
                                                    <option value="26.803701;;29.750676">Egypt </option>
                                                    <option value="62.497235;;25.751024">Finland </option>
                                                    <option value="46.598119;;2.137325">France </option>
                                                    <option value="51.599887;;10.406636">Germany </option>
                                                    <option value="51.599887;;10.406636">Germany </option>
                                                    <option value="22.282180;;114.175428">Hong Kong </option>
                                                    <option value="65.118599;;19.036829">Iceland </option>
                                                    <option value="23.252494;;80.294512">India </option>
                                                    <option value="1.271348;;113.637561">Indonesia </option>
                                                    <option value="4.807000;;102.043290">Malaysia </option>
                                                    <option value="4.807000;;102.043290">Malaysia </option>
                                                    <option value="24.329604;;-102.865703">Mexico </option>
                                                    <option value="-42.537861;;172.254860">New Zealand </option>
                                                    <option value="12.930564;;123.069711">Philippines </option>
                                                    <option value="52.239036;;19.043199">Poland </option>
                                                    <option value="39.687870;;-8.317149">Portugal </option>
                                                    <option value="1.366898;;103.816795">Singapore </option>
                                                    <option value="40.823704;;-3.808700">Spain </option>
                                                    <option value="46.942896;;8.207274">Switzerland </option>
                                                    <option value="23.946114;;121.086081">Taiwan </option>
                                                    <option value="16.547641;;100.947437">Thailand </option>
                                                    <option value="38.905592;;35.409001">Turkey </option>
                                                    <option value="23.255602;;43.245555">Saudi Arabia </option>
                                                    <option value="21.319196;;105.892917">Việt Nam </option>
                                                    <option value="-30.285403;;22.944565">South Africa </option>
                                                    <option value="41.900787;;12.493417">Italia </option>
                                                    <option value="14.457402;;14.234618">Senegal </option>
                                                    <option value="29.969012;;69.128259">Pakistan </option>
                                                    <option value="55.555406;;10.014524">Denmark </option>
                                                    <option value="60.481455;;8.454728">Na Uy </option>
                                                    <option value="23.071342;;79.114303">India </option>
                                                    <option value="-7.572942;;-55.624011">Brazil </option>
                                                    <option value="24.342777;; -103.133996">Mexico </option>
                                                    <option value="52.369351;;4.900329">Netherlands </option>
                                                    <option value="34.060010;;-118.263455">United States 1 </option>
                                                    <option value="42.917783;;-76.239494">United States 2 </option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--End  Vị trí-->

                                        <!--Quốc gia-->
                                        <div class="form-group">
                                            <div class="col-sm-12" style = "margin-left: 50px">
                                                <label>Ngôn ngữ</label>
                                                    <select class="form-control m-bot15" id="LanguageAdd" name="LanguageAdd">
                                                        <option value="en">Mặc định </option>
                                                        <option value="ab">Abkhazian</option>
                                                        <option value="aa">Afar</option>
                                                        <option value="af">Afrikaans</option>
                                                        <option value="ak">Akan</option>
                                                        <option value="sq">Albanian</option>
                                                        <option value="am">Amharic</option>
                                                        <option value="ar">Arabic</option>
                                                        <option value="an">Aragonese</option>
                                                        <option value="hy">Armenian</option>
                                                        <option value="as">Assamese</option>
                                                        <option value="av">Avaric</option>
                                                        <option value="ae">Avestan</option>
                                                        <option value="ay">Aymara</option>
                                                        <option value="az">Azerbaijani</option>
                                                        <option value="bm">Bambara</option>
                                                        <option value="ba">Bashkir</option>
                                                        <option value="eu">Basque</option>
                                                        <option value="be">Belarusian</option>
                                                        <option value="bn">Bengali</option>
                                                        <option value="bh">Bihari languages</option>
                                                        <option value="bi">Bislama</option>
                                                        <option value="bs">Bosnian</option>
                                                        <option value="br">Breton</option>
                                                        <option value="bg">Bulgarian</option>
                                                        <option value="my">Burmese</option>
                                                        <option value="ca">Catalan, Valencian</option>
                                                        <option value="ch">Chamorro</option>
                                                        <option value="ce">Chechen</option>
                                                        <option value="ny">Chichewa, Chewa, Nyanja</option>
                                                        <option value="zh">Chinese</option>
                                                        <option value="cv">Chuvash</option>
                                                        <option value="kw">Cornish</option>
                                                        <option value="co">Corsican</option>
                                                        <option value="cr">Cree</option>
                                                        <option value="hr">Croatian</option>
                                                        <option value="cs">Czech</option>
                                                        <option value="da">Danish</option>
                                                        <option value="dv">Divehi, Dhivehi, Maldivian</option>
                                                        <option value="nl">Dutch, Flemish</option>
                                                        <option value="dz">Dzongkha</option>
                                                        <option value="en">English</option>
                                                        <option value="eo">Esperanto</option>
                                                        <option value="et">Estonian</option>
                                                        <option value="ee">Ewe</option>
                                                        <option value="fo">Faroese</option>
                                                        <option value="fj">Fijian</option>
                                                        <option value="fl">Filipino</option>
                                                        <option value="fi">Finnish</option>
                                                        <option value="fr">French</option>
                                                        <option value="ff">Fulah</option>
                                                        <option value="gl">Galician</option>
                                                        <option value="ka">Georgian</option>
                                                        <option value="de">German</option>
                                                        <option value="el">Greek (modern)</option>
                                                        <option value="gn">Guaraní</option>
                                                        <option value="gu">Gujarati</option>
                                                        <option value="ht">Haitian, Haitian Creole</option>
                                                        <option value="ha">Hausa</option>
                                                        <option value="he">Hebrew (modern)</option>
                                                        <option value="hz">Herero</option>
                                                        <option value="hi">Hindi</option>
                                                        <option value="ho">Hiri Motu</option>
                                                        <option value="hu">Hungarian</option>
                                                        <option value="ia">Interlingua</option>
                                                        <option value="id">Indonesian</option>
                                                        <option value="ie">Interlingue</option>
                                                        <option value="ga">Irish</option>
                                                        <option value="ig">Igbo</option>
                                                        <option value="ik">Inupiaq</option>
                                                        <option value="io">Ido</option>
                                                        <option value="is">Icelandic</option>
                                                        <option value="it">Italian</option>
                                                        <option value="iu">Inuktitut</option>
                                                        <option value="ja">Japanese</option>
                                                        <option value="jv">Javanese</option>
                                                        <option value="kl">Kalaallisut, Greenlandic</option>
                                                        <option value="kn">Kannada</option>
                                                        <option value="kr">Kanuri</option>
                                                        <option value="ks">Kashmiri</option>
                                                        <option value="kk">Kazakh</option>
                                                        <option value="km">Central Khmer</option>
                                                        <option value="ki">Kikuyu, Gikuyu</option>
                                                        <option value="rw">Kinyarwanda</option>
                                                        <option value="ky">Kirghiz, Kyrgyz</option>
                                                        <option value="kv">Komi</option>
                                                        <option value="kg">Kongo</option>
                                                        <option value="ko">Korean</option>
                                                        <option value="ku">Kurdish</option>
                                                        <option value="kj">Kuanyama, Kwanyama</option>
                                                        <option value="la">Latin</option>
                                                        <option value="lb">Luxembourgish, Letzeburgesch</option>
                                                        <option value="lg">Ganda</option>
                                                        <option value="li">Limburgan, Limburger, Limburgish</option>
                                                        <option value="ln">Lingala</option>
                                                        <option value="lo">Lao</option>
                                                        <option value="lt">Lithuanian</option>
                                                        <option value="lu">Luba-Katanga</option>
                                                        <option value="lv">Latvian</option>
                                                        <option value="gv">Manx</option>
                                                        <option value="mk">Macedonian</option>
                                                        <option value="mg">Malagasy</option>
                                                        <option value="ms">Malay</option>
                                                        <option value="ml">Malayalam</option>
                                                        <option value="mt">Maltese</option>
                                                        <option value="mi">Maori</option>
                                                        <option value="mr">Marathi</option>
                                                        <option value="mh">Marshallese</option>
                                                        <option value="mn">Mongolian</option>
                                                        <option value="na">Nauru</option>
                                                        <option value="nv">Navajo, Navaho</option>
                                                        <option value="nd">North Ndebele</option>
                                                        <option value="ne">Nepali</option>
                                                        <option value="ng">Ndonga</option>
                                                        <option value="nb">Norwegian Bokmål</option>
                                                        <option value="nn">Norwegian Nynorsk</option>
                                                        <option value="no">Norwegian</option>
                                                        <option value="ii">Sichuan Yi, Nuosu</option>
                                                        <option value="nr">South Ndebele</option>
                                                        <option value="oc">Occitan</option>
                                                        <option value="oj">Ojibwa</option>
                                                        <option value="cu">Church Slavic, Church Slavonic, Old Church Slavonic, Old Slavonic, Old Bulgarian</option>
                                                        <option value="om">Oromo</option>
                                                        <option value="or">Oriya</option>
                                                        <option value="os">Ossetian, Ossetic</option>
                                                        <option value="pa">Panjabi, Punjabi</option>
                                                        <option value="pi">Pali</option>
                                                        <option value="fa">Persian</option>
                                                        <option value="pl">Polish</option>
                                                        <option value="ps">Pashto, Pushto</option>
                                                        <option value="pt">Portuguese</option>
                                                        <option value="qu">Quechua</option>
                                                        <option value="rm">Romansh</option>
                                                        <option value="rn">Rundi</option>
                                                        <option value="ro">Romanian, Moldavian, Moldovan</option>
                                                        <option value="ru">Russian</option>
                                                        <option value="sa">Sanskrit</option>
                                                        <option value="sc">Sardinian</option>
                                                        <option value="sd">Sindhi</option>
                                                        <option value="se">Northern Sami</option>
                                                        <option value="sm">Samoan</option>
                                                        <option value="sg">Sango</option>
                                                        <option value="sr">Serbian</option>
                                                        <option value="gd">Gaelic, Scottish Gaelic</option>
                                                        <option value="sn">Shona</option>
                                                        <option value="si">Sinhala, Sinhalese</option>
                                                        <option value="sk">Slovak</option>
                                                        <option value="sl">Slovenian</option>
                                                        <option value="so">Somali</option>
                                                        <option value="st">Southern Sotho</option>
                                                        <option value="es">Spanish, Castilian</option>
                                                        <option value="su">Sundanese</option>
                                                        <option value="sw">Swahili</option>
                                                        <option value="ss">Swati</option>
                                                        <option value="sv">Swedish</option>
                                                        <option value="ta">Tamil</option>
                                                        <option value="te">Telugu</option>
                                                        <option value="tg">Tajik</option>
                                                        <option value="th">Thai</option>
                                                        <option value="">Tigrinya</option>
                                                        <option value="bo">Tibetan</option>
                                                        <option value="tk">Turkmen</option>
                                                        <option value="tl">Tagalog</option>
                                                        <option value="tn">Tswana</option>
                                                        <option value="to">Tonga (Tonga Islands)</option>
                                                        <option value="tr">Turkish</option>
                                                        <option value="ts">Tsonga</option>
                                                        <option value="tt">Tatar</option>
                                                        <option value="tw">Twi</option>
                                                        <option value="ty">Tahitian</option>
                                                        <option value="ug">Uighur, Uyghur</option>
                                                        <option value="uk">Ukrainian</option>
                                                        <option value="ur">Urdu</option>
                                                        <option value="uz">Uzbek</option>
                                                        <option value="ve">Venda</option>
                                                        <option value="vi">Vietnamese</option>
                                                        <option value="vo">Volapük</option>
                                                        <option value="wa">Walloon</option>
                                                        <option value="cy">Welsh</option>
                                                        <option value="wo">Wolof</option>
                                                        <option value="fy">Western Frisian</option>
                                                        <option value="xh">Xhosa</option>
                                                        <option value="yi">Yiddish</option>
                                                        <option value="yo">Yoruba</option>
                                                        <option value="za">Zhuang, Chuang</option>
                                                        <option value="zu">Zulu</option>
                                                    </select>
                                            </div>
                                        </div>
                                        <!--End  Quốc Gia-->

                                        <!-- Cut Video-->
                                        <div class="form-group" id="SplitVideo">
                                            <div class="col-sm-12">
                                                <label>Cắt Video:</label>
                                            </div>
                                            <div class="col-sm-12" style = "margin-left: 50px">
                                                <div class="row">
                                                    <div class="col-lg-1">
                                                        <span>Cắt Đầu:  </span></div>
                                                    <div class="col-lg-4"><input id="FirstMinAdd" name="FirstMinAdd" class="form-control" type="text" value="0"></div>
                                                    <div class="col-lg-1"><span> phút - </span> </div>
                                                    <div class="col-lg-4"><input id="FirstSecAdd" name="FirstSecAdd" class="form-control" onkeyup="checkTime();" type="text" value="2"></div>
                                                    <div class="col-lg-1"><span> giây</span></div>
                                                </div>
                                                <div class="row" >
                                                    <div class="col-lg-1">
                                                        <span>Cắt Đuôi:    </span></div>
                                                    <div class="col-lg-4"><input id="EndMinAdd" name="EndMinAdd" class="form-control" type="text" value="0"> </div>
                                                    <div class="col-lg-1"><span> phút - </span></div>
                                                    <div class="col-lg-4"><input id="EndSecAdd" name="EndSecAdd" class="form-control" onkeyup="checkTime();" type="text" value="10"></div>
                                                    <div class="col-lg-1"><span> giây</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Cắt Video-->

                                        <!-- Cấu hình Auto Upload-->
                                        <div class="form-group" id="TotalVideo" style="display: none;">
                                            <div class="col-sm-12">
                                                <label>Cấu Hình Auto Upload:</label>
                                                <label> Tổng số video upload trong ngày</label>
                                                <div class="col-sm-12">
                                                    <input id="TotalVideo" name="TotalVideo" width="50px"  class="form-control" type="text" value="0">
                                                </div>

                                            </div>
                                        </div>
                                        <!-- End Cấu hình Auto Upload-->

                                    </div>
                                </div>
                        </section>
                        <section class="panel">
                            <div class="panel-body">
                                <input type="submit" id="default-next-1" class="button-next btn btn-info" name="add_config" value="Lưu"/>
                            </div>
                        </section>

                </div>
            </div>
            </form>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->

