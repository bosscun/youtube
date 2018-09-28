<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Danh sách kênh
            </header>
            <a class="btn btn-success btn-xs" href="#" style="margin: 10px"><i class="icon-ok"></i></a>File chưa sử dụng <a class="btn btn-xs btn-danger" href="#" style="margin: 10px"><i class="icon-off"></i></a>File đã sử dụng <a class="btn btn-xs btn-danger" href="#" style="margin: 10px"><i class="icon-trash"></i></a>Xóa file
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="btn-group">
                            <a href="<?php echo BASE_PATH;?>admin/controller/c_upload_file.php?controller=upload_file&action=view_file" class="btn btn-success">
                                Thêm mới file <i class="icon-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                        <tr>
                            <th  hidden>ID</th>
                            <th>STT</th>
                            <th>Tên file</th>
                            <th hidden>Đường dẫn</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($arr_file as $index=> $file )
                        {
                            ?>
                            <tr class="">
                                <td class="ID"  hidden><?php echo $file['ID'];?> </td>
                                <td class="Stt"> <?php echo $index +1; ?></td>
                                <td class="FileName"> <?php echo $file['FileName']; ?></td>
                                <td class="FileUrl hidden" ><?php echo $file['FileUrl']; ?></td>
                                <td>
                                    <?php
                                    if($file['Status'] == 1)
                                    {
                                        ?>
                                        <a class="btn btn-success btn-xs" href="<?php echo BASE_PATH;?>admin/controller/c_upload_file.php?controller=upload_file&action=change_active&ID=<?php echo $file['ID'];?>&status=<?php echo $file['Status'];?>"><i class="icon-ok"></i></a>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <a class="btn btn-xs btn-danger" href="<?php echo BASE_PATH;?>admin/controller/c_upload_file.php?controller=upload_file&action=change_active&ID=<?php echo $file['ID'];?>&status=<?php echo $file['Status'];?>"><i class="icon-off"></i></a>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td class="center">
                                    <div class="hidden-phone">
                                        <a class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc muốn xóa?\n Các danh mục con của nó cũng sẽ bị xóa!')"  href="<?php echo BASE_PATH;?>admin/controller/c_upload_file.php?controller=upload_file&action=delete&ID=<?php echo $file['ID'];?>"><i class="icon-trash "></i></a>
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


