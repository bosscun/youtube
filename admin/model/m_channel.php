<?php
include '../../config.php';
class m_channel extends ConnectionDB
{
    //general


    public function GetAllChannel($UserID)
    {
        if ($_SESSION["Role"] =="1")
        {
            $sql = "SELECT ci.ID,(SELECT UserName FROM tbl_user WHERE ID = ci.AssignToUserID) UserNameAssign, ci.UserID ,ci.ChannelID, ci.TotalVideoUpload,ci.ChannelName,ci.TotalVideoUploaded, u.UserName,ci.CreateDate,ci.Status from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID";
        }
        elseif  ($_SESSION["Role"] =="2") {

            $sql = "SELECT ci.ID,(SELECT UserName FROM tbl_user WHERE ID = ci.AssignToUserID) UserNameAssign, ci.UserID ,ci.ChannelID, ci.TotalVideoUpload,ci.ChannelName,ci.TotalVideoUploaded,  u.UserName,ci.CreateDate,ci.Status from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID WHERE AssignToUserID ='$UserID' or UserID = '$UserID'";
        }
        else
        {
            $sql = "SELECT ci.ID,(SELECT UserName FROM tbl_user WHERE ID = ci.AssignToUserID) UserNameAssign, ci.UserID ,ci.ChannelID, ci.TotalVideoUpload,ci.ChannelName,ci.TotalVideoUploaded, u.UserName,ci.CreateDate,ci.Status from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID WHERE AssignToUserID ='$UserID'";
        }

        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }

    public function GetChannelNameSearch($UserID)
    {
        if ($_SESSION["Role"] =="1")
        {
            $sql = "SELECT ci.ID,ci.ChannelID,ci.ChannelName from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID ORDER BY ci.ChannelName  ";
        }
        elseif  ($_SESSION["Role"] =="2") {

            $sql = "SELECT ci.ID,ci.ChannelID,ci.ChannelName from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID  WHERE AssignToUserID ='$UserID' or UserID = '$UserID' ORDER BY ci.ChannelName  ";
        }
        else
        {
            $sql = "SELECT ci.ID,ci.ChannelID,ci.ChannelName from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID WHERE AssignToUserID ='$UserID' ORDER BY ci.ChannelName  ";
        }

        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }

    public function GetAllChannelBySearch($UserID,$ChannelID)
    {
        $sql = "SELECT ci.ID,(SELECT UserName FROM tbl_user WHERE ID = ci.AssignToUserID) UserNameAssign, ci.UserID ,ci.ChannelID, ci.TotalVideoUpload,ci.ChannelName,ci.TotalVideoUploaded, (SELECT MAX(UploadDate) From tbl_downloadvideo WHERE ChannelID=ci.ChannelID AND UploadStatus =2)UploadDate, u.UserName,ci.CreateDate,ci.Status from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID WHERE  ci.ChannelID= '$ChannelID' ";
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }



    public function GetTotalChannel()
    {
        $sql = "SELECT COUNT(ID) TotalChannel FROM `tbl_channelinfo`";
        $row = parent::fetch_one($sql);
        return $row;
    }
    public function GetTotalFileByChannel($FromFile)
    {
        $sql = "SELECT COUNT(ID) TotalFile FROM `tbl_channelinfo` WHERE `FromJsonFile` = '$FromFile'";
        $row = parent::fetch_one($sql);
        return $row;
    }
	/*----select blogs ID*/
	public function GetFileConfig()
	{
		$sql="SELECT * FROM `tbl_fileclientsecret` WHERE `Count` < 50 AND `Status` = 1  LIMIT 0,1";
		$row = parent::fetch_one($sql);

		return  $row;
	}
    public function GetFileConfigByUrl($UrlFile)
	{
		$sql="SELECT * FROM `tbl_fileclientsecret` WHERE `FileUrl` = '$UrlFile' LIMIT 0,1";
		$row = parent::fetch_one($sql);
		return  $row;
	}
    public function GetChannelByID($ID)
    {
        $sql = "SELECT * from tbl_channelinfo WHERE ID = $ID ";
		$row = parent::fetch_one($sql);
		return  $row;
    }
    public function GetChannelEmail($ChannelId)
    {
        $sql = "SELECT * from tbl_useremail WHERE `ChannelId` ='$ChannelId'";
        $row = parent::fetch_one($sql);
        return  $row;
    }

