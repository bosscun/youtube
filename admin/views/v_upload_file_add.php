<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">

            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <!--content-->
                    <form class="form-horizontal tasi-form" method="post" action="<?php echo BASE_PATH; ?>/admin/controller/c_upload_file.php?controller=upload_file&action=add_file" id="configForm" enctype="multipart/form-data">
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
                                                <label for="ImageAdd">Nhập file</label>
                                                <input type="file" id="FileAdd" name="FileAdd" ">
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
	 
	  