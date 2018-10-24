<?php
include '../../config.php';
class m_user extends ConnectionDB
{

    public function SelectGroup()
    {
        $sql="SELECT `ID`, `GroupName`, `UserIdCreate`, `CreateDate`, `Status` FROM `tbl_group`";
        $row = ConnectionDB::fetch($sql);
        return  $row;

    }
    public function SelectGroupByID($GroupID)
    {
        $sql = "SELECT g.GroupName FROM tbl_user u INNER JOIN tbl_group g WHERE G.ID = '$GroupID' ";
        $row = parent::fetch_one($sql);
        return $row;

    }

    public function GetAllUser($UserID)
    {
        if($_SESSION['Role']=="1")
        {
            $sql = "SELECT u.ID, u.UserName,u.VPSIP, u.PassWord,  u.FullName, u.PhoneNumber, u.Role,(SELECT UserName FROM tbl_user WHERE ID =u.CreateUserId ) CreateUser, u.CreateDate, u.IsApprove, u.IsBlock FROM tbl_user  u";
        }
        else{
            $sql = "SELECT u.ID, u.UserName,u.VPSIP, u.PassWord,  u.FullName, u.PhoneNumber, u.Role,(SELECT UserName FROM tbl_user WHERE ID =u.CreateUserId ) CreateUser, u.CreateDate, u.IsApprove, u.IsBlock FROM tbl_user  u WHERE u.CreateUserId='$UserID'";
        }
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }
    public function GetAllLeader()
    {
        $sql = "SELECT * FROM `tbl_user`  WHERE `Role`!='3' ";
        $rows = ConnectionDB::fetch($sql);
        return $rows;
    }
	
	/*----select User  ID*/
	public function SelectUser($Id)
	{
		$sql="SELECT * FROM `tbl_user` Where `Id`= '$Id'";
		$row = parent::fetch_one($sql);
		return  $row;
			
	}
	
	/*----End select User ID*/

	/*---update User */
	public function EditUser($ID,$UserName,$PassWord,$FullName,$PhoneNumber,$Role)
	{
	    if($PassWord!="") {
            $sql = "UPDATE `tbl_user` SET `UserName` = '$UserName', `PassWord` = '$PassWord', `FullName` = '$FullName',   `PhoneNumber` = '$PhoneNumber' , `Role`='$Role' WHERE `ID`=$ID";
        }
        else
        {
            $sql = "UPDATE `tbl_user` SET `UserName` = '$UserName',  `FullName` = '$FullName',   `PhoneNumber` = '$PhoneNumber' , `Role`='$Role' WHERE `ID`=$ID";
        }
      
		$row=parent::query($sql);
		return $row;

	}
	//UPDATE `tbl_user` SET `VPSIP` = '12' WHERE `tbl_user`.`ID` = 1;
    public function AssignVPS($Id,$Ip)
    {
        $sql="UPDATE `tbl_user` SET `VPSIP` = '$Ip' WHERE `ID` = '$Id'";
        $row=parent::query($sql);
        return $row;
    }
	
	/*---End update User*/

	/*---insert User*/
	public function InsertUser($UserName,$PassWord,$FullName,$PhoneNumber,$Role,$CreateUserId,$CreateDate,$IsApprove,$IsBlock)
	{
		$sql="INSERT INTO `tbl_user`(`UserName`, `PassWord`,  `FullName`, `PhoneNumber`, `Role`, `CreateUserId`, `CreateDate`, `IsApprove`, `IsBlock`) VALUES ('$UserName','$PassWord','$FullName','$PhoneNumber','$Role','$CreateUserId','$CreateDate','$IsApprove','$IsBlock')";
		$row= parent::query($sql);
		print_r($sql);
		return $row;
	}



	public function DeleteUser($ID)
	{
		$sql="DELETE FROM `tbl_user` WHERE `ID` = '$ID'";
		$row= parent::query($sql);
		return $row;

	}

    public function DeleteChanel($ID)
    {
        $sql="DELETE FROM `tbl_channelinfo` WHERE `UserID` = '$ID'";
        $row= parent::query($sql);
        return $row;

    }

    public function DeleteChannelConfig($ID)
    {
        $sql="DELETE FROM `tbl_channelconfig` WHERE `UserID` = '$ID'";
        $row= parent::query($sql);
        return $row;

    }
    public function VideoDownloadByUserID($UserID)
    {
        $sql="DELETE FROM `tbl_channelconfig` WHERE `UserID` = '$UserID'";
        $row= parent::query($sql);
        return $row;

    }
    public function DeleteDetailSourceByUserID($UserID)
    {
        $sql="DELETE FROM `tbl_channelconfig` WHERE `UserID` = '$UserID'";
        $row= parent::query($sql);
        return $row;

    }
	/*--Change user password-*/
	public function ChangeAssignUser($Id,$CreateUserID)
	{
		$sql="UPDATE `tbl_user` SET `CreateUserId`=$CreateUserID Where `Id`=$Id";
		$row=parent::query($sql);
		return $row;
	}
	/*--End Change user password */
	
	/*--Change user permission*/	
	public function ChangeUserPer($Id, $UserPermission)
	{
		$sql="UPDATE `tbl_user` SET `UserPermission`=$UserPermission Where `Id`=$Id";
		$row=parent::query($sql);
		return $row;
	}
	
	/*--End Change user permission*/
	/*--Change active User*/
	public function ChangeActive($ID, $IsBlock)
	{
		If ($IsBlock == '0')
		{ $sql="UPDATE `tbl_user` SET `IsBlock` = 1 WHERE `ID` = '$ID'";
		}
		else {
			$sql="UPDATE `tbl_user` SET `IsBlock` = 0 WHERE `ID` = '$ID'";
		}
		$row= parent::query($sql);
		return $row;
	}

    public function ChangeApprove($ID, $IsApprove)
    {
        If ($IsApprove == '0')
        { $sql="UPDATE `tbl_user` SET `IsApprove` = 1 WHERE `ID` = '$ID'";
        }
        else {
            $sql="UPDATE `tbl_user` SET `IsApprove` = 0 WHERE `ID` = '$ID'";
        }
        $row= parent::query($sql);
        return $row;
    }

    public  function  GetGroupID($ID)    {
        $sql = "SELECT *  FROM `tbl_user` WHERE `ID`='$ID'";
        $rows = parent::fetch_one($sql);
        return $rows;
    }

    public function CheckUser($username)
    {
        $sql="SELECT * FROM `tbl_user` WHERE `UserName`= '$username'";
        $row = parent::fetch_one($sql);
        return  $row;
    }

}
?>