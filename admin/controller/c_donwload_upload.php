<?php
	session_start();
	if(!isset($_SESSION['UserId'])){
		header("Location: ../login.php");
	}
?>
<?php
	class c_donwload_upload
	{
		public $m_donwload_upload;
		public function __construct()
		{

			$main_menu = "donwload_upload";

			
			if(file_exists('../model/m_donwload_upload.php'))
			{
				include '../model/m_donwload_upload.php';
			}

			$this->m_donwload_upload = new m_donwload_upload();


			$ID= 0;
			if(isset($_GET["ID"]))
			{
				$ID = $_GET["ID"];
			}

			$now = getdate();

			if(isset($_GET["action"]))
			{
				$action = $_GET["action"];
				switch($action)
				{
/*-----------------------    change active    -------------------*/	
					case "change_active":
						$Status = $_GET["status"];
						$this->m_donwload_upload->ChangeActive($ID, $Status );
						var_dump($ID);
						header("location: ../controller/c_donwload_upload.php?controller=donwload_upload");
						break;

					case "update_status":
						$this->m_donwload_upload->UpdateStatus($ID);
                        header("location: ../controller/c_donwload_upload.php?controller=donwload_upload");
						break;

					case "search_video":

                        $arr_channelSearch = $this->m_donwload_upload->GetChannelSearch($_SESSION["UserId"]);
                        $arr_user= $this->m_donwload_upload->GetUserSearch($_SESSION["UserId"]);
                        $ChannelIDSearch= isset($_POST["ChannelIDSearch"]) ? trim($_POST["ChannelIDSearch"]) : '';
                        $UserIDSearch= isset($_POST["UserIDSearch"]) ? trim($_POST["UserIDSearch"]) : '';
                        $SearchType =isset($_POST["searchMode"]) ? trim($_POST["searchMode"]) : '';


                        if ($SearchType=="1") {
                            if ($ChannelIDSearch != "") {
                                if ($ChannelIDSearch != "all") {
                                    $arr_donwload_upload = $this->m_donwload_upload->GetVideoSearchByChannel($_SESSION["UserId"], $ChannelIDSearch);
                                } else {
                                    $arr_donwload_upload = $this->m_donwload_upload->GetAllDownloadUploadVideo($_SESSION["UserId"]);
                                }
                            }
                        }
                        else {
                            if ($UserIDSearch != "") {
                                if ($UserIDSearch != "all") {
                                    $arr_donwload_upload = $this->m_donwload_upload->GetVideoSearchByUserID($UserIDSearch);
                                } else {
                                    $arr_donwload_upload = $this->m_donwload_upload->GetAllDownloadUploadVideo($_SESSION["UserId"]);//
                                }
                            }

                        }



                        $title = "Danh sách vides download - upload";
                        $sub_menu = "download_upload";
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

                        if(file_exists('../views/v_donwload_upload.php'))
                        {

                            $titleAction = "Danh sách download- upload videos";
                            include '../views/v_donwload_upload.php';
                        }
                        if(file_exists('../views/_layers/l_footer.php'))
                        {
                            require_once("../views/_layers/l_footer.php");
                        }

                        if(file_exists('../views/_layers/l_script.php'))
                        {
                            require_once("../views/_layers/l_script.php");
                        }

                        if(file_exists('../script/download_upload_js.php'))
                        {
                            require_once("../script/download_upload_js.php");
                        }
					break;
				}

			}
			else
			{

                $arr_channelSearch = $this->m_donwload_upload->GetChannelSearch($_SESSION["UserId"]);
                $arr_user= $this->m_donwload_upload->GetUserSearch($_SESSION["UserId"]);
                $arr_donwload_upload = $this->m_donwload_upload->GetVideoSearchByChannel($_SESSION['UserId'],$arr_channelSearch[0]['ChannelID']);

				$title = "Danh sách vides download - upload";
				$sub_menu = "download_upload";
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

				if(file_exists('../views/v_donwload_upload.php'))
				{

					$titleAction = "Danh sách download- upload videos";
					include '../views/v_donwload_upload.php';
				}					
				if(file_exists('../views/_layers/l_footer.php'))
				{
					require_once("../views/_layers/l_footer.php");
				}

				if(file_exists('../views/_layers/l_script.php'))
				{
					require_once("../views/_layers/l_script.php");
				}

                if(file_exists('../script/download_upload_js.php'))
                {
                    require_once("../script/download_upload_js.php");
                }
			}

		}
	}
	$c_donwload_upload= new c_donwload_upload();
?>