    public function GetTotalVideoUploadByChannelID($ID)
    {
        $sql = "SELECT TotalVideoUpload from tbl_channelinfo WHERE ID = $ID ";
		$row = parent::fetch_one($sql);
		return  $row;

    }
    public function GetSchedulePublicByConfigID($ID)
    {
        $sql = "SELECT * FROM `tbl_schedulepublic` WHERE ChannelInforID = $ID ";
		$rows = ConnectionDB::fetch($sql);
        return $rows;
    }

    public function InsertSchedulePublic($ChannelInforID, $AfterDays, $Hours, $Minutes, $TimeZone, $OrderBy, $Status ){
        $sql="INSERT INTO  `tbl_schedulepublic` (`ChannelInforID`, `AfterDays`, `Hours`, `Minutes`, `TimeZone`, `OrderBy`, `Status` ) VALUES ('$ChannelInforID', '$AfterDays', '$Hours', '$Minutes', '$TimeZone', '$OrderBy', '$Status' )";
        $row= parent::query($sql);
        return $row;

    }
    public function DeleteSchedulePublic($ChannelInforID)
    {
        $sql="DELETE FROM `tbl_schedulepublic` WHERE `ChannelInforID`= '$ChannelInforID'";
        $row= parent::query($sql);
        return $row;

    }
    public function DeleteDetailSource($ChannelConfigID)
    {
        $sql="DELETE FROM `tbl_detailsource` WHERE `ChannelConfigID`='$ChannelConfigID'";
        $row= parent::query($sql);
        return $row;

    }


