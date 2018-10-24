<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo $title;?>
            </header>
            <div>

                <label>  Nguời tạo:</label>  <?php echo $config['UserName'];?> <br>
                <label> Kênh tải lên </label> : <?php echo $config['ChannelName'] ?><br>
                 <label> Nguồn tải lên :</label>  <?php
                $source = json_decode($config["FromSourceVideo"], true);
                echo $source['Value'];
                ?> <br>
                <label> Lọc :</label>
                <?php

                $filter =json_decode($config["FilterConfig"], true);
                echo $filter['FilterQuality']==""? "":($filter['FilterQuality']=="480"? "SD": ($filter['FilterQuality']=="720"?"HD":"Full HD"))." : ";
                echo $filter['FilterTime']=="0"? "":($filter['FilterTime']=="3"? "Lớn hơn 4p": ($filter['FilterTime']=="2"?" từ : 4p đến: 20p":"lớn hơn 20p"))." : ";
                 if($filter['FilterAdvance']!="")
                 {
                     if($filter['FilterAdvance']=="0")
                     {
                         echo "Lọc theo videos mới nhất của kênh";
                     }
                     else
                     {
                         echo  "Lọc theo videos có views từ : ".$filter['FilterViews'];
                     }
                 }


                ?> <br>

                <label>Tiêu đề :</label>
                <?php

                $videoTitle= json_decode($config["VideoTitle"], true);

                if ( $videoTitle['AddFirst'] !="")
                   echo "Thêm vào đầu tiêu đề : ".$videoTitle['AddFirst']."<br>";
                if ( $videoTitle['AddEnd'] !="")
                    echo "Thêm vào cuối tiêu đề : ".$videoTitle['AddEnd']."<br>";
                if ( $videoTitle['AddAll'] !="")
                    echo "Thay thế toàn bộ tiêu đề : ".$videoTitle['AddAll']."<br>";
                if ( $videoTitle['ReplaceFrom'] !="")
                    echo "Thay thế : ".$videoTitle['ReplaceFrom']." bằng : ".$videoTitle['ReplaceTo'];
                 if ( $videoTitle['TranslateTo'] !="")
                     echo "Dịch tiêu đề sang ngôn ngữ: ".$videoTitle['TranslateTo']."<br>";
                ?> <br>
                <label>Mô tả:</label>
                <?php
                $videoDescription= json_decode($config["VideoDescription"], true);
                //{"AddFirst" : "", "AddEnd" : "", "ReplaceFrom" : "...
                if ( $videoDescription['AddFirst'] !="")
                    echo "Thêm vào đầu mô tả : ".$videoDescription['AddFirst']."<br>";
                if ( $videoDescription['AddEnd'] !="")
                    echo "Thêm vào cuối mô tả : ".$videoDescription['AddEnd']."<br>";
                if ( $videoDescription['AddAll'] !="")
                    echo "Thay thế toàn bộ mô tả : ".$videoDescription['AddAll']."<br>";
                if ( $videoDescription['ReplaceFrom'] !="")
                    echo "Thay thế : ".$videoDescription['ReplaceFrom']." bằng : ".$videoDescription['ReplaceTo']."<br>";
                if ( $videoDescription['TranslateTo'] !="")
                    echo "Dịch mô tả sang ngôn ngữ: ".$videoDescription['TranslateTo']."<br>";
                if ( $videoDescription['ReplaceLink'] !="")
                    echo "Bỏ linh trong mô tả";
                else echo "Không bỏ link trong mô tả";
                ?> <br>

<!--                -->
                <label>Tag :</label>
                <?php
                $videoTag= json_decode($config["VideoTags"], true);

                if ( $videoTag['AddFirst'] !="")
                    echo "Thêm vào đầu tag : ".$videoTag['AddFirst']."<br>";
                if ( $videoTag['AddEnd'] !="")
                    echo "Thêm vào cuối tag : ".$videoTag['AddEnd']."<br>";
                if ( $videoTag['AddAll'] !="")
                    echo "Thay thế toàn bộ tag : ".$videoTag['AddAll']."<br>";
                if ( $videoTag['ReplaceFrom'] !="")
                    echo "Thay thế : ".$videoTag['ReplaceFrom']." bằng : ".$videoTag['ReplaceTo'];
                if ( $videoTag['TranslateTo'] !="")
                    echo "Dịch tag sang ngôn ngữ: ".$videoTag['TranslateTo']."<br>";
                ?> <br>

                <label>Video intro</label>
                <?php
                $extentionFunc= json_decode($config["ExtentionFunc"], true);
                //{"VideoIntroPost" : "", "LinkIntro" : ""}
                if($extentionFunc['VideoIntroPost']!="")
                {
                    if ($extentionFunc['VideoIntroPost']=="2")
                    {
                        echo "Thêm intro video : ".$extentionFunc['LinkIntro']." vào đầu ";
                    }
                    else
                        echo "Thêm intro video : ".$extentionFunc['LinkIntro']." vào cuối ";
                }
                else echo "Không";
                ?> <br>
                <label> Trạng thái : </label> <?php
                echo $config['VideoStatus']=="private"? "Riêng tư": "Công khai";
                ?><br>
                <label>Ngôn ngữ : </label> <?php echo $config['VideoLanguage'] ;?> <br>
                <label> Cắt video : </label>
                <?php
                $SplitVideo= json_decode($config["SplitVideo"], true);
                $minFirst = floor($SplitVideo['First']/60);
                $secFirst = $SplitVideo['First']- $minFirst*60;
                $minEnd = floor($SplitVideo['End']/60);
                $secEnd = $SplitVideo['End']- $minFirst*60;
                echo "Cắt đầu : ".$minFirst." phút ".$secFirst." giây". " "."Cắt đuôi :".$minEnd." phút ".$secEnd." giây";

                ?>


            </div>



        </section>
    </section>
</section>



<!--main content end-->

