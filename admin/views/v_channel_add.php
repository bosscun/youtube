<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo $titleAction;?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <!--content-->
                    <form class="form-horizontal tasi-form" method="post" action="<?php echo BASE_PATH; ?>/admin/controller/c_channel.php?controller=channel&action=add_channelInfo" id="configForm" enctype="multipart/form-data">
                        <section class="panel">
                            <div class="panel-body">
                                <input type="submit" id="default-next-0" class="button-next btn btn-info" name="add" value="Lưu"/>
                            </div>
                        </section>
                        <section class="panel">
                            <input type="hidden" name="IDConfig" value="<?php if ($ID != 0){ echo $ID;}?>">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div id="info" class="tab-pane active">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Địa chỉ email</label>
                                                <input type="text" id="EmailAdd" name="EmailAdd" class="form-control"  placeholder="Nhập Email">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Mã kênh video</label>
                                                <input type="text" id="ChannelIdAdd" name="ChannelIdAdd" class="form-control"  placeholder="Nhập mã kênh video">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Tên kênh video</label>
                                                <input type="text" id="ChannelNameAdd" name="ChannelNameAdd" class="form-control"  placeholder="Nhập tên kênh video">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Loại kênh</label>
                                                <select class="form-control m-bot15" id="IsUploadChannelAdd" name="IsUploadChannelAdd">
                                                    <option value="1">Kênh upload video</option>
                                                    <option value="0">Kênh download video</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group" id="fromchannelid" style="display: block">
                                            <div class="col-sm-12">
                                                <label>Kênh download</label>
                                                <select class="form-control m-bot15" id="FromChannelIdAdd" name="FromChannelIdAdd">
                                                <?php
                                                foreach ($arr_channel_download as $channel) {
                                                    ?>
                                                        <option value="<?php echo $channel["ChannelID"]?>"><?php echo $channel["ChannelName"]?></option>
                                                    <?php
                                                }
                                                ?>
                                                </select>
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
	 
	  