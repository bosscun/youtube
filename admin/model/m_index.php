<?php
//include '../../config.php';
include '../../config.php';

class m_index extends ConnectionDB
{

    public function GetTotalChannel()
    {
        $sql = "SELECT COUNT(ID) TotalChannel FROM `tbl_channelinfo`";
        $row = parent::fetch_one($sql);
        return $row;
    }

    public function GetDieChannel()
    {
        $sql = "SELECT COUNT(ID) TotalChannel FROM `tbl_channelinfo` WHERE `Status`=0";
        $row = parent::fetch_one($sql);
        return $row;
    }

    public function GetTotalUser()
    {
        $sql = "SELECT COUNT(ID) From tbl_user ";
        $row = parent::fetch_one($sql);
        return $row;
    }

    public function GetTotalActiveUser()
    {
        $sql = "SELECT * From tbl_user WHERE `IsApprove`= 1 AND `IsBlock`=0";
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }

    public function GetChannelAnalysticForSearch($UserID)
    {
        $sql = "SELECT ci.ChannelID, ca.Report, ca.MonthlyReport, ca.MonthlyReport,ca.RevenueReport,ca.CreateDate FROM tbl_channelinfo ci  INNER JOIN tbl_analystic ca on ci.ChannelID = ca.ChannelID WHERE ci.AssignToUserID ='$UserID' OR ci.UserID = '$UserID'";
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }

    public function GetBlockUser()
    {
        $sql = "SELECT COUNT(ID) From tbl_user WHERE IsApprove=0";
        $row = parent::fetch_one($sql);
        return $row;
    }

    public function GetTotalConfig()
    {
        $sql = "SELECT COUNT(ID) From tbl_channelconfig";
        $row = parent::fetch_one($sql);
        return $row;
    }

    public function GetTotalRevenue()
    {
        $sql = "SELECT RevenueReport FROM `tbl_analystic` WHERE `RevenueReport`!='' and `RevenueReport`!='null'";
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }

    public function GetAllReport()
    {
        $sql = "SELECT * FROM `tbl_analystic`";
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }

}

?>