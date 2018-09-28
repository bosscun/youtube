<?php
	session_start();
	if(!isset($_SESSION['UserId'])){
		header("Location: ../login.php");
	}
?>
<?php

	class c_channel
	{
		public $m_channel;
		public function __construct()
		{
			$main_menu = "channel";
			if(file_exists('../model/m_channel.php'))
			{
				include '../model/m_channel.php';
			}
			$this->m_channel = new m_channel();
            $destination_path = "../api_json";
            $jsonPath="../YoutubeApi/ClientSecretFile/";
            $UploadDate=0;
            $CountFileConfig = $this->m_channel->GetFileConfig();
			$Id = 0;
			if(isset($_GET["Id"]))
			{
				$Id = $_GET["Id"];
			}
			$action = "";
			if(isset($_GET["action"]))
			{
				$action = $_GET["action"];
				switch($action)
				{
/*-----------------------    add    -------------------*/
					case "channel_add_view":
						$jsonFile = $this->m_channel->GetFileConfig();
						if(isset($jsonFile) && file_exists($jsonFile['FileName'])){
							require_once '../YoutubeApi/vendor/autoload.php';
							$client = new Google_Client();
							$client->setAuthConfigFile($jsonFile['FileName']);
							$client->setRedirectUri(REDIRECT_URI);
							$client->addScope('https://www.googleapis.com/auth/youtube.force-ssl https://www.googleapis.com/auth/youtube https://www.googleapis.com/auth/yt-analytics-monetary.readonly');
							$client->setAccessType("offline");
							$client->setIncludeGrantedScopes(true);
							$client->setApprovalPrompt('force');
							$client->setApplicationName('Youtube Smart Tools');
							$return_code = $_GET['code'];
							if (! isset($return_code)) {
							$auth_url = $client->createAuthUrl();
							  //$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/ytbweb/index.php';
							header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
							} else {
								$accessToken = $client->fetchAccessTokenWithAuthCode($return_code);
								$service = new Google_Service_YouTube($client);
									$response = $service->channels->listChannels(
										'snippet,contentDetails,statistics', array('mine' => true)
									);

                            //    lưu json file
                              $channelPath = $destination_path."/".$response['items'][0]['id'];
								if(!file_exists($channelPath))
									{
									mkdir($channelPath,700);
									}
								copy($jsonFile['FileName'],$channelPath."/".basename($jsonFile['FileName']));
								$tokenName="Google.Apis.Auth.OAuth2.Responses.TokenResponse-channel";
                                if(!file_exists($channelPath."/".$tokenName)) {
                                    $Json_accessToken = json_encode($accessToken);
                                    file_put_contents($channelPath."/".$tokenName, $Json_accessToken );
                                }
                                //end save json file

								date_default_timezone_set('Asia/Bangkok');
								$now = getdate();
								$Status = 1;
								$CreateDate = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"]. " " . $now["hours"]. ":" . $now["minutes"];
								$checkChannel = $this->m_channel->CheckChannel($response['items'][0]['id']);
								$TotalVideoUploaded= "{\"CurrentDate\":\"\",\"NumberVideoUploaded\":\"0\"}";
								if($checkChannel == null){
									$channelId = $this->m_channel->InsertChannel($_SESSION["UserId"], $response['items'][0]['id'],$response['items'][0]['snippet']['title'],$accessToken["access_token"],$accessToken["refresh_token"], $jsonFile['FileUrl'],$TotalVideoUploaded, $CreateDate , $Status);
									$countFile = $this->m_channel->GetTotalFileByChannel($jsonFile['FileUrl']);
									$this->m_channel->UpdateCountFile((int)$jsonFile['ID'], (int)$countFile['TotalFile']);
                                    if($channelId != 0) {
                                        header('location: ../controller/c_channel.php?controller=channel&action=scheduleupload&Id='.$channelId);

                                   }
								}
								else {
                                    header('location: ../controller/c_channel.php?controller=channel');
                                }
							}
						}else{
							header("location: ../controller/c_channel.php?controller=channel");
						}
                        break;
/*-----------------------    scheduleupload    -------------------*/
					case "scheduleupload":
						$title="Cài đặt thời thời gian upload";
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
                        if(file_exists('../views/v_add_schedule_upload.php'))
                        {
                            include '../views/v_add_schedule_upload.php';
                        }
                        if(file_exists('../views/_layers/l_footer.php'))
                        {
                            require_once("../views/_layers/l_footer.php");
                        }
                        if(file_exists('../views/_layers/l_script.php'))
                        {
                            require_once("../views/_layers/l_script.php");
                        }
                        if(file_exists('../script/channel_js.php'))
                        {
                            require_once("../script/channel_js.php");
                        }
						break;
					case "delete":
						$Channel = $this->m_channel->GetChannelByID($Id);
						$ChannelConfig = $this->m_channel->GetUploadConfig($Channel['ChannelID']);
						$this->m_channel->DeleteVideoDownload($ChannelConfig['ID']);
                        $this->m_channel->DeleteConfigUpload($Channel['ChannelID']);
						$this->m_channel->DeleteDetailSource($ChannelConfig['ID']);
                        $this->m_channel->DeleteSchedulePublic($Id);
						$this->m_channel->DeleteChannel($Id);
						$jsonFile = $this->m_channel->GetFileConfigByUrl($Channel['FromJsonFile']);

                        array_map('unlink', glob($destination_path."/".$Channel['ChannelID']."/*"));
                        rmdir($destination_path."/".$Channel['ChannelID']);
						//update count file
                        $countFile = $this->m_channel->GetTotalFileByChannel($jsonFile['FileUrl']);
                        $this->m_channel->UpdateCountFile((int)$jsonFile['ID'], (int)$countFile['TotalFile']);
						header("location: ../controller/c_channel.php?controller=channel");
						break;

					case "change_active":
                        $Status = $_GET["status"];
						$this->m_channel->ChangeActive($Id, $Status );
						header("location: ../controller/c_channel.php?controller=channel");
						break;
                    case "edit_channel_view":
                        $channel = $this->m_channel->GetChannelByID($Id);
                        $arr_user = $this->m_channel->GetUser($_SESSION['Role'] ,$_SESSION["UserId"]);
                        $title = "Sửa thông tin kênh";
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
                        if(file_exists('../views/v_edit_channel.php'))
                        {
                            include '../views/v_edit_channel.php';
                        }
                        if(file_exists('../views/_layers/l_footer.php'))
                        {
                            require_once("../views/_layers/l_footer.php");
                        }
                        if(file_exists('../views/_layers/l_script.php'))
                        {
                            require_once("../views/_layers/l_script.php");
                        }
                        if(file_exists('../script/channel_js.php'))
                        {
                            require_once("../script/channel_js.php");
                        }
                        break;

                    case "edit_channel":
                        $AssignTo = isset($_POST["AssignTo"]) ? trim($_POST["AssignTo"]) : '';
                        $this->m_channel->UpdateChannel($Id,$AssignTo);
                        header("location: ../controller/c_channel.php?controller=channel");
                        break;

                    case "update_schedule":
                        $IDChanel = isset($_POST['channelID']) ?($_POST['channelID']) : '';
                        $TotalVideoUpload = isset($_POST["TotalVideoUpload"]) ? trim($_POST["TotalVideoUpload"]) : '';
                        $AfterDays = isset($_POST["AfterDays"]) ? $_POST["AfterDays"] : '';
                        $Hours = isset($_POST["Hours"]) ? $_POST["Hours"] : '';
                        $Minutes =isset($_POST["Minutes"]) ? $_POST["Minutes"] : '';
                        $TimeZone =isset($_POST["Zone"]) ? $_POST["Zone"] : '';
                        $Status=0;
                        $TotalVideoPublish = isset($_POST["TotalVideoPublish"]) ? $_POST["TotalVideoPublish"] : 0;
                        $this->m_channel->DeleteSchedulePublic($IDChanel);
						for ($i =0;$i<$TotalVideoPublish;$i++)
							{
								$this->m_channel->InsertSchedulePublic($IDChanel, $AfterDays, $Hours[$i],$Minutes[$i], $TimeZone[$i], $i+1, $Status);
							}
						$this->m_channel->UpdateChannelTotalVideoUpload($IDChanel, $TotalVideoUpload);
						header("location: ../controller/c_channel.php?controller=channel");
                        break;

					case "search_channel":
                        $title = "Quản lý kênh";
                        $arr_config= $this->m_channel->GetAllConfig();
                        $arr_detailSource= $this->m_channel->GetAllDetailSource();

                        //Get all uploaded videos
                        $totalVideoUploaded= $this->m_channel->GetAllDownloadVideo();
                        $arrayUpload = array_map(function($element){
                            return $element['ChannelID'];
                        }, $totalVideoUploaded);

                        $arrayUploadedVideo = (array_count_values($arrayUpload));
                        //Get all error video
                        $totalVideoError= $this->m_channel->GetAllDDownloadVideoFail();
                        $arrayError = array_map(function($element){
                            return $element['ChannelID'];
                        }, $totalVideoError);
                        $arrayVideoError = (array_count_values($arrayError));

						//
                        $arr_user= $this->m_channel->GetUserSearch($_SESSION['UserId']);
                        $arr_channelSeach = $this->m_channel->GetChannelNameSearch($_SESSION["UserId"] );
                        $ChannelIDSearch= isset($_POST["ChannelIDSearch"]) ? trim($_POST["ChannelIDSearch"]) : '';
						$UserIDSearch= isset($_POST["UserIDSearch"]) ? trim($_POST["UserIDSearch"]) : '';
						$SearchType =isset($_POST["searchMode"]) ? trim($_POST["searchMode"]) : '';
						//echo "mã người dùng".$UserID."   Mã kênh ".$ChannelID;
                        //GetChannelSearchByUserID
						if ($SearchType=="1") {
                            if ($ChannelIDSearch != "") {
                                if ($ChannelIDSearch != "all") {
                                    $arr_chanel = $this->m_channel->GetAllChannelBySearch($_SESSION["UserId"], $ChannelIDSearch);
                                } else {
                                    $arr_chanel = $this->m_channel->GetAllChannel($_SESSION["UserId"]);
                                }
                            }
                        }
                    else {
                        if ($UserIDSearch != "") {
                            if ($UserIDSearch != "all") {
                                $arr_chanel = $this->m_channel->GetChannelSearchByUserID($UserIDSearch);
                            } else {
                                $arr_chanel = $this->m_channel->GetAllChannel($_SESSION["UserId"]);//
                            }
                        }

                    }

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
                        if(file_exists('../views/v_channel.php'))
                        {
                            include '../views/v_channel.php';
                        }
                        if(file_exists('../views/_layers/l_footer.php'))
                        {
                            require_once("../views/_layers/l_footer.php");
                        }
                        if(file_exists('../views/_layers/l_script.php'))
                        {
                            require_once("../views/_layers/l_script.php");
                        }
                        if(file_exists('../script/channel_js.php'))
                        {
                            require_once("../script/channel_js.php");
                        }
						break;

					case "change_channel_info_view" :
						$title="Đổi tên kênh";
                        $channel = $this->m_channel->GetChannelByID($Id);
                        $channelEmail = $this->m_channel->GetChannelEmail($channel['ChannelID']);
                        if ($channelEmail!='')
                            $decryptPass=$this->encrypt_decrypt('decrypt',$channelEmail['PassWord']);
                        else
                            $decryptPass="";

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
                        if(file_exists('../views/v_add_channel_email.php'))
                        {
                            include '../views/v_add_channel_email.php';
                        }
                        if(file_exists('../views/_layers/l_footer.php'))
                        {
                            require_once("../views/_layers/l_footer.php");
                        }
                        if(file_exists('../views/_layers/l_script.php'))
                        {
                            require_once("../views/_layers/l_script.php");
                        }
                        if(file_exists('../script/channel_js.php'))
                        {
                            require_once("../script/channel_js.php");
                        }
                        break;
					case "change_channel_info":
                        $ChannelName= isset($_POST["ChannelName"]) ? trim($_POST["ChannelName"]) : '';
                        $ChannelEmail= isset($_POST["ChannelEmail"]) ? trim($_POST["ChannelEmail"]) : '';
                        $ChannelPass= isset($_POST["ChannelPassWord"]) ? trim($_POST["ChannelPassWord"]) : '';
                        if(isset($_GET["channelID"]))
                        {
                            $channelID = $_GET["channelID"];
                        }
                        $key = hash('sha256', $channelID, false);
                        $this->m_channel->UpdateChannelName($Id,$ChannelName);
                        $encryptPass= $this->encrypt_decrypt("encrypt",$ChannelPass);
                        $channelEmail = $this->m_channel->GetChannelEmail($channelID);
                        echo $channelEmail;
                        if ($channelEmail=='') {
                            $this->m_channel->InsertChannelEmail($channelID, $ChannelEmail, $encryptPass);
                        }
                        else {
                        	if($_SESSION['Role']!=3) {
                                $this->m_channel->UpdateChannelEmail($channelID, $ChannelEmail, $encryptPass);
                            }
                        }
                        header("location: ../controller/c_channel.php?controller=channel");
                        break;

					case "channel_analytics_view":

						break;
				}
			}
			else
			{
				$title = "Quản lý kênh";

                $arr_channelSeach = $this->m_channel->GetChannelNameSearch($_SESSION["UserId"] );
                $arr_user= $this->m_channel->GetUserSearch($_SESSION['UserId']);
                $arr_chanel = $this->m_channel->GetChannelSearchByUserID($arr_user[0]['ID'] );
                $arr_config= $this->m_channel->GetAllConfig();
                $arr_detailSource= $this->m_channel->GetAllDetailSource();
				// get channel report

				//Get all uploaded videos
                $totalVideoUploaded= $this->m_channel->GetAllDownloadVideo();
                $arrayUpload = array_map(function($element){
                    return $element['ChannelID'];
                }, $totalVideoUploaded);

                $arrayUploadedVideo = (array_count_values($arrayUpload));
				//Get all error video
                $totalVideoError= $this->m_channel->GetAllDDownloadVideoFail();
                $arrayError = array_map(function($element){
                    return $element['ChannelID'];
                }, $totalVideoError);
                $arrayVideoError = (array_count_values($arrayError));

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
				if(file_exists('../views/v_channel.php'))
				{
					include '../views/v_channel.php';
				}
				if(file_exists('../views/_layers/l_footer.php'))
				{
					require_once("../views/_layers/l_footer.php");
				}

				if(file_exists('../views/_layers/l_script.php'))
				{
					require_once("../views/_layers/l_script.php");
				}
				if(file_exists('../script/channel_js.php'))
				{
					require_once("../script/channel_js.php");
				}
			}

		}

        function encrypt_decrypt($action, $string) {
            $output = false;
            $encrypt_method = "AES-256-CBC";
            $secret_key = 'vatGsBXwW&5y3OkQb0F7nJuCVB!1*C#$';
            $secret_iv = '88 12 48 24 87 08 00 45 95 08 77 71 78 47 82 80';
            // hash
            $key = hash('sha256', $secret_key);

            // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
            $iv = substr(hash('sha256', $secret_iv), 0, 16);
            if ( $action == 'encrypt' ) {
                $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
                $output = base64_encode($output);
            } else if( $action == 'decrypt' ) {
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
            }
            return $output;
        }


    }
	$c_channel = new c_channel();
?>