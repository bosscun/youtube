 <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <section class="panel">
                  <header class="panel-heading">
                      Danh sách người dùng
                  </header>
                  <a class="btn btn-success btn-xs" href="#" style="margin: 10px"><i class="icon-ok"></i></a>Người dùng đang hoạt động <a class="btn btn-xs btn-danger" href="#" style="margin: 10px"><i class="icon-off"></i></a>Người dùng đã dừng  <a class="btn btn-primary btn-xs selectCountry" href="#" style="margin: 10px"><i class="icon-pencil"></i></a>Sửa thông người dùng  <a class="btn btn-xs btn-danger" href="#" style="margin: 10px"><i class="icon-trash"></i></a>Xóa người dùng
                  <a class="btn btn-group btn-xs" href="#" style="margin: 10px"><i class="icon-group""></i></a>Gán người quản lí
                  <a class="btn btn-send btn-xs" href="#" style="margin: 10px"> <i class="icon-keyboard"></i></a> Gán địa chỉ Ip Vps
                  <div class="panel-body">
                      <div class="adv-table editable-table ">
                          <div class="clearfix">
                              <div class="btn-group">
                                  <a href="<?php echo BASE_PATH;?>admin/controller/c_user.php?controller=user&action=add_view_user" class="btn btn-success">
                                      Thêm mới người dùng<i class="icon-plus"></i>
                                  </a>
                              </div>
                          </div>
                          <div class="space15"></div>
                          <table class="table table-striped table-hover table-bordered" id="editable-sample">
                              <thead>
                              <tr>
                                  <th hidden>ID</th>
                                  <th>STT</th>
                                  <th>UserName</th>
                                  <th hidden>PassWord</th>
                                  <th hidden>KeyAcess</th>
                                  <th>Họ tên</th>
                                  <th>Số điện thoại</th>
                                  <th>Người quản lí</th>
                                  <th>Quyền</th>
                                  <th>VPS</th>
                                  <th>Ngày tạo</th>
                                  <th>Đã duyệt</th>
                                  <th>Trạng thái</th>
                                  <th>Hành động</th>
                              </tr>
                              </thead>
                          <tbody>
                              <?php
                              foreach($arr_users as $index=> $users)
                              {
                              ?>
                              <tr class="">
                                  <td hidden class="UserId"><?php echo $users['ID']; ?></td>
                                  <td><?php echo $index + 1; ?></td>
                                  <td class="UserName"><?php echo $users['UserName']; ?></td>
                                  <td class="PassWord" hidden><?php echo $users['PassWord']; ?></td>
                                  <td class="KeyAcess" hidden><?php echo $users['KeyAcess']; ?></td>
                                  <td class="FullName"><?php echo $users['FullName']; ?></td>
                                  <td class="PhoneNumber"><?php echo $users['PhoneNumber']; ?></td>
                                  <td class="CreateUser"><?php
                                      echo $users['CreateUser'];
                                      ?></td>
                                  <td class="Role">
                                      <?php
                                        if( $users['Role'] =="1")
                                            echo "Admin";
                                        elseif ($users['Role'] =="2")
                                            echo "Leader";
                                        else
                                            echo  "User";
                                      ?>
                                  </td>
                                  <td class="CreateDate"><?php echo $users['VPSIP']; ?></td>
                                  <td class="CreateDate"><?php echo $users['CreateDate']; ?></td>
                                  <td class="IsApprove" >
                                      <?php
                                      if($users['IsApprove'] == 1)
                                      {
                                          ?>
                                          <a class="btn btn-success btn-xs" href="<?php echo BASE_PATH;?>admin/controller/c_user.php?controller=user&action=change_aprrove&ID=<?php echo $users['ID'];?>&approve=<?php echo $users['IsApprove'];?>"><i class="icon-ok-sign"></i></a>
                                          <?php
                                      }
                                      else
                                      {
                                          ?>
                                          <a class="btn btn-xs btn-danger" href="<?php echo BASE_PATH;?>admin/controller/c_user.php?controller=user&action=change_aprrove&ID=<?php echo $users['ID'];?>&approve=<?php echo $users['IsApprove'];?>"><i class="icon-remove-circle"></i></a>
                                          <?php
                                      }
                                      ?>
                                  </td>
                                  <td>
                                      <?php
                                      if($users['IsBlock'] == 0)
                                      {
                                          ?>
                                          <a class="btn btn-success btn-xs" href="<?php echo BASE_PATH;?>admin/controller/c_user.php?controller=user&action=change_active&ID=<?php echo $users['ID'];?>&status=<?php echo $users['IsBlock'];?>"><i class="icon-ok"></i></a>
                                          <?php
                                      }
                                      else
                                      {
                                          ?>
                                          <a class="btn btn-xs btn-danger" href="<?php echo BASE_PATH;?>admin/controller/c_user.php?controller=user&action=change_active&ID=<?php echo $users['ID'];?>&status=<?php echo $users['IsBlock'];?>"><i class="icon-off"></i></a>
                                          <?php
                                      }
                                      ?>
                                  </td>
                                  <td class="center">
                                      <div class="hidden-phone">
                                          <a data-toggle="" href="<?php echo BASE_PATH;?>admin/controller/c_user.php?controller=user&action=edit_user_view&ID=<?php echo $users['ID'];?>" class="btn btn-primary btn-xs selectCountry"><i class="icon-pencil"></i></a>
                                          <a class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc muốn xóa?\n Các danh mục con của nó cũng sẽ bị xóa!')"  href="<?php echo BASE_PATH;?>admin/controller/c_user.php?controller=user&action=delete&ID=<?php echo $users['ID'];?>"><i class="icon-trash"></i></a>

                                          <?php
                                          if ($_SESSION["Role"]==1) {
                                              ?>
                                              <a class="btn btn-send btn-xs"   href="<?php echo BASE_PATH;?>admin/controller/c_user.php?controller=user&action=assign_vps_view&ID=<?php echo $users['ID'];?>"><i class="icon-keyboard"></i></a>
                                          <?php }?>

                                         <?php if ($_SESSION["Role"]==1 & $users['Role']=="3")
                                         {
                                         ?>
                                          <a class="btn btn-group btn-xs"  href="<?php echo BASE_PATH;?>admin/controller/c_user.php?controller=user&action=assign_group_view&ID=<?php echo $users['ID'];?>">
                                           <i class="icon-group"></i>
                                          </a>
                                          <?php }?>

                                      </div>
                                  </td>
                              </tr>
                                  <?php
                              }
                              ?>
                          </tbody>
                          </table>
                      </div>
                  </div>
              </section>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
	  

