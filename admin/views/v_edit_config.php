<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo $title;?>

            </header>

            <div class="panel-body" style = "width:800px">
                <div class="adv-table editable-table ">
                    <!--content-->
                    <input type="hidden" name="IDConfig" value="<?php if ($ID != 0){ echo $ID;}?>">
                    <form class="form-horizontal tasi-form" method="post" action="<?php echo BASE_PATH; ?>/admin/controller/c_config.php?controller=config&action=edit_config&ID=<?php echo $ID;?> "  id="configForm" enctype="multipart/form-data">
                        <section class="panel">
                            <div class="panel-body">
                                <input type="submit" id="default-next-0" class="button-next btn btn-info" name="add" value="Lưu" style = "display:none"/>
                            </div>
                        </section>
                        <section class="panel">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div id="info" class="tab-pane active" style = "width:800px">
                                        <!--   Chọn kênh-->
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label>Chọn kênh</label>
                                                <?php
                                                $source = json_decode($config["FromSourceVideo"], true);
                                                ?>
                                                    <div class="col-lg-12">
                                                        <input class="form-control m-bot15" disabled id="ChannelIDADD" name="ChannelIDADD"
                                                               value="<?php echo $config["ChannelName"]; ?>">
                                                        </input>
                                                    </div>

                                                <div class="col-lg-12" >
                                                    <input style="display: none" class="form-control m-bot15" disabled id="ChannelReupMusic" name="ChannelReupMusic"
                                                           value="<?php echo $config["ChannelName"]; ?>">
                                                    </input>
                                                </div>


                                            </div>
                                        </div>
                                        <!--  End Chọn kênh:-->

                                        <div class="form-group">
                                            <!--   Thêm Link hoặc Keyword:-->
                                            <div class="col-sm-12">
                                                <label>Thêm Link hoặc Keyword</label>
                                                <div class="col-lg-12">
                                                    <?php
                                                    $source = json_decode($config["FromSourceVideo"], true);
                                                    $type=$source['Source'];
                                                    ?>
                                                    <label class="checkbox-inline">
                                                        <input type="radio" name="ReupFromLinkAdd"  checked id="ReupFromLinkAdd" onclick="checkInputVideo()" value="1" <?php if($source['Source'] =='1') echo "checked"; ?> > Reup Từ Link (Channel hoặc Video)
                                                    </label>

                                                    <label class="checkbox-inline">
                                                        <input type="radio" name="ReupFromLinkAdd" id="ReupFromPLL" onclick="checkInputVideo()"   value="1" <?php if(($source['Source'] =='1') &&(strpos($source['Value'], "playlist?") == true)) echo "checked"; ?> > Reup Từ Link (Playlist)
                                                    </label>
                                                    <label class="checkbox-inline" style="display: none">
                                                        <input type="radio" name="ReupFromLinkAdd" id="ReupFromKeyWord" onclick="checkInputVideo()"  value="2" <?php if($source['Source'] =='2') echo "checked"; ?>> Reup Theo Keyword
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="radio" name="ReupFromLinkAdd" id="ReupMusic"  onclick="checkInputVideo()" value="3" <?php if($source['Source'] =='3') echo "checked"; ?> > Reup Nhạc
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
                                                    <textarea id="url" name="url"  class="form-control tat" rows="8"> <?php
                                                        $source = json_decode($config["FromSourceVideo"], true);
                                                        echo $source['Value'];
                                                        ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div  id="UploadImage" style="display: none ; margin: 0;" >
                                                    <label for="ImageAdd">Nhập ảnh</label>

                                                    <input type="file" accept=".jpg" id="ImageAdd"   name="ImageAdd" onchange="readURL(this);"><br>
                                                    <img id="blah" src=" <?php if ($config['Image']!="") echo "../ImagesReup"."/".basename($config['Image']);?>"  width="300px" height="150px" />
                                                    <input  id="imgLoad" hidden name="imgLoad" type="text" value="<?php echo $config['Image'];?>">
                                                </div> <br>
