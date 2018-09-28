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
                    <form class="form-horizontal tasi-form" method="post" action="<?php echo BASE_PATH; ?>/admin/controller/c_channel.php?controller=UpdateSchedule&action=update_schedule&Id=<?php echo $Id;?>"  id="configForm" enctype="multipart/form-data">
                        <input type="hidden" name="channelID" value="<?php echo $Id;?>">
                        <section class="panel">
                            <div class="panel-body">
                                <a href="<?php echo BASE_PATH; ?>/admin/controller/c_channel.php?controller=channel" id="default-next-0" class="button-next btn btn-warning" style="float: left">Bỏ qua</a>
                                <input type="submit" id="saveSchedule"  class="button-next btn btn-info" name="add" value="Lưu"/>
                            </div>
                        </section>
                            <section class="panel col-lg-3 col-md-3 col-sm-3"></section>
                            <section class="panel col-lg-6 col-md-6 col-sm-6">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label>Số video upload trong ngày</label>
                                            <select class="form-control m-bot15" id="TotalVideoUpload" name="TotalVideoUpload" onchange="ChangeTotalVideo('.trim($id).')">
                                                <option value="0" >Chọn số video upload trong 1 ngày..</option>
                                               <?php for($i = 1; $i<=5; $i++) {
                                                   ?>
                                                   <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                                                   <?php
                                               }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label>Số video publish trong ngày</label>
                                            <select class="form-control m-bot15" id="TotalVideoPublish"  onchange="addPublishschedule()" name="TotalVideoPublish">
                                                <option value="0">Chọn số video puhlish trong ngày</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="publishTime">
                                    </div>
                                    <div class="form-group" style="display: none" id="setAfterDays">
                                        <div class="col-sm-12">
                                            <label>Video sẽ publish sau:</label>
                                            <select class="form-control m-bot15" id="" name="AfterDays">
                                                <option value="1">1 Ngày</option>
                                                <option value="2">2 Ngày</option>
                                                <option value="3">3 Ngày</option>
                                                <option value="4">4 Ngày</option>
                                                <option value="5">5 Ngày</option>
                                                <option value="0">Publish ngay</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="panel col-lg-3 col-md-3 col-sm-3"></section>
                    </form>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
	 
	  