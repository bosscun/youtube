<?php
include '../../config.php';
class m_config extends ConnectionDB
{

    /*Get all config*/

    public  function  GetAllConfig( $UserID)    {
        if ($_SESSION["Role"] =="1") {

            $sql = "SELECT cf.ID , cf.ChannelID,ci.ChannelName, cf.FromSourceVideo,cf.CreateDate, cf.UserID,u.UserName, cf.Status ,(SELECT TotalVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)TotalVideos,(SELECT NumberVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)NumberVideos ,(SELECT IsGetAllVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)IsGetAllVideos  from tbl_channelconfig cf INNER JOIN tbl_user u on cf.UserID=u.ID INNER JOIN tbl_channelinfo ci on cf.ChannelID=ci.ChannelID";
        }
       elseif  ($_SESSION["Role"] =="2") {

           $sql = "SELECT cf.ID , cf.ChannelID,ci.ChannelName, cf.FromSourceVideo,cf.CreateDate, cf.UserID,u.UserName, cf.Status ,(SELECT TotalVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)TotalVideos,(SELECT NumberVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)NumberVideos ,(SELECT IsGetAllVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)IsGetAllVideos  from tbl_channelconfig cf INNER JOIN tbl_user u on cf.UserID=u.ID INNER JOIN tbl_channelinfo ci on cf.ChannelID=ci.ChannelID WHERE  cf.UserID='$UserID' or ( ci.AssignToUserID =cf.UserID)";
        }
        else
        {
            $sql = "SELECT cf.ID , cf.ChannelID,ci.ChannelName, cf.FromSourceVideo,cf.CreateDate, cf.UserID,u.UserName, cf.Status ,(SELECT TotalVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)TotalVideos,(SELECT NumberVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)NumberVideos ,(SELECT IsGetAllVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)IsGetAllVideos  from tbl_channelconfig cf INNER JOIN tbl_user u on cf.UserID=u.ID INNER JOIN tbl_channelinfo ci on cf.ChannelID=ci.ChannelID WHERE  cf.UserID='$UserID'";
        }
        $rows = ConnectionDB::fetch($sql);
        return $rows;

    }

    public  function  GetAllConfigSearchByChannel($UserID,$ChannelID)    {
        if ($_SESSION["Role"] =="1") {

            $sql = "SELECT cf.ID , cf.ChannelID,ci.ChannelName, cf.FromSourceVideo,cf.CreateDate, cf.UserID,u.UserName, cf.Status ,(SELECT TotalVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)TotalVideos,(SELECT NumberVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)NumberVideos ,(SELECT IsGetAllVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)IsGetAllVideos  from tbl_channelconfig cf INNER JOIN tbl_user u on cf.UserID=u.ID INNER JOIN tbl_channelinfo ci on cf.ChannelID=ci.ChannelID WHERE cf.ChannelID='$ChannelID'";
        }
        elseif  ($_SESSION["Role"] =="2") {

            $sql = "SELECT cf.ID , cf.ChannelID,ci.ChannelName, cf.FromSourceVideo,cf.CreateDate, cf.UserID,u.UserName, cf.Status ,(SELECT TotalVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)TotalVideos,(SELECT NumberVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)NumberVideos ,(SELECT IsGetAllVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)IsGetAllVideos  from tbl_channelconfig cf INNER JOIN tbl_user u on cf.UserID=u.ID INNER JOIN tbl_channelinfo ci on cf.ChannelID=ci.ChannelID WHERE ( cf.UserID='$UserID' or ( ci.AssignToUserID =cf.UserID)) AND cf.ChannelID='$ChannelID'";
        }
        else
        {
            $sql = "SELECT cf.ID , cf.ChannelID,ci.ChannelName, cf.FromSourceVideo,cf.CreateDate, cf.UserID,u.UserName, cf.Status ,(SELECT TotalVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)TotalVideos,(SELECT NumberVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)NumberVideos ,(SELECT IsGetAllVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)IsGetAllVideos  from tbl_channelconfig cf INNER JOIN tbl_user u on cf.UserID=u.ID INNER JOIN tbl_channelinfo ci on cf.ChannelID=ci.ChannelID WHERE  cf.UserID ='$UserID' AND cf.ChannelID='$ChannelID'";
        }

        $rows = ConnectionDB::fetch($sql);
        return $rows;

    }

