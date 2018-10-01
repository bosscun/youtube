<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <header class="panel-heading">
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script
                    src="https://code.jquery.com/jquery-3.3.1.min.js"
                    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                    crossorigin="anonymous">
            </script>
        </header>
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol terques">
                        <i class="icon-user"></i>
                    </div>

                    <div class="value">
                        <h1>
                            <?php echo $totalUser[0] ?>
                        </h1>
                        <p>Người dùng</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol red">
                        <i class="icon-tags"></i>
                    </div>
                    <div class="value">
                        <h1>
                            <?php echo $totalChanel[0] . " /" . $totalDieChannel[0] ?>
                        </h1>
                        <p>Kênh sống / chết</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol yellow">
                        <i class="icon-shopping-cart"></i>
                    </div>
                    <div class="value">
                        <h1>
                            <?php echo $totalConfig[0] ?>
                        </h1>
                        <p>Cấu hình</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol blue">
                        <i class="icon-bar-chart"></i>
                    </div>
                    <div class="value">
                        <h1>
                            <?php echo $estimateRevenue ?>
                        </h1>
                        <p>Doanh thu</p>
                    </div>
                </section>
            </div>
        </div>
        <!--state overview end-->


        <div class="row">
            <div class="col-lg-12">
                <!--work progress start-->
                <section class="panel">
                    <form class="form-group"
                          action="<?php echo BASE_PATH; ?>admin/controller/c_index.php?controller=dashboard&action=search_user"
                          method="post">
                        <div class="panel-body progress-panel">
                            <div class="task-option">
                                <select id="SearchByUserID" name="UserIDSearch"
                                        style="width: 150px; height: 40px; margin: 0">
                                    <option value="">All</option>
                                    <?php foreach ($totalActiveUser as $user) { ?>
                                        <option value="<?php echo $user['ID']; ?>" <?php echo isset($UserIDSearch) ? ($UserIDSearch == $user['ID'] ? 'selected' : '') : ''; ?>><?php echo $user['UserName'] ?></option>
                                        <?php
                                    } ?>
                                </select> <br><br>
                                <button type="submit" class="btn btn-info">Tìm kiếm <i class=" icon-search"></i>
                                </button>
                            </div>

                        </div>
                    </form>
                    <table class="table table-hover personal-task">
                        <tbody>
                        <tr>
                            <td class="col-md-2">1</td>
                            <td class="col-md-2">
                                View
                            </td>
                            <td class="col-lg-8">
                                <span><?php echo array_sum($viewsArr) ?></span>
                            </td>

                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                Like
                            </td>
                            <td>
                                <span><?php echo array_sum($likesArr) ?></span>
                            </td>

                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                Subs
                            </td>
                            <td>
                                <span><?php echo array_sum($subsArr) ?></span>
                            </td>

                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                Revenue
                            </td>
                            <td>
                                <span><?php echo $estimateRevenue ?></span>
                            </td>

                        </tr>

                        </tbody>
                    </table>
                </section>
                <!--work progress end-->
            </div>
        </div>

        <div class="panel-body">
            <div id="analytic_chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            <script type="text/javascript">
                $(function () {
                    var views = <?php echo json_encode($viewsArr); ?>;
                    var likes = <?php echo json_encode($likesArr);; ?>;
                    var subs = <?php echo json_encode($subsArr); ?>;
                    var date = <?php echo json_encode($dateArr); ?>;
                    var myChart = Highcharts.chart('analytic_chart', {
                        chart: {
                            type: 'line'
                        },
                        title: {
                            text: ""
                        },
                        xAxis: {
                            "type": "datetime",
                            "labels": {
                                "format": "{value:%b %d}"
                            },
                            categories: date

                        },

                        yAxis: {
                            title: {
                                text: ''
                            }
                        },
                        series: [{
                            name: 'views',
                            data: views
                        }, {
                            name: 'like',
                            data: likes
                        },
                            {
                                name: 'subs',
                                data: subs
                            }]
                    });
                });
            </script>
        </div>


    </section>
</section>
<!--main content end-->