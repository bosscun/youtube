<?php
include '../../config.php';

class m_donwload_upload extends ConnectionDB
{
	//general

	
	//current page
	public function GetAllDownloadUploadVideo($UserID)
	{

	    if($_SESSION['Role'] =="1") {
            $sql = "SELECT  dv.ID, dv.UserID, cf.ChannelID, ci.ChannelName,ds.TotalVideos, dv.SourceVideo, dv.VideoID, dv.UploadStatus, dv.UploadDate,dv.MessageUpload, dv.DonwloadStatus,dv.MessageDownload, dv.DownloadDate, dv.IsDelete, dv.Status FROM tbl_downloadvideo dv INNER JOIN tbl_channelconfig cf ON dv.ChannelConfigID =cf.ID INNER JOIN tbl_channelinfo ci ON ci.ChannelID = cf.ChannelID INNER JOIN tbl_detailsource ds on ds.ChannelConfigID = dv.ChannelConfigID  AND (dv.DonwloadStatus!=0 )  ";
        }
        elseif ($_SESSION['Role'] =="2")
        {
            $sql ="  SELECT dv.ID, dv.UserID, cf.ChannelID, ci.ChannelName,ds.TotalVideos, dv.SourceVideo, dv.VideoID, dv.UploadStatus, dv.UploadDate,dv.MessageUpload, dv.DonwloadStatus,dv.MessageDownload, dv.DownloadDate, dv.IsDelete, dv.Status FROM tbl_downloadvideo dv INNER JOIN tbl_channelconfig cf ON dv.ChannelConfigID =cf.ID INNER JOIN tbl_channelinfo ci ON ci.ChannelID = cf.ChannelID INNER JOIN tbl_detailsource ds on ds.ChannelConfigID = dv.ChannelConfigID WHERE  dv.UserID ='$UserID' or  ci.UserID='$UserID'  AND (dv.DonwloadStatus!=0 )  ";
        }
        else{
            $sql ="  SELECT dv.ID, dv.UserID, cf.ChannelID, ci.ChannelName,ds.TotalVideos, dv.SourceVideo, dv.VideoID, dv.UploadStatus, dv.UploadDate,dv.MessageUpload, dv.DonwloadStatus,dv.MessageDownload, dv.DownloadDate, dv.IsDelete, dv.Status FROM tbl_downloadvideo dv INNER JOIN tbl_channelconfig cf ON dv.ChannelConfigID =cf.ID INNER JOIN tbl_channelinfo ci ON ci.ChannelID = cf.ChannelID INNER JOIN tbl_detailsource ds on ds.ChannelConfigID = dv.ChannelConfigID WHERE  dv.UserID ='$UserID'  AND (dv.DonwloadStatus!=0 ) ";
        }
		$rows = ConnectionDB::fetch($sql);
		return $rows;
	}
    public function GetVideoSearchByChannel($UserID,$ChannelID)
    {

        if($_SESSION['Role'] =="1") {
            $sql = "SELECT dv.ID, dv.UserID, cf.ChannelID, ci.ChannelName,ds.TotalVideos, dv.SourceVideo, dv.VideoID, dv.UploadStatus, dv.UploadDate,dv.MessageUpload, dv.DonwloadStatus,dv.MessageDownload, dv.DownloadDate, dv.IsDelete, dv.Status FROM tbl_downloadvideo dv INNER JOIN tbl_channelconfig cf ON dv.ChannelConfigID =cf.ID INNER JOIN tbl_channelinfo ci ON ci.ChannelID = cf.ChannelID INNER JOIN tbl_detailsource ds ON cf.ID = ds.ChannelConfigID WHERE dv.ChannelID = '$ChannelID' AND (dv.DonwloadStatus!=0 )";
        }
        elseif ($_SESSION['Role'] =="2")
        {
            $sql ="SELECT dv.ID, dv.UserID, cf.ChannelID, ci.ChannelName,(Select TotalVideos FROM tbl_detailsource WHERE tbl_detailsource.ChannelConfigID =dv.ChannelConfigID ) TotalVideos, dv.SourceVideo, dv.VideoID, dv.UploadStatus, dv.UploadDate,dv.MessageUpload, dv.DonwloadStatus,dv.MessageDownload, dv.DownloadDate, dv.IsDelete, dv.Status FROM tbl_downloadvideo dv INNER JOIN tbl_channelconfig cf ON dv.ChannelConfigID =cf.ID INNER JOIN tbl_channelinfo ci ON ci.ChannelID = cf.ChannelID WHERE ( dv.UserID ='$UserID' or  ci.UserID='$UserID') AND (dv.DonwloadStatus!=0 )  AND cf.ChannelID='$ChannelID'";
        }
        else{
            $sql ="SELECT dv.ID, dv.UserID, cf.ChannelID, ci.ChannelName,(Select TotalVideos FROM tbl_detailsource WHERE tbl_detailsource.ChannelConfigID =dv.ChannelConfigID ) TotalVideos, dv.SourceVideo, dv.VideoID, dv.UploadStatus, dv.UploadDate,dv.MessageUpload, dv.DonwloadStatus,dv.MessageDownload, dv.DownloadDate, dv.IsDelete, dv.Status FROM tbl_downloadvideo dv INNER JOIN tbl_channelconfig cf ON dv.ChannelConfigID =cf.ID INNER JOIN tbl_channelinfo ci ON ci.ChannelID = cf.ChannelID WHERE dv.UserID ='$UserID' and  cf.ChannelID='$ChannelID' AND (dv.DonwloadStatus!=0 )";
        }
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }

