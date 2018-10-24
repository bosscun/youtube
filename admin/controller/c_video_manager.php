<?php
	session_start();
	if(!isset($_SESSION['UserId'])){
		header("Location: ../login.php");
	}
	// to change a session variable, just overwrite it 
	
?>
<?php

	class c_video_manager
	{
		public $m_video_manager;

        /**
         * c_channel_analytics constructor.
         */
        public function __construct()		{
		 $maxResults=25;
		 
			$main_menu = "video_manager";
			if(file_exists('../model/m_video_manager.php'))
			{
				include '../model/m_video_manager.php';
			}
			$this->m_video_manager = new m_video_manager();
            $destination_path = "../api_json";

			$Id = 0;
			if(isset($_GET["Id"]))
			{
				$Id = $_GET["Id"];
			}
			//

            if(isset($_GET["videoID"]))
            {
                $videoID = $_GET["videoID"];
            }
			$action = "";
			if(isset($_GET["action"]))
			{
				$action = $_GET["action"];

				switch($action) {
                    /*-----------------------    add    -------------------*/

                    case "search_channel":
                        //$ChannelID = isset($_POST['ChannelIDSearch']) ?($_POST['ChannelIDSearch']) : '';
                        if (isset($_GET["ChannelIDSearch"])) {
                            $ChannelID = $_GET["ChannelIDSearch"];
                        }

                        $channel = $this->m_video_manager->GetChannel($ChannelID);
                        $jsonFile = $channel['FromJsonFile'];
                        $token = $this->m_video_manager->GetToken($ChannelID);
                        $accessToken = $token['AccessToken'];
                        $refreshToken = $token['RefreshToken'];
                        $jsonPath = "../YoutubeApi/ClientSecretFile/" . basename(dirname($channel['FromJsonFile'])) . "/" . "client_secret.json";
                        if (!file_exists($destination_path . "/" . $ChannelID)) {
                            mkdir($destination_path . "/" . $ChannelID, 0777);
                            copy($jsonPath, $destination_path . "/" . $ChannelID . "/" . basename($jsonFile));
                            $apikey = "{\"access_token\":\"$accessToken\",\"token_type\":\"Bearer\",\"expires_in\":3600,\"created\":1528072583,\"refresh_token\":\"$refreshToken\"}";
                            $tokenName = "Google.Apis.Auth.OAuth2.Responses.TokenResponse-channel";
                            file_put_contents($destination_path . "/" . $ChannelID . "/" . $tokenName, $apikey);
                        }
                        $authConfigFile = $destination_path . "/" . $ChannelID . "/" . "client_secret.json";
                        $credentialsPath = $destination_path . "/" . $ChannelID . "/" . "Google.Apis.Auth.OAuth2.Responses.TokenResponse-channel";
                        require_once '../YoutubeApi/vendor/autoload.php';
						try {
                            $token = $this->m_video_manager->GetToken($ChannelID);
                            $client = $this->getClient($authConfigFile, $credentialsPath);


                            // Define an object that will be used to make all API requests.
                            $youtube = new Google_Service_YouTube($client);
                            $responses = $youtube->search->listSearch(
                                'snippet',
                                array('maxResults' => $maxResults, 'forMine' => true, 'type' => 'video')
                            );
                            /* // sleep for 10 seconds
                            echo "<br><br> Data:";
                            print_r($responses);
                            echo "<br><br><br><br> "; */
                            $videoInfo = array();
                            $j = 0;


                            for ($i = 0; $i < count($responses); $i++) {
                                $videoUploadEvent = $responses['items'][$i]['id']['videoId'];
                                if (!empty($videoUploadEvent)) {
                                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                                    $dt = $responses['items'][$i]['snippet']['publishedAt'];
                                    $publishDate = date("d-m-Y", strtotime($dt));
                                    $publishTime = date("H:i:s", strtotime($dt));
                                    $cTime = "$publishDate $publishTime";
                                    $videoInfo[$j] = array("VideoID" => $responses['items'][$i]['id']['videoId'],
                                        "VideoTitle" => $responses['items'][$i]['snippet']['title'],
                                        "VideoThumbnails" => $responses['items'][$i]['snippet']['thumbnails']['default']['url'],
                                        "totalResults" => $responses['pageInfo']['totalResults'],
                                        "channelId" => $responses['items'][$i]['snippet']['channelId'],
                                        "UpdateTime" => $cTime
                                    );
                                    $j++;
                                }
                            }
                            /* echo "<br><br> Data:";
                            print_r($responses);
                            echo "<br><br><br><br> "; */
                            $pageToken = array($responses['nextPageToken']);
                            $totalVideo = $responses['pageInfo']['totalResults'];
                            $currentPage = 0;
                            $currentVideo = ($currentPage + 1) * $maxResults;
                            $json = json_encode($videoInfo);
                            unset($_SESSION['data']);
                            unset($_SESSION['pageToken']);
                            unset($_SESSION['currentPage']);

                            $_SESSION['data'] = $json;
                            $_SESSION['pageToken'] = $pageToken;
                            $_SESSION['currentPage'] = $currentPage;
                            $_SESSION['totalVideo'] = $totalVideo;

                            /* if(!file_exists("C:/vfast_tmp"))
                                mkdir("C:/vfast_tmp",700);
                            file_put_contents("C:/vfast_tmp/tmp.txt",$json);

                            file_put_contents("C:/vfast_tmp/page.txt",json_encode($pageToken)); */


                            $title = "Trình quản lý video";
                            if (file_exists('../views/_layers/l_head.php')) {
                                require_once("../views/_layers/l_head.php");
                            }
                            if (file_exists('../views/_layers/l_header_menu.php')) {
                                require_once("../views/_layers/l_header_menu.php");
                            }
                            if (file_exists('../views/_layers/l_left_menu.php')) {
                                require_once("../views/_layers/l_left_menu.php");
                            }
                            if (file_exists('../views/v_video_manager.php')) {
                                include '../views/v_video_manager.php';
                            }
                            if (file_exists('../views/_layers/l_footer.php')) {
                                require_once("../views/_layers/l_footer.php");
                            }
                        }
                        catch (Exception $exception){

						}
                        break;

                    case "load_paging":

                        if (isset($_GET["ChannelIDSearch"])) {
                            $ChannelID = $_GET["ChannelIDSearch"];
                        }
                        if (isset($_GET["page"])) {
                            $pageType = $_GET["page"];
                        }
                        $authConfigFile = $destination_path . "/" . $ChannelID . "/" . "client_secret.json";
                        $credentialsPath = $destination_path . "/" . $ChannelID . "/" . "Google.Apis.Auth.OAuth2.Responses.TokenResponse-channel";
                        require_once '../YoutubeApi/vendor/autoload.php';
                        $client = $this->getClient($authConfigFile, $credentialsPath);
                        // Define an object that will be used to make all API requests.
                        $youtube = new Google_Service_YouTube($client);
                        $myArray = $_SESSION['pageToken'];
                        $currentPage = $_SESSION['currentPage'];
                        $totalVideo = $_SESSION['totalVideo'];
                        $currentVideo = ($currentPage + 1) * $maxResults;

                        /* $data = file_get_contents('C:/vfast_tmp/page.txt'); */

                        /* $myArray =json_decode($data,true); */
                        if ($pageType == "Next") {
                            if ((($currentPage + 1) * $maxResults) < $totalVideo)
                            {
								try {
                                    $responses = $youtube->search->listSearch(
                                        'snippet',
                                        array('maxResults' => $maxResults, 'forMine' => true, 'pageToken' => $myArray[$currentPage], 'type' => 'video')
                                    );
                                }
                                catch (Exception $exception)
								{

								}
                                $currentPage++;
                            }
                            else
							{
							    if($currentPage != 0)
                                {
                                	try {
                                        $responses = $youtube->search->listSearch(
                                            'snippet',
                                            array('maxResults' => $maxResults, 'forMine' => true, 'pageToken' => $myArray[$currentPage - 1], 'type' => 'video')
                                        );
                                    }
                                    catch (Exception $exception)
									{}
                                }
								else
								{	try {
                                    $responses = $youtube->search->listSearch(
                                        'snippet',
                                        array('maxResults' => $maxResults, 'forMine' => true, 'type' => 'video')
                                    );
                                }
                                catch (Exception $exception)
								{}
								}
								 
							}

                            /* // sleep for 10 seconds
                            echo "<br><br> CurrentPage:";
                            print_r($currentPage);
                            echo "<br><br> "; */
                        } else {
                            if ($currentPage == 0) {
                               try {
                                   $responses = $youtube->search->listSearch(
                                       'snippet',
                                       array('maxResults' => $maxResults, 'forMine' => true, 'type' => 'video')
                                   );
                               }
                               catch ( Exception $exception) {}
                            } else {
                                if ($currentPage > 1) {
                                	try {
                                        $responses = $youtube->search->listSearch(
                                            'snippet',
                                            array('maxResults' => $maxResults, 'forMine' => true, 'pageToken' => $myArray[$currentPage - 2], 'type' => 'video')
                                        );
                                    }catch (Exception $exception){}
                                    $currentPage--;
                                } else {

                                  try {
                                      $responses = $youtube->search->listSearch(
                                          'snippet',
                                          array('maxResults' => $maxResults, 'forMine' => true, 'type' => 'video')
                                      );
                                      $currentPage = 0;
                                  }
                                  catch ( Exception $exception){}
                                }

                            }
                            /* echo "<br><br> CurrentPage:";
                            print_r($currentPage);
                            echo "<br><br> "; */
                        }
                        $currentVideo = ($currentPage + 1) * $maxResults;
                        if ((($currentPage + 1) * $maxResults) < $totalVideo)
                            $myArray[$currentPage] = $responses['nextPageToken'];
                        /*                         if(!empty($responses['prevPageToken']))
                                                        $myArray["PrevPage"] = $responses['prevPageToken']; */
                        //HaiVM modified
                        $_SESSION['pageToken'] = $myArray;
                        $_SESSION['currentPage'] = $currentPage;
                        /* file_put_contents("C:/vfast_tmp/page.txt",json_encode($myArray)); */
                        $videoInfo = array();
                        $j = 0;
                        for ($i = 0; $i < count($responses); $i++) {
                            $videoUploadEvent = $responses['items'][$i]['id']['videoId'];
                            if (!empty($videoUploadEvent)) {
                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                $dt = $responses['items'][$i]['snippet']['publishedAt'];
                                $publishDate = date("d-m-Y", strtotime($dt));
                                $publishTime = date("H:i:s", strtotime($dt));
                                $cTime = "$publishDate $publishTime";
                                $videoInfo[$j] = array("VideoID" => $responses['items'][$i]['id']['videoId'],
                                    "VideoTitle" => $responses['items'][$i]['snippet']['title'],
                                    "VideoThumbnails" => $responses['items'][$i]['snippet']['thumbnails']['default']['url'],
                                    "totalResults" => $responses['pageInfo']['totalResults'],
                                    "channelId" => $responses['items'][$i]['snippet']['channelId'],
                                    "UpdateTime" => $cTime
                                );
                                $j++;
                            }
                        }


                        //HaiVM modified
                        $_SESSION['data'] = json_encode($videoInfo);
                        /*   file_put_contents("C:/vfast_tmp/tmp.txt",json_encode($videoInfo)); */
                        //
                      //  $arr_channel = $this->m_video_manager->GetAllChannel($_SESSION['Role'], $_SESSION["UserId"]);

                        $title = "Trình quản lý video";
                        if (file_exists('../views/_layers/l_head.php')) {
                            require_once("../views/_layers/l_head.php");
                        }
                        if (file_exists('../views/_layers/l_header_menu.php')) {
                            require_once("../views/_layers/l_header_menu.php");
                        }
                        if (file_exists('../views/_layers/l_left_menu.php')) {
                            require_once("../views/_layers/l_left_menu.php");
                        }
                        if (file_exists('../views/v_video_manager.php')) {
                            include '../views/v_video_manager.php';
                        }
                        if (file_exists('../views/_layers/l_footer.php')) {
                            require_once("../views/_layers/l_footer.php");
                        }
                        break;

                    case "view_detail":
                        $currentPage = $_SESSION['currentPage'];
                        $totalVideo = $_SESSION['totalVideo'];
                        $currentVideo = ($currentPage + 1) * $maxResults;
                        if (isset($_GET["videoID"])) {
                            $videoID = $_GET["videoID"];
                        }
                        if (isset($_GET["channelID"])) {
                            $ChannelID = $_GET["channelID"];
                        }
                        //  echo $ChannelID;
                        $channel = $this->m_video_manager->GetChannel($ChannelID);
                        $authConfigFile = $destination_path . "/" . $ChannelID . "/" . "client_secret.json";
                        $credentialsPath = $destination_path . "/" . $ChannelID . "/" . "Google.Apis.Auth.OAuth2.Responses.TokenResponse-channel";

                        try {
                            require_once '../YoutubeApi/vendor/autoload.php';   //
                            $client = $this->getClient($authConfigFile, $credentialsPath);
                            $youtube = new Google_Service_YouTube($client);
                            $response = $youtube->videos->listVideos(
                                'snippet,statistics,status, contentDetails',
                                array('id' => $videoID)
                            );

                            $videoDuration = $response['items'][0]['contentDetails']['duration'];
                            $videoDuration = str_replace("PT", '', $videoDuration);
                            $videoDuration = str_replace("M", ':', $videoDuration);
                            $videoDuration = str_replace("S", '', $videoDuration);

                            $video_restric = $response['items'][0]['contentDetails']['regionRestriction']['blocked'];
                            if ($video_restric == '')
                                $video_restric = "Không";
                            else
                                $video_restric = "Video bị chặn tại " . count($video_restric) . " quốc gia";

                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $publish_datetime = $response['items'][0]['status']['publishAt'];
                            //echo "RealTime: $publish_datetime <br>";
                            $publish_datetime = date('Y-m-d H:i:s', strtotime($publish_datetime));
                            $privacy = $response['items'][0]['status']['privacyStatus'];

                            $hiddenTime = "hidden";
                            $hiddenscheduled = "hidden";

                            $selectPublic = '';
                            $selectUnlisted = '';
                            $selectPrivate = '';
                            $selectScheduled = '';

                            switch ($privacy) {
                                case "public":
                                    $publish_datetime = $response['items'][0]['snippet']['publishedAt'];
                                    $selectPublic = "selected";
                                    break;
                                case "unlisted":
                                    $publish_datetime = $response['items'][0]['snippet']['publishedAt'];
                                    $selectUnlisted = "selected";
                                    break;
                                case "private":
                                    //echo $publish_datetime ."<br>";
                                    $date_curr = date('Y-m-d H:i:s', time());
                                    //echo $date_curr ."<br>";
                                    if ($publish_datetime > $date_curr) {
                                        $privacy = "scheduled";
                                        $hiddenTime = '';
                                        $hiddenscheduled = '';
                                        $selectScheduled = "selected";
                                        //echo "Đặt lịch"."<br>";
                                    } else {
                                        $selectPrivate = "selected";
                                    }
                                    break;
                                default:
                            }
                            $publishDate = date("d", strtotime($publish_datetime));
                            $publishMonth = date("m", strtotime($publish_datetime));
                            $publishYear = date("Y", strtotime($publish_datetime));
                            $publishHour = date("H", strtotime($publish_datetime));
                            $publishMinute = date("i", strtotime($publish_datetime));
                            $publishSec = date("s", strtotime($publish_datetime));
                            $publishZone = date("O", strtotime($publish_datetime));
                            $publishDateTime = date("Y-m-d", strtotime($publish_datetime));

                            $title = "Chỉnh sửa video";
                            if (file_exists('../views/_layers/l_head.php')) {
                                require_once("../views/_layers/l_head.php");
                            }
                            if (file_exists('../views/_layers/l_header_menu.php')) {
                                require_once("../views/_layers/l_header_menu.php");
                            }
                            if (file_exists('../views/_layers/l_left_menu.php')) {
                                require_once("../views/_layers/l_left_menu.php");
                            }
                            if (file_exists('../views/v_video_detail.php')) {
                                include '../views/v_video_detail.php';
                            }
                            if (file_exists('../views/_layers/l_footer.php')) {
                                require_once("../views/_layers/l_footer.php");
                            }
                            if (file_exists('../views/_layers/l_script.php')) {
                                require_once("../views/_layers/l_script.php");
                            }
                            if (file_exists('../script/video_manager_js.php')) {
                                require_once("../script/video_manager_js.php");

                            }
                        }
                        catch (Exception $exception)
						{

						}

                        break;
                    case "update_video":

                        $currentPage = $_SESSION['currentPage'];
                        $totalVideo = $_SESSION['totalVideo'];
                        $currentVideo = ($currentPage + 1) * $maxResults;
                        if (isset($_GET["videoID"])) {
                            $videoID = $_GET["videoID"];
                        }
                        if (isset($_GET["channelID"])) {
                            $ChannelID = $_GET["channelID"];
                        }
                        $title = isset($_POST['AddTitle']) ? ($_POST['AddTitle']) : '';
                        $description = isset($_POST['AddDes']) ? ($_POST['AddDes']) : '';
                        $tags = isset($_POST['AddTag']) ? ($_POST['AddTag']) : '';
                        $category = isset($_POST['CategoryAdd']) ? ($_POST['CategoryAdd']) : '';
                        $language = isset($_POST['LanguageAdd']) ? ($_POST['LanguageAdd']) : '';
                        $status = isset($_POST['StatusAdd']) ? ($_POST['StatusAdd']) : '';
                        $arrTags = explode(',', $tags);

                        // print_r($category);

                        $authConfigFile = $destination_path . "/" . $ChannelID . "/" . "client_secret.json";
                        $credentialsPath = $destination_path . "/" . $ChannelID . "/" . "Google.Apis.Auth.OAuth2.Responses.TokenResponse-channel";
						try {
                            require_once '../YoutubeApi/vendor/autoload.php';   //
                            $client = $this->getClient($authConfigFile, $credentialsPath);
                            $youtube = new Google_Service_YouTube($client);
                            $response = $youtube->videos->listVideos(
                                'snippet,status',
                                array('id' => $videoID)
                            );
                        }
                        catch (Exception $exception )
						{

						}
                        $video = $response[0];
                        $videoSnippet = $video['snippet'];
                        $videoStatus = $video['status'];

                        $videoSnippet['title'] = $title;

                        $videoSnippet['tags'] = $arrTags;
                        $videoSnippet['description'] = $description;
                        $videoSnippet['categoryId'] = $category;
                        if ($language != "") {
                            $videoSnippet['defaultLanguage'] = $language;
                            $videoSnippet['defaultAudioLanguage'] = $language;
                        }

                        // print_r($video['snippet']);

                        switch ($status) {
                            case "scheduled":
                                $videoStatus['privacyStatus'] = "private";
                                $publish_datetime = isset($_POST['publishDateTime']) ? ($_POST['publishDateTime']) : '';
                                //echo "publish_datetime " .$publish_datetime ."<br>";
                                $publishDate =  date("d", strtotime($publish_datetime));
                                $publishMonth = date("m", strtotime($publish_datetime));
                                $publishYear =  date("Y", strtotime($publish_datetime));
                                $publishHour =  isset($_POST['publishHour']) ? ($_POST['publishHour']) : '';
                                $publishMinute = isset($_POST['publishMinute']) ? ($_POST['publishMinute']) : '';


                                $cTime = $d=mktime($publishHour, $publishMinute, 0, $publishMonth, $publishDate, $publishYear);
                                $cTime = date("Y-m-d H:i:s", $cTime);
                                //echo "Tạo time " .$cTime ."<br>";
                                $cTime = date("Y-m-d H:i:s", strtotime('-7 hours', strtotime($cTime)));
                                $publishDate = date("Y-m-d", strtotime($cTime));
                                $publishTime = date("H:i:s", strtotime($cTime));
                                $cTime = $publishDate . "T" . $publishTime . ".000Z";
                                $videoStatus['publishAt'] = $cTime;
                                //echo $cTime;
                                break;
                            default:
                                $videoStatus['privacyStatus'] = $status;
                                $videoStatus['publishAt'] = null;
                                break;
                        }
                        try {
                            $updateResponse = $youtube->videos->update("snippet,status", $video);

                            //HaiVM modified
                            $data = $_SESSION['data'];
                            /* //search_channel
                            $data = file_get_contents('C:/vfast_tmp/tmp.txt'); */
                            // echo $data;
                            $videoInfo = json_decode($data, true);
                            // print_r($myArray)."<br>";
                            for ($i = 0; $i < count($videoInfo); $i++) {
                                if ($videoInfo[$i]['VideoID'] == $videoID) {
                                    $videoInfo[$i]['VideoTitle'] = $updateResponse['snippet']['title'];
                                }
                            }
                            $json = json_encode($videoInfo);
                            $_SESSION['data'] = $json;
                            /* file_put_contents("C:/vfast_tmp/tmp.txt",$json); */
                            //  print_r($updateResponse);
                            $title = "Trình quản lý Video";
                            if (file_exists('../views/_layers/l_head.php')) {
                                require_once("../views/_layers/l_head.php");
                            }
                            if (file_exists('../views/_layers/l_header_menu.php')) {
                                require_once("../views/_layers/l_header_menu.php");
                            }
                            if (file_exists('../views/_layers/l_left_menu.php')) {
                                require_once("../views/_layers/l_left_menu.php");
                            }
                            if (file_exists('../views/v_video_manager.php')) {
                                include '../views/v_video_manager.php';
                            }
                            if (file_exists('../views/_layers/l_footer.php')) {
                                require_once("../views/_layers/l_footer.php");
                            }
                        }
                        catch (Exception $exception)
						{

						}
                        break;

                    case "upload_thumbnail_view":
                        $message='start';
                        if (isset($_GET["channelID"])) {
                            $ChannelID = $_GET["channelID"];
                        }
                        $title = "Upload Thumbnails";
                        if (file_exists('../views/_layers/l_head.php')) {
                            require_once("../views/_layers/l_head.php");
                        }
                        if (file_exists('../views/_layers/l_header_menu.php')) {
                            require_once("../views/_layers/l_header_menu.php");
                        }
                        if (file_exists('../views/_layers/l_left_menu.php')) {
                            require_once("../views/_layers/l_left_menu.php");
                        }
                        if (file_exists('../views/v_upload_thumbnail.php')) {
                            include '../views/v_upload_thumbnail.php';
                        }
                        if (file_exists('../views/_layers/l_footer.php')) {
                            require_once("../views/_layers/l_footer.php");
                        }

                        break;

                    case "upload_thumbnail":
                        if (isset($_GET["channelID"])) {
                            $ChannelID = $_GET["channelID"];
                        }

                        $authConfigFile = $destination_path . "/" . $ChannelID . "/" . "client_secret.json";
                        $credentialsPath = $destination_path . "/" . $ChannelID . "/" . "Google.Apis.Auth.OAuth2.Responses.TokenResponse-channel";

                        require_once '../YoutubeApi/vendor/autoload.php';   //
                        $client = $this->getClient($authConfigFile, $credentialsPath);
                        $youtube = new Google_Service_YouTube($client);
                        //upload thumbnails
                        if ($_FILES['FileAdd']['name'] != NULL) {
                            if ($_FILES['FileAdd']['size'] < 50000000) {

                                $SubFolderName = md5(uniqid());
                                // file hợp lệ, tiến hành upload
                                $FileName = "../Thumbnails" . "/" . $_FILES["FileAdd"]["name"];
                                $target_path = "../Thumbnails" . "/" . $_FILES["FileAdd"]["name"];
                                move_uploaded_file($_FILES['FileAdd']['tmp_name'], $target_path);
                                //echo $FileName;

                            }
                        }
                        // echo $videoID;
                    try {
                        $updateResponse = $this->thumbnailsSet($client,
                            $youtube,
                            $FileName,
                            array('videoId' => $videoID));
                        $data = $_SESSION['data'];
                        $videoInfo = json_decode($data, true);

                        $title="Trình Quản lí video";
                        $message=$updateResponse['items'][0]['default']['url'];
                        if (file_exists('../views/_layers/l_head.php')) {
                            require_once("../views/_layers/l_head.php");
                        }
                        if (file_exists('../views/_layers/l_header_menu.php')) {
                            require_once("../views/_layers/l_header_menu.php");
                        }
                        if (file_exists('../views/_layers/l_left_menu.php')) {
                            require_once("../views/_layers/l_left_menu.php");
                        }
                        if (file_exists('../views/v_video_manager.php')) {
                            include '../views/v_video_manager.php';
                        }
                        if (file_exists('../views/_layers/l_footer.php')) {
                            require_once("../views/_layers/l_footer.php");
                        }
                    }
                    catch (Exception $exception)
                    {
                        $title="Upload thumbnail";
                        $message="";
                        if (isset($_GET["channelID"])) {
                            $ChannelID = $_GET["channelID"];
                        }
                        $title = "Upload Thumbnails";
                        if (file_exists('../views/_layers/l_head.php')) {
                            require_once("../views/_layers/l_head.php");
                        }
                        if (file_exists('../views/_layers/l_header_menu.php')) {
                            require_once("../views/_layers/l_header_menu.php");
                        }
                        if (file_exists('../views/_layers/l_left_menu.php')) {
                            require_once("../views/_layers/l_left_menu.php");
                        }
                        if (file_exists('../views/v_upload_thumbnail.php')) {
                            include '../views/v_upload_thumbnail.php';
                        }
                        if (file_exists('../views/_layers/l_footer.php')) {
                            require_once("../views/_layers/l_footer.php");
                        }
                    }
                        break;
                }

			}
			else
			{
				$title = "Trình quản lí Video";
				$currentPage = $_SESSION['currentPage'];         
				$totalVideo = $_SESSION['totalVideo'];           //HaiVM modified
				$currentVideo = ($currentPage + 1) * $maxResults;
				$data = $_SESSION['data'];
               /*  $data = file_get_contents('C:/vfast_tmp/tmp.txt'); */
                // echo $data;
                $videoInfo = json_decode($data, true);

                //end
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
				if(file_exists('../views/v_video_manager.php'))
				{
					include '../views/v_video_manager.php';
				}
				if(file_exists('../views/_layers/l_footer.php'))
				{
					require_once("../views/_layers/l_footer.php");
				}


			}

		}
        function getClient($authConfigFile,$credentialsPath) {
            $client = new Google_Client();
            $client->setAuthConfigFile($authConfigFile);
            $client->setRedirectUri('http://localhost/ytbweb/');
            $client->addScope('https://www.googleapis.com/auth/youtube.force-ssl https://www.googleapis.com/auth/youtube https://www.googleapis.com/auth/yt-analytics-monetary.readonly https://www.googleapis.com/auth/youtubepartner https://www.googleapis.com/auth/youtube.upload');
            $client->setAccessType("offline");
            $client->setIncludeGrantedScopes(true);
            $client->setApprovalPrompt('force');
            $client->setApplicationName('Youtube Smart Tools');
            // Load previously authorized credentials from a file.

            if (file_exists($credentialsPath))
            {
                $unserArray =  file_get_contents($credentialsPath);
                $accessToken = json_decode($unserArray,true);
                //$accessToken = json_decode(file_get_contents($credentialsPath), true);

            }
            else
            {
                $redirect_uri = 'http://localhost/ytbweb/oauth2callback.php';
                header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
            }
            $client->setAccessToken($accessToken);

            // Refresh the token if it's expired.
            if ($client->isAccessTokenExpired())
            {
               $refreshTokenSaved = $client->getRefreshToken();
                if($refreshTokenSaved != null)
                {
                  //  printf('update access token		');
                    $client->fetchAccessTokenWithRefreshToken($refreshTokenSaved);
                    //printf('%cpass access token to some variable',10);
                    $accessTokenUpdated = $client->getAccessToken();
                  //  print('append refresh token		');
                    $accessTokenUpdated['refresh_token'] = $refreshTokenSaved;
                  //  print('save to file		');
                    file_put_contents($credentialsPath, json_encode($accessTokenUpdated));
                }
                else
                {
                  //  printf("Get Refresh token fail%c",10);
                }


                //$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                //file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
            }
            return $client;
        }
        function uploadMedia($client, $request, $filePath, $mimeType) {
            // Specify the size of each chunk of data, in bytes. Set a higher value for
            // reliable connection as fewer chunks lead to faster uploads. Set a lower
            // value for better recovery on less reliable connections.
            $chunkSizeBytes = 1 * 1024 * 1024;

            // Create a MediaFileUpload object for resumable uploads.
            // Parameters to MediaFileUpload are:
            // client, request, mimeType, data, resumable, chunksize.
            $media = new Google_Http_MediaFileUpload(
                $client,
                $request,
                $mimeType,
                null,
                true,
                $chunkSizeBytes
            );
            $media->setFileSize(filesize($filePath));


            // Read the media file and upload it chunk by chunk.
            $status = false;
            $handle = fopen($filePath, "rb");
            while (!$status && !feof($handle)) {
                $chunk = fread($handle, $chunkSizeBytes);
                $status = $media->nextChunk($chunk);
            }

            fclose($handle);
            return $status;
        }

        /***** END BOILERPLATE CODE *****/

	// Sample php code for thumbnails.set

		function thumbnailsSet($client, $service, $media_file, $params) {
			$params = array_filter($params);
			$client->setDefer(true);
			$request = $service->thumbnails->set(join(',', $params));
			$client->setDefer(false);
			 return $response =$this-> uploadMedia($client, $request, $media_file, 'image/png');
			//print_r($response);
		}



    }
	$c_video_manager = new c_video_manager();
?>
