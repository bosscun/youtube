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
                    <form class="form-horizontal tasi-form" method="post" action="<?php echo BASE_PATH; ?>/admin/controller/c_group.php?controller=group&action=edit_group" id="formEditGroup" enctype="multipart/form-data">
                        <section class="panel">
                            <div class="panel-body">
                                <input type="submit" id="default-next-0" class="button-next btn btn-info" name="add" value="Lưu"/>
                            </div>
                        </section>
                        <section class="panel">
                            <input type="hidden" name="IDGroup" value="<?php if ($ID != 0){ echo $ID;}?>">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div id="info" class="tab-pane active">
                                        <div class="form-group" id="GroupName" style="display: block">
                                            <div class="col-sm-12">
                                                <label>Tên nhóm</label>
                                                  <input type="text"  id="GroupNameEdit" name="GroupNameEdit" value="<?php echo $groupSelected["GroupName"]?> ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="panel">
                            <div class="panel-body">
                                <input type="submit" id="default-next-1" class="button-next btn btn-info" name="edit_group" value="Lưu"/>
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
	 
	  