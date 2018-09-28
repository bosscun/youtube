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
                    <form class="form-horizontal tasi-form" method="post" action="<?php echo BASE_PATH; ?>/admin/controller/c_channel.php?controller=channel&action=change_channel_info&Id=<?php echo $Id;?>&channelID=<?php echo $channel['ChannelID'];?>" id="configForm" enctype="multipart/form-data">
                        <section class="panel">
                            <div class="panel-body">
                                <input type="submit" id="update_channel_info" class="button-next btn btn-info" name="add" value="Lưu"/>
                            </div>
                        </section>
                        <section class="panel">

                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="form-group">
                                    <div>
                                        <label>Tên kênh</label>
                                        <input type="text" id="ChannelName" name="ChannelName" class="form-control"  width="40px" value="<?php echo $channel["ChannelName"];?>" >
                                    </div>
                                        <?php if ($_SESSION['Role']!=3){?>

                                    <div id="info" class="tab-pane active">
                                        <label>Email</label>
                                        <input type="text" id="ChannelEmail" value="<?php if ($channelEmail!='') echo $channelEmail['Email'] ?>" name="ChannelEmail" class="form-control"  width="40px" >
                                    </div>
                                    <div id="info" class="tab-pane active">
                                        <label>PassWord</label>
                                        <input type="text" id="ChannelPassWord" name="ChannelPassWord" value="<?php echo $decryptPass?>" class="form-control"  width="40px">
                                    </div>
                                        <?php }?>
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
	 
	  