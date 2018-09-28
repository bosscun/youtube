<?php
	include '../../config.php';
	class m_login extends ConnectionDB
	{
		public function getLogin($username,$password)
		{
			$sql = "SELECT * FROM `tbl_user` WHERE `UserName` = '$username' and `PassWord` = '$password' and `IsApprove` = 1 and `IsBlock` = 0";
			$rows = parent::fetch_one($sql);
			return $rows;
		}
		public function getInfo($username,$password)
		{
			$sql = "SELECT * FROM tbl_user WHERE user_name='$username' AND user_pass = '$password'";
			$rows = parent::fetch_one($sql);
			return $rows;
		}
		public function Log($UserName, $Content){
			$timezone = 'Asia/Ho_Chi_Minh';  //perl: $timeZoneName = "MY TIME ZONE HERE";
			$date = new DateTime('now', new DateTimeZone($timezone));
			$localtime = $date->format('d/m/Y H:i:s');
			$sql="INSERT INTO `tb_log`(`UserName`, `Content`, `CreateDate`) VALUES ('$UserName', '$Content', '".$localtime."')";
			$row= parent::query($sql);
			return $row;
		}
	}
?>