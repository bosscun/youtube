<?php
include '../../config.php';
class m_upload_file extends ConnectionDB
{
    //general


    public function GetAllFile()
    {
        $sql = "SELECT  `ID`, `FileName`, `FileUrl`, `Status` FROM  `tbl_fileclientsecret` ORDER BY ID DESC";
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }
	/*----select file ID*/

    public function GetFile($ID)
    {
        $sql = "SELECT  `ID`, `FileName`, `FileUrl`, `Status` FROM  `tbl_fileclientsecret` WHERE `ID`='$ID'";
        $rows = parent::fetch_one($sql);
        return $rows;
    }
    /*---insert country*/
    public function InsertFile($FileName, $FileUrl, $Count, $Status){
        $sql="INSERT INTO `tbl_fileclientsecret`(`FileName`, `FileUrl`, `Count`, `Status`) VALUES ('$FileName', '$FileUrl', $Count, $Status)";
        $row= parent::query($sql);
        return $row;

    }
    /*---End insert country*/

    /*---Delete country*/
    public function DeleteFile($ID)
    {
        $sql="DELETE FROM `tbl_fileclientsecret` WHERE `ID`= '$ID'";
        $row= parent::query($sql);
        return $row;

    }
    /*---End Delete country*/

    /*--Change active country*/
    public function ChangeActive($ID,$Status)
    {
        If ($Status == '0') {
            $sql = "UPDATE `tbl_fileclientsecret` SET `Status` = 1 WHERE `ID` = '$ID'";
        } else {
            $sql = "UPDATE `tbl_fileclientsecret` SET `Status` = 0 WHERE `ID` = '$ID'";
        }
        $row = parent::query($sql);
        return $row;
    }



}

?>