<?php
include '../../config.php';
class m_group extends ConnectionDB
{

	public function GetAllGroup()
	{
		$sql = "SELECT `ID`, `GroupName`, `UserIdCreate`, `CreateDate`, `Status` FROM `tbl_group`";
		$rows = ConnectionDB::fetch($sql);
		return $rows;
	}
/*--end select all*/
	
	/*----select User  ID*/
	public function SelectGroup($ID)
	{
		$sql="SELECT  `GroupName`, `Status` FROM `tbl_group` Where `ID`= '$ID'";
		$row = parent::fetch_one($sql);
		return  $row;
			
	}
	
	/*----End select User ID*/

	/*---update User */
	public function EditGroup($ID, $GroupName, $Status)
	{
		$sql="UPDATE `tbl_group` SET `GroupName`= '$GroupName', `Status` = '$Status'  WHERE `ID`=$ID";
		$row=parent::query($sql);
		return $row;

	}
	
	
	
	/*---End update User*/

	/*---insert User*/
	public function InsertGroup($GroupName,$UserIdCreate, $CreateDate, $Status)
	{
		$sql="INSERT INTO `tbl_group` (`GroupName`, `UserIdCreate`, `CreateDate`, `Status`) VALUES ('$GroupName','$UserIdCreate', '$CreateDate', '$Status')";
		$row= parent::query($sql);
		return $row;

	}
	/*---End insert User*/

	/*---insert User*/
	public function DeleteGroup($ID)
	{
        $sql="DELETE FROM `tbl_group` WHERE `ID` = '$ID'";
		$row= parent::query($sql);
		return $row;

	}
	/*---End insert User*/
	/*--Change user password-*/

	
	/*--End Change user permission*/
	/*--Change active User*/
	public function ChangeActive($ID, $Status)
	{
		If ($Status == '0')
		{ $sql="UPDATE `tbl_group` SET `Status` = 1 WHERE `ID` = '$ID'";
		}
		else {
			$sql="UPDATE `tbl_group` SET `Status` = 0 WHERE `ID` = '$ID'";
		}
		$row= parent::query($sql);
		return $row;
	}

}
?>