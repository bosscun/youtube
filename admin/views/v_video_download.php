 <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <section class="panel">
                  <header class="panel-heading">
                      Danh sách người dùng
                  </header>
                  <div class="panel-body">
                      <div class="adv-table editable-table ">
                          <div class="clearfix">
                              <div class="btn-group">
                                  <button data-toggle="modal" href="#myModalAdd" class="btn green">
                                      Thêm mới <i class="icon-plus"></i>
                                  </button>
                              </div>
                          </div>
                          <div class="space15"></div>
                          <table class="table table-striped table-hover table-bordered" id="editable-sample">
                              <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>UserID</th>
                                  <th>ChanelID</th>
                                  <th>VideoID</th>
                                  <th>VideoTitle</th>
                                  <th>VideoDescription</th>
                                  <th>VideoTags</th>
                                  <th>UploadStatus</th>
                                  <th>UploadDate</th>
                                  <th>DonwloadStatus</th>
                                  <th>DownloadDate</th>
                                  <th>IsDelete</th>
                                  <th>Status</th>
                              </tr>
                              </thead>
                          <tbody>
                              <?php
                              foreach($arr_users as $users)
                              {
                              ?>
                              <tr class="">
                                  <td class="UserId"><?php echo $users['ID']; ?></td>
                                  <td class="UserName"><?php echo $users['UserName']; ?></td>
                                  <td class="PassWord" hidden><?php echo $users['PassWord']; ?></td>
                                  <td class="KeyAcess"><?php echo $users['KeyAcess']; ?></td>
                                  <td class="Address"><?php echo $users['Address']; ?></td>
                                  <td class="PhoneNumber"><?php echo $users['PhoneNumber']; ?></td>
                                  <td class="CreateDate"><?php echo $users['CreateDate']; ?></td>
                                  <td class="Role"><?php echo $users['Role']; ?></td>
                                  <td class="IsApprove"><?php echo $users['IsApprove']; ?></td>
                                  <td class="IsBlock"><?php echo $users['IsBlock']; ?></td>
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
					  <h4 class="modal-title">Thêm mới người dùng</h4>
				  </div>
					<form class="form-horizontal tasi-form" method="post" action="../controller/c_user.php?controller=user&action=add_user" enctype="multipart/form-data">
					  <div class="modal-body">
						  <div class="form-group">
							  <div class="col-sm-12">
								  <input type="text" id="UserNameAdd" name="UserNameAdd" class="form-control"  placeholder="Nhập tên đăng nhập...">
							  </div>
							</div>
						  <div class="form-group">
							  <div class="col-sm-12">
								  <input type="password" id="PassWordAdd" name="PassWordAdd" class="form-control"  placeholder="Nhập mật khẩu..">
							  </div>
							</div>
						  <div class="form-group">
							  <div class="col-sm-12">
								  <input type="text" id="Address" name="AddressAdd" class="form-control"  placeholder="Nhập địa chỉ liên hệ...">
							  </div>
							</div>
						  <div class="form-group">
							  <div class="col-sm-12">
								  <input type="text" id="PhoneNumber" name="PhoneNumberAdd" class="form-control"  placeholder="Nhập số điện thoại..">
							  </div>
							</div>
						  <div class="form-group">
							  <div class="col-sm-12">
								  <input type="text" id="Role" name="RoleAdd" class="form-control"  placeholder="Phân quyền...">
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
	  
	  <!-- Modal Edit-->
	  <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			  <div class="modal-content">
				  <div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					  <h4 class="modal-title">Chỉnh sửa thông tin người dùng</h4>
				  </div>
				<form class="form-horizontal tasi-form" method="post" id="editForm" action="" enctype="multipart/form-data">
					  <div class="modal-body" id="editUser">
						  <div class="form-group">
							  <div class="col-sm-12">
								  <input type="text" id="UserNameEdit" name="UserNameEdit" class="form-control"  placeholder="Nháº­p tÃªn Ä‘Äƒng nháº­p...">
							  </div>
							</div>
						  <div class="form-group">
							  <div class="col-sm-12">
								  <input type="password" id="PassWordEdit" name="PassWordEdit" class="form-control"  placeholder="Nháº­p máº­t kháº©u...">
							  </div>
							</div>
						  <div class="form-group">
							  <div class="col-sm-12">
								  <label for="Image">Nhập ảnh đại diện</label>
								  <input type="file" id="AvatarEdit" name="AvatarEdit"  accept="image/x-png, image/gif, image/jpeg">
								  <input type="hidden" id="AvatarUserEdit" name="AvatarUserEdit" value="">
							  </div>
						  </div>
						  <div class="form-group">
							  <div class="col-sm-12">
								  <input type="text" id="FullNameEdit" name="FullNameEdit" class="form-control"  placeholder="Nháº­p tÃªn hiá»ƒn thá»‹...">
							  </div>
							</div>
						  <div class="form-group">
							  <div class="col-sm-12">
								  <input type="text" id="EmailEdit" name="EmailEdit" class="form-control"  placeholder="Nháº­p Ä‘á»‹a chá»‰ email...">
							  </div>
							</div>
						  <div class="form-group">
							  <div class="col-sm-12">
								  <input type="text" id="BirthdayEdit" name="BirthdayEdit" class="form-control"  placeholder="Nháº­p ngÃ y sinh(ngÃ y/thÃ¡ng/nÄƒm)...">
							  </div>
							</div>
						  <div class="form-group">
							  <div class="col-sm-12">
								  <input type="text" id="FacebookEdit" name="FacebookEdit" class="form-control"  placeholder="Nháº­p Ä‘á»‹a chá»‰ facebook...">
							  </div>
							</div>
						  <div class="form-group">
							  <div class="col-sm-12">
								  <input type="text" id="SkypeEdit" name="SkypeEdit" class="form-control"  placeholder="Nháº­p tÃªn Skype...">
							  </div>
							</div>
						  <div class="form-group">
							  <div class="col-sm-12">
								  <input type="text" id="PhoneEdit" name="PhoneEdit" class="form-control"  placeholder="Nháº­p sá»‘ Ä‘iá»‡n thoáº¡i...">
							  </div>
							</div>
						  
						</div>
				  <div class="modal-footer">
					  <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
					  <button class="btn btn-success" id="update" name="update" type="submit">Lưu</button>
				  </div>
				 </form>
				  </div>
			  </div>
		  </div>
	  <!-- modal -->