<?php
	session_start();
	if(!isset($_SESSION['UserId'])){
		header("Location: ../login.php");
	}
?>
<?php

	class c_upload_file
	{
		public $m_upload_file;

		public function __construct()
		{
			$main_menu = "upload_file";
			if(file_exists('../model/m_upload_file.php'))
			{
				include '../model/m_upload_file.php';
			}
			$this-> m_upload_file= new m_upload_file();
			$arr_file = $this->m_upload_file->GetAllFile();
			$ID = 0;
			if(isset($_GET["ID"]))
			{
				$ID = $_GET["ID"];
			}
			$action = "";

            $destination_path = "../YoutubeApi/ClientSecretFile/";
			if(isset($_GET["action"]))
			{
				$action = $_GET["action"];
				switch($action)
				{
                    case "view_file":
                        $title = "Quản lý upload file";
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
                        if(file_exists('../views/v_upload_file_add.php'))
                        {
                            include '../views/v_upload_file_add.php';
                        }
                        if(file_exists('../views/_layers/l_footer.php'))
                        {
                            require_once("../views/_layers/l_footer.php");
                        }

                        if(file_exists('../views/_layers/l_script.php'))
                        {
                            require_once("../views/_layers/l_script.php");
                        }
                        break;
/*-----------------------    add    -------------------*/
					case "add_file":
                        //$FileName = isset($_POST["FileNameAdd"]) ? trim($_POST["FileNameAdd"]) : '';

                        $Status = 1;
                        $FileAdd = "";
                        $FileName ="";

                        if($_FILES['FileAdd']['name'] != NULL){ // Đã chọn file
                                // Tiến hành code upload
                            if($_FILES['FileAdd']['size'] > 50000000){
                                echo "File không được lớn hơn 1mb";
                            }else {
								$SubFolderName = md5(uniqid());
                                // file hợp lệ, tiến hành upload
                                $FileName = $destination_path.$SubFolderName."/".$_FILES["FileAdd"]["name"];
                                $SubFolder = $destination_path.'/'.$SubFolderName;
								mkdir($SubFolder,777);
                                $target_path = $SubFolder."/".$_FILES["FileAdd"]["name"];
                                move_uploaded_file($_FILES['FileAdd']['tmp_name'], $target_path);
                              	$FileUrl=BASE_PATH."admin/YoutubeApi/ClientSecretFile/".$SubFolderName."/".$_FILES["FileAdd"]["name"];

                            }
                        }else{
                            echo "Vui lòng chọn file";
                        }
                        $this->m_upload_file-> InsertFile($FileName, $FileUrl, 0, $Status);
                        header("location: ../controller/c_upload_file.php?controller=upload_file");

                        break;
/*-----------------------    delete    -------------------*/		
					case "delete":
                        $file =$this->m_upload_file->GetFile($ID);

                        $subfolder=( basename(dirname($file['FileUrl'])));

						if (file_exists($destination_path.$subfolder."/".$file['FileName']))
						{
							unlink($destination_path.$subfolder."/".$file['FileName']);
                            rmdir($destination_path.$subfolder);
						}
						$this->m_upload_file->DeleteFile($ID);
						header("location: ../controller/c_upload_file.php?controller=upload_file");
						break;
/*-----------------------    and delete    -------------------*/
/*-----------------------    change active    -------------------*/	
					case "change_active":
						$Status = $_GET["status"];
						$this->m_upload_file->ChangeActive($ID, $Status );
						header("location: ../controller/c_upload_file.php?controller=upload_file");
						break;	
				}
			}
			else
			{
				$title = "Quản lý upload file";
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
				if(file_exists('../views/v_upload_file.php'))
				{
					include '../views/v_upload_file.php';
				}					
				if(file_exists('../views/_layers/l_footer.php'))
				{
					require_once("../views/_layers/l_footer.php");
				}

				if(file_exists('../views/_layers/l_script.php'))
				{
					require_once("../views/_layers/l_script.php");
				}

			}

		}
	}
$c_upload_file = new c_upload_file();
?>