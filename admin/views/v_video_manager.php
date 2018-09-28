<!---->
<!--/**-->
<!-- * Created by PhpStorm.-->
<!-- * User: Mr TNT-->
<!-- * Date: 5/29/2018-->
<!-- * Time: 5:07 PM-->
<!-- */-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Danh sách videos
            </header>

            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                        <tr class="" stype = "border-style: none" >
                            <a class="btn btn-xs btn-success" href="#" ><i class="icon-pencil"></i></a><font size="2" color="green"> &ensp; Chỉnh sửa video &ensp; &ensp; &ensp; &ensp;</font></td>
                            <a class="btn btn-xs btn-success" href="#" ><i class="icon-picture"></i></a><font size="2" color="green"> &ensp;Upload ảnh Thumbnails</font></td></tr><br><br>
                        </tr>
                        <tr>
                            <th style="text-align:center">Tên video</th>
                            <th style="text-align:center">Mã video</th>
                            <th style="text-align:center">Thumbnail</th>
                            <th style="text-align:center">Thời gian update</th>
                            <th style="text-align:center">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($videoInfo as $video)
                        {
                            ?>
                            <tr class="" >
                                <td class="col-md-4"> <?php if($video['VideoID'] != '') {echo $video['VideoTitle'] ;}else{{echo "Đọc thông tin video bị lỗi";}}?></td>
								
                                <td class="col-md-2" > <?php if($video['VideoID'] != '') echo $video['VideoID']; ?></td>
								
                                <td class="col-md-2" ><img src="<?php if($video['VideoID'] != ''){if($video['VideoThumbnails'] != '')  echo $video['VideoThumbnails'] ; else echo "../img/ytb_thumb.jpg";}else{ echo "../img/youtube_fail.jpg";}?>" width="100%" height="100%"></td>
                                <td class="col-md-2"><?php echo $video['UpdateTime']?></td>
                                <td  class="col-md-1">
                                    <div class="hidden-phone" style="text-align:center">
                                        <a class="btn btn-success btn-xs"  href="<?php echo BASE_PATH;?>admin/controller/c_video_manager.php?controller=video_manager&action=view_detail&videoID=<?php echo $video['VideoID'];?>&channelID=<?php echo $video['channelId'];?>"><i class="icon-pencil"></i></a>
                                        <a class="btn btn-success btn-xs"  href="<?php echo BASE_PATH;?>admin/controller/c_video_manager.php?controller=video_manager&action=upload_thumbnail_view&videoID=<?php echo $video['VideoID'];?>&channelID=<?php echo $video['channelId'];?>"><i class="icon-picture"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <div>
                    <a class="button-next btn-send btn" href="<?php echo BASE_PATH;?>admin/controller/c_video_manager.php?controller=video_manager&action=load_paging&page=Next&ChannelIDSearch=<?php echo $video['channelId']; ?>"> Next </a>
					<span style="margin-left:40%"><font size="4" color="green">
					
					<?php 
						if($currentVideo < $totalVideo)
						{
							echo $currentVideo; echo "/"; echo $totalVideo; 
						}
						else 
						{
							echo $totalVideo; echo "/"; echo $totalVideo; 
						}
					?>
					
					</font></span>
                    <a class="button-back btn-send btn" href="<?php echo BASE_PATH;?>admin/controller/c_video_manager.php?controller=video_manager&action=load_paging&page=Prev&ChannelIDSearch=<?php echo $video['channelId']; ?>"> Prev </a>
					
                </div>
            </div>

        </section>
        <!-- page end-->
    </section>
</section>


