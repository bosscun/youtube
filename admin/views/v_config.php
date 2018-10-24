 <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <section class="panel">
                  <header class="panel-heading">
                      Danh sách cấu hình <br>
                  </header>
                  <div class="panel-body">
                      <div class="adv-table editable-table ">
                          <div class="clearfix">
                              <a class="btn btn-success btn-xs" href="#" style="margin: 10px"><i class="icon-ok"></i></a>Cấu hình đang chạy <a class="btn btn-xs btn-danger" href="#" style="margin: 10px"><i class="icon-off"></i></a>Cấu hình đã dừng <a class="btn btn-xs btn-danger" href="#" style="margin: 10px"><i class="icon-trash"></i></a>Xóa cấu hình
                              <a class="btn btn-xs btn-warning" style="center" ><i class="icon-remove"></i></a> Cấu hình bị trùng
                              <div class="space10"></div>
                              <div class="btn-group">
                                  <a data-toggle="modal"  class="btn btn-success" href="<?php echo BASE_PATH;?>admin/controller/c_config.php?controller=config&action=add_config_view" class="btn green">
                                      Thêm mới <i class="icon-plus"></i>
                                  </a>
                              </div>
                              <br><br><br>
                              <form class="form-group" action="<?php echo BASE_PATH;?>admin/controller/c_config.php?controller=config&action=search_config" method="post" >
                                  <label> Tìm kiếm theo : </label>

                                  <input type="radio" name="searchMode"  id="SearchByChannel" onclick="ChooseSearchConfig();"  class="ck-filter-chil2" value="1">Tên kênh &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                  <input type="radio" name="searchMode" id="SearchByName"  onclick="ChooseSearchConfig();" checked class="ck-filter-chil2" value="2">Người dùng
                                  <div>
                                      <div>
                                          <select id="SearchByChannelID" name="ChannelIDSearch" style="display: none;width: 200px; height: 25px" >
                                              <?php foreach ($arr_channelSearch as $channel){?>
                                                  <option value="<?php echo $channel['ChannelID'];?>" <?php echo isset($ChannelID) ? ($ChannelID == $channel['ChannelID'] ? 'selected': ''): '';?>> <?php echo $channel['ChannelName'];?> </option>
                                              <?php }?>
                                              <option value="all">All</option>
                                          </select>
                                      </div >
                                      <select id="SearchByUserID" name="UserIDSearch" style="width: 150px; height: 25px" >
                                          <?php foreach ($arr_user as $user) {?>
                                              <option value="<?php echo $user['ID'];?>"><?php echo $user['UserName']?></option>
                                          <?php }?>
                                          <option value="all">All</option>
                                      </select>

                                      <select id="SearchByChannelID" name="StatusValue" hidden>
                                          <option value="">All</option>
                                          <option value="Download">Đang chờ</option>
                                          <option value="Upload">Đang thực hiện</option>
                                          <option value="Upload">Đã hoàn thành</option>
                                      </select>
                                  </div><br>
                                  <button type="submit" class="btn btn-send">Tìm kiếm <i class=" icon-search"></i></button>
                              </form>
                          <div class="space10"></div>
                          <table class="table table-striped table-hover table-bordered" id="editable-sample">
                              <thead>
                              <tr>
                                  <th hidden>ID</th>
                                  <th style="text-align:center">STT</th>
                                  <th style="text-align:center">Người tạo</th>
                                  <th style="text-align:center">Kênh tải lên</th>
                                  <th style="text-align:center">Kênh nguồn</th>
                                  <th style="text-align:center">Ngày tạo</th>
                                  <th style="text-align:center">Tổng video Upload</th>
                                  <th style="text-align:center">Trạng thái</th>
                                  <th style="text-align:center">Hành động</th>
                              </tr>
                              </thead>
                              <tbody>
							  <?php 
								foreach($arr_config as $index => $config)
								{
							  ?>
                              <tr class="" >
								  <td  class="ConfigID" hidden><?php echo $config['ID']; ?></td>
                                  <td  class="col-md-1" style="text-align:center"> <?php echo $index +1; ?></td>
                                  <td  class="col-md-1">
                                      <?php
                                        echo  $config['UserName'];
                                      ?>
                                  </td>
                                  <td class="col-md-2"><?php echo $config['ChannelName']; ?>
                                      <a class="copyText" data-clipboard-text="https://www.youtube.com/channel/<?php echo $config['ChannelID'];?>"><i class="icon-copy"></i> </a> <br>
                                      <a href="<?php echo BASE_PATH;?>admin/controller/c_config.php?controller=c_config&action=view_config&ID=<?php echo $config['ID'];?>">Xem cấu hình <i class="icon-plus-sign-alt"></i> </a>
                                  </td>
                                  <td class="col-md-3" style="word-wrap: break-word">
                                      <?php
                                      $source = json_decode($config["FromSourceVideo"], true);
                                      $sourceValue=  str_replace("https://www.youtube.com/", " ", $source['Value']);
                                          echo substr_replace($sourceValue, ' ', 50 , 0);
                                      ?>
                                      <a class="copyText" data-clipboard-text="<?php echo $source['Value'];?>"><i class="icon-copy"></i> </a>
                                  </td>
                                  <td class="col-md-1" style="word-wrap: break-word"><?php echo $config['CreateDate']; ?></td>
                                  <td>
                                        <?php echo $config['NumberVideos']."/".$config['TotalVideos']?><br>
                                       <?php
                                       if ($config['IsGetAllVideos'] =="1")
                                           echo "Hoàn thành";
                                       else echo "Đang chạy";
                                       ?>
                                  </td>
                                  <td class="col-md-1" style="text-align:center">
								  <?php 
									if($config['Status'] == 1)
									{
								  ?>
								  <a class="btn btn-success btn-xs" href="<?php echo BASE_PATH;?>admin/controller/c_config.php?controller=c_config&action=change_active&ID=<?php echo $config['ID'];?>&status=<?php echo $config['Status'];?>"><i class="icon-ok"></i></a>
								  <?php
								  }
								  else
								  {
								  ?>
								  <a class="btn btn-xs btn-danger" href="<?php echo BASE_PATH;?>admin/controller/c_config.php?controller=c_config&action=change_active&ID=<?php echo $config['ID'];?>&status=<?php echo $config['Status'];?>"><i class="icon-off"></i></a>
								  <?php
                                  }
								  ?>
                                  <?php
                                  $duplicateFound=0;
                                  $source_ogri = json_decode($config["FromSourceVideo"], true);
                                  foreach ($duplicate_arr_config as $duplicateconfig)
                                  {
                                      $source_compare = json_decode($duplicateconfig["FromSourceVideo"], true);
                                      if ($source_ogri['Value'] == $source_compare['Value'] && $config['ChannelID']==$duplicateconfig['ChannelID'] && $duplicateconfig['ID']!= $config['ID']  )
                                      {
                                          $duplicateFound=1;
                                          break;
                                      }
                                  }?>
                                  <?php
                                  if ($duplicateFound==1)
                                  {?>
                                  <a class="btn btn-xs btn-warning" style="text-align: center" ><i class="icon-remove"></i></a>
                                  <?php }?>
								  </td>
                                  <td style="text-align:center" class="center" class="col-md-2">
                                      <div class="hidden-phone" style="text-align:center">
                                        <a class="btn btn-success btn-xs"  href="<?php echo BASE_PATH;?>admin/controller/c_config.php?controller=c_config&action=edit_config_view&ID=<?php echo $config['ID'];?>"><i class="icon-pencil "></i> </a>
                                        <a class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc muốn xóa?\n Tất cả các thông tin liên quan đến cấu hình này sẽ bị xóa\n')"  href="<?php echo BASE_PATH;?>admin/controller/c_config.php?controller=config&action=delete&ID=<?php echo $config['ID'];?>"><i class="icon-trash "></i></a>
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