    public  function  GetAllConfigSearchByUserID($UserID)    {

        $sql = "SELECT cf.ID , cf.ChannelID,ci.ChannelName, cf.FromSourceVideo,cf.CreateDate, cf.UserID,u.UserName, cf.Status ,(SELECT TotalVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)TotalVideos,(SELECT NumberVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)NumberVideos ,(SELECT IsGetAllVideos from tbl_detailsource ds WHERE ds.ChannelConfigID=cf.ID)IsGetAllVideos  from tbl_channelconfig cf INNER JOIN tbl_user u on cf.UserID=u.ID INNER JOIN tbl_channelinfo ci on cf.ChannelID=ci.ChannelID WHERE cf.UserID='$UserID'";
        $rows = ConnectionDB::fetch($sql);
        return $rows;

    }
    public  function  GetUser($ID)    {
        $sql = "SELECT * FROM `tbl_user` WHERE `ID` = '$ID' and `IsApprove` = 1 and `IsBlock` = 0";
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }


    /*Get all channel*/
    public  function  GetAllChannelReupChannel($UserID)
    {
        if ($_SESSION["Role"]=="1")
        {
            $sql = "SELECT  * FROM tbl_channelinfo ci WHERE  TotalVideoUpload IS NOT NULL  AND (ci.UserID='$UserID' AND ci.AssignToUserID IS NULL ) AND ci.AssignToUserID IS NULL ORDER BY ci.ChannelName";
        }
        elseif($_SESSION["Role"]=="2")
        {
            $sql = "SELECT  * FROM tbl_channelinfo ci WHERE TotalVideoUpload IS NOT NULL  AND (ci.UserID= '$UserID' AND ci.AssignToUserID Is NULL) OR (ci.AssignToUserID ='$UserID') ORDER BY ci.ChannelName";
        }
        else
        {
            $sql = "SELECT  * FROM tbl_channelinfo ci WHERE TotalVideoUpload IS NOT NULL  AND `AssignToUserID`= '$UserID' ORDER BY ci.ChannelName";
        }

        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }

    public  function  GetAllChannelReupMusic($UserID)
    {
        if ($_SESSION["Role"]=="1")
        {
            $sql = "SELECT  * FROM tbl_channelinfo ci WHERE  TotalVideoUpload IS NOT NULL  AND (ci.UserID='$UserID' AND ci.AssignToUserID IS NULL )AND ci.AssignToUserID IS NULL ORDER BY ci.ChannelName";
        }
        elseif($_SESSION["Role"]=="2")
        {
            $sql = "SELECT  * FROM tbl_channelinfo ci WHERE TotalVideoUpload IS NOT NULL  AND (ci.UserID= '$UserID' AND ci.AssignToUserID Is NULL) oR (ci.AssignToUserID ='$UserID') ORDER BY ci.ChannelName";
        }
        else
        {
            $sql = "SELECT  * FROM tbl_channelinfo ci WHERE TotalVideoUpload IS NOT NULL  AND `AssignToUserID`= '$UserID' ORDER BY ci.ChannelName";
        }

        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }

    public function GetAllChannelSearch($UserID)
    {
        if ($_SESSION["Role"]=="1")
        {

            $sql = "SELECT  * FROM tbl_channelinfo ci WHERE  TotalVideoUpload IS NOT NULL  ORDER BY ci.ChannelName";
        }
        elseif($_SESSION["Role"]=="2") {

            $sql = "SELECT  * FROM tbl_channelinfo ci WHERE (TotalVideoUpload IS NOT NULL  AND `UserID`= '$UserID') OR (`TotalVideoUpload` IS NOT NULL  AND `AssignToUserID` ='$UserID')  ORDER BY ci.ChannelName";
        }
        else
        {
            $sql = "SELECT  * FROM tbl_channelinfo ci  WHERE TotalVideoUpload IS NOT NULL  AND `UserID`= '$UserID'  ORDER BY ci.ChannelName";

        }
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }

