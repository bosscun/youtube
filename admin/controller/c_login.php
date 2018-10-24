<?php
class c_login
{
    public $m_login;
    public function __construct()
    {
        if(file_exists('../model/m_login.php'))
        {
            include '../model/m_login.php';
            $this->m_login = new m_login();
        }
        $action = "";
        if(isset($_GET["action"]))
        {
            $action = $_GET["action"];
            session_start();
            switch($action)
            {
                case "login":
                    if  (isset($_SESSION['token']) &&  isset($_POST['token']) &&  $_POST['token']  ==  $_SESSION['token'])
                    {
                        if(isset($_POST["btnLogin"]))
                        {
                            $username = $_POST["UserName"];
                            $password = hash('sha256',$_POST["PassWord"]);
                            $username = str_replace(array('\\', "\0", "\n", "\r", "'", '"', '%', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\'", '\"', '\%', '\\Z'), $username);

                            $row = $this->m_login->getLogin($username,$password);
                            //echo $row;
                            if($row > 0)
                            {
                                //co nghia la co username va password trong db
                                $_SESSION["UserName"] = $row["UserName"];
                                $_SESSION["UserId"] = $row["ID"];
                                $_SESSION["Role"] = $row["Role"];
                                $_SESSION['CreateUserId']=$row["CreateUserId"];
                               if($row["Role"]==1)
                                header("location: c_channel.php");
                               else
                                header("location: c_channel.php");

                            }
                            else{
                                header("location: ../login.php");
                            }
                        }
                    }
                    break;
                case "logout":
                    $this->m_login->Log($_SESSION["UserName"], $_SESSION["UserName"].": đã đăng xuất khỏi hệ thống.");
                    unset($_SESSION["UserId"]);
                    unset($_SESSION['token']);
                    header("location: ../login.php");
                    break;
            }

        }
        else{

            $title = "Đăng nhập";
            if(file_exists('views/_layers/l_head.php'))
            {
                require_once("views/_layers/l_head.php");
            }

            if(file_exists('views/v_login.php'))
            {
                include 'views/v_login.php';
            }
            if(file_exists('views/_layers/l_script.php'))
            {
                require_once("views/_layers/l_script.php");
            }
        }
    }
}
$c_login = new c_login();
?>