<!--                                                <div  id="UploadAudio" style="display: none">-->
<!--                                                    <label for="ImageAdd">Nhập file nhạc</label>-->
<!--                                                    <input type="file" id="AudioAdd" name="AudioAdd">-->
<!--                                                </div>-->
                                            </div>
                                            <br> <br>
                                        </div>
                                        <div class="form-group  col-lg-12" id="thumbnail" >
                                            <div class=" col-lg-12">
                                                <label class="checkbox-inline" >
                                                    <input type="checkbox" onclick="checkInputVideo()" <?php if ($config['IsSetThumbnail'] == '1') echo "checked";?> name="SetThumbnail" id="SetThumbnail"  class="ck-filter-chil2" value="1080">Set Thumbnail
                                                </label>
                                            </div>
                                        </div>
                                        <!-- filter-->
                                        <div class="form-group" id="filterVideo">
                                            <div  class="col-lg-12">
                                                <div  class="col-lg-12">
                                                   <!-- --><?php /*print_r($config);*/?>
                                                    <?php
                                                        $filter = json_decode($config['FilterConfig'], true);
                                                        $filer_quality = $filter['FilterQuality'];
                                                        $filer_time = $filter['FilterTime'];

                                                        if(count($filter)>3) {
                                                            $filer_view = $filter['FilterViews'];
                                                        }
                                                        else $filer_view="";
                                                        $filer_advanture = $filter['FilterAdvance'];

                                                    ?>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="FilterVideoAdd" id="FilterVideoAdd"  onclick="checkfilter();" value="1" <?php if($filer_quality !='' ||  $filer_time != '0' || $filer_advanture !='') echo "checked"; ?> > Lọc video  </label>
                                                    <div id="filter_link"   class="col-lg-12" style="display:block;">
                                                        <div id="div_filter_res" style = "display:none" >
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="FilterQualityMode" id="FilterMode"  onclick="checkfilter()"  class="ck-filter-chil1" value="1" <?php if($filer_quality !='') echo "checked"; ?> >Lọc chất lượng của video
                                                            </label>
                                                            <div id="filterQuality" onclick="checkfilter()">
                                                                <label class="checkbox-inline">
                                                                    <input type="radio" name="FilterQuality" id="FilterQuality"    class="ck-filter-chil2" value="480" <?php if($filer_quality =='480') echo "checked"; ?> >SD
                                                                </label>
                                                                <label class="checkbox-inline">
                                                                    <input type="radio" name="FilterQuality" id="FilterQuality"  class="ck-filter-chil2" value="720" <?php if($filer_quality =='720') echo "checked"; ?> >HD
                                                                </label>
                                                                <label class="checkbox-inline">
                                                                    <input type="radio" name="FilterQuality" id="FilterQuality"  class="ck-filter-chil2" value="1080" <?php if($filer_quality =='1080') echo "checked"; ?> >FullHD
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="ck_filter_time"  style = "display:none"  >
                                                            <label class="checkbox-inline"  onclick="checkfilter()">
                                                                <input type="checkbox" name="FilterTimeMode"  class="ck-filter-chil1" onclick="checkfilter()" id="filtertimeck" value="2"  <?php if($filer_time !='0') echo "checked"; ?> >Lọc theo độ dài của videos
                                                            </label>
                                                            <div id="div_filter_time"  >
                                                                <label class="checkbox-inline">
                                                                    <input type="radio" name="FilterTime" id="ck_filter_time_value" class="ck-filter-chil2" value="3" <?php if($filer_time =='3') echo "checked"; ?>> lớn hơn 4p
                                                                </label>
                                                                <label class="checkbox-inline">
                                                                    <input type="radio" name="FilterTime" id="ck_filter_time_value"  class="ck-filter-chil2" value="2" <?php if($filer_time =='2') echo "checked"; ?>> từ : 4p đến: 20p
                                                                </label>
                                                                <label class="checkbox-inline">
                                                                    <input type="radio" name="FilterTime" id="ck_filter_time_value"  class="ck-filter-chil2" value="1" <?php if($filer_time =='1') echo "checked"; ?>> lớn hơn 20p
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="AdvanceFilter" style = "display:none" >
                                                            <label class="checkbox-inline"  onclick="checkfilter()">
                                                                <input type="checkbox" name="FilterAdvance"  class="ck-filter-chil1" onclick="checkfilter()" id="filteradvance" value="3" <?php if($filer_advanture !='') echo "checked"; ?> >Lọc theo thời gian hoặc views
                                                            </label>
                                                            <div id="div_filter_advance"  >
                                                                <label class="checkbox-inline">
                                                                    <input type="radio" name="filterAdvanceValue" id="filterAdvanceValue"  onclick="checkfilter();" class="ck-filter-chil2" value="0" <?php if($filer_advanture =='0') echo "checked"; ?> > Video mới nhất của kênh
                                                                </label>
                                                                <label class="checkbox-inline">
                                                                    <input type="radio" name="filterAdvanceValue" id="filterVideoViews"  onclick="checkfilter()" class="ck-filter-chil2" value="5" <?php if($filer_advanture =='5') echo "checked"; ?> > Video có lượng views nhiều nhất                                                                </label> <br>
                                                                    <input type="text" name="FilterViewValue" id="FilterViewValue"  style = "display:none"  value="<?php echo $filer_view ?>" class="col-md-4" placeholder="nhập số views cần lọc" >

                                                                </label>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            checkfilter();
                                            checkInputVideo();
                                        </script>
                                        <!--  End Thêm Link hoặc Keyword:-->

                                        <!-- Tiêu Đề-->
                                        <div class="form-group">
                                            <div  class="col-lg-12">
                                                <label>Tiêu Đề: </label>  (tối đa là 100 kí tự) <br>
                                            </div>
                                            <?php
                                            $videoTitle= json_decode($config["VideoTitle"], true);
                                            ?>
                                            <div class="col-lg-12" id="ReplaceTitleByPart"style = "width:800px" >
                                                <label class="checkbox-inline"><input type="radio" name="TitleReplaceMode" id="ck_add_local_title" onclick="checkTitle()" value="1" <?php if(($videoTitle['AddFirst'] || $videoTitle['AddEnd'] || $videoTitle['ReplaceFrom'] || $videoTitle['ReplaceFrom'] || $videoTitle['ReplaceTo'])  != '') echo "checked"; ?> > Thay thế từng phần
                                                </label>
                                                <div  class="col-lg-12" id = "part_replacetilte" style = "display:none;margin-left: 50px">
                                                    <label class="checkbox-inline"> <input type="checkbox" name="TitleReplacePost" id="ck_add_first_title" onclick="checkTitle()" value="1" <?php if($videoTitle['AddFirst']!= '') echo "checked"; ?> > Thêm vào đầu </label>
                                                    <div id="box_add_first_title" class="col-lg-12" >
                                                        <input type="text" name="AddTitleFirst" id="text_add_first_title" value="<?php echo $videoTitle['AddFirst'];?>" placeholder="Normal or Spin title: I {love|hate|like} youtube!" class="form-control m-bot15">
                                                    </div>

                                                    <label class="checkbox-inline"><input type="checkbox" name="TitleReplacePost" id="ck_add_last_title" onclick="checkTitle()" value="2" <?php if($videoTitle['AddEnd']!= '') echo "checked"; ?>> Thêm vào cuối
                                                    </label>
                                                    <div id="box_add_last_title" class="col-lg-12" >
                                                        <input type="text" name="AddTitleEnd" id="text_add_last_title"  value="<?php echo $videoTitle['AddEnd']?>" placeholder="Normal or Spin title: I {love|hate|like} youtube!" class="form-control m-bot15">
                                                    </div>
                                                    <label class="checkbox-inline"><input type="checkbox" name="TitleReplacePost" id="ck_add_replace_title" onclick="checkTitle()" value="3" <?php if($videoTitle['ReplaceFrom']!= '') echo "checked"; ?>> Thay thế </label>
                                                    <div id="box_add_replace_title"  class="col-lg-12">
                                                        <input type="text" name="ReplaceTitleFrom" value="<?php echo $videoTitle['ReplaceFrom']?>" id="text_add_replace_titleA"  class="form-control m-bot15">  Bằng: <input type="text" name="ReplaceTitleTo" value="<?php echo $videoTitle['ReplaceTo']?>" id="text_add_replace_titleB" placeholder="Normal or Spin title: I {love|hate|like} youtube!"  class="form-control m-bot15">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12" id = "all_replacetilte" style = "width:800px">
                                                <label class="checkbox-inline"><input type="radio" name="TitleReplaceMode" id="ck_add_all_title"  onclick="checkTitle()" value="2" <?php if($videoTitle['AddAll']!= '') echo "checked"; ?>> Thay thế toàn bộ
                                                </label>
                                                <div id="box_add_all_title"  class="col-lg-12" style="display: none;margin-left: 50px">
                                                    <input type="text" name="ReplaceAllTitle"  value="<?php echo $videoTitle['AddAll']?>" id="text_add_all_title" onKeyup="CheckForm(1);" placeholder="Normal or Spin title: I {love|hate|like} youtube!" class="form-control m-bot15">
                                                </div>
                                            </div>
                                            <div class="col-lg-12" id="box_spin_title" style = "margin-left: 20px">
                                                <input type="checkbox" name="TranslateTitleTo" id="ck_spin_title" value="1" <?php if($videoTitle['TranslateTo']!= '') echo "checked"; ?>>Tiêu đề thông minh <br>
                                                <span style = "margin-left: 20px">Ngôn ngữ: </span><select class="inAutoReup input_select" name="TranslateTitleTo">
                                                    <option value="">Chọn ngôn ngữ</option>
                                                    <option value="">Chọn ngôn ngữ</option>
                                                    <option value="ar" <?php if($videoTitle['TranslateTo'] =="ar")echo "selected = 1";?>>Ả rập</option>
                                                    <option value="km" <?php if($videoTitle['TranslateTo'] =="km")echo "selected = 1";?>>Campuchia</option>
                                                    <option value="de" <?php if($videoTitle['TranslateTo'] =="de")echo "selected = 1";?>>Đức</option>
                                                    <option value="en" <?php if($videoTitle['TranslateTo'] =="en")echo "selected = 1";?>>English</option>
                                                    <option value="nl" <?php if($videoTitle['TranslateTo'] =="nl")echo "selected = 1";?>>Hà Lan</option>
                                                    <option value="ko" <?php if($videoTitle['TranslateTo'] =="ko")echo "selected = 1";?>>Hàn Quốc</option>
                                                    <option value="ja" <?php if($videoTitle['TranslateTo'] =="ja")echo "selected = 1";?>>Nhật Bản</option>
                                                    <option value="it" <?php if($videoTitle['TranslateTo'] =="it")echo "selected = 1";?>>Italia</option>
                                                    <option value="id" <?php if($videoTitle['TranslateTo'] =="id")echo "selected = 1";?>>Indo</option>
                                                    <option value="fr" <?php if($videoTitle['TranslateTo'] =="fr")echo "selected = 1";?>>Pháp</option>
                                                    <option value="tr" <?php if($videoTitle['TranslateTo'] =="tr")echo "selected = 1";?>>Thổ Nhĩ Kỳ</option>
                                                    <option value="th" <?php if($videoTitle['TranslateTo'] =="th")echo "selected = 1";?>>Thái Lan</option>
                                                    <option value="es" <?php if($videoTitle['TranslateTo'] =="es")echo "selected = 1";?>>Tây Ban Nha</option>
                                                    <option value="zh-CN" <?php if($videoTitle['TranslateTo'] =="zh-CN")echo "selected = 1";?>>Trung Quốc</option>
                                                </select><br>
                                            </div>
                                        </div>
                                        <script>checkTitle();</script>
                                        <!-- End Tiêu Đề-->

                                        <!-- Mô Tả-->
                                        <div class="form-group">
                                            <div  class="col-lg-12">
                                                <label>Mô tả: </label>  (tối đa 5000 kí tự)
                                            </div>
                                            <?php
                                            $videoDescription= json_decode($config["VideoDescription"], true);
                                            ?>
                                            <div  class="col-lg-12" id="ReplaceDesByPart" style = "width:800px">
                                                <label class="checkbox-inline"><input type="radio" name="ReplaceDesMode" id="ck_add_local_des" onclick = "checkDes();" value="1" <?php if(($videoDescription['AddFirst'] || $videoDescription['AddEnd'] || $videoDescription['ReplaceFrom'] || $videoDescription['ReplaceFrom'] || $videoDescription['ReplaceTo'])  != '') echo "checked"; ?>> Thay thế từng phần </label> <br>
                                                <div  class="col-lg-12" id = "part_replaceDes" style = "display:none;margin-left: 50px">
                                                    <label class="checkbox-inline"><input type="checkbox" name="AddDesFirst" id="ck_add_first_des" value="1" <?php if($videoDescription['AddFirst'] !='') echo "checked";?>> Thêm vào đầu </label>
                                                    <div id="box_add_first_des" class="col-lg-12">
                                                        <textarea type="text" name="AddDesFirst" class="form-control tat" id="text_add_first_des" rows="5" placeholder="Normal or Spin Des: I {love|hate|like} youtube!"><?php echo $videoDescription['AddFirst']?></textarea>
                                                    </div>
                                                    <label class="checkbox-inline"><input type="checkbox" name="ReplaceDesContent" id="ck_add_last_des" value="2" <?php if($videoDescription['AddEnd'] !='') echo "checked";?>> Thêm vào cuối </label>
                                                    <div id="box_add_last_des" class="col-lg-12">
                                                        <textarea type="text" name="AddDesEnd" class="form-control tat" id="text_add_last_des" rows="5" placeholder="Normal or Spin Des: I {love|hate|like} youtube!"><?php echo $videoDescription['AddFirst']?> </textarea>
                                                    </div>
                                                    <input type="checkbox" name="ReplacePost" id="ck_add_replace_des" value="3" <?php if($videoDescription['ReplaceFrom'] !='') echo "checked";?>> Thay thế </label>
                                                    <div id="box_add_replace_des"  class="col-lg-12">
                                                        <input type="text" name="ReplaceDesFrom" value="<?php echo $videoDescription['ReplaceFrom']?>" id="ReplaceDesFrom" class="form-control m-bot15">  Bằng: <input type="text" value="<?php echo $videoDescription['ReplaceTo']?>" name="ReplaceDesTo" id="ReplaceDesTo" placeholder="Normal or Spin title: I {love|hate|like} youtube!"  class="form-control m-bot15">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12" id = "all_replacedes">
                                                <label class="checkbox-inline"><input type="radio" name="ReplaceDesMode" id="ck_add_all_des" onclick = "checkDes();" value="1" <?php if($videoDescription['AddAll'] !='') echo "checked";?>> Thay thế toàn bộ </label>
                                                <div id="box_add_all_des" class="col-lg-12" style = "display:none;margin-left: 50px">
                                                    <textarea  name="ReplaceDesAll" class="form-control tat" onKeyup="CheckForm(2);" id="text_add_all_des" rows="8" placeholder="Normal or Spin Des: I {love|hate|like} youtube!"><?php echo $videoDescription['AddAll']?></textarea><br>
                                                </div>
                                            </div>
                                            <div class="col-lg-12" id="box_spin_des" style = "margin-left: 20px">
                                                <input type="checkbox" name="TranslateDes" id="ck_spin_des" value="1" <?php if($videoDescription['TranslateTo'] !='') echo "checked";?>>Mô tả thông minh <br>
                                                    <span style = "margin-left: 20px">Ngôn ngữ: </span>
                                                    <select class="inAutoReup input_select" name="TranslateDesTo">
                                                        <option value="">Chọn ngôn ngữ</option>
                                                        <option value="ar" <?php if($videoDescription['TranslateTo'] =="ar")echo "selected = 1";?>>Ả rập</option>
                                                        <option value="km" <?php if($videoDescription['TranslateTo'] =="km")echo "selected = 1";?>>Campuchia</option>
                                                        <option value="de" <?php if($videoDescription['TranslateTo'] =="de")echo "selected = 1";?>>Đức</option>
                                                        <option value="en" <?php if($videoDescription['TranslateTo'] =="en")echo "selected = 1";?>>English</option>
                                                        <option value="nl" <?php if($videoDescription['TranslateTo'] =="nl")echo "selected = 1";?>>Hà Lan</option>
                                                        <option value="ko" <?php if($videoDescription['TranslateTo'] =="ko")echo "selected = 1";?>>Hàn Quốc</option>
                                                        <option value="ja" <?php if($videoDescription['TranslateTo'] =="ja")echo "selected = 1";?>>Nhật Bản</option>
                                                        <option value="it" <?php if($videoDescription['TranslateTo'] =="it")echo "selected = 1";?>>Italia</option>
                                                        <option value="id" <?php if($videoDescription['TranslateTo'] =="id")echo "selected = 1";?>>Indo</option>
                                                        <option value="fr" <?php if($videoDescription['TranslateTo'] =="fr")echo "selected = 1";?>>Pháp</option>
                                                        <option value="tr" <?php if($videoDescription['TranslateTo'] =="tr")echo "selected = 1";?>>Thổ Nhĩ Kỳ</option>
                                                        <option value="th" <?php if($videoDescription['TranslateTo'] =="th")echo "selected = 1";?>>Thái Lan</option>
                                                        <option value="es" <?php if($videoDescription['TranslateTo'] =="es")echo "selected = 1";?>>Tây Ban Nha</option>
                                                        <option value="zh-CN" <?php if($videoDescription['TranslateTo'] =="zh-CN")echo "selected = 1";?>>Trung Quốc</option>
                                                    </select><br>
                                                <label class="checkbox-inline"><input type="checkbox" name="ReplaceLink" id="ReplaceLinkInDes" value="1" <?php if ($videoDescription['ReplaceLink'] != '') echo "checked";?>> Loại bỏ Link trong mô tả </label>
                                            </div>
                                        </div>
                                        <script>checkDes();</script>
                                        <!-- End Mô Tả-->

                                        <!-- Thẻ Tag-->
                                        <div  class="form-group">
                                            <div class="col-lg-12">
                                                <label>Thẻ Tag: </label> (tối đa 500 kí tự)
                                            </div>
                                            <?php
                                            $videoTag= json_decode($config["VideoTags"], true);
                                            ?>
                                            <div class="col-lg-12" id="ReplaceTagByPart">
                                                <label class="checkbox-inline">
                                                    <input type="radio" name="ReplaceTagMode" id="ck_add_local_tag" onclick = "checkTag();" value="1" <?php if(($videoTag['AddFirst'] || $videoTag['AddEnd'] || $videoTag['ReplaceFrom'] || $videoTag['ReplaceFrom'] || $videoTag['ReplaceTo'])  != '') echo "checked"; ?>> Thay thế từng phần </label>
                                                <div  class="col-lg-12" id = "part_replacetag" style = "display:none;margin-left: 50px">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="ReplaceTagPost" id="ck_add_first_tag" value="1" <?php if ($videoTag['AddFirst'] != '') echo "checked";?>> Thêm vào đầu </label>
                                                    <div id="box_add_first_tag" class="col-lg-12">
                                                        <input type="text" name="AddTagFirst" class="form-control" value="<?php echo $videoTag['AddFirst']?>" id="text_add_first_tag" placeholder="Normal or Spin tag: I {love|hate|like} youtube!">
                                                    </div>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="ReplaceTagPost" id="ck_add_last_tag" value="2" <?php if ($videoTag['AddEnd'] != '') echo "checked";?>> Thêm vào cuối </label>
                                                    <div id="box_add_last_tag"  class="col-lg-12">
                                                        <input type="text" name="AddTagEnd" class="form-control" value="<?php echo $videoTag['AddEnd']?>" id="text_add_last_tag" placeholder="Normal or Spin tag: I {love|hate|like} youtube!" >
                                                    </div>
                                                    <input type="checkbox" name="ReplaceTag" id="ck_add_replace_title" value="3" <?php if ($videoTag['ReplaceFrom'] != '') echo "checked";?>> Thay thế </label>
                                                    <div id="box_add_replace_title"  class="col-lg-12">
                                                        <input type="text" name="ReplaceTagFrom" id="ReplaceTagFrom"  value="<?php echo $videoTag['ReplaceFrom']?>" class="form-control m-bot15">  Bằng: <input type="text"  value="<?php echo $videoTag['ReplaceTo']?>" name="ReplaceTagTo" id="ReplaceDesTo" placeholder="Normal or Spin title: I {love|hate|like} youtube!"  class="form-control m-bot15">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12" id = "all_replacetag">
                                                <label class="checkbox-inline">
                                                    <input type="radio" name="ReplaceTagMode" id="ck_add_all_tag" onclick = "checkTag();" value="2" <?php if ($videoTag['AddAll'] != '') echo "checked";?>> Thay thế toàn bộ </label>
                                                <div id="box_add_all_tag" class="col-lg-12" style = "display:none;margin-left: 50px">
                                                    <textarea type="text" name="ReplaceAllTag" class="form-control tat" onKeyup="CheckForm(3);" id="text_add_all_tag" rows="8" placeholder="Normal or Spin tag: I {love|hate|like} youtube!"><?php echo $videoTag['AddAll']?></textarea>
                                                    <br>
                                                </div>
                                            </div>

                                            <div class="col-lg-12" id="box_spin_tag" style = "margin-left: 20px">
                                                <input type="checkbox" name="TranslateTag" id="ck_spin_title" value="1" <?php if ($videoTag['TranslateTo'] != '') echo "checked";?>>Thẻ Tag thông minh <br>
                                                <span style = "margin-left: 20px">Ngôn ngữ: </span><select class="inAutoReup input_select" name="TranslateTagTo">
                                                    <option value="">Chọn ngôn ngữ</option>
                                                    <option value="ar" <?php if($videoTag['TranslateTo'] =="ar")echo "selected = 1";?>>Ả rập</option>
                                                    <option value="km" <?php if($videoTag['TranslateTo'] =="km")echo "selected = 1";?>>Campuchia</option>
                                                    <option value="de" <?php if($videoTag['TranslateTo'] =="de")echo "selected = 1";?>>Đức</option>
                                                    <option value="en" <?php if($videoTag['TranslateTo'] =="en")echo "selected = 1";?>>English</option>
                                                    <option value="nl" <?php if($videoTag['TranslateTo'] =="nl")echo "selected = 1";?>>Hà Lan</option>
                                                    <option value="ko" <?php if($videoTag['TranslateTo'] =="ko")echo "selected = 1";?>>Hàn Quốc</option>
                                                    <option value="ja" <?php if($videoTag['TranslateTo'] =="ja")echo "selected = 1";?>>Nhật Bản</option>
                                                    <option value="it" <?php if($videoTag['TranslateTo'] =="it")echo "selected = 1";?>>Italia</option>
                                                    <option value="id" <?php if($videoTag['TranslateTo'] =="id")echo "selected = 1";?>>Indo</option>
                                                    <option value="fr" <?php if($videoTag['TranslateTo'] =="fr")echo "selected = 1";?>>Pháp</option>
                                                    <option value="tr" <?php if($videoTag['TranslateTo'] =="tr")echo "selected = 1";?>>Thổ Nhĩ Kỳ</option>
                                                    <option value="th" <?php if($videoTag['TranslateTo'] =="th")echo "selected = 1";?>>Thái Lan</option>
                                                    <option value="es" <?php if($videoTag['TranslateTo'] =="es")echo "selected = 1";?>>Tây Ban Nha</option>
                                                    <option value="zh-CN" <?php if($videoTag['TranslateTo'] =="zh-CN")echo "selected = 1";?>>Trung Quốc</option>
                                                </select><br>
                                            </div>
                                        </div>
                                        <!-- End Thẻ Tag-->
                                        <script>checkTag();</script>

                                        <!-- Chức năng nâng cao-->
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <label>Chức Năng Nâng Cao:</label>
                                            </div>
                                            <?php
                                            $extentionFunc= json_decode($config["ExtentionFunc"], true);
                                            ?>
                                            <div class="col-lg-12">
                                                <input type="checkbox" name="is_videointro" id="is_videointro" value="1" <?php if($extentionFunc['VideoIntroPost']!= '') echo "checked"; ?>> Thêm Video Intro
                                                <div id="active_videointro" style="display: block;margin-left: 50px">
                                                    <label class="checkbox-inline">
                                                        <input type="radio" name="radioVideoIntro" id="addIntroFirst" value="1" <?php if($extentionFunc['VideoIntroPost']== "1") echo "checked"; ?>> Thêm vào đầu </label>
                                                    <label class="checkbox-inline">
                                                        <input type="radio" name="radioVideoIntro" id="addIntroEnd" value="2" <?php if($extentionFunc['VideoIntroPost']== "2") echo "checked"; ?>> Thêm vào cuối</label>
                                                    <input type="text" name="addIntro" value="<?php echo $extentionFunc['LinkIntro']?>" id="addIntro" class="form-control" placeholder="Điền link video intro của bạn">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Chức năng nâng cao-->

                                        <!-- Trạng Thái-->
                                        <div class="form-group">
                                            <div class="col-sm-12" >
                                                <label>Trạng Thái: </label>
                                            </div>
                                            <div class="col-sm-12" style = "margin-left: 50px">
                                                <select class="form-control input_select" id="PrivacyStatusAdd"  onchange="privacyStatusChange()" name="PrivacyStatusAdd">
                                                    <option value="public" <?php if($config['VideoStatus'] =="public")echo "selected = 1";?>>Công Khai</option>
                                                    <option value="private" <?php if($config['VideoStatus'] =="private")echo "selected = 1";?>>Riêng Tư</option>
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
                                                    <option value="">Mặc Định</option>
                                                    <option value="1" <?php if($config['VideoCategory'] == "1") echo "selected = 1"?>>Film Animation </option>
                                                    <option value="29"<?php if($config['VideoCategory'] == "29") echo "selected = 1"?>>Nonprofits Activism </option>
                                                    <option value="28"<?php if($config['VideoCategory'] == "28") echo "selected = 1"?>>Science Technology </option>
                                                    <option value="27"<?php if($config['VideoCategory'] == "27") echo "selected = 1"?>>Education </option>
                                                    <option value="26"<?php if($config['VideoCategory'] == "26") echo "selected = 1"?>>Howto Style </option>
                                                    <option value="25"<?php if($config['VideoCategory'] == "25") echo "selected = 1"?>>News Politics </option>
                                                    <option value="24"<?php if($config['VideoCategory'] == "24") echo "selected = 1"?>>Entertainment </option>
                                                    <option value="23"<?php if($config['VideoCategory'] == "23") echo "selected = 1"?>>Comedy </option>
                                                    <option value="22"<?php if($config['VideoCategory'] == "22") echo "selected = 1"?>>People Blogs </option>
                                                    <option value="20"<?php if($config['VideoCategory'] == "20") echo "selected = 1"?>>Gaming </option>
                                                    <option value="19"<?php if($config['VideoCategory'] == "19") echo "selected = 1"?>>Travel Events </option>
                                                    <option value="15"<?php if($config['VideoCategory'] == "15") echo "selected = 1"?>>Pets Animals </option>
                                                    <option value="10"<?php if($config['VideoCategory'] == "10") echo "selected = 1"?>>Music </option>
                                                    <option value="2"<?php if($config['VideoCategory'] == "2") echo "selected = 1"?>>Autos Vehicles </option>
                                                    <option value="17"<?php if($config['VideoCategory'] == "17") echo "selected = 1"?>>Sports </option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- End Danh Dục-->
                                        <!--Quốc gia-->
                                        <div class="form-group">
                                            <div class="col-sm-12" style = "margin-left: 50px">
                                                <label>Ngôn ngữ</label>
                                                    <select class="form-control m-bot15" id="LanguageAdd" name="LanguageAdd">
                                                        <option value="ab" <?php if($config['VideoLanguage']=="ab")echo "selected = 1";?> >Abkhazian</option>
                                                        <option value="aa" <?php if($config['VideoLanguage']=="aa")echo "selected = 1";?>>Afar</option>
                                                        <option value="af" <?php if($config['VideoLanguage']=="af")echo "selected = 1";?>>Afrikaans</option>
                                                        <option value="ak" <?php if($config['VideoLanguage']=="ak")echo "selected = 1";?>>Akan</option>
                                                        <option value="sq" <?php if($config['VideoLanguage']=="sq")echo "selected = 1";?>>Albanian</option>
                                                        <option value="am" <?php if($config['VideoLanguage']=="am")echo "selected = 1";?>>Amharic</option>
                                                        <option value="ar" <?php if($config['VideoLanguage']=="ar")echo "selected = 1";?>>Arabic</option>
                                                        <option value="an" <?php if($config['VideoLanguage']=="an")echo "selected = 1";?>>Aragonese</option>
                                                        <option value="hy" <?php if($config['VideoLanguage']=="hy")echo "selected = 1";?>>Armenian</option>
                                                        <option value="as" <?php if($config['VideoLanguage']=="as")echo "selected = 1";?>>Assamese</option>
                                                        <option value="av" <?php if($config['VideoLanguage']=="av")echo "selected = 1";?>>Avaric</option>
                                                        <option value="ae" <?php if($config['VideoLanguage']=="ae")echo "selected = 1";?>>Avestan</option>
                                                        <option value="ay" <?php if($config['VideoLanguage']=="ay")echo "selected = 1";?>>Aymara</option>
                                                        <option value="az" <?php if($config['VideoLanguage']=="az")echo "selected = 1";?>>Azerbaijani</option>
                                                        <option value="bm" <?php if($config['VideoLanguage']=="bm")echo "selected = 1";?>>Bambara</option>
                                                        <option value="ba" <?php if($config['VideoLanguage']=="ba")echo "selected = 1";?>>Bashkir</option>
                                                        <option value="eu" <?php if($config['VideoLanguage']=="eu")echo "selected = 1";?>>Basque</option>
                                                        <option value="be" <?php if($config['VideoLanguage']=="be")echo "selected = 1";?>>Belarusian</option>
                                                        <option value="bn" <?php if($config['VideoLanguage']=="bn")echo "selected = 1";?>>Bengali</option>
                                                        <option value="bh" <?php if($config['VideoLanguage']=="bh")echo "selected = 1";?>>Bihari languages</option>
                                                        <option value="bi" <?php if($config['VideoLanguage']=="bi")echo "selected = 1";?>>Bislama</option>
                                                        <option value="bs" <?php if($config['VideoLanguage']=="bs")echo "selected = 1";?>>Bosnian</option>
                                                        <option value="br" <?php if($config['VideoLanguage']=="br")echo "selected = 1";?>>Breton</option>
                                                        <option value="bg" <?php if($config['VideoLanguage']=="bg")echo "selected = 1";?>>Bulgarian</option>
                                                        <option value="my" <?php if($config['VideoLanguage']=="my")echo "selected = 1";?>>Burmese</option>
                                                        <option value="ca" <?php if($config['VideoLanguage']=="ca")echo "selected = 1";?>>Catalan, Valencian</option>
                                                        <option value="ch" <?php if($config['VideoLanguage']=="ch")echo "selected = 1";?>>Chamorro</option>
                                                        <option value="ce" <?php if($config['VideoLanguage']=="ce")echo "selected = 1";?>>Chechen</option>
                                                        <option value="ny" <?php if($config['VideoLanguage']=="ny")echo "selected = 1";?>>Chichewa, Chewa, Nyanja</option>
                                                        <option value="zh" <?php if($config['VideoLanguage']=="zh")echo "selected = 1";?>>Chinese</option>
                                                        <option value="cv" <?php if($config['VideoLanguage']=="cv")echo "selected = 1";?>>Chuvash</option>
                                                        <option value="kw" <?php if($config['VideoLanguage']=="kw")echo "selected = 1";?>>Cornish</option>
                                                        <option value="co" <?php if($config['VideoLanguage']=="co")echo "selected = 1";?>>Corsican</option>
                                                        <option value="cr" <?php if($config['VideoLanguage']=="cr")echo "selected = 1";?>>Cree</option>
                                                        <option value="hr" <?php if($config['VideoLanguage']=="hr")echo "selected = 1";?>>Croatian</option>
                                                        <option value="cs" <?php if($config['VideoLanguage']=="cs")echo "selected = 1";?>>Czech</option>
                                                        <option value="da" <?php if($config['VideoLanguage']=="da")echo "selected = 1";?>>Danish</option>
                                                        <option value="dv" <?php if($config['VideoLanguage']=="dv")echo "selected = 1";?>>Divehi, Dhivehi, Maldivian</option>
                                                        <option value="nl" <?php if($config['VideoLanguage']=="nl")echo "selected = 1";?>>Dutch, Flemish</option>
                                                        <option value="dz" <?php if($config['VideoLanguage']=="dz")echo "selected = 1";?>>Dzongkha</option>
                                                        <option value="en-US" <?php if($config['VideoLanguage']=="en-US")echo "selected = 1";?>>English(US)</option>
                                                        <option value="eo" <?php if($config['VideoLanguage']=="eo")echo "selected = 1";?>>Esperanto</option>
                                                        <option value="et" <?php if($config['VideoLanguage']=="et")echo "selected = 1";?>>Estonian</option>
                                                        <option value="ee" <?php if($config['VideoLanguage']=="ee")echo "selected = 1";?>>Ewe</option>
                                                        <option value="fo" <?php if($config['VideoLanguage']=="fo")echo "selected = 1";?>>Faroese</option>
                                                        <option value="fj" <?php if($config['VideoLanguage']=="fj")echo "selected = 1";?>>Fijian</option>
                                                        <option value="fl" <?php if($config['VideoLanguage']=="fl")echo "selected = 1";?>>Filipino</option>
                                                        <option value="fi" <?php if($config['VideoLanguage']=="fi")echo "selected = 1";?>>Finnish</option>
                                                        <option value="fr" <?php if($config['VideoLanguage']=="fr")echo "selected = 1";?>>French</option>
                                                        <option value="ff" <?php if($config['VideoLanguage']=="ff")echo "selected = 1";?>>Fulah</option>
                                                        <option value="gl" <?php if($config['VideoLanguage']=="gl")echo "selected = 1";?>>Galician</option>
                                                        <option value="ka" <?php if($config['VideoLanguage']=="ka")echo "selected = 1";?>>Georgian</option>
                                                        <option value="de" <?php if($config['VideoLanguage']=="de")echo "selected = 1";?>>German</option>
                                                        <option value="el" <?php if($config['VideoLanguage']=="el")echo "selected = 1";?>>Greek (modern)</option>
                                                        <option value="gn" <?php if($config['VideoLanguage']=="gn")echo "selected = 1";?>>Guaraní</option>
                                                        <option value="gu" <?php if($config['VideoLanguage']=="gu")echo "selected = 1";?>>Gujarati</option>
                                                        <option value="ht" <?php if($config['VideoLanguage']=="ht")echo "selected = 1";?>>Haitian, Haitian Creole</option>
                                                        <option value="ha" <?php if($config['VideoLanguage']=="ha")echo "selected = 1";?>>Hausa</option>
                                                        <option value="he" <?php if($config['VideoLanguage']=="he")echo "selected = 1";?>>Hebrew (modern)</option>
                                                        <option value="hz" <?php if($config['VideoLanguage']=="hz")echo "selected = 1";?>>Herero</option>
                                                        <option value="hi" <?php if($config['VideoLanguage']=="hi")echo "selected = 1";?>>Hindi</option>
                                                        <option value="ho" <?php if($config['VideoLanguage']=="ho")echo "selected = 1";?>>Hiri Motu</option>
                                                        <option value="hu" <?php if($config['VideoLanguage']=="hu")echo "selected = 1";?>>Hungarian</option>
                                                        <option value="ia" <?php if($config['VideoLanguage']=="ia")echo "selected = 1";?>>Interlingua</option>
                                                        <option value="id" <?php if($config['VideoLanguage']=="id")echo "selected = 1";?>>Indonesian</option>
                                                        <option value="ie" <?php if($config['VideoLanguage']=="ie")echo "selected = 1";?>>Interlingue</option>
                                                        <option value="ga" <?php if($config['VideoLanguage']=="ga")echo "selected = 1";?>>Irish</option>
                                                        <option value="ig" <?php if($config['VideoLanguage']=="ig")echo "selected = 1";?>>Igbo</option>
                                                        <option value="ik" <?php if($config['VideoLanguage']=="ik")echo "selected = 1";?>>Inupiaq</option>
                                                        <option value="io" <?php if($config['VideoLanguage']=="io")echo "selected = 1";?>>Ido</option>
                                                        <option value="is" <?php if($config['VideoLanguage']=="is")echo "selected = 1";?>>Icelandic</option>
                                                        <option value="it" <?php if($config['VideoLanguage']=="it")echo "selected = 1";?>>Italian</option>
                                                        <option value="iu" <?php if($config['VideoLanguage']=="iu")echo "selected = 1";?>>Inuktitut</option>
                                                        <option value="ja" <?php if($config['VideoLanguage']=="ja")echo "selected = 1";?>>Japanese</option>
                                                        <option value="jv" <?php if($config['VideoLanguage']=="jv")echo "selected = 1";?>>Javanese</option>
                                                        <option value="kl" <?php if($config['VideoLanguage']=="kl")echo "selected = 1";?>>Kalaallisut, Greenlandic</option>
                                                        <option value="kn" <?php if($config['VideoLanguage']=="kn")echo "selected = 1";?>>Kannada</option>
                                                        <option value="kr" <?php if($config['VideoLanguage']=="kr")echo "selected = 1";?>>Kanuri</option>
                                                        <option value="ks" <?php if($config['VideoLanguage']=="ks")echo "selected = 1";?>>Kashmiri</option>
                                                        <option value="kk" <?php if($config['VideoLanguage']=="kk")echo "selected = 1";?>>Kazakh</option>
                                                        <option value="km" <?php if($config['VideoLanguage']=="km")echo "selected = 1";?>>Central Khmer</option>
                                                        <option value="ki" <?php if($config['VideoLanguage']=="ki")echo "selected = 1";?>>Kikuyu, Gikuyu</option>
                                                        <option value="rw" <?php if($config['VideoLanguage']=="rw")echo "selected = 1";?>>Kinyarwanda</option>
                                                        <option value="ky" <?php if($config['VideoLanguage']=="ky")echo "selected = 1";?>>Kirghiz, Kyrgyz</option>
                                                        <option value="kv" <?php if($config['VideoLanguage']=="kv")echo "selected = 1";?>>Komi</option>
                                                        <option value="kg" <?php if($config['VideoLanguage']=="kg")echo "selected = 1";?>>Kongo</option>
                                                        <option value="ko" <?php if($config['VideoLanguage']=="ko")echo "selected = 1";?>>Korean</option>
                                                        <option value="ku" <?php if($config['VideoLanguage']=="ku")echo "selected = 1";?>>Kurdish</option>
                                                        <option value="kj" <?php if($config['VideoLanguage']=="kj")echo "selected = 1";?>>Kuanyama, Kwanyama</option>
                                                        <option value="la" <?php if($config['VideoLanguage']=="la")echo "selected = 1";?>>Latin</option>
                                                        <option value="lb" <?php if($config['VideoLanguage']=="lb")echo "selected = 1";?>>Luxembourgish, Letzeburgesch</option>
                                                        <option value="lg" <?php if($config['VideoLanguage']=="lg")echo "selected = 1";?>>Ganda</option>
                                                        <option value="li" <?php if($config['VideoLanguage']=="li")echo "selected = 1";?>>Limburgan, Limburger, Limburgish</option>
                                                        <option value="ln" <?php if($config['VideoLanguage']=="ln")echo "selected = 1";?>>Lingala</option>
                                                        <option value="lo" <?php if($config['VideoLanguage']=="lo")echo "selected = 1";?>>Lao</option>
                                                        <option value="lt" <?php if($config['VideoLanguage']=="lt")echo "selected = 1";?>>Lithuanian</option>
                                                        <option value="lu" <?php if($config['VideoLanguage']=="lu")echo "selected = 1";?>>Luba-Katanga</option>
                                                        <option value="lv" <?php if($config['VideoLanguage']=="lv")echo "selected = 1";?>>Latvian</option>
                                                        <option value="gv" <?php if($config['VideoLanguage']=="gv")echo "selected = 1";?>>Manx</option>
                                                        <option value="mk" <?php if($config['VideoLanguage']=="mk")echo "selected = 1";?>>Macedonian</option>
                                                        <option value="mg" <?php if($config['VideoLanguage']=="mg")echo "selected = 1";?>>Malagasy</option>
                                                        <option value="ms" <?php if($config['VideoLanguage']=="ms")echo "selected = 1";?>>Malay</option>
                                                        <option value="ml" <?php if($config['VideoLanguage']=="ml")echo "selected = 1";?>>Malayalam</option>
                                                        <option value="mt" <?php if($config['VideoLanguage']=="mt")echo "selected = 1";?>>Maltese</option>
                                                        <option value="mi" <?php if($config['VideoLanguage']=="mi")echo "selected = 1";?>>Maori</option>
                                                        <option value="mr" <?php if($config['VideoLanguage']=="mr")echo "selected = 1";?>>Marathi</option>
                                                        <option value="mh" <?php if($config['VideoLanguage']=="mh")echo "selected = 1";?>>Marshallese</option>
                                                        <option value="mn" <?php if($config['VideoLanguage']=="mm")echo "selected = 1";?>>Mongolian</option>
                                                        <option value="na" <?php if($config['VideoLanguage']=="na")echo "selected = 1";?>>Nauru</option>
                                                        <option value="nv" <?php if($config['VideoLanguage']=="nv")echo "selected = 1";?>>Navajo, Navaho</option>
                                                        <option value="nd" <?php if($config['VideoLanguage']=="nd")echo "selected = 1";?>>North Ndebele</option>
                                                        <option value="ne" <?php if($config['VideoLanguage']=="ne")echo "selected = 1";?>>Nepali</option>
                                                        <option value="ng" <?php if($config['VideoLanguage']=="ng")echo "selected = 1";?>>Ndonga</option>
                                                        <option value="nb" <?php if($config['VideoLanguage']=="nb")echo "selected = 1";?>>Norwegian Bokmål</option>
                                                        <option value="nn" <?php if($config['VideoLanguage']=="nn")echo "selected = 1";?>>Norwegian Nynorsk</option>
                                                        <option value="no" <?php if($config['VideoLanguage']=="no")echo "selected = 1";?>>Norwegian</option>
                                                        <option value="ii" <?php if($config['VideoLanguage']=="ii")echo "selected = 1";?>>Sichuan Yi, Nuosu</option>
                                                        <option value="nr" <?php if($config['VideoLanguage']=="vi")echo "selected = 1";?>>South Ndebele</option>
                                                        <option value="oc" <?php if($config['VideoLanguage']=="oc")echo "selected = 1";?>>Occitan</option>
                                                        <option value="oj" <?php if($config['VideoLanguage']=="oj")echo "selected = 1";?>>Ojibwa</option>
                                                        <option value="cu" <?php if($config['VideoLanguage']=="cu")echo "selected = 1";?>>Church Slavic, Church Slavonic, Old Church Slavonic, Old Slavonic, Old Bulgarian</option>
                                                        <option value="om" <?php if($config['VideoLanguage']=="om")echo "selected = 1";?>>Oromo</option>
                                                        <option value="or" <?php if($config['VideoLanguage']=="or")echo "selected = 1";?>>Oriya</option>
                                                        <option value="os" <?php if($config['VideoLanguage']=="os")echo "selected = 1";?>>Ossetian, Ossetic</option>
                                                        <option value="pa" <?php if($config['VideoLanguage']=="pa")echo "selected = 1";?>>Panjabi, Punjabi</option>
                                                        <option value="pi" <?php if($config['VideoLanguage']=="pi")echo "selected = 1";?>>Pali</option>
                                                        <option value="fa" <?php if($config['VideoLanguage']=="fa")echo "selected = 1";?>>Persian</option>
                                                        <option value="pl" <?php if($config['VideoLanguage']=="pl")echo "selected = 1";?>>Polish</option>
                                                        <option value="ps" <?php if($config['VideoLanguage']=="ps")echo "selected = 1";?>>Pashto, Pushto</option>
                                                        <option value="pt" <?php if($config['VideoLanguage']=="pt")echo "selected = 1";?>>Portuguese</option>
                                                        <option value="qu" <?php if($config['VideoLanguage']=="qu")echo "selected = 1";?>>Quechua</option>
                                                        <option value="rm" <?php if($config['VideoLanguage']=="rm")echo "selected = 1";?>>Romansh</option>
                                                        <option value="rn" <?php if($config['VideoLanguage']=="rn")echo "selected = 1";?>>Rundi</option>
                                                        <option value="ro" <?php if($config['VideoLanguage']=="ro")echo "selected = 1";?>>Romanian, Moldavian, Moldovan</option>
                                                        <option value="ru" <?php if($config['VideoLanguage']=="ru")echo "selected = 1";?>>Russian</option>
                                                        <option value="sa" <?php if($config['VideoLanguage']=="sa")echo "selected = 1";?>>Sanskrit</option>
                                                        <option value="sc" <?php if($config['VideoLanguage']=="sc")echo "selected = 1";?>>Sardinian</option>
                                                        <option value="sd" <?php if($config['VideoLanguage']=="sd")echo "selected = 1";?>>Sindhi</option>
                                                        <option value="se" <?php if($config['VideoLanguage']=="se")echo "selected = 1";?>>Northern Sami</option>
                                                        <option value="sm" <?php if($config['VideoLanguage']=="vi")echo "selected = 1";?>>Samoan</option>
                                                        <option value="sg" <?php if($config['VideoLanguage']=="sm")echo "selected = 1";?>>Sango</option>
                                                        <option value="sr" <?php if($config['VideoLanguage']=="sr")echo "selected = 1";?>>Serbian</option>
                                                        <option value="gd" <?php if($config['VideoLanguage']=="gd")echo "selected = 1";?>>Gaelic, Scottish Gaelic</option>
                                                        <option value="sn" <?php if($config['VideoLanguage']=="sn")echo "selected = 1";?>>Shona</option>
                                                        <option value="si" <?php if($config['VideoLanguage']=="si")echo "selected = 1";?>>Sinhala, Sinhalese</option>
                                                        <option value="sk" <?php if($config['VideoLanguage']=="sk")echo "selected = 1";?>>Slovak</option>
                                                        <option value="sl" <?php if($config['VideoLanguage']=="sl")echo "selected = 1";?>>Slovenian</option>
                                                        <option value="so" <?php if($config['VideoLanguage']=="so")echo "selected = 1";?>>Somali</option>
                                                        <option value="st" <?php if($config['VideoLanguage']=="st")echo "selected = 1";?>>Southern Sotho</option>
                                                        <option value="es" <?php if($config['VideoLanguage']=="es")echo "selected = 1";?>>Spanish, Castilian</option>
                                                        <option value="su" <?php if($config['VideoLanguage']=="su")echo "selected = 1";?>>Sundanese</option>
                                                        <option value="sw" <?php if($config['VideoLanguage']=="sw")echo "selected = 1";?>>Swahili</option>
                                                        <option value="ss" <?php if($config['VideoLanguage']=="ss")echo "selected = 1";?>>Swati</option>
                                                        <option value="sv" <?php if($config['VideoLanguage']=="sv")echo "selected = 1";?>>Swedish</option>
                                                        <option value="ta" <?php if($config['VideoLanguage']=="ta")echo "selected = 1";?>>Tamil</option>
                                                        <option value="te" <?php if($config['VideoLanguage']=="te")echo "selected = 1";?>>Telugu</option>
                                                        <option value="tg" <?php if($config['VideoLanguage']=="tg")echo "selected = 1";?>>Tajik</option>
                                                        <option value="th" <?php if($config['VideoLanguage']=="th")echo "selected = 1";?>>Thai</option>
                                                        <option value="bo" <?php if($config['VideoLanguage']=="bo")echo "selected = 1";?>>Tibetan</option>
                                                        <option value="tk" <?php if($config['VideoLanguage']=="tk")echo "selected = 1";?>>Turkmen</option>
                                                        <option value="tl" <?php if($config['VideoLanguage']=="tl")echo "selected = 1";?>>Tagalog</option>
                                                        <option value="tn" <?php if($config['VideoLanguage']=="tn")echo "selected = 1";?>>Tswana</option>
                                                        <option value="to" <?php if($config['VideoLanguage']=="to")echo "selected = 1";?>>Tonga (Tonga Islands)</option>
                                                        <option value="tr" <?php if($config['VideoLanguage']=="tr")echo "selected = 1";?>>Turkish</option>
                                                        <option value="ts" <?php if($config['VideoLanguage']=="ts")echo "selected = 1";?>>Tsonga</option>
                                                        <option value="tt" <?php if($config['VideoLanguage']=="tt")echo "selected = 1";?>>Tatar</option>
                                                        <option value="tw" <?php if($config['VideoLanguage']=="tw")echo "selected = 1";?>>Twi</option>
                                                        <option value="ty" <?php if($config['VideoLanguage']=="ty")echo "selected = 1";?>>Tahitian</option>
                                                        <option value="ug" <?php if($config['VideoLanguage']=="ug")echo "selected = 1";?>>Uighur, Uyghur</option>
                                                        <option value="uk" <?php if($config['VideoLanguage']=="uk")echo "selected = 1";?>>Ukrainian</option>
                                                        <option value="ur" <?php if($config['VideoLanguage']=="ur")echo "selected = 1";?>>Urdu</option>
                                                        <option value="uz" <?php if($config['VideoLanguage']=="uz")echo "selected = 1";?>>Uzbek</option>
                                                        <option value="ve" <?php if($config['VideoLanguage']=="ve")echo "selected = 1";?>>Venda</option>
                                                        <option value="vi" <?php if($config['VideoLanguage']=="vi")echo "selected = 1";?>>Vietnamese</option>
                                                        <option value="vo" <?php if($config['VideoLanguage']=="vo")echo "selected = 1";?>>Volapük</option>
                                                        <option value="wa" <?php if($config['VideoLanguage']=="wa")echo "selected = 1";?>>Walloon</option>
                                                        <option value="cy" <?php if($config['VideoLanguage']=="cy")echo "selected = 1";?>>Welsh</option>
                                                        <option value="wo" <?php if($config['VideoLanguage']=="wo")echo "selected = 1";?>>Wolof</option>
                                                        <option value="fy" <?php if($config['VideoLanguage']=="fy")echo "selected = 1";?>>Western Frisian</option>
                                                        <option value="xh" <?php if($config['VideoLanguage']=="xh")echo "selected = 1";?>>Xhosa</option>
                                                        <option value="yi" <?php if($config['VideoLanguage']=="yi")echo "selected = 1";?>>Yiddish</option>
                                                        <option value="yo" <?php if($config['VideoLanguage']=="yo")echo "selected = 1";?>>Yoruba</option>
                                                        <option value="za" <?php if($config['VideoLanguage']=="za")echo "selected = 1";?>>Zhuang, Chuang</option>
                                                        <option value="zu" <?php if($config['VideoLanguage']=="zu")echo "selected = 1";?>>Zulu</option>
                                                        <option value=""  <?php if(empty($config['VideoLanguage']))echo "selected = 1";?> >Chọn ngôn ngữ  </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--End  Quốc Gia-->

                                        <!-- Cut Video-->
                                        <div class="form-group" id="SplitVideo" >
                                            <div class="col-sm-12">
                                                <label>Cắt Video:</label>
                                            </div>
                                            <?php
                                            $SplitVideo= json_decode($config["SplitVideo"], true);
                                            $minFirst = floor($SplitVideo['First']/60);
                                            $secFirst = $SplitVideo['First']- $minFirst*60;
                                            $minEnd = floor($SplitVideo['End']/60);
                                            $secEnd = $SplitVideo['End']- $minFirst*60;

                                            ?>
                                            <div class="col-sm-12" style = "margin-left: 50px" >
                                                <div class="row">
                                                    <div class="col-lg-1">
                                                        <span>Cắt Đầu:  </span></div>
                                                    <div class="col-lg-4"><input id="FirstMinAdd" name="FirstMinAdd" class="form-control" type="text" value="<?php echo $minFirst?>"></div>
                                                    <div class="col-lg-1"><span> phút - </span> </div>
                                                    <div class="col-lg-4"><input id="FirstSecAdd"  name="FirstSecAdd" class="form-control" onkeyup="checkTime();" type="text" value="<?php echo $secFirst?>"></div>
                                                    <div class="col-lg-1"><span> giây</span></div>
                                                </div>
                                                <div class="row" >
                                                    <div class="col-lg-1">
                                                        <span>Cắt Đuôi:    </span></div>
                                                    <div class="col-lg-4"><input id="EndMinAdd" name="EndMinAdd" class="form-control" type="text" value="<?php echo $minEnd?>"> </div>
                                                    <div class="col-lg-1"><span> phút - </span></div>
                                                    <div class="col-lg-4"><input id="EndSecAdd" name="EndSecAdd" class="form-control" onkeyup="checkTime();" type="text" value="<?php echo $secEnd?>"></div>
                                                    <div class="col-lg-1"><span> giây</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Cắt Video-->

                                        <!-- Cấu hình Auto Upload-->
                                        <div class="form-group" id="TotalVideo" style="display: none">
                                            <div class="col-sm-12">
                                                <label>Cấu Hình Auto Upload:</label>
                                                <label> Tổng số video upload trong ngày</label>
                                                <div class="col-sm-12" style = "margin-left: 50px">
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
                                <input  type="submit" id="btn_edit_config" class="button-next btn btn-info" name="add_config" value="Lưu"/>
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