    public function GetVideoSearchByUserID($UserID)
    {
        $sql ="SELECT dv.ID, dv.UserID, cf.ChannelID, ci.ChannelName,(Select TotalVideos FROM tbl_detailsource WHERE tbl_detailsource.ChannelConfigID =dv.ChannelConfigID ) TotalVideos, dv.SourceVideo, dv.VideoID, dv.UploadStatus, dv.UploadDate,dv.MessageUpload, dv.DonwloadStatus,dv.MessageDownload, dv.DownloadDate, dv.IsDelete, dv.Status FROM tbl_downloadvideo dv INNER JOIN tbl_channelconfig cf ON dv.ChannelConfigID =cf.ID INNER JOIN tbl_channelinfo ci ON ci.ChannelID = cf.ChannelID WHERE ( dv.UserID ='$UserID' or  ci.UserID='$UserID') AND (dv.DonwloadStatus!=0 )";
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }

    public function ChangeActive($ID, $Status)
    {
        If ($Status == '0')
        { $sql="UPDATE `tbl_downloadvideo` SET `Status` = 1 WHERE `ID` = '$ID'";
        }
        else {
            $sql="UPDATE `tbl_downloadvideo` SET `Status` = 0 WHERE `ID` = '$ID'";
        }
        $row= parent::query($sql);
        return $row;
    }
    public function UpdateStatus($ID)    {

        $sql="UPDATE `tbl_downloadvideo` SET `UploadStatus` = 0, `DonwloadStatus`= 0 WHERE `ID` = '$ID'";
        $row= parent::query($sql);
        return $row;
    }
    public function GetAllTotalVideoUpload()
    {
        $sql =" SELECT TotalVideoUpload FROM `tbl_channelinfo` WHERE TotalVideoUpload  IS NOT NULL";
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }

    public function GetAllVideoUploadStatus()
    {
        $sql =" SELECT * from tbl_downloadvideo WHERE UploadStatus =2";
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }
    public function GetChannelSearch($UserID)
    {
        if ($_SESSION["Role"] =="1")
        {
            $sql = "SELECT ci.ID,ci.ChannelID,ci.ChannelName from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID ORDER  BY ci.ChannelName ";
        }
        elseif  ($_SESSION["Role"] =="2") {

            $sql = "SELECT ci.ID,ci.ChannelID,ci.ChannelName from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID  WHERE AssignToUserID ='$UserID' or UserID = '$UserID' ORDER  BY ci.ChannelName";
        }
        else
        {
            $sql = "SELECT ci.ID,ci.ChannelID,ci.ChannelName from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID WHERE AssignToUserID ='$UserID' ORDER  BY ci.ChannelName";
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


}
?>