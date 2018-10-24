
  <body>
  <section id="container" >
      <!--header start-->
      <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
            </div>
            <!--logo start-->
            <a href="<?php echo BASE_PATH;?>" class="logo">Youtube Management Systems (YTMS) </a>
            <!--logo end-->
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
<!--                            <img alt="" src="--><?php //echo BASE_PATH;?><!--images/user/--><?php //echo (isset($_SESSION["Avatar"]) ? trim($_SESSION["Avatar"]) : 'avatar-mini.jpg');?><!--" height="25" width="25">-->
                            <span class="username"><?php echo (isset($_SESSION["UserName"]) ? trim($_SESSION["UserName"]) : 'Admin');?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="#"><i class=" icon-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="icon-cog"></i> Settings</a></li>
                            <li><a href="#"><i class="icon-bell-alt"></i> Notification</a></li>
                            <li><a href="<?php echo BASE_PATH?>admin/controller/c_login.php?controller=login&action=logout"><i class="icon-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->