    public function GetUserSearch($ID)
    {
        if($_SESSION['Role']==1)
        {
            $sql = "SELECT * FROM `tbl_user` ORDER BY `UserName`";
        }
        else
        {
            $sql = "SELECT * FROM `tbl_user` WHERE `ID`='$ID' or `CreateUserId`='$ID' ORDER BY `UserName`";
        }
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }
    /*---insert Config */
    public function InsertConfig($UserID,$ChannelID,$FromSourceVideo,$Image,$FilterConfig,$VideoTitle,$VideoDescription,$VideoTags,$ExtentionFunc,$VideoStatus,$VideoCategory,$VideoPosition,$VideoLanguage,$SplitVideo, $IsSetThumbnail,$IsAutoSeo, $CreateDate, $Status)
    {
        $sql="INSERT INTO `tbl_channelconfig`(`UserID`,`ChannelID`,`FromSourceVideo`,`Image`,`FilterConfig`,`VideoTitle`,`VideoDescription`,`VideoTags`,`ExtentionFunc`,`VideoStatus`, `VideoCategory`, `VideoPosition`,`VideoLanguage`,`SplitVideo`,`IsSetThumbnail`, `IsAutoSeo`,`CreateDate`, `Status`) VALUES ('$UserID','$ChannelID','$FromSourceVideo','$Image','$FilterConfig','$VideoTitle','$VideoDescription','$VideoTags','$ExtentionFunc','$VideoStatus' ,'$VideoCategory','$VideoPosition','$VideoLanguage','$SplitVideo',$IsSetThumbnail,'$IsAutoSeo','$CreateDate','$Status')";
        $id= parent::query_get_id($sql);
        return $id;

    }
    public function UpdateConfig($ID,$UserID,$ChannelID,$FromSourceVideo,$Image,$FilterConfig,$VideoTitle,$VideoDescription,$VideoTags,$ExtentionFunc,$VideoStatus,$VideoCategory,$VideoPosition,$VideoLanguage,$SplitVideo,$IsSetThumbnail, $IsAutoSeo, $CreateDate, $Status)
    {
        $sql="UPDATE `tbl_channelconfig` SET `UserID`='$UserID',`ChannelID`='$ChannelID',`FromSourceVideo`='$FromSourceVideo',`Image`='$Image',`FilterConfig`='$FilterConfig',`VideoTitle`='$VideoTitle',`VideoDescription`='$VideoDescription',`VideoTags`='$VideoTags',`ExtentionFunc`='$ExtentionFunc',`VideoStatus`='$VideoStatus',`VideoCategory`='$VideoCategory',`VideoPosition`='$VideoPosition',`VideoLanguage`='$VideoLanguage',`SplitVideo`='$SplitVideo',`IsSetThumbnail`=$IsSetThumbnail,`IsAutoSeo`='$IsAutoSeo',`CreateDate`='$CreateDate',`Status`='$Status' WHERE `ID`='$ID'";
        $row= parent::query($sql);
        return $row;
    }

    public function DeleteConfig($ID)
    {
        $sql=" DELETE FROM `tbl_channelconfig` WHERE `ID`= '$ID'";
        $row= parent::query($sql);
        return $row;

    }

    public function DeleteVideoDownload($ChannelConfigID)
    {
        $sql=" DELETE FROM `tbl_downloadvideo` WHERE `ChannelConfigID` ='$ChannelConfigID' AND `UploadStatus`!=2";
        $row= parent::query($sql);
        return $row;

    }

    public function DeleteDetailSource($ChannelConfigID)
    {
        $sql=" DELETE FROM `tbl_detailsource` WHERE `ChannelConfigID` ='$ChannelConfigID'";
        $row= parent::query($sql);
        return $row;

    }

    public function GetMaxConfigID()
    {
        $sql = "SELECT MAX(ID)  FROM `tbl_channelconfig`";
        $row = parent::fetch_one($sql);
        return $row;
    }
    public function UpdateVideoDownloadChannelConfig($IDNew, $IDOld)    {

        $sql = "UPDATE `tbl_downloadvideo` SET `ChannelConfigID`=$IDNew WHERE ChannelConfigID=$IDOld";
        $row=parent::query($sql);
        return $row;

    }

    public function ChangeActive($ID, $Status)
    {

        If ($Status == '0')
        { $sql="UPDATE `tbl_channelconfig` SET `Status` = 1 WHERE `ID` = '$ID'";
        }
        else {
            $sql="UPDATE `tbl_channelconfig` SET `Status` = 0 WHERE `ID` = '$ID'";
        }
        $row= parent::query($sql);
        return $row;
    }
    public function GetConfig($ID)
    {
        $sql = "SELECT cf.UserID,(SELECT UserName from tbl_user WHERE ID=cf.UserID)UserName, cf.ChannelID, (Select DISTINCT ChannelName FROM tbl_channelinfo WHERE ChannelID=cf.ChannelID)ChannelName , cf.Image,cf.FromSourceVideo,cf.Image,cf.FilterConfig,cf.VideoTitle,cf.VideoDescription,cf.VideoTags,cf.ExtentionFunc,cf.VideoStatus, cf.VideoCategory,cf.VideoPosition, cf.VideoLanguage, cf.SplitVideo ,cf.IsSetThumbnail FROM tbl_channelconfig cf  WHERE  cf.ID='$ID'";
        $rows = parent::fetch_one($sql);
        return $rows;
    }

    public function GetAllTotalVideoUpload($UserID)
    {
        $sql =" SELECT TotalVideoUpload FROM tbl_channelconfig cf INNER JOIN tbl_channelinfo ci WHERE cf.ChannelID= ci.ChannelID AND cf.UserID='$UserID'";
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }
    public function GetAllVideoUploadStatus()
    {
        $sql =" SELECT * from tbl_downloadvideo WHERE UploadStatus =2";
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }
}
?>