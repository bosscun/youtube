 <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <section class="panel">
                  <header class="panel-heading">
                      Danh sách nhóm
                  </header>
                  <a class="btn btn-success btn-xs" href="#" style="margin: 10px"><i class="icon-ok"></i></a>Nhóm đang hoạt động <a class="btn btn-xs btn-danger" href="#" style="margin: 10px"><i class="icon-off"></i></a>Nhóm đã dừng   <a class="btn btn-primary btn-xs selectCountry" href="#" style="margin: 10px"><i class="icon-pencil"></i></a>Sửa nhóm <a class="btn btn-xs btn-danger" href="#" style="margin: 10px"><i class="icon-trash"></i></a>Xóa nhóm
                  <div class="panel-body">
                      <div class="adv-table editable-table ">
                          <div class="clearfix">
                              <div class="btn-group">
                                  <button data-toggle="modal" href="#myModalAdd" class="btn btn-success">
                                      Thêm mới <i class="icon-plus"></i>
                                  </button>
                              </div>
                          </div>
                          <div class="space15"></div>
                          <table class="table table-striped table-hover table-bordered" id="editable-sample">
                              <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Tên nhóm </th>
                                  <th hidden>UserIdCreate</th>
                                  <th>Ngày tạo</th>
                                  <th>Trạng thái</th>
                                  <th>Hành động</th>
                              </tr>
                              </thead>
                          <tbody>
                              <?php
                              foreach($arr_group as $users)
                                 // var_dump($users['ID']);
                              {
                              ?>
                              <tr class="">
                                  <td class="UserId"><?php echo $users['ID']; ?></td>
                                  <td class="GroupName"><?php echo $users['GroupName']; ?></td>
                                  <td class="UserIdCreate" hidden><?php echo $users['UserIdCreate']; ?></td>
                                  <td class="CreateDate"><?php echo $users['CreateDate']; ?></td>
                                  <td>
                                      <?php
                                      if($users['Status'] == 1)
                                      {
                                          ?>
                                          <a class="btn btn-success btn-xs" href="<?php echo BASE_PATH;?>admin/controller/c_group.php?controller=group&action=change_active&ID=<?php echo $users['ID'];?>&status=<?php echo $users['Status'];?>"><i class="icon-ok"></i></a>
                                          <?php
                                      }
                                      else
                                      {
                                          ?>
                                          <a class="btn btn-xs btn-danger" href="<?php echo BASE_PATH;?>admin/controller/c_group.php?controller=group&action=change_active&ID=<?php echo $users['ID'];?>&status=<?php echo $users['Status'];?>"><i class="icon-off"></i></a>
                                          <?php
                                      }
                                      ?>
                                  </td>
                                  <td class="center">
                                      <div class="hidden-phone">
                                          <a data-toggle="modal" href="<?php echo BASE_PATH;?>admin/controller/c_group.php?controller=group&action=group_edit_view&ID=<?php echo $users['ID'];?>" class="btn btn-primary btn-xs selectCountry" ><i class="icon-pencil"></i></a>
                                          <a class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc muốn xóa?\n Các danh mục con của nó cũng sẽ bị xóa!')"  href="<?php echo BASE_PATH;?>admin/controller/c_group.php?controller=group&action=DeleteGroup&ID=<?php echo $users['ID'];?>"><i class="icon-trash "></i></a>
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
	  
	  <!-- Modal Add-->
	  <div class="modal fade" id="myModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			  <div class="modal-content">
				  <div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					  <h4 class="modal-title" >Thêm mới group</h4>
				  </div>
					<form class="form-horizontal tasi-form" method="post" action="../controller/c_group.php?controller=group&action=add_group&ID" enctype="multipart/form-data">
					  <div class="modal-body">
						  <div class="form-group">
							  <div class="col-sm-12">
								  <input type="text" id="GroupNameAdd" name="GroupNameAdd" class="form-control"  placeholder="Nhập tên group...">
							  </div>
							</div>
					  </div>
					  <div class="modal-footer">
						  <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
						  <button class="btn btn-success" id="add" name="add" type="submit">Lưu</button>
					  </div>
				 </form>
			  </div>
		  </div>
	  </div>
	  <!-- modal -->

