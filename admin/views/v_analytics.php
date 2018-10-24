<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Danh sách kênh
            </header>

            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <a class="btn btn-success btn-xs" href="#" style="margin: 10px"><i class="icon-ok"></i></a>Kênh
                        đang hoạt động
                        <a class="btn btn-xs btn-danger" href="#" style="margin: 10px"><i class="icon-off"></i></a>Kênh
                        đã dừng
                        <a class="btn btn-xs btn-danger" href="#" style="margin: 10px"><i class="icon-trash"></i></a>Xóa
                        kênh
                        <a class="btn btn-info btn-xs" href="#"><i class="icon-double-angle-right"></i></a> Chi tiết
                        <br><br>
                        <form class="form-group"
                              action="<?php echo BASE_PATH; ?>admin/controller/c_channel_analytics.php?controller=channel_analytics&action=search_channel"
                              method="post">
                            <label> Tìm kiếm theo : </label>
                            <input type="radio" name="searchMode" id="SearchByName" checked value="2">Người dùng
                            <div>
                                <select id="SearchByUserID" name="UserIDSearch" style="width: 150px; height: 25px">
                                    <?php foreach ($arr_user as $user) { ?>
                                        <option value="<?php echo $user['ID']; ?>"><?php echo $user['UserName'] ?></option>
                                    <?php } ?>
                                    <option value="all">All</option>
                                </select>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-send">Tìm kiếm <i class=" icon-search"></i></button>
                        </form>
                    </div>
                    <div class="space10"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                        <tr>
                            <th width="10%" style="text-align:center">Tên kênh</th>
                            <th width="10%" style="text-align:center">Người tạo</th>
                            <th width="10%" style="text-align:center">Người sử dụng</th>
                            <th style="text-align:center">Views</th>
                            <th style="text-align:center">Likes</th>
                            <th style="text-align:center">Sub</th>
                            <?php if ($_SESSION['Role'] == 1) { ?>
                            <th style="text-align:center">Doanh thu</th>
                            <?php }?>
                            <th style="text-align:center">Ngày tạo</th>
                            <th style="text-align:center">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $next = "";
                        foreach ($channelReport as $report) {
                            $analytics = json_decode($report['Report']);
                            $revenue = json_decode($report['RevenueReport']);
                            ?>
                            <tr class="">
                                <td class="UserName"><?php echo $report['ChannelName']; ?></td>
                                <td class="UserName"><?php echo $report['CreateUser']; ?></td>
                                <td class="AssignTo"><?php echo $report['AssignToUser']; ?></td>
                                <td class=""><?php
                                    if ($analytics != "")
                                        echo $analytics[0][1];
                                    else echo "0";
                                    ?>
                                </td>
                                <td class=""><?php
                                    if ($analytics != "") echo $analytics[0][2];
                                    else echo "0";
                                    ?>
                                </td>
                                <td class=""><?php
                                    if ($analytics != "") echo $analytics[0][4];
                                    else echo "0"; ?></td>
                                <?php if ($_SESSION['Role'] == 1) { ?>
                                <td class="">
                                    <?php if ($revenue == '') echo "0 $";
                                    else
                                        echo $revenue[0][1] . " $";
                                    ?></td>
                                <?php }?>
                                <td class="AssignTo"><?php echo $report['CreateDate']; ?></td>
                                <td class="col-md-1" style="text-align:center">
                                    <div class="hidden-phone">
                                        <a class="btn btn-danger btn-xs"
                                           onclick="return confirm('!Bạn có chắc muốn xóa?\nChú ý:Tất cả thông tin của kênh và các cấu hình của kênh sẽ bị xóa\nDữ liệu không thể phục hồi!')"
                                           href="<?php echo BASE_PATH; ?>admin/controller/c_channel_analytics.php?controller=channel_analytics&action=delete&ChannelID=<?php echo $report['ChannelID']; ?>"><i
                                                    class="icon-trash"></i></a>
                                        <a class="btn btn-info btn-xs"
                                           href="<?php echo BASE_PATH; ?>admin/controller/c_channel_analytics.php?controller=channel_analytics&action=view_chart&ChannelID=<?php echo $report['ChannelID']; ?>"><i
                                                    class="icon-double-angle-right"></i>
                                        </a>
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



