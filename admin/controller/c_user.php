<?php
	session_start();
	if(!isset($_SESSION['UserId'])){
		header("Location: ../login.php");
	}
?>
<?php
	class c_user
	{
		public $m_user;
		public function __construct()
		{
			$main_menu = "admin";
			$sub_menu = "user";
			if(file_exists('../model/m_user.php'))
			{
				include '../model/m_user.php';
			}

			$this->m_user = new m_user();
			$arr_users = $this->m_user->GetAllUser( $_SESSION['UserId']);
			$ID = 0;
			if(isset($_GET["ID"]))
			{
				$ID = $_GET["ID"];
			}

			$now = getdate();
			/* $destination_path = "../../images/user/"; */
			$action = "";
			if(isset($_GET["action"]))
			{
				$action = $_GET["action"];
				switch($action)
				{
/*-----------------------    add    -------------------*/
					case "add_view_user":

						$title = "Thêm mới người dùng";
						$titleAction  = "Thêm mới người dùng";
                        $arr_group = $this->m_user->SelectGroup();
                        $message="addUser";
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
						if(file_exists('../views/_layers/l_script.php'))
                        {
                            require_once("../views/_layers/l_script.php");
                        }
                        if(file_exists('../script/user_js.php'))
                        {
                            require_once("../script/user_js.php");
                        }
                        if(file_exists('../views/v_user_add.php'))
                        {
                            include '../views/v_user_add.php';
                        }
                        if(file_exists('../views/_layers/l_footer.php'))
                        {
                            require_once("../views/_layers/l_footer.php");
                        }
						break;

					case "add_user":
						$UserName = isset($_POST["UserNameAdd"]) ? trim($_POST["UserNameAdd"]) : '';
						$PassWord = isset($_POST["PassWordAdd"]) ? hash('sha256',trim($_POST["PassWordAdd"])) : '';
						// hash('sha256', $password )
						$FullName = isset($_POST["AddressAdd"]) ? trim($_POST["AddressAdd"]) : '';
						$PhoneNumber = isset($_POST["PhoneNumberAdd"]) ? trim($_POST["PhoneNumberAdd"]) : '';
						$Role= isset($_POST["RoleAdd"]) ? trim($_POST["RoleAdd"]) : '';
						$CreateDate = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"];
                        $CreateUserId= $_SESSION['UserId'];

						if($_SESSION['Role']=="1")
						{
                            $IsApprove ="1";
						}
						else
							$IsApprove="0";

                        $IsBlock="0";
                        $checkUser=$this->m_user->CheckUser($UserName);
                        if ($checkUser== null) {
                            $this->m_user->InsertUser($UserName, $PassWord, $FullName, $PhoneNumber, $Role, $CreateUserId, $CreateDate, $IsApprove, $IsBlock);
                            header("location: ../controller/c_user.php?controller=user");
                            $message="success";
                        }
                        else
						{
                            $message="";
                            $title = "Thêm mới người dùng";
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
                            if(file_exists('../views/_layers/l_script.php'))
                            {
                                require_once("../views/_layers/l_script.php");
                            }
                            if(file_exists('../script/user_js.php'))
                            {
                                require_once("../script/user_js.php");
                            }
                            if(file_exists('../views/v_user_add.php'))
                            {
                                include '../views/v_user_add.php';
                            }
                            if(file_exists('../views/_layers/l_footer.php'))
                            {
                                require_once("../views/_layers/l_footer.php");
                            }
						}

						break;
/*-----------------------    and add    -------------------*/

/*-----------------------    edit    -------------------*/
					case "edit_user_view":
						$UserInfo = $this->m_user->SelectUser($ID);
                        $title = "Sửa thông tin người dùng";
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
						if(file_exists('../views/_layers/l_script.php'))
                        {
                            require_once("../views/_layers/l_script.php");
                        }
                        if(file_exists('../script/user_js.php'))
                        {
                            require_once("../script/user_js.php");
                        }
                        if(file_exists('../views/v_user_edit.php'))
                        {
                            include '../views/v_user_edit.php';
                        }
                        if(file_exists('../views/_layers/l_footer.php'))
                        {
                            require_once("../views/_layers/l_footer.php");
                        }
                        break;


					case "edit_user":
                        $UserName = isset($_POST["UserNameAdd"]) ? trim($_POST["UserNameAdd"]) : '';

                        $PassWord = isset($_POST["PassWordAdd"]) ? trim($_POST["PassWordAdd"]) : '';
						if($PassWord !="" )
                            $PassWord=	hash('sha256',$PassWord);
                        $FullName = isset($_POST["AddressAdd"]) ? trim($_POST["AddressAdd"]) : '';
                        $PhoneNumber = isset($_POST["PhoneNumberAdd"]) ? trim($_POST["PhoneNumberAdd"]) : '';
                        $Role= isset($_POST["RoleAdd"]) ? trim($_POST["RoleAdd"]) : '';
                      //$ID,$UserName,$PassWord,$FullName,$PhoneNumber,$Role
                        $this->m_user->EditUser($ID,$UserName,$PassWord,$FullName,$PhoneNumber,$Role);
                        header("location: ../controller/c_user.php?controller=user");
						break;
					case "change_pass":
						break;
/*-----------------------    and edit    -------------------*/
					case "assign_group_view":
						$arr_leader= $this->m_user->GetAllLeader();
						$title="Gán người quản lí";
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
                        if(file_exists('../views/v_assign_group.php'))
                        {
                            include '../views/v_assign_group.php';
                        }
                        if(file_exists('../views/_layers/l_footer.php'))
                        {
                            require_once("../views/_layers/l_footer.php");
                        }

                        if(file_exists('../views/_layers/l_script.php'))
                        {
                            require_once("../views/_layers/l_script.php");
                        }
                        if(file_exists('../script/user_js.php'))
                        {
                            require_once("../script/user_js.php");
                        }
						break;
					case "assign_group":
						$LeaderID= isset($_POST["LeaderID"]) ? trim($_POST["LeaderID"]) : '';
                        $CreateUserID = isset($_POST["AssignToUserID"]) ? trim($_POST["AssignToUserID"]) : '';
                        $this->m_user->ChangeAssignUser($ID,$CreateUserID);
                        header("location: ../controller/c_user.php?controller=user");
						break;
					case "delete":
						$this->m_user->DeleteUser($ID);
						$this->m_user->DeleteChanel($ID);
                        $this->m_user->DeleteChannelConfig($ID);
						//var_dump($ID);
						header("location: ../controller/c_user.php?controller=user");
						break;
/*-----------------------    change active    -------------------*/
					case "change_active":
						$Status = $_GET["status"];
						$this->m_user->ChangeActive($ID, $Status );
						header("location: ../controller/c_user.php?controller=user");
						break;
                    case "change_aprrove":
                    	if($_SESSION['Role']==1) {
                            $IsApprove = $_GET["approve"];
                            $this->m_user->ChangeApprove($ID, $IsApprove);
                        }
						header("location: ../controller/c_user.php?controller=user");
						break;
					case "assign_vps_view":
                        $title = "Danh sách người dùng";
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
                        if(file_exists('../views/v_assign_vps.php'))
                        {
                            include '../views/v_assign_vps.php';
                        }
                        if(file_exists('../views/_layers/l_footer.php'))
                        {
                            require_once("../views/_layers/l_footer.php");
                        }

                        if(file_exists('../views/_layers/l_script.php'))
                        {
                            require_once("../views/_layers/l_script.php");
                        }
                        if(file_exists('../script/user_js.php'))
                        {
                            require_once("../script/user_js.php");
                        }
						break;

					case "assign_vps":
                        $Ip = isset($_POST["AssignVPS"]) ? trim($_POST["AssignVPS"]) : '';
						$this->m_user->AssignVPS($ID,$Ip);
                        header("location: ../controller/c_user.php?controller=user");
						break;
				}
			}
			else
			{

				$title = "Danh sách người dùng";
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
				if(file_exists('../views/v_user.php'))
				{
					include '../views/v_user.php';
				}
				if(file_exists('../views/_layers/l_footer.php'))
				{
					require_once("../views/_layers/l_footer.php");
				}

				if(file_exists('../views/_layers/l_script.php'))
				{
					require_once("../views/_layers/l_script.php");
				}
				if(file_exists('../script/user_js.php'))
				{
					require_once("../script/user_js.php");
				}
			}
		}
	}
	$c_user = new c_user();
?>