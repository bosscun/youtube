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
                    <input type="hidden" name="IDConfig" value="<?php if ($ID != 0){ echo $ID;}?>">
                    <form class="form-horizontal tasi-form" method="post" action="<?php echo BASE_PATH; ?>/admin/controller/c_user.php?controller=user&action=edit_user&ID=<?php echo $ID?>" id="configForm" enctype="multipart/form-data">
                        <section class="panel">
                            <div class="panel-body">
                                <input type="submit" id="default-next-0" class="button-next btn btn-info" name="add" value="Lưu"/>
                            </div>
                        </section>
                        <section class="panel">

                            <div class="panel-body">
                                <div class="tab-content">
                                    <div id="info" class="tab-pane active">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Tên đăng nhập</label>
                                                <input type="text" id="UserNameAdd" onkeyup="passwordChanged();"  name="UserNameAdd" class="form-control" value="<?php echo $UserInfo['UserName'];?>" readonly>
												<span id="nameNotice">Chú ý: Tên tài khoản phải dài hơn 3 ký tự</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
												<label>Đổi mật khẩu &nbsp &nbsp </label>
												<input type ="checkbox" id = "ChangePass" onclick = "ShowPassInput();"></input><br>
                                                <input type="password" style = "display:none" id="PassWordAdd" name="PassWordAdd"  onkeyup="passwordChanged();" class="form-control"  placeholder="Mật khẩu">
                                                <span id="strength" style = "display:none" >Chú ý: Mật khẩu mới phải có độ dài tối thiểu 8 kí tự, bao gồm kí tự hoa, thường, số, và kí tự đặc biệt</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Họ tên</label>
                                                <input type="text" id="Address" name="AddressAdd" class="form-control"   value="<?php echo $UserInfo['FullName'] ;?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Số điện thoại</label>
                                                <input type="text" id="PhoneNumber" name="PhoneNumberAdd" class="form-control"  value="<?php echo $UserInfo['PhoneNumber'] ;?>">
                                            </div>
                                        </div>

                                        <div class="form-group" id="fromchannelid" style="display: block">
                                            <div class="col-sm-12">
                                                <label>Phân quyền</label>
                                                <select class="form-control m-bot15" id="RoleAdd" name="RoleAdd" >

                                                    <?php
                                                    if ( $_SESSION["Role"]==1 && $UserInfo['Role']==1)
													{
														echo "<option value=\"1\">Admin</option>";
													}
                                                    elseif ($_SESSION["Role"]==1 && $UserInfo['Role']==2)
                                                    {
														echo "<option value=\"3\" selected>User</option>
                                                        <option value=\"2\" selected>Leader</option>";
                                                    }
                                                    else{
                                                        echo "<option value=\"3\" selected>User</option>";
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
	 
	  