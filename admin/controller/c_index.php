<?php
session_start();
if (!isset($_SESSION['UserId'])) {
    header("Location: ../login.php");
}
?>
<?php

class index
{
    public $m_index;

    public function __construct()
    {

        $main_menu = "dashboard";
        $sub_menu = "";
        if (file_exists('../model/m_index.php')) {
            include '../model/m_index.php';
        }
        $this->m_index = new m_index();
        $totalChanel = $this->m_index->GetTotalChannel();
        $totalUser = $this->m_index->GetTotalUser();
        $totalActiveUser = $this->m_index->GetTotalActiveUser();
        $totalBlockUser = $this->m_index->GetBlockUser();
        $totalDieChannel = $this->m_index->GetDieChannel();
        $totalConfig = $this->m_index->GetTotalConfig();
        $totalRevenue = $this->m_index->GetTotalRevenue();
        $estimateRevenue = 0;
        foreach ($totalRevenue as $Revenue) {
            $tmp_revenue = json_decode($Revenue['RevenueReport']);
            $estimateRevenue += $tmp_revenue[0][1];

        }
        $viewsArr = [];
        $likesArr = [];
        $subsArr = [];
        $dateArr = [];

        if (isset($_GET["action"])) {

            $action = $_GET["action"];

            switch ($action) {
                case "search_user":
                    $UserIDSearch = isset($_POST["UserIDSearch"]) ? trim($_POST["UserIDSearch"]) : '';
                    $channelReportSearch = $this->m_index->GetChannelAnalysticForSearch($UserIDSearch);
                    $getDate = json_decode($channelReportSearch[0]['MonthlyReport']);
                    $i = 0;
                    foreach ($getDate as $dt) {
                        $views = 0;
                        foreach ($channelReportSearch as $report) {
                            $getData = json_decode($report['MonthlyReport']);
                            if (count($getData) <= $i)
                                break;
                            if ($getData[$i][1] != null) {
                                //$views += $getData[$i][1];
                                array_push($viewsArr, $getData[$i][1]);
                                array_push($likesArr, $getData[$i][2]);
                                array_push($subsArr, $getData[$i][4]);
                                array_push($dateArr, $getData[$i][0]);
                            }
                        }
                        $i++;
                    }
                    $title = "Quản trị hệ thống";
                    if (file_exists('../views/_layers/l_head.php')) {
                        require_once("../views/_layers/l_head.php");
                    }
                    if (file_exists('views/_layers/l_header_menu.php')) {
                        require_once("../views/_layers/l_header_menu.php");
                    }
                    if (file_exists('../views/_layers/l_left_menu.php')) {
                        require_once("../views/_layers/l_left_menu.php");
                    }
                    if (file_exists('../views/_layers/l_script.php')) {
                        require_once("../views/_layers/l_script.php");
                    }

                    if (file_exists('../views/_layers/l_footer.php')) {
                        require_once("../views/_layers/l_footer.php");
                    }
                    if (file_exists('../views/v_index.php')) {
                        include '../views/v_index.php';
                    }
                    break;
            }
        } else {

            //
            $channelReport = $this->m_index->GetAllReport();
            $viewsArr = [];
            $likesArr = [];
            $subsArr = [];
            $dateArr = [];
            $getDate = json_decode($channelReport[3]['MonthlyReport']);
            $i = 0;
            foreach ($getDate as $dt) {
                $views = 0;
                foreach ($channelReport as $report) {
                    $getData = json_decode($report['MonthlyReport']);

                    if (count($getData) <= $i)
                        break;
                    if ($getData[$i][1] != null) {
                        array_push($viewsArr, $getData[$i][1]);
                        array_push($likesArr, $getData[$i][2]);
                        array_push($subsArr, $getData[$i][4]);
                        array_push($dateArr, $getData[$i][0]);
                    }
                }
                $i++;
            }
            $title = "Quản trị hệ thống";
            if (file_exists('../views/_layers/l_head.php')) {
                require_once("../views/_layers/l_head.php");
            }
            if (file_exists('views/_layers/l_header_menu.php')) {
                require_once("../views/_layers/l_header_menu.php");
            }
            if (file_exists('../views/_layers/l_left_menu.php')) {
                require_once("../views/_layers/l_left_menu.php");
            }

            if (file_exists('../views/v_index.php')) {
                include '../views/v_index.php';
            }

            if (file_exists('views/_layers/l_footer.php')) {
                require_once("../views/_layers/l_footer.php");
            }

            if (file_exists('../views/_layers/l_script.php')) {
                require_once("../views/_layers/l_script.php");
            }
        }
    }
}

$index = new index();

?>