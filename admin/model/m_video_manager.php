<?php
include '../../config.php';
class m_video_manager extends ConnectionDB
{
    //general

    public function GetAllChannel($UserID)
    {
        if ($_SESSION["Role"] =="1")
        {
            $sql = "SELECT ci.ID,(SELECT UserName FROM tbl_user WHERE ID = ci.AssignToUserID) UserNameAssign, ci.UserID ,ci.ChannelID, ci.TotalVideoUpload,ci.ChannelName,ci.TotalVideoUploaded, (SELECT MAX(UploadDate) From tbl_downloadvideo WHERE ChannelID=ci.ChannelID AND UploadStatus =2)UploadDate, u.UserName,ci.CreateDate,ci.Status from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID";
        }
        elseif  ($_SESSION["Role"] =="2") {
            $sql = "SELECT ci.ID,(SELECT UserName FROM tbl_user WHERE ID = ci.AssignToUserID) UserNameAssign, ci.UserID ,ci.ChannelID, ci.TotalVideoUpload,ci.ChannelName,ci.TotalVideoUploaded, (SELECT MAX(UploadDate) From tbl_downloadvideo WHERE ChannelID=ci.ChannelID AND UploadStatus =2)UploadDate, u.UserName,ci.CreateDate,ci.Status from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID WHERE AssignToUserID ='$UserID' or UserID = '$UserID'";
        }
        else
        {
            $sql = "SELECT ci.ID,(SELECT UserName FROM tbl_user WHERE ID = ci.AssignToUserID) UserNameAssign, ci.UserID ,ci.ChannelID, ci.TotalVideoUpload,ci.ChannelName,ci.TotalVideoUploaded, (SELECT MAX(UploadDate) From tbl_downloadvideo WHERE ChannelID=ci.ChannelID AND UploadStatus =2)UploadDate, u.UserName,ci.CreateDate,ci.Status from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID WHERE AssignToUserID ='$UserID'";
        }
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }
    public function GetToken($ChannelID)
    {
        $sql = "SELECT * FROM `tbl_channelinfo` WHERE `ChannelID`='$ChannelID'";
        $rows = parent::fetch_one($sql);
        return $rows;

    }
    public function UpdateAccessToken($channelID,$accessToken)
    {
        $sql = "UPDATE `tbl_channelinfo` SET `AccessToken`= '$accessToken' WHERE `ChannelID`='$channelID'";
        $row=parent::query($sql);
        return $row;
    }
    public function UpdateRefreshToken($channelID,$refreshToken)
    {
        $sql = "UPDATE `tbl_channelinfo` SET `RefreshToken`= '$refreshToken' WHERE `ChannelID`='$channelID'";
        $row=parent::query($sql);
        return $row;
    }
    public function InsertVideos($ChannelID, $VideoID, $VideoTitle, $VideoThumbnail, $VideoDescription, $NextPage){
        $sql=" INSERT INTO `tbl_video_manager`(`ChannelID`,`VideoID`, `VideoTitle`, `VideoThumbnail`, `VideoDescription`, `NextPage`) VALUES ('$ChannelID', '$VideoID', '$VideoTitle','$VideoThumbnail', '$VideoDescription','$NextPage')";
        $row= parent::query($sql);
      //  print_r($sql)."<br>";
        return $row;

    }
    public function InsertVideoID($ChannelID, $VideoID, $CurrentPage, $Status){
        $sql=" INSERT INTO `tbl_video_manager`(`ChannelID`, `VideoID`, `CurrentPage`, `Status`) VALUES ('$ChannelID', '$VideoID','$CurrentPage', '$Status')";
        $row= parent::query($sql);
        return $row;

    }
    public function GetAllVideos()
    {

       $sql = "SELECT * FROM `tbl_video_manager`";

        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }
    public function GetFileConfig()
    {
        $sql="SELECT * FROM `tbl_fileclientsecret` WHERE `Count` < 50 AND `Status` = 1  LIMIT 0,1";
        $row = parent::fetch_one($sql);
        return  $row;
    }
    public function GetChannel($channelID)
    {
        $sql = "SELECT * FROM `tbl_channelinfo` WHERE `ChannelID`='$channelID'";
        $row=parent::fetch_one($sql);
        return $row;

    }
    public function GetVideo($videoID)
    {
        $sql = "SELECT * FROM `tbl_video_manager` WHERE `VideoID`='$videoID'";
        $row=parent::fetch_one($sql);
        return $row;
    }
    //$id= parent::query_get_id($sql);
    //        return $id;
    public function CheckVideo($videoID)
    {
        $sql = "SELECT * FROM `tbl_video_manager` WHERE `VideoID`='$videoID'";
        $id= parent::query_get_id($sql);
        return $id;
    }
}

?>