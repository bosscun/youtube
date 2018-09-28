<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->

        <section class="panel">

            <header class="panel-heading">
                <strong> Thống kê từ ngày <?php echo $date[0]." đến ".$date[count($date) -1]?> </strong>
                <script src="https://code.highcharts.com/highcharts.js"></script>
                <script
                        src="https://code.jquery.com/jquery-3.3.1.min.js"
                        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                        crossorigin="anonymous">
                </script>
            </header>
            <div class="panel-body">
                <div id="analytic_chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                <script type="text/javascript">
                    $(function () {

                        var views = <?php echo json_encode($views); ?>;
                        var likes = <?php echo json_encode($likes);; ?>;
                        var subs = <?php echo json_encode($subs); ?>;
                        var date = <?php echo json_encode($date); ?>;
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
        <!-- page end-->
    </section>
</section>



