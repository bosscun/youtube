<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Danh sách kênh
            </header>

            <script type="text/javascript" src="https://secure.skypeassets.com/i/scom/js/skype-uri.js"></script>
            <div id="SkypeButton_Call_live:vfast.vn_1">
                <script type="text/javascript">
                    Skype.ui({
                        "name": "chat",
                        "element": "SkypeButton_Call_live:vfast.vn_1",
                        "participants": ["live:vfast.vn"],
                        "imageSize": 24
                    });
                </script>

            </div>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix" >
                        <a class="btn btn-success btn-xs" href="#" style="margin: 10px"><i class="icon-ok"></i></a>Kênh đang hoạt động <a class="btn btn-xs btn-danger" href="#" style="margin: 10px"><i class="icon-off"></i></a>Kênh đã dừng <a class="btn btn-xs btn-danger" href="#" style="margin: 10px"><i class="icon-trash"></i></a>Xóa kênh<br><br>

                        <?php  if($_SESSION["Role"]!=3 && $CountFileConfig != null) {
                            ?>
                            <div class="btn-group">
                                <a href="<?php echo BASE_PATH;?>admin/controller/c_channel.php?controller=channel&action=channel_add_view" class="btn btn-success">
                                    Thêm mới kênh <i class="icon-plus"></i>
                                </a>
                            </div>
                        <?php }

                        else { ?>&nbsp&nbsp&nbsp
                        <label style="color: red ; font-size: 14px">Không thể thêm kênh, cần tạo thêm file json</label>
                        <?php }
                        ?>

                        <br><br><br>
                        <form class="form-group" action="<?php echo BASE_PATH;?>admin/controller/c_channel.php?controller=channel&action=search_channel" method="post" >
                            <label> Tìm kiếm theo : </label>

                            <input type="radio" name="searchMode"  id="SearchByChannel" onclick="ChooseSearch();"  class="ck-filter-chil2" value="1">Tên kênh &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            <input type="radio" name="searchMode" id="SearchByName"  onclick="ChooseSearch();" checked class="ck-filter-chil2" value="2">Người dùng
                            <div>
                                <div>
                                <select id="SearchByChannelID" name="ChannelIDSearch" style="display: none;width: 200px; height: 25px" >
                                    <?php foreach ($arr_channelSeach as $channel){?>
                                        <option value="<?php echo $channel['ChannelID'];?>" <?php echo isset($ChannelID) ? ($ChannelID == $channel['ChannelID'] ? 'selected': ''): '';?>> <?php echo $channel['ChannelName'];?> </option>
                                    <?php }?>
                                    <option value="all">All</option>
                                </select>
                                </div >
                                <select id="SearchByUserID" name="UserIDSearch" style="width: 150px; height: 25px" >
                                    <?php foreach ($arr_user as $user) {?>
                                    <option value="<?php echo $user['ID'];?>"><?php echo $user['UserName']?></option>
                                    <?php }?>
                                    <option value="all">All</option>
                                </select>

                                <select id="SearchByChannelID" name="StatusValue" hidden>
                                    <option value="">All</option>
                                    <option value="Download">Đang chờ</option>
                                    <option value="Upload">Đang thực hiện</option>
                                    <option value="Upload">Đã hoàn thành</option>
                                </select>
                            </div><br>
                            <button type="submit" class="btn btn-send">Tìm kiếm <i class=" icon-search"></i></button>
                        </form>

                    </div>
                    <div class="space10"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                        <tr >

                            <th style="text-align:center">Trình quản lí video</th>
                            <th style="text-align:center;">Tên kênh</th>
                            <th style="text-align:center">Người tạo</th>
                            <th style="text-align:center">Người sử dụng</th>
                            <th style="text-align:center">Ngày tạo</th>
                            <th width="10%" style="text-align:center">Video upload /ngày</th>
                            <th style="text-align:center" hidden>Thời gian upload</th>
                            <th style="text-align:center">Trạng thái</th>
                            <th style="text-align:center">Tiến trình<br>(videos)</th>
                            <th style="text-align:center">Tạo lịch</th>
                            <th style="text-align:center">Gán</th>
                            <th style="text-align:center">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $next="";
                        foreach($arr_chanel as $channel)
                        {
                            ?>
                            <tr class="">
                                <td class="col-md-1" style="text-align:center"> <a class="btn btn-danger btn-xs"  href="<?php echo BASE_PATH;?>admin/controller/c_video_manager.php?controller=video_manager&action=search_channel&ChannelIDSearch=<?php echo $channel['ChannelID'];?>"><i class="icon-youtube-play"></i></a></td>
                                <td class="channelName"><?php echo $channel['ChannelName']; ?> <a class="copyText" data-clipboard-text="https://www.youtube.com/channel/<?php echo $channel['ChannelID'];?>"><i class="icon-copy"></i> </a><br>
                                </td>
                                <td class="UserName" ><?php echo $channel['UserName']; ?></td>
                                <td class="AssignTo" ><?php echo $channel['UserNameAssign']; ?></td>
                                <td class="createdate"><?php echo $channel['CreateDate']; ?></td>
                                <td style="text-align:center;">
                                    <?php
                                    $totalVideoUploaded =json_decode($channel["TotalVideoUploaded"], true);
                                    if ($channel['TotalVideoUpload'] !="")
                                        echo $totalVideoUploaded['NumberVideoUploaded']."/".$channel['TotalVideoUpload'];
                                    else
                                        echo $totalVideoUploaded['NumberVideoUploaded']."/0";
                                    ?>
                                </td>
                                <td hidden >

                                    <?php

                                    if( $UploadDate!="" )
                                    {
                                        echo  "Lần cuối : ".$channel['UploadDate']."<br>";
                                        ?>
                                    Tiếp theo : <?php
                                        //echo $channel['UploadDate'];
                                        $totalVideoUploaded =json_decode($channel["TotalVideoUploaded"], true);
                                        $dt = new DateTime($UploadDate);
                                        $lastUpload = new DateTime($UploadDate);
                                            $dt->modify('+' . $plustime . ' minutes');
                                            echo $dt->format('d-m-Y H:i:s');

                                        ?>
                                    <?php
                                    }?>



                                </td>
                                <td style="text-align:center">
                                    <?php
                                    if($channel['Status'] == 1)
                                    {
                                        ?>
                                        <a class="btn btn-success btn-xs" href="<?php echo BASE_PATH;?>admin/controller/c_channel.php?controller=channel&action=change_active&Id=<?php echo $channel['ID'];?>&status=<?php echo $channel['Status'];?>"><i class="icon-ok"></i></a>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <a class="btn btn-xs btn-danger" href="<?php echo BASE_PATH;?>admin/controller/c_channel.php?controller=channel&action=change_active&Id=<?php echo $channel['ID'];?>&status=<?php echo $channel['Status'];?>"><i class="icon-off"></i></a>
                                        <?php
                                    }
                                    ?>
                                <td class="col-md-1">
                                    <?php
                                    $found="";
                                    $totalVideo=0;
                                    $totalUploaded=0;
                                    foreach ($arr_detailSource as $detail)
                                    {
                                        if($detail['ChannelID'] == $channel['ChannelID'])
                                        {
                                            $totalVideo+= $detail['NumberVideos'];
                                        }
                                    }

                                    for ($i = 0; $i < count($arr_config); $i++) {
                                        if(array_key_exists($channel['ChannelID'],$arrayUploadedVideo))
                                        {
                                            if ($arr_config[$i]['ChannelID'] == $channel['ChannelID'] && $arr_config[$i]['ID'] != $next )
                                            {
                                                $totalUploaded= $arrayUploadedVideo[$arr_config[$i]['ChannelID']];

                                                $next= $arr_config[$i]['ID'];
                                                $found="";
                                                break;
                                            }
                                            else
                                                $found="0";
                                        }

                                    }
                                    if ($totalUploaded!=0)
                                    {
                                        echo $totalUploaded."/".trim($totalVideo);
                                        if (array_key_exists($channel['ChannelID'],$arrayVideoError))
                                        {
                                            echo "<br>"."Lỗi: ".$arrayVideoError[$channel['ChannelID']];
                                        }
                                        else echo "<br>"."Lỗi: 0";
                                    }
                                    else echo "Chưa có config";



                                    ?>
                                </td>
                                </td>

                                <td style="text-align:center">

                                    <button data-toggle="modal" <?php if($_SESSION["Role"]=="3" ||$channel['TotalVideoUpload']!="") {?> style="background: blue" <?php } ?> href="#myModalAddSchedule" class="btn btn-danger btn-xs" onclick="UpdateSchedule(<?php echo $channel['ID'];?>)">

                                        <i class="icon-calendar" ></i>

                                    </button>

                                </td>
                                <td class="center" style="text-align:center">

                                    <div class="hidden-phone">
                                        <a class="btn btn-warning btn-xs"  href="<?php echo BASE_PATH;?>admin/controller/c_channel.php?controller=channel&action=edit_channel_view&Id=<?php echo $channel['ID'];?>">
                                            <?php ?>    <i class="icon-user"></i>
                                        </a>
                                    </div>
                                </td>
                                <td class="col-md-1" style="text-align:center">
                                    <div class="hidden-phone">
                                        <a class="btn btn-success btn-xs"  href="<?php echo BASE_PATH;?>admin/controller/c_channel.php?controller=channel&action=change_channel_info_view&Id=<?php echo $channel['ID'];?>"><i class="icon-pencil"></i></a>
                                        <a class="btn btn-danger btn-xs" onclick="return confirm('!Bạn có chắc muốn xóa?\nChú ý:Tất cả thông tin của kênh và các cấu hình của kênh sẽ bị xóa\nDữ liệu không thể phục hồi!')"  href="<?php echo BASE_PATH;?>admin/controller/c_channel.php?controller=channel&action=delete&Id=<?php echo $channel['ID'];?>"><i class="icon-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!-- Modal Edit-->
<div class="modal fade" id="myModalAddSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Thiết lập số video upload trong 1 ngày và thời gian public</h4>
            </div>
            <form class="form-horizontal tasi-form" method="post" action="<?php echo BASE_PATH;?>admin/controller/c_channel.php?controller=channel&action=update_schedule" enctype="multipart/form-data">
                <div class="modal-body" id="scheduleUpload">
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-success" id="update" name="update" type="submit">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal -->

