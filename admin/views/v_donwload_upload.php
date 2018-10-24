<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">

            </header>
            <div class="panel-body">
               <div  class="adv-table editable-table">
                   <div class="clearfix">
                       <form class="form-group" action="<?php echo BASE_PATH;?>admin/controller/c_donwload_upload.php?controller=donwload_upload&action=search_video" method="post" >
                           <label> Tìm kiếm theo : </label>

                           <input type="radio" name="searchMode"  id="SearchByChannel" onclick="ChooseSearchProcess();"  class="ck-filter-chil2" value="1">Tên kênh &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                           <input type="radio" name="searchMode" id="SearchByName"  onclick="ChooseSearchProcess();"      checked class="ck-filter-chil2" value="2">Người dùng
                           <div>
                               <div>
                                   <select id="SearchByChannelID" name="ChannelIDSearch" style="display: none;width: 200px; height: 25px" >
                                       <?php foreach ($arr_channelSearch as $channel){?>
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
                   <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                        <tr>
                            <th hidden>ID</th>
                            <th>STT</th>
                            <th>Nguồn video</th>
                            <th>Mã video</th>
                            <th>Trạng thái tải lên</th>
                            <th>Ngày tải lên</th>
                            <th>Trạng thái tải về</th>
                            <th>Ngày tải về</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($arr_donwload_upload as $index=>$videos)
                        {

                            ?>
                            <tr class="">
                                <td class="ID" hidden><?php echo $videos['ID']; ?></td>
                                <td class="UserID"><?php echo $index + 1; ?></td>
                                <td  style="word-wrap: break-word" ><?php echo str_replace("https://www.youtube.com/", " ", $videos['SourceVideo']);?> <a class="copyText" data-clipboard-text="<?php echo $videos['SourceVideo'];?>"><i class="icon-copy"></i> </a> <br>
                                    <div style="color: red">Tổng videos <?php echo $videos['TotalVideos']; ?> </div>
                                    <div style="color: #00A8B3">  Kênh tải lên :<strong><?php echo $videos['ChannelName']; ?>  </strong><a class="copyText" data-clipboard-text="https://www.youtube.com/channel/<?php echo $videos['ChannelID'];?>">  <i class="icon-copy"></i> </a> </div>

                                </td>
                                <td class="VideoID"><?php echo $videos['VideoID']; ?> <a class="copyText" data-clipboard-text="https://www.youtube.com/watch?v=<?php echo $videos['VideoID'];?>"><i class="icon-copy"></i> </a></td>
                                <td class="UploadStatus" ><span title="<?php echo $videos['MessageUpload']; ?>"><?php echo  $videos['UploadStatus']==0 ? "Đang chờ xử lý":($videos['UploadStatus']==1? "Đang tải lên": ($videos['UploadStatus']==2? "Đã tải lên":  "Lỗi tải lên ")); ?></span> </td>
                                <td class="UploadDate"><?php echo $videos['UploadDate']; ?> <br>
                                </td>
                                <td class="DonwloadStatus"><span  title="<?php echo $videos['MessageDownload']; ?>">  <?php echo $videos['DonwloadStatus']==0 ? "Đang chờ xử lý":($videos['DonwloadStatus']==1? "Đang tải về":($videos['DonwloadStatus']==2? "Đã tải về": " Lỗi tải về" )); ?> </span> </td>
                                <td class="DownloadDate"><?php echo $videos['DownloadDate']; ?></td>
                                <td>
                                    <?php
                                    if($videos['Status'] == 1)
                                    {
                                        ?>
                                        <a class="btn btn-success btn-xs" href="<?php echo BASE_PATH;?>admin/controller/c_donwload_upload.php?controller=donwload_upload&action=change_active&ID=<?php echo $videos['ID'];?>&status=<?php echo $videos['Status'];?>"><i class="icon-ok"></i></a>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <a class="btn btn-xs btn-danger" href="<?php echo BASE_PATH;?>admin/controller/c_donwload_upload.php?controller=donwload_upload&action=change_active&ID=<?php echo $videos['ID'];?>&status=<?php echo $videos['Status'];?>"><i class="icon-off"></i></a>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a class="btn btn-success btn-xs" href="<?php echo BASE_PATH;?>admin/controller/c_donwload_upload.php?controller=donwload_upload&action=update_status&ID=<?php echo $videos['ID'];?>"> Up lại<i class="icon-ok"></i></a>
                                </td>

                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>

        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->

