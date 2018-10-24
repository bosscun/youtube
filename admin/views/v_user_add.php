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
                    <form class="form-horizontal tasi-form" method="post" action="<?php echo BASE_PATH; ?>/admin/controller/c_user.php?controller=user&action=add_user" id="configForm" enctype="multipart/form-data">
                        <section class="panel">
                            <div class="panel-body">
                                <input type="submit" id="default-next-0" disabled = "disabled" class="button-next btn btn-info" name="add" value="Lưu"/>
                            </div>
                        </section>
                        <section class="panel">
                            <input type="hidden" name="IDConfig" value="<?php if ($ID != 0){ echo $ID;}?>">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div id="info" class="tab-pane active">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Tên đăng nhập</label> <?php if ($message=="") echo " <font size=\"4\" color=\"red\"> Người dùng đã tồn tại..</font>" ;?>
                                                <input type="text" id="UserNameAdd" name="UserNameAdd" class="form-control" onkeyup="passwordChanged();" placeholder="Tên đăng nhập">
												<span id="nameNotice">Chú ý: Tên tài khoản phải dài hơn 3 ký tự</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Mật khẩu</label>
                                                <input type="password" id="PassWordAdd" name="PassWordAdd"  onkeyup="passwordChanged();" class="form-control"  placeholder="Mật khẩu">
                                                <span id="strength">Chú ý: Mật khẩu phải có tối thiểu 8 kí tự, bao gồm kí tự hoa, thường, số, và kí tự đặc biệt</span>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Họ tên</label>
                                                <input type="text" id="Address" name="AddressAdd" class="form-control"  placeholder="Địa chỉ liên hệ">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Số điện thoại</label>
                                                <input type="text" id="PhoneNumber" name="PhoneNumberAdd" class="form-control"  placeholder="Số điện thoại">
                                            </div>
                                        </div>

                                        <div class="form-group" id="fromchannelid" style="display: block">
                                            <div class="col-sm-12">
                                                <label>Phân quyền</label>
                                                <select class="form-control m-bot15" id="RoleAdd" name="RoleAdd">
                                                    <?php if($_SESSION["Role"] =="1"){?>
                                                    <option value="2">Leader</option>
                                                    <?php }?>
                                                    <option value="3">User</option>
                                                </select>
                                            </div>
<!--                                            <div class="col-sm-12">-->
<!--                                                <label>Nhóm</label>-->
<!--                                                <select class="form-control m-bot15" id="GroupIDAdd" name="GroupIDAdd" >-->
<!--                                                    --><?php
//                                                    foreach ($arr_group as $group) {
//                                                        ?>
<!--                                                        <option value="--><?php //echo $group['ID']?><!--">--><?php //echo $group['GroupName']?><!--</option>-->
<!--                                                        --><?php
//                                                    }
//                                                    ?>
<!--                                                </select>-->
<!--                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="panel">
                            <div class="panel-body">
                                <input type="submit" id="default-next-1" class="button-next btn btn-info" name="add_channelInfo" disabled = "disabled" value="Lưu"/>
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
	 
	  