    public function GetUser($Role ,$CreateUserId)
    {
        if($_SESSION["Role"]=="1") {
            $sql = "SELECT * FROM `tbl_user` WHERE `Role` >'$Role'";
        }
        else{
            $sql = "SELECT * FROM `tbl_user` WHERE `Role` >'$Role' AND `CreateUserId` ='$CreateUserId'";
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

    public function GetChannelSearchByUserID($UserID)
    {
        $sql = "SELECT ci.ID,(SELECT UserName FROM tbl_user WHERE ID = ci.AssignToUserID) UserNameAssign, ci.UserID ,ci.ChannelID, ci.TotalVideoUpload,ci.ChannelName,ci.TotalVideoUploaded, u.UserName,ci.CreateDate,ci.Status from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID WHERE AssignToUserID ='$UserID' or UserID = '$UserID'";
        $rows = ConnectionDB::fetch($sql);
        return $rows;

    }

	public function CheckChannel($ChannelID)
	{
		$sql="SELECT *  FROM `tbl_channelinfo` WHERE `ChannelID`= '$ChannelID'";
		$row = parent::fetch_one($sql);
		return  $row;
	}


    /*---insert country*/
    public function InsertChannel($UserID, $ChannelID, $ChannelName, $AccessToken ,$RefreshToken, $FromJsonFile, $TotalVideoUploaded, $CreateDate, $Status){
        $sql="INSERT INTO `tbl_channelinfo`(`UserID`, `ChannelID`, `ChannelName`, `AccessToken`, `RefreshToken`, `FromJsonFile`, `TotalVideoUploaded` ,`CreateDate`, `Status`) VALUES ($UserID, '$ChannelID', '$ChannelName', '$AccessToken' ,'$RefreshToken', '$FromJsonFile', '$TotalVideoUploaded','$CreateDate', $Status)";
        $id= parent::query_get_id($sql);
        return $id;
    }
    /*---End insert country*/
    /*--Change active country*/
    public function UpdateCountFile($ID,$Count)
    {
        $sql = "UPDATE `tbl_fileclientsecret` SET `Count` = $Count WHERE `ID` = '$ID'";
        $row = parent::query($sql);
        return $row;
    }


    /*---Delete country*/
    public function DeleteChannel($ID)
    {
        $sql="DELETE FROM `tbl_channelinfo` WHERE `ID`= '$ID'";
        $row= parent::query($sql);
        return $row;

    }

    public function DeleteConfigUpload($ChannelID)
    {
        $sql="DELETE FROM `tbl_channelconfig` WHERE ChannelID= '$ChannelID'";
        $row= parent::query($sql);
        return $row;

    }

    public  function  GetUploadConfig($ChannelID)    {
        $sql = "SELECT * FROM `tbl_channelconfig` WHERE `ChannelID` ='$ChannelID'";
        $row = parent::fetch_one($sql);
        return $row;
    }

    public function DeleteVideoDownload($ChannelConfigID)
    {
        $sql="DELETE FROM `tbl_downloadvideo` WHERE `ChannelConfigID` = '$ChannelConfigID'";
        $row= parent::query($sql);
        return $row;

    }


    public function ChangeActive($ID,$Status)
    {
        If ($Status == '0') {
            $sql = "UPDATE `tbl_channelinfo` SET `Status` = 1 WHERE `ID` = '$ID'";
        } else {
            $sql = "UPDATE `tbl_channelinfo` SET `Status` = 0 WHERE `ID` = '$ID'";
        }
        $row = parent::query($sql);
        return $row;
    }

    public function UpdateChannel($ID ,$AssignToUserID)
    {
       $sql = "UPDATE `tbl_channelinfo` SET `AssignToUserID` = '$AssignToUserID'   WHERE `ID` = '$ID'";
       $row = parent::query($sql);
       return $row;
    }

    public function UpdateChannelTotalVideoUpload($ID ,$TotalVideoUpload)
    {
        $sql = "UPDATE `tbl_channelinfo` SET `TotalVideoUpload` = '$TotalVideoUpload'   WHERE `ID` = '$ID'";
        $row = parent::query($sql);
        return $row;
    }
    //
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
    public function GetAllConfig()
    {
        $sql =" SELECT `ID`,`UserID`,`ChannelID` from `tbl_channelconfig`";

        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }
    public function GetAllDetailSource()
    {
        $sql ="SELECT ds.ID, ds.ChannelConfigID, cf.ChannelID,ds.NumberVideos, ds.TotalVideos,  ds.IsGetAllVideos FROM tbl_detailsource ds INNER JOIN tbl_channelconfig cf on cf.ID = ds.ChannelConfigID";

        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }

    public function GetAllDownloadVideo()
    {
        $sql ="SELECT `ID`,`UserID`,`ChannelID`,`ChannelConfigID`,`DonwloadStatus`,`UploadDate` FROM `tbl_downloadvideo` WHERE `UploadStatus` =2";
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }

    public function GetAllDDownloadVideoFail()
    {
        $sql ="SELECT `ID`,`UserID`,`ChannelID`,`ChannelConfigID`,`DonwloadStatus`,`UploadDate` FROM `tbl_downloadvideo` WHERE `UploadStatus` =3 Or `DonwloadStatus`=3";
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }

    public function UpdateChannelName($ID ,$ChannelName)
    {
        $sql = "UPDATE `tbl_channelinfo` SET `ChannelName` = '$ChannelName'   WHERE `ID` = '$ID'";
        $row = parent::query($sql);
        return $row;
    }
    public function InsertChannelEmail($ChannelId,$Email,$PassWord){
        $sql="INSERT INTO `tbl_useremail`(`ChannelId`, `Email`, `PassWord`) VALUES ('$ChannelId', '$Email', '$PassWord')";
        $row= parent::query($sql);
        return $row;

    }
    public function UpdateChannelEmail($ChannelId,$Email,$PassWord){
        $sql="UPDATE `tbl_useremail` SET `Email`='$Email',`PassWord`='$PassWord' WHERE `ChannelId`='$ChannelId'";
        $row= parent::query($sql);
        return $row;
    }


}

?>