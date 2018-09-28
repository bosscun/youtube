<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
            </header>
            <input type="hidden" name="videoID" value="<?php if ($videoID != 0){ echo $videoID;}?>">
            <input type="hidden" name="channelID" value="<?php if ($ChannelID != 0){ echo $ChannelID;}?>">
            <script language="JavaScript">
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#blah').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>
            <div class="panel-body">
                <div class="adv-table editable-table ">

                    <!--content-->
                    <form class="form-horizontal tasi-form" method="post" action="<?php echo BASE_PATH; ?>/admin/controller/c_video_manager.php?controller=video_manager&action=upload_thumbnail&videoID=<?php echo $videoID;?>&channelID=<?php echo $ChannelID?>" id="configForm" enctype="multipart/form-data">

                        <section class="panel">

                            <div class="panel-body">
                                <div class="tab-content">
                                    <div id="info" class="tab-pane active">

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Upload Thumbnail:</label> <?php if ($message=="") echo " <font size=\"4\" color=\"red\"> Upload thumbnail lỗi</font>" ;?>
                                                <input type="file" id="uploadThumbnail" name="FileAdd" accept=".jpg"  onchange="readURL(this);" >
                                                <br><br>
                                                <img id="blah" src="../img/ytb_thumb.jpg"  width="640px" height="320px" />
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="panel">
                            <div class="panel-body">
                                <input type="submit" id="default-next-1" class="button-next btn btn-info" name="add_channelInfo" value="Lưu"/>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->

