<?php
    include '../../config.php';

    class m_channel_analytics extends ConnectionDB
    {
        //general

        public function GetAllChannelReport()
        {
            $sql = "SELECT ca.Report, ca.MonthlyReport, ca.RevenueReport, ca.CreateDate,ca.ChannelID , ci.ChannelName, (Select cu.UserName from tbl_user cu WHERE cu.ID=ci.UserID )CreateUser ,(Select cu.UserName from tbl_user cu WHERE cu.ID=ci.AssignToUserID )AssignToUser FROM `tbl_analystic` ca INNER JOIN tbl_channelinfo ci  ON ca.ChannelID=ci.ChannelID ";
            $rows = ConnectionDB::fetch($sql);
            return $rows;
        }

        public function GetUserSearch($ID)
        {
            if ($_SESSION['Role'] == 1) {
                $sql = "SELECT * FROM `tbl_user` ORDER BY `UserName`";
            } else {
                $sql = "SELECT * FROM `tbl_user` WHERE `ID`='$ID' or `CreateUserId`='$ID' ORDER BY `UserName`";
            }
            $rows = ConnectionDB::fetch($sql);
            return $rows;
        }

        public function GetChannelNameSearch($UserID)
        {
            if ($_SESSION["Role"] == "1") {
                $sql = "SELECT ci.ID,ci.ChannelID,ci.ChannelName from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID ORDER BY ci.ChannelName  ";
            } elseif ($_SESSION["Role"] == "2") {

                $sql = "SELECT ci.ID,ci.ChannelID,ci.ChannelName from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID  WHERE AssignToUserID ='$UserID' or UserID = '$UserID' ORDER BY ci.ChannelName  ";
            } else {
                $sql = "SELECT ci.ID,ci.ChannelID,ci.ChannelName from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID WHERE AssignToUserID ='$UserID' ORDER BY ci.ChannelName  ";
            }

            $rows = ConnectionDB::fetch($sql);
            return $rows;
        }

        public function GetChannelByUserID($UserID)
        {
            if ($_SESSION["Role"] == "1") {
                $sql = "SELECT ci.ID,ci.ChannelID,ci.ChannelName from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID ORDER BY ci.ChannelName  ";
            } elseif ($_SESSION["Role"] == "2") {

                $sql = "SELECT ci.ID,ci.ChannelID,ci.ChannelName from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID  WHERE AssignToUserID ='$UserID' or UserID = '$UserID' ORDER BY ci.ChannelName  ";
            } else {
                $sql = "SELECT ci.ID,ci.ChannelID,ci.ChannelName from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID WHERE AssignToUserID ='$UserID' ORDER BY ci.ChannelName  ";
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

        //DELETE FROM `tbl_analystic` WHERE `ChannelID`

        public function DeleteChannelAnalytics($ChannelID)
        {
            $sql = "DELETE FROM `tbl_analystic` WHERE `ChannelID`='$ChannelID'";
            $row = parent::query($sql);
            return $row;

        }

        public function GetAllChannel($UserID)
        {
            if ($_SESSION["Role"] == "1") {
                $sql = "SELECT ci.ID,(SELECT UserName FROM tbl_user WHERE ID = ci.AssignToUserID) UserNameAssign, ci.UserID ,ci.ChannelID, ci.TotalVideoUpload,ci.ChannelName,ci.TotalVideoUploaded, u.UserName,ci.CreateDate,ci.Status from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID";
            } elseif ($_SESSION["Role"] == "2") {

                $sql = "SELECT ci.ID,(SELECT UserName FROM tbl_user WHERE ID = ci.AssignToUserID) UserNameAssign, ci.UserID ,ci.ChannelID, ci.TotalVideoUpload,ci.ChannelName,ci.TotalVideoUploaded,  u.UserName,ci.CreateDate,ci.Status from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID WHERE AssignToUserID ='$UserID' or UserID = '$UserID'";
            } else {
                $sql = "SELECT ci.ID,(SELECT UserName FROM tbl_user WHERE ID = ci.AssignToUserID) UserNameAssign, ci.UserID ,ci.ChannelID, ci.TotalVideoUpload,ci.ChannelName,ci.TotalVideoUploaded, u.UserName,ci.CreateDate,ci.Status from tbl_channelinfo ci INNER JOIN tbl_user u on u.ID = ci.UserID WHERE AssignToUserID ='$UserID'";
            }

            $rows = ConnectionDB::fetch($sql);
            return $rows;
        }

        public function GetChanelReport($ChannelID)
        {
            $sql = "SELECT * FROM `tbl_analystic` Where `ChannelID`='$ChannelID' ";
            $rows = ConnectionDB::fetch($sql);
            return $rows;
        }
    }

?>