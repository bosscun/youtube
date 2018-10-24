<?php
session_start();
if (!isset($_SESSION['UserId'])) {
    header("Location: ../login.php");
}
// to change a session variable, just overwrite it

?>
<?php
//c_channel_analytics.php

class c_channel_analytics
{
    public $m_channel_analytics;

    /**
     * c_channel_analytics constructor.
     */
    public function __construct()
    {
        $maxResults = 25;

        $main_menu = "video_manager";
        if (file_exists('../model/m_channel_analytics.php')) {
            include '../model/m_channel_analytics.php';
        }
        $this->m_channel_analytics = new m_channel_analytics();
        $arr_user = $this->m_channel_analytics->GetUserSearch($_SESSION['UserId']);
        $destination_path = "../api_json";
        if (isset($_GET["ChannelID"])) {
            $ChannelID = $_GET["ChannelID"];
        }
        $Id = 0;
        if (isset($_GET["Id"])) {
            $Id = $_GET["Id"];
        }
        //

        if (isset($_GET["videoID"])) {
            $videoID = $_GET["videoID"];
        }
        $action = "";
        if (isset($_GET["action"])) {
            $action = $_GET["action"];

            switch ($action) {
                /*-----------------------    add    -------------------*/

                case "search_channel":
                    $title = "Thống kê";

                    $UserIDSearch = isset($_POST["UserIDSearch"]) ? trim($_POST["UserIDSearch"]) : '';
                    if ($UserIDSearch != "") {
                        if ($UserIDSearch != "all") {
                            $channelReport = $this->m_channel_analytics->GetChannelSearchByUserID($UserIDSearch);
                        } else {
                            $channelReport = $this->m_channel_analytics->GetAllChannel($_SESSION["UserId"]);//
                        }
                    }
                    if (file_exists('../views/_layers/l_head.php')) {
                        require_once("../views/_layers/l_head.php");
                    }
                    if (file_exists('../views/_layers/l_header_menu.php')) {
                        require_once("../views/_layers/l_header_menu.php");
                    }
                    if (file_exists('../views/_layers/l_left_menu.php')) {
                        require_once("../views/_layers/l_left_menu.php");
                    }
                    if (file_exists('../views/v_analytics.php')) {
                        include '../views/v_analytics.php';
                    }
                    if (file_exists('../views/_layers/l_footer.php')) {
                        require_once("../views/_layers/l_footer.php");
                    }
                    if (file_exists('../views/_layers/l_script.php')) {
                        require_once("../views/_layers/l_script.php");
                    }
                    if (file_exists('../script/channel_js.php')) {
                        require_once("../script/channel_js.php");
                    }
                    break;

                case "delete":
                    $this->m_channel_analytics->DeleteChannelAnalytics($ChannelID);
                    header("location: ../controller/c_channel_analytics.php?controller=channel_analytics");
                    break;

                case "view_chart":
                    $title = "Biểu đồ";
                    // $ChannelID;
                    $channelReportByID = $this->m_channel_analytics->GetChanelReport($ChannelID);
                    $views = [];
                    $likes = [];
                    $subs = [];
                    $date = [];

                    $reports = json_decode($channelReportByID[0]['MonthlyReport']);
                    foreach ($reports as $report) {

                        array_push($date, $report[0]);
                        array_push($views, $report[1]);
                        array_push($likes, $report[2]);
                        array_push($subs, $report[4]);

                    }
                    if (file_exists('../views/_layers/l_head.php')) {
                        require_once("../views/_layers/l_head.php");
                    }
                    if (file_exists('../views/_layers/l_header_menu.php')) {
                        require_once("../views/_layers/l_header_menu.php");
                    }
                    if (file_exists('../views/_layers/l_left_menu.php')) {
                        require_once("../views/_layers/l_left_menu.php");
                    }
                    if (file_exists('../views/_layers/l_footer.php')) {
                        require_once("../views/_layers/l_footer.php");
                    }
                    if (file_exists('../views/_layers/l_script.php')) {
                        require_once("../views/_layers/l_script.php");
                    }

                    if (file_exists('../views/v_chart_analytics.php')) {
                        include '../views/v_chart_analytics.php';
                    }

                    break;
            }

        } else {
            $title = "Thống kê";
            $channelReport = $this->m_channel_analytics->GetChannelSearchByUserID($arr_user[0]['ID']);
            if (file_exists('../views/_layers/l_head.php')) {
                require_once("../views/_layers/l_head.php");
            }
            if (file_exists('../views/_layers/l_header_menu.php')) {
                require_once("../views/_layers/l_header_menu.php");
            }
            if (file_exists('../views/_layers/l_left_menu.php')) {
                require_once("../views/_layers/l_left_menu.php");
            }
            if (file_exists('../views/v_analytics.php')) {
                include '../views/v_analytics.php';
            }
            if (file_exists('../views/_layers/l_footer.php')) {
                require_once("../views/_layers/l_footer.php");
            }
            if (file_exists('../views/_layers/l_script.php')) {
                require_once("../views/_layers/l_script.php");
            }
            if (file_exists('../script/channel_js.php')) {
                require_once("../script/channel_js.php");
            }
        }

    }
}

$c_channel_analytics = new c_channel_analytics();
?>