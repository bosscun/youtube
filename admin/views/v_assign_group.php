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
                    <input type="hidden" name="LeaderID" value="<?php if ($ID != 0){ echo $ID;}?>">
                    <form class="form-horizontal tasi-form" method="post" action="<?php echo BASE_PATH; ?>/admin/controller/c_user.php?controller=user&action=assign_group&ID=<?php echo $ID;?>" id="configForm" enctype="multipart/form-data">
                        <section class="panel">
                            <div class="panel-body">
                                <input type="submit" id="update_channel_info" class="button-next btn btn-info" name="add" value="Lưu"/>
                            </div>
                        </section>
                        <section class="panel">

                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="form-group">
                                    <div id="info" class="tab-pane active">
                                        <div class="form-group" id="fromchannelid" style="display: block">
                                            <div class="col-sm-12">
                                                <label>Gán người dùng vào nhóm :</label>
                                                <select class="form-control m-bot15" id="AssignToUserID" name="AssignToUserID">
                                                    <?php
                                                    foreach ($arr_leader as $leader) {
                                                        ?>
                                                        <option value="<?php echo $leader["ID"]?>"><?php echo $leader["UserName"]?></option>
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
	 
	  