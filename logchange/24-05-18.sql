c_login : 
		- change md5-hash256
		-change $_SESSION["GroupId"] => $_SESSION["CreateUserId"];
c_user 	:
		- Check null password when edit User .
c_channel : 
		- Change GetAllChannel($_SESSION['Role'],$_SESSION["GroupId"],$_SESSION["UserId"] => GetAllChannel($_SESSION['Role'],$_SESSION["UserId"] ) line 20
		- caculate plus time line 200
c_config :
		- Remove caculate plus time
		- Add view detail config
c_download_upload :
		- Add search all condition  line 55
	===========
m_channel :
		- line 8 : remove $GroupID
		- line 97 : change $GroupID = CreateUserId
		- line 196 : add check total video.
m_config :
		- Update sql  to "SELECT cf.ID , cf.ChannelID,ci.ChannelName, cf.FromSourceVideo,cf.CreateDate, cf.UserID,u.UserName, cf.Status from tbl_channelconfig cf INNER JOIN tbl_user u on cf.UserID=u.ID INNER JOIN tbl_channelinfo ci on cf.ChannelID=ci.ChannelID WHERE 
		cf.UserID='$UserID' or ( ci.AssignToUserID =cf.UserID"
		- line 98 update sql from : "SELECT * FROM `tbl_channelconfig`  WHERE `ID`='$ID'"
m_user :
		- line 52 Change Address => FullName , update edit user sql
============
v_config :
		- css table by add "class="col-md-2"
		- Remove total videoupload and plustime
v_download_upload :
		- Css + add search
v_view_config : addnew 
		
== logchange : 24-5-2018