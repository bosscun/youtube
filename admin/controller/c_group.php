<?php
	session_start();
	if(!isset($_SESSION['UserId'])){
		header("Location: ../login.php");
	}
?>
<?php
	class c_group
	{
		public $m_group;
		public function __construct()
		{
			$main_menu = "admin";
			$sub_menu = "group";
			if(file_exists('../model/m_group.php'))
			{
				include '../model/m_group.php';
			}

			$this->m_group = new m_group();
			$arr_group= $this->m_group->GetAllGroup();
			$ID = 0;
			if(isset($_GET["ID"]))
			{
				$ID = $_GET["ID"];
			}
            $groupSelected ="";
			$now = getdate();
			$action = "";
			if(isset($_GET["action"]))
			{
				$action = $_GET["action"];
				switch($action)
				{
/*-----------------------    add    -------------------*/
					case "add_group":
						$GroupName = isset($_POST["GroupNameAdd"]) ? trim($_POST["GroupNameAdd"]):'';
                        $CreateDate = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"];
						// insert group
                        $UserIdCreate=1;
                        $Status=1;
                    	$this->m_group->InsertGroup(addslashes($GroupName),$UserIdCreate,$CreateDate,$Status);
                     //   $GroupName,$UserIdCreate, $CreateDate, $Status
						header("location: ../controller/c_group.php?controller=group");
						break;
/*-----------------------    and add    -------------------*/
                    /*-----------------------    edit    -------------------*/
                    case "group_edit_view":
                        $title = "Chỉnh sửa nhóm";
                        $titleAction  = "Chỉnh sửa nhóm";
                       // var_dump($ID);
                        $groupSelected = $this->m_group->SelectGroup($ID);
                        if(file_exists('../views/_layers/l_head.php'))
                        {
                            require_once("../views/_layers/l_head.php");
                        }
                        if(file_exists('../views/_layers/l_header_menu.php'))
                        {
                            require_once("../views/_layers/l_header_menu.php");
                        }
                        if(file_exists('../views/_layers/l_left_menu.php'))
                        {
                            require_once("../views/_layers/l_left_menu.php");
                        }
                        if(file_exists('../views/v_group_edit.php'))
                        {
                            include '../views/v_group_edit.php';
                        }
                        if(file_exists('../views/_layers/l_footer.php'))
                        {
                            require_once("../views/_layers/l_footer.php");
                        }

                        if(file_exists('../views/_layers/l_script.php'))
                        {
                            require_once("../views/_layers/l_script.php");
                        }
//                        if(file_exists('../script/channel_js.php'))
//                        {
//                            require_once("../script/channel_js.php");
//                        }

					case "edit_group":

                        $GroupName = isset($_POST["GroupNameEdit"]) ? trim($_POST["GroupNameEdit"]) : '';
                      //  $Status = isset($_POST["StatusEdit"]) ? trim($_POST["StatusEdit"]) : '';

                        $IDGroup=isset($_POST["IDGroup"]) ? trim($_POST["IDGroup"]):'';
                        $Status=1;
						$this->m_group->EditGroup($IDGroup, addslashes($GroupName), $Status);
                        header("location: ../controller/c_group.php?controller=group");
						break;
/*-----------------------    end edit    -------------------*/
					case "DeleteGroup":

						$this->m_group->DeleteGroup($ID);
						header("location: ../controller/c_group.php?controller=group");
						break;
/*-----------------------    change active    -------------------*/
					case "change_active":
						$Status = $_GET["status"];
						$this->m_group->ChangeActive($ID, $Status );
						header("location: ../controller/c_group.php?controller=group");
						break;
				}
			}
			else
			{
				$title = "Danh sách nhóm";
				if(file_exists('../views/_layers/l_head.php'))
				{
					require_once("../views/_layers/l_head.php");
				}
				if(file_exists('../views/_layers/l_header_menu.php'))
				{
					require_once("../views/_layers/l_header_menu.php");
				}
				if(file_exists('../views/_layers/l_left_menu.php'))
				{
					require_once("../views/_layers/l_left_menu.php");
				}
				if(file_exists('../views/v_group.php'))
				{
					include '../views/v_group.php';
				}
				if(file_exists('../views/_layers/l_footer.php'))
				{
					require_once("../views/_layers/l_footer.php");
				}

				if(file_exists('../views/_layers/l_script.php'))
				{
					require_once("../views/_layers/l_script.php");
				}
//				if(file_exists('../script/user_js.php'))
//				{
//					require_once("../script/user_js.php");
//				}
			}
		}
	}
	$c_group = new c_group();
?>