<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo $title;?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <!--content-->
                    <input type="hidden" name="IDConfig" value="<?php if ($Id != 0){ echo $Id;}?>">
                    <form class="form-horizontal tasi-form" method="post" action="<?php echo BASE_PATH; ?>/admin/controller/c_channel.php?controller=channel&action=edit_channel&Id=<?php echo $Id;?>" id="configForm" enctype="multipart/form-data">
                        <section class="panel">
                            <div class="panel-body">
                                <input type="submit" id="update_channel_info" class="button-next btn btn-info" name="add" value="Lưu"/>
                            </div>
                        </section>
                        <section class="panel">

                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="form-group">
                                    <div >
                                        <label>Tên kênh</label>
                                        <input type="text" disabled id="ChannelName" name="ChannelName" class="form-control"  width="40px" value="<?php echo $channel["ChannelName"];?>" >
                                    </div> <br> <br>
                                    <div id="info" class="tab-pane active">
                                        <div class="form-group" id="fromchannelid" style="display: block">
                                            <div class="col-sm-12">
                                                <label>Cấp cho người dùng</label>
                                                <select class="form-control m-bot15" id="AssignTo" name="AssignTo">
                                                    <?php
                                                    foreach ($arr_user as $user) {
                                                        ?>
                                                        <option value="<?php echo $user["ID"]?>"><?php echo $user["UserName"]?></option>
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
                    </form>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
	 
	  