<?php
session_start();
if(!isset($_SESSION['UserId'])){
    header("Location: ../login.php");
}
?>
<?php

class c_config
{
    public $m_config;
    public function __construct()
    {

        $main_menu = "config";

        if(file_exists('../model/m_config.php'))
        {
            include '../model/m_config.php';			}

        $this->m_config  = new m_config();

        $destination_path = "../ImagesReup/";
        $destination_pathaudio = "../AudioFile/";
        $ID = 0;
        if(isset($_GET["ID"]))
        {
            $ID = $_GET["ID"];
        }
        date_default_timezone_set('Asia/Bangkok');
        $now = getdate();
        $TranslateLanguage="    <option value=\"\">Chọn ngôn ngữ</option>
                                <option value=\"ar\">Ả rập</option>
                                <option value=\"km\">Campuchia</option>
                                <option value=\"de\">Đức</option>
                                <option value=\"en\">English</option>
                                <option value=\"nl\">Hà Lan</option>
                                <option value=\"ko\">Hàn Quốc</option>
                                <option value=\"ja\">Nhật Bản</option>
                                <option value=\"id\">Indo</option>
                                <option value=\"it\">Italia</option>
                                <option value=\"fr\">Pháp</option>
                                <option value=\"tr\">Thổ Nhĩ Kỳ</option>
                                <option value=\"th\">Thái Lan</option>
                                <option value=\"es\">Tây Ban Nha</option>
                                <option value=\"zh-CN\">Trung Quốc</option>
                            ";
        if(isset($_GET["action"]))
        {
            $action = $_GET["action"];
            switch($action)
            {
                case "add_config_view":
                    $title = "Cấu hình Re-Up";
                    $UserID =$_SESSION["UserId"];
                    $arr_channel = $this->m_config->GetAllChannelReupChannel($UserID);
                    $arr_channelReupMusic =$this->m_config->GetAllChannelReupMusic($UserID);

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
                    if(file_exists('../views/v_action_config.php'))
                    {
                        $titleAction = "Thêm mới cấu hình";
                        include '../views/v_action_config.php';
                    }
                    if(file_exists('../views/_layers/l_footer.php'))
                    {
                        require_once("../views/_layers/l_footer.php");
                    }

                    if(file_exists('../views/_layers/l_script.php'))
                    {
                        require_once("../views/_layers/l_script.php");
                    }
                    if(file_exists('../script/config_js.php'))
                    {
                        require_once("../script/config_js.php");
                    }
                    break;
                case "add_config":


                    /*Get videos source */
                    $ReupMode = isset($_POST["ReupFromLinkAdd"]) ? trim($_POST["ReupFromLinkAdd"]) : '';
                    if ($ReupMode=="3")
                    {
                        $ChannelID = isset($_POST["ChannelReupMusic"]) ? trim($_POST["ChannelReupMusic"]) : '';
                    }
                    else
                    {
                        $ChannelID = isset($_POST["ChannelIDADD"]) ? trim($_POST["ChannelIDADD"]) : '';
                    }

                    /* == Upload video file for source video==*/
                    $AudioFileName ="";
                    // Tiến hành  upload audio file


                    if($ReupMode == "4")
                    {
                        if ($_FILES['AudioAdd']['size'] > 50000000) {
                            echo "File không được lớn hơn 50mb";
                        }
                        else
                        {
                            // file hợp lệ, tiến hành upload
                            $AudioFileName = basename($_FILES["AudioAdd"]["name"]);
                            $target_path = $destination_pathaudio.$AudioFileName;
                            move_uploaded_file($_FILES['AudioAdd']['tmp_name'], $target_path);
                            $Audio = BASE_PATH . "admin/AudioFile/" . $AudioFileName;
                        }
                        $Value=$Audio;
                    }
                    else {
                        $Value = isset($_POST["url"]) ? trim($_POST["url"]) : '';
                    }
                    $FromSourceVideo ="{\"Source\" : \"$ReupMode\", \"Value\" : \"$Value\"}";
                    /*End Get videos source */
                    /* Get Filter*/
                    $FilterVideoAdd = isset($_POST["FilterVideoAdd"]) ? trim($_POST["FilterVideoAdd"]) : '';
                    $FilterQualityMode = isset($_POST["FilterQualityMode"]) ? trim($_POST["FilterQualityMode"]) : '';
                    $FilterTimeMode = isset($_POST["FilterTimeMode"]) ? trim($_POST["FilterTimeMode"]) : '';
                    $FilterAd = isset($_POST["FilterAdvance"]) ? trim($_POST["FilterAdvance"]) : '';

                    $FilterQuality = isset($_POST["FilterQuality"]) ? trim($_POST["FilterQuality"]) : '';
                    $FilterTime	= isset($_POST["FilterTime"]) ? trim($_POST["FilterTime"]) : '';
                    $FilterAdvance =isset($_POST["filterAdvanceValue"]) ? trim($_POST["filterAdvanceValue"]) : '';
                    $FilterViews = isset($_POST["FilterViewValue"]) ? trim($_POST["FilterViewValue"]) : '';

                    if($FilterVideoAdd =='')
                    {
                        $FilterQuality = '';
                        $FilterTime = '';
                        $FilterAdvance = '';
                        $FilterViews = '';
                    }
                    if($FilterQualityMode == '')
                    {
                        $FilterQuality = '';
                    }
                    if($FilterTimeMode == '')
                    {
                        $FilterTime = '';
                    }
                    if($FilterAd == '')
                    {
                        $FilterAdvance = '';
                        $FilterViews = '';
                    }
                    if ($FilterTime =="")
                    {
                        $FilterTime="0";
                    }
                    $FilterConfig = "{\"FilterQuality\" : \"$FilterQuality\", \"FilterTime\" : \"$FilterTime\", \"FilterAdvance\" : \"$FilterAdvance\" ,\"FilterViews\":\"$FilterViews\"}";


                    /* End Get Filter*/


                    /*End Re-up mode */

                    /*Get Description*/
                    $AddDesFirst = isset($_POST["AddDesFirst"]) ? trim($_POST["AddDesFirst"]) : '';
                    $AddDesEnd= isset($_POST["AddDesEnd"]) ? trim($_POST["AddDesEnd"]) : '';
                    $ReplaceDesFrom = isset($_POST["ReplaceDesFrom"]) ? trim($_POST["ReplaceDesFrom"]) : '';
                    $ReplaceDesTo = isset($_POST["ReplaceDesTo"]) ? trim($_POST["ReplaceDesTo"]) : '';
                    $ReplaceDesAll = isset($_POST["ReplaceDesAll"]) ? trim($_POST["ReplaceDesAll"]) : '';
                    $TranslateDesTo = isset($_POST["TranslateDesTo"]) ? trim($_POST["TranslateDesTo"]) : '';
                    $ReplaceLink = isset($_POST["ReplaceLink"]) ? trim($_POST["ReplaceLink"]) : '';
                    $VideoDescription="{\"AddFirst\" : \"$AddDesFirst\", \"AddEnd\" : \"$AddDesEnd\", \"ReplaceFrom\" : \"$ReplaceDesFrom\" , \"ReplaceTo\" : \"$ReplaceDesTo\", \"AddAll\" : \"$ReplaceDesAll\",\"TranslateTo\" : \"$TranslateDesTo\" ,  \"ReplaceLink\" : \"$ReplaceLink\" }";

                    /*End Get Description*/

                    /*Get Tag*/
                    $AddTagFirst = isset($_POST["AddTagFirst"]) ? trim($_POST["AddTagFirst"]) : '';
                    $AddTagEnd= isset($_POST["AddTagEnd"]) ? trim($_POST["AddTagEnd"]) : '';
                    $ReplaceTagFrom = isset($_POST["ReplaceTagFrom"]) ? trim($_POST["ReplaceTagFrom"]) : '';
                    $ReplaceTagTo = isset($_POST["ReplaceTagTo"]) ? trim($_POST["ReplaceTagTo"]) : '';
                    $ReplaceAllTag = isset($_POST["AddTagAll"]) ? trim($_POST["AddTagAll"]) : '';

                    $TranslateTagTo = isset($_POST["TranslateTagTo"]) ? trim($_POST["TranslateTagTo"]) : '';

                    $VideoTags="{\"AddFirst\" : \"$AddTagFirst\", \"AddEnd\" : \"$AddTagEnd\", \"ReplaceFrom\" : \"$ReplaceTagFrom\" , \"ReplaceTo\" : \"$ReplaceTagTo\", \"AddAll\" : \"$ReplaceAllTag\", \"TranslateTo\" : \"$TranslateTagTo\" }";



                    /*End Get Tag*/
                    $VideoStatus = isset($_POST["PrivacyStatusAdd"]) ? trim($_POST["PrivacyStatusAdd"]) : '';

                    /*Get Title */
                    $AddTitleFirst = isset($_POST["AddTitleFirst"]) ? trim($_POST["AddTitleFirst"]) : '';
                    $AddTitleEnd= isset($_POST["AddTitleEnd"]) ? trim($_POST["AddTitleEnd"]) : '';
                    $ReplaceTitleFrom = isset($_POST["ReplaceTitleFrom"]) ? trim($_POST["ReplaceTitleFrom"]) : '';
                    $ReplaceTitleTo = isset($_POST["ReplaceTitleTo"]) ? trim($_POST["ReplaceTitleTo"]) : '';
                    $ReplaceAllTitle = isset($_POST["ReplaceAllTitle"]) ? trim($_POST["ReplaceAllTitle"]) : '';
                    $TranslateTitleTo = isset($_POST["TranslateTitleTo"]) ? trim($_POST["TranslateTitleTo"]) : '';
                    $VideoTitle="{\"AddFirst\" : \"$AddTitleFirst\", \"AddEnd\" : \"$AddTitleEnd\", \"ReplaceFrom\" : \"$ReplaceTitleFrom\" , \"ReplaceTo\" : \"$ReplaceTitleTo\", \"AddAll\" : \"$ReplaceAllTitle\", \"TranslateTo\" : \"$TranslateTitleTo\" }";

                    /*End get Title*/
                    $VideoCategory =isset($_POST["CategoryAdd"]) ? trim($_POST["CategoryAdd"]) : '';
                    $VideoPosition = isset($_POST["VideoPositionAdd"]) ? trim($_POST["VideoPositionAdd"]) : '';
                    $VideoLanguage = isset($_POST["LanguageAdd"]) ? trim($_POST["LanguageAdd"]) : '';

                    /*get split time*/
                    $FirstMin = isset($_POST["FirstMinAdd"]) ? trim($_POST["FirstMinAdd"]) : '';
                    $FirstSec = isset($_POST["FirstSecAdd"]) ? trim($_POST["FirstSecAdd"]) : '';
                    $EndMin = isset($_POST["EndMinAdd"]) ? trim($_POST["EndMinAdd"]) : '';
                    $EndSec = isset($_POST["EndSecAdd"]) ? trim($_POST["EndSecAdd"]) : '';
                    $First = $FirstMin * 60 + $FirstSec;
                    $End = $EndMin * 60 + $EndSec;
                    $SplitVideo = "{\"First\" : \"$First\", \"End\" : \"$End\"}";
                    /*End get split time*/

                    /*Get Schedule time*/
                    $FromTime = isset($_POST["FromTime"]) ? trim($_POST["FromTime"]) : '';
                    $ToTime = isset($_POST["ToTime"]) ? trim($_POST["ToTime"]) : '';
                    $TotalVideo = isset($_POST["TotalVideo"]) ? trim($_POST["TotalVideo"]) : '';
                    $TimeToPublishVideo = isset($_POST["TimeToPublishVideo"]) ? trim($_POST["TimeToPublishVideo"]) : '';

                    //$ScheduleUpload = "{\"FromTime\" : \"$FromTime\", \"ToTime\" : \"$ToTime\" , \"TotalVideo\": \"$TotalVideo\",  \"TimeToPublishVideo\": \"$TimeToPublishVideo\"}";
                    $ScheduleUpload = "{\"TotalVideo\": \"$TotalVideo\",  \"TimeToPublishVideo\": \"$TimeToPublishVideo\"}";

                    /* End Get Schedule time*/

                    /*Get advance funtion*/
                    $VideoIntroPost = isset($_POST["radioVideoIntro"]) ? trim($_POST["radioVideoIntro"]) : '';
                    $addIntro = isset($_POST["addIntro"]) ? trim($_POST["addIntro"]) : '';


                    $ExtentionFunc ="{\"VideoIntroPost\" : \"$VideoIntroPost\", \"LinkIntro\" : \"$addIntro\"}";

                    /**/
                    /*Upload image*/
                    $FileName ="";
                    $Image="";
                    // Tiến hành code upload
                    if($_FILES['ImageAdd']['name'] != NULL) {
                        if ($_FILES['ImageAdd']['size'] > 50000000) {
                            echo "File không được lớn hơn 1mb";
                        } else {
                            // file hợp lệ, tiến hành upload
                            $file_extention = substr($_FILES['ImageAdd']['name'], strrpos($_FILES['ImageAdd']['name'], '.')+1);
                            $FileName =md5(uniqid()).".".$file_extention;
                            $target_path = $destination_path . $FileName;
                            move_uploaded_file($_FILES['ImageAdd']['tmp_name'], $target_path);
                            if (file_exists($target_path)) {
                                $Image = BASE_PATH . "admin/ImagesReup/" . $FileName;
                            }
                            else
                                $Image ="";
                        }
                    }


                     /*End upload image*/
                    $UserID=$_SESSION["UserId"];
                    if($ReupMode!=3 && isset($_POST["SetThumbnail"])== true) {
                        $IsSetThumbnail = 1;
                    }
                    else
                        $IsSetThumbnail = 0;

                    $Status = 1;
                    $IsAutoSeo = 0;
                    $CreateDate = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"]. " " . $now["hours"]. ":" . $now["minutes"];
                    $this->m_config ->InsertConfig($UserID,$ChannelID,$FromSourceVideo,$Image,$FilterConfig,$VideoTitle,$VideoDescription,$VideoTags,$ExtentionFunc, $VideoStatus,$VideoCategory,$VideoPosition,$VideoLanguage, $SplitVideo,$IsSetThumbnail,$IsAutoSeo, $CreateDate, $Status);
                   header("location: ../controller/c_config.php?controller=config");
                    break;
                /*-----------------------    end add    -------------------*/

                /*-----------------------    delete    -------------------*/
                case "delete":

                    $config = $this->m_config->GetConfig($ID);
                    $imageName = basename($config['Image']);
                    if (file_exists($destination_path.$imageName))
                    {
                        unlink($destination_path.$imageName);

                    }
                    $this->m_config->DeleteConfig($ID);
                    $this->m_config->DeleteVideoDownload($ID);
                    $this->m_config->DeleteDetailSource($ID);
                    header("location: ../controller/c_config.php?controller=config");
                    break;
                /*-----------------------    and delete    -------------------*/
                /*-----------------------    change active    -------------------*/
                case "view_config":
                    $config =$this->m_config->GetConfig($ID);
                    $title="Cấu hình chi tiết";
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
                    if(file_exists('../views/v_view_config.php'))
                    {

                        include '../views/v_view_config.php';
                    }
                    if(file_exists('../views/_layers/l_footer.php'))
                    {
                        require_once("../views/_layers/l_footer.php");
                    }

                    if(file_exists('../views/_layers/l_script.php'))
                    {
                        require_once("../views/_layers/l_script.php");
                    }
                    if(file_exists('../script/config_js.php'))
                    {
                        require_once("../script/config_js.php");
                    }
                    break;
                case "edit_config_view":

                    $config =$this->m_config->GetConfig($ID);

                    $title="Sửa cấu hình";
                  //  print_r($config);
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
                    if(file_exists('../script/config_js.php'))
                    {
                        require_once("../script/config_js.php");
                    }
                    if(file_exists('../views/v_edit_config.php'))
                    {
                        include '../views/v_edit_config.php';
                    }
                    if(file_exists('../views/_layers/l_footer.php'))
                    {
                        require_once("../views/_layers/l_footer.php");
                    }


                    break;
                case "edit_config" :

                        /*Get videos source */
                        $ReupMode = isset($_POST["ReupFromLinkAdd"]) ? trim($_POST["ReupFromLinkAdd"]) : '';

                        /* == Upload video file for source video==*/
                        $AudioFileName ="";
                        // Tiến hành  upload audio file
                        if ($_FILES['AudioAdd']['size'] > 50000000) {
                            echo "File không được lớn hơn 50mb";
                        }
                        else
                        {
                            // file hợp lệ, tiến hành upload
                            $AudioFileName = basename($_FILES["AudioAdd"]["name"]);
                            $target_path = $destination_pathaudio.$AudioFileName;
                            move_uploaded_file($_FILES['AudioAdd']['tmp_name'], $target_path);
                            $Audio = BASE_PATH . "admin/AudioFile/" . $AudioFileName;
                        }

                        if($ReupMode == "4")
                        {
                            $Value=$Audio;
                        }
                        else {
                            $Value = isset($_POST["url"]) ? trim($_POST["url"]) : '';
                        }
                        $FromSourceVideo ="{\"Source\" : \"$ReupMode\", \"Value\" : \"$Value\"}";
                        /*End Get videos source */
                        /* Get Filter*/

                        $FilterVideoAdd = isset($_POST["FilterVideoAdd"]) ? trim($_POST["FilterVideoAdd"]) : '';
                        $FilterQualityMode = isset($_POST["FilterQualityMode"]) ? trim($_POST["FilterQualityMode"]) : '';
                        $FilterTimeMode = isset($_POST["FilterTimeMode"]) ? trim($_POST["FilterTimeMode"]) : '';
                        $FilterAd = isset($_POST["FilterAdvance"]) ? trim($_POST["FilterAdvance"]) : '';

                        $FilterQuality = isset($_POST["FilterQuality"]) ? trim($_POST["FilterQuality"]) : '';
                        $FilterTime	= isset($_POST["FilterTime"]) ? trim($_POST["FilterTime"]) : '';
                        $FilterAdvance =isset($_POST["filterAdvanceValue"]) ? trim($_POST["filterAdvanceValue"]) : '';
                        $FilterViews = isset($_POST["FilterViewValue"]) ? trim($_POST["FilterViewValue"]) : '';

                        if($FilterVideoAdd =='')
                        {
                            $FilterQuality = '';
                            $FilterTime = '';
                            $FilterAdvance = '';
                            $FilterViews = '';
                        }
                        if($FilterQualityMode == '')
                        {
                            $FilterQuality = '';
                        }
                        if($FilterTimeMode == '')
                        {
                            $FilterTime = '';
                        }
                        if($FilterAd == '')
                        {
                            $FilterAdvance = '';
                            $FilterViews = '';
                        }
                        if ($FilterTime =="")
                        {
                            $FilterTime="0";
                        }

                        $FilterConfig = "{\"FilterQuality\" : \"$FilterQuality\", \"FilterTime\" : \"$FilterTime\", \"FilterAdvance\" : \"$FilterAdvance\" ,\"FilterViews\":\"$FilterViews\"}";
                        /* End Get Filter*/


                        /*End Re-up mode */

                        /*Get Description*/
                        $AddDesFirst = isset($_POST["AddDesFirst"]) ? trim($_POST["AddDesFirst"]) : '';
                        $AddDesEnd= isset($_POST["AddDesEnd"]) ? trim($_POST["AddDesEnd"]) : '';
                        $ReplaceDesFrom = isset($_POST["ReplaceDesFrom"]) ? trim($_POST["ReplaceDesFrom"]) : '';
                        $ReplaceDesTo = isset($_POST["ReplaceDesTo"]) ? trim($_POST["ReplaceDesTo"]) : '';
                        $ReplaceDesAll = isset($_POST["ReplaceDesAll"]) ? trim($_POST["ReplaceDesAll"]) : '';
                        $TranslateDesTo = isset($_POST["TranslateDesTo"]) ? trim($_POST["TranslateDesTo"]) : '';
                        $ReplaceLink = isset($_POST["ReplaceLink"]) ? trim($_POST["ReplaceLink"]) : '';
                        $VideoDescription="{\"AddFirst\" : \"$AddDesFirst\", \"AddEnd\" : \"$AddDesEnd\", \"ReplaceFrom\" : \"$ReplaceDesFrom\" , \"ReplaceTo\" : \"$ReplaceDesTo\", \"AddAll\" : \"$ReplaceDesAll\",\"TranslateTo\" : \"$TranslateDesTo\" ,  \"ReplaceLink\" : \"$ReplaceLink\" }";

                        /*End Get Description*/

                        /*Get Tag*/
                        $AddTagFirst = isset($_POST["AddTagFirst"]) ? trim($_POST["AddTagFirst"]) : '';
                        $AddTagEnd= isset($_POST["AddTagEnd"]) ? trim($_POST["AddTagEnd"]) : '';
                        $ReplaceTagFrom = isset($_POST["ReplaceTagFrom"]) ? trim($_POST["ReplaceTagFrom"]) : '';
                        $ReplaceTagTo = isset($_POST["ReplaceTagTo"]) ? trim($_POST["ReplaceTagTo"]) : '';
                        $ReplaceAllTag = isset($_POST["ReplaceAllTag"]) ? trim($_POST["ReplaceAllTag"]) : '';
                        $TranslateTagTo = isset($_POST["TranslateTagTo"]) ? trim($_POST["TranslateTagTo"]) : '';

                        $VideoTags="{\"AddFirst\" : \"$AddTagFirst\", \"AddEnd\" : \"$AddTagEnd\", \"ReplaceFrom\" : \"$ReplaceTagFrom\" , \"ReplaceTo\" : \"$ReplaceTagTo\", \"AddAll\" : \"$ReplaceAllTag\", \"TranslateTo\" : \"$TranslateTagTo\" }";



                        /*End Get Tag*/
                        $VideoStatus = isset($_POST["PrivacyStatusAdd"]) ? trim($_POST["PrivacyStatusAdd"]) : '';

                        /*Get Title */
                        $AddTitleFirst = isset($_POST["AddTitleFirst"]) ? trim($_POST["AddTitleFirst"]) : '';
                        $AddTitleEnd= isset($_POST["AddTitleEnd"]) ? trim($_POST["AddTitleEnd"]) : '';
                        $ReplaceTitleFrom = isset($_POST["ReplaceTitleFrom"]) ? trim($_POST["ReplaceTitleFrom"]) : '';
                        $ReplaceTitleTo = isset($_POST["ReplaceTitleTo"]) ? trim($_POST["ReplaceTitleTo"]) : '';
                        $ReplaceAllTitle = isset($_POST["ReplaceAllTitle"]) ? trim($_POST["ReplaceAllTitle"]) : '';
                        $TranslateTitleTo = isset($_POST["TranslateTitleTo"]) ? trim($_POST["TranslateTitleTo"]) : '';
                        $VideoTitle="{\"AddFirst\" : \"$AddTitleFirst\", \"AddEnd\" : \"$AddTitleEnd\", \"ReplaceFrom\" : \"$ReplaceTitleFrom\" , \"ReplaceTo\" : \"$ReplaceTitleTo\", \"AddAll\" : \"$ReplaceAllTitle\", \"TranslateTo\" : \"$TranslateTitleTo\" }";

                        /*End get Title*/
                        $VideoCategory =isset($_POST["CategoryAdd"]) ? trim($_POST["CategoryAdd"]) : '';
                        $VideoPosition = isset($_POST["VideoPositionAdd"]) ? trim($_POST["VideoPositionAdd"]) : '';
                        $VideoLanguage = isset($_POST["LanguageAdd"]) ? trim($_POST["LanguageAdd"]) : '';

                        /*get split time*/
                        $FirstMin = isset($_POST["FirstMinAdd"]) ? trim($_POST["FirstMinAdd"]) : '';
                        $FirstSec = isset($_POST["FirstSecAdd"]) ? trim($_POST["FirstSecAdd"]) : '';
                        $EndMin = isset($_POST["EndMinAdd"]) ? trim($_POST["EndMinAdd"]) : '';
                        $EndSec = isset($_POST["EndSecAdd"]) ? trim($_POST["EndSecAdd"]) : '';
                        $First = $FirstMin * 60 + $FirstSec;
                        $End = $EndMin * 60 + $EndSec;
                        $SplitVideo = "{\"First\" : \"$First\", \"End\" : \"$End\"}";
                        /*End get split time*/

                        /*Get Schedule time*/
                        $FromTime = isset($_POST["FromTime"]) ? trim($_POST["FromTime"]) : '';
                        $ToTime = isset($_POST["ToTime"]) ? trim($_POST["ToTime"]) : '';
                        $TotalVideo = isset($_POST["TotalVideo"]) ? trim($_POST["TotalVideo"]) : '';
                        $TimeToPublishVideo = isset($_POST["TimeToPublishVideo"]) ? trim($_POST["TimeToPublishVideo"]) : '';

                        //$ScheduleUpload = "{\"FromTime\" : \"$FromTime\", \"ToTime\" : \"$ToTime\" , \"TotalVideo\": \"$TotalVideo\",  \"TimeToPublishVideo\": \"$TimeToPublishVideo\"}";
                        $ScheduleUpload = "{\"TotalVideo\": \"$TotalVideo\",  \"TimeToPublishVideo\": \"$TimeToPublishVideo\"}";

                        /* End Get Schedule time*/

                        /*Get advance funtion*/
                        $VideoIntroPost = isset($_POST["radioVideoIntro"]) ? trim($_POST["radioVideoIntro"]) : '';
                        $addIntro = isset($_POST["addIntro"]) ? trim($_POST["addIntro"]) : '';


                        $ExtentionFunc ="{\"VideoIntroPost\" : \"$VideoIntroPost\", \"LinkIntro\" : \"$addIntro\"}";

                        /**/
                        /*Upload image*/
                        $FileName ="";
                        $Image="";
                        // Tiến hành code upload
                        $imgLoad = isset($_POST["imgLoad"]) ? trim($_POST["imgLoad"]) : '';

                        if($_FILES['ImageAdd']['name'] != NULL) {
                            if ($_FILES['ImageAdd']['size'] > 50000000) {
                                echo "File không được lớn hơn 50mb";
                            } else {
                                // file hợp lệ, tiến hành upload
                                $file_extention = substr($_FILES['ImageAdd']['name'], strrpos($_FILES['ImageAdd']['name'], '.')+1);
                                $FileName =md5(uniqid()).".".$file_extention;
                                $target_path = $destination_path . $FileName;
                                move_uploaded_file($_FILES['ImageAdd']['tmp_name'], $target_path);
                               if (file_exists($target_path)) {
                                   $Image = BASE_PATH . "admin/ImagesReup/" . $FileName;
                               }
                               else
                                   $Image ="";

                            }
                        }
                        elseif ($_FILES['ImageAdd']['name'] == NULL && $imgLoad!="")
                            $Image=$imgLoad;

                        /*End upload image*/
                        $UserID=$_SESSION["UserId"];
                        $Status = 1;
                        $IsAutoSeo = 0;
                        $CreateDate = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"]. " " . $now["hours"]. ":" . $now["minutes"];
                        $config =$this->m_config->GetConfig($ID);
                        $ChannelID = $config['ChannelID'];
                        $source =json_decode($config["FromSourceVideo"], true);
                        if($ReupMode!=3 && isset($_POST["SetThumbnail"])== true) {
                            $IsSetThumbnail = 1;
                        }
                        else
                            $IsSetThumbnail = 0;

                      //  echo $Value;
                       // echo $source['Value'];

                        if($Value!=$source['Value'])
                        {
                          $NextChannelID=  $this->m_config ->InsertConfig($UserID,$ChannelID,$FromSourceVideo,$Image,$FilterConfig,$VideoTitle,$VideoDescription,$VideoTags,$ExtentionFunc, $VideoStatus,$VideoCategory,$VideoPosition,$VideoLanguage, $SplitVideo,$IsSetThumbnail,$IsAutoSeo, $CreateDate, $Status);

                            $imageName = basename($config['Image']);
                            if($imgLoad!=$config['Image']) {
                                if (file_exists($destination_path . $imageName)) {
                                    unlink($destination_path . $imageName);

                                }
                            }
                            $this->m_config->DeleteConfig($ID);
                            $this->m_config->DeleteVideoDownload($ID);
                            $this->m_config->DeleteDetailSource($ID);
//                            $index=$this->m_config->GetMaxConfigID();
                            $this->m_config->UpdateVideoDownloadChannelConfig($NextChannelID,$ID);

                        }
                       else {
                           $this->m_config->UpdateConfig($ID,$UserID, $ChannelID, $FromSourceVideo, $Image, $FilterConfig, $VideoTitle, $VideoDescription, $VideoTags, $ExtentionFunc, $VideoStatus, $VideoCategory, $VideoPosition, $VideoLanguage, $SplitVideo,$IsSetThumbnail, $IsAutoSeo, $CreateDate, $Status);
                       }
                       header("location: ../controller/c_config.php?controller=config");
                        break;
                case "change_active":
                    $Status = $_GET["status"];
                    $this->m_config->ChangeActive($ID, $Status );
                    header("location: ../controller/c_config.php?controller=config");
                    break;
                case "search_config":
                    $arr_user= $this->m_config->GetUserSearch($_SESSION['UserId']);
                    $ChannelID= isset($_POST["ChannelIDSearch"]) ? trim($_POST["ChannelIDSearch"]) : '';
                    $arr_channelSearch = $this->m_config->GetAllChannelSearch($_SESSION["UserId"]);
                    $ChannelIDSearch= isset($_POST["ChannelIDSearch"]) ? trim($_POST["ChannelIDSearch"]) : '';
                    $UserIDSearch= isset($_POST["UserIDSearch"]) ? trim($_POST["UserIDSearch"]) : '';
                    $SearchType =isset($_POST["searchMode"]) ? trim($_POST["searchMode"]) : '';

                    if ($SearchType=="1") {
                        if ($ChannelIDSearch != "") {
                            if ($ChannelIDSearch != "all") {
                                $arr_config = $this->m_config->GetAllConfigSearchByChannel($_SESSION["UserId"], $ChannelIDSearch);
                            } else {
                                $arr_config = $this->m_config->GetAllConfig($_SESSION["UserId"]);
                            }
                        }
                    }
                    else {
                        if ($UserIDSearch != "") {
                            if ($UserIDSearch != "all") {
                                $arr_config = $this->m_config->GetAllConfigSearchByUserID($UserIDSearch);
                            } else {
                                $arr_config = $this->m_config->GetAllConfig($_SESSION["UserId"]);
                            }
                        }

                    }
                    $duplicate_arr_config=$arr_config;

                    $title = "Cấu hình Re-up";

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
                    if(file_exists('../views/v_config.php'))
                    {
                        include '../views/v_config.php';
                    }
                    if(file_exists('../views/_layers/l_footer.php'))
                    {
                        require_once("../views/_layers/l_footer.php");
                    }
                    if(file_exists('../views/_layers/l_script.php'))
                    {
                        require_once("../views/_layers/l_script.php");
                    }
                    if(file_exists('../script/config_js.php'))
                    {
                        require_once("../script/config_js.php");
                    }

                    break;
            }
        }
        else
        {
            $title = "Cấu hình";
            $arr_user= $this->m_config->GetUserSearch($_SESSION['UserId']);
            $arr_channelSearch = $this->m_config->GetAllChannelSearch($_SESSION["UserId"]);
            $duplicate_arr_config=$arr_config = $this->m_config->GetAllConfigSearchByUserID($arr_user[0]['ID']);


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
            if(file_exists('../views/v_config.php'))
            {
                $titleAction = "Cấu hình upload";
                include '../views/v_config.php';
            }
            if(file_exists('../views/_layers/l_footer.php'))
            {
                require_once("../views/_layers/l_footer.php");
            }

            if(file_exists('../views/_layers/l_script.php'))
            {
                require_once("../views/_layers/l_script.php");
            }
            if(file_exists('../script/config_js.php'))
            {
                require_once("../script/config_js.php");
            }
        }

    }
}
$c_config = new c_config();
?>