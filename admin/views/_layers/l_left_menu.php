   <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  
                   <?php if  ($_SESSION["Role"]== "1" ||$_SESSION["Role"]== "2")  { ?>
                      <li class="sub-menu" >
                          <a href="javascript:;" class="<?php if($main_menu=="admin"){echo "active";}?>">
                              <i class="icon-laptop"></i>
                              <span>Quản lý</span>
                          </a>
                          <ul class="sub">
                              <li class="<?php if($sub_menu=="user"){echo "active";}?>"><a  href="<?php echo BASE_PATH;?>admin/controller/c_user.php?controller=user">Quản lí người dùng</a></li>
<!--                              <li class="--><?php //if($sub_menu=="group"){echo "active";}?><!--"><a  href="--><?php //echo BASE_PATH;?><!--admin/controller/c_group.php?controller=group">Quản lí nhóm</a></li>-->
                          </ul>
                      </li>
                  <?php }?>

<!--                  --><?php //if  ($_SESSION["Role"]== "1" || $_SESSION["Role"]== "2")  { ?>
                      <li class="sub-menu">
                          <a  href="<?php echo BASE_PATH;?>admin/controller/c_channel.php?controller=channel" class="<?php if($main_menu=="channel"){echo "active";}?>">
                              <i class="icon-bullhorn"></i>
                              <span>Quản lý kênh </span>
                          </a>
                      </li>
<!--                  --><?php //}?>
                  <li class="sub-menu">
                      <a  href="<?php echo BASE_PATH;?>admin/controller/c_config.php?controller=config" class="<?php if($main_menu=="config"){echo "active";}?>">
                          <i class="icon-cogs"></i>
                          <span>Cấu hình kênh upload </span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a  href="<?php echo BASE_PATH;?>admin/controller/c_donwload_upload.php?controller=video_download" class="<?php if($main_menu=="donwload_upload"){echo "active";}?>">
                          <i class="icon-download-alt"></i>
                          <span>Tiến trình </span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a  href="<?php echo BASE_PATH;?>admin/controller/c_channel_analytics.php?controller=c_analystic" class="<?php if($main_menu=="donwload_upload"){echo "active";}?>">
                          <i class="icon-bar-chart"></i>
                          <span>Thống kê </span>
                      </a>
                  </li>
                  <?php if  ($_SESSION["Role"]== "1")  { ?>
                      <li class="sub-menu">
                          <a  href="<?php echo BASE_PATH;?>admin/controller/c_upload_file.php?controller=channel" class="<?php if($main_menu=="upload_file"){echo "active";}?>">
                              <i class="icon-upload"></i>
                              <span>Upload key </span>
                          </a>
                      </li>
                  <?php }?>
<!--                  <li class="sub-menu">-->
<!--                      <a  href="--><?php //echo BASE_PATH;?><!--admin/controller/c_video_manager.php?controller=video_manager" class="--><?php //if($main_menu=="video_manager"){echo "active";}?><!--">-->
<!--                          <i class="icon-youtube-play"></i>-->
<!--                          <span>Trình quản lí videos</span>-->
<!--                      </a>-->
<!--                  </li>-->
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
