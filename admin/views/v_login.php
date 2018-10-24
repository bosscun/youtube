<?php
	session_start();
	$token  =  md5(uniqid(rand(),  TRUE)); 
	$_SESSION['token']  =  $token;
?>

<body style="background-image: url(<?php echo BASE_PATH?>admin/img/bg-login.png);">
<div class="container">

      <form class="form-signin" action="controller/c_login.php?controller=login&action=login" method="post">
        <h2 class="form-signin-heading">Đăng nhập vào hệ thống</h2>
        <div class="login-wrap">
			<input  type="hidden"  name="token"  value="<?php  echo  $token;  ?>"  />
            <input type="text" name="UserName" class="form-control" placeholder="Tên đăng nhập..." autofocus>
            <input type="password" name="PassWord" class="form-control" placeholder="Mật khẩu...">
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Nhớ mật khẩu
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Quên mật khẩu?</a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit" name="btnLogin">Đăng nhập</button>
        </div>

          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Quên mật khẩu?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Nhập địa chỉ email của bạn để reset mật khẩu.</p>
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Thoát</button>
                          <button class="btn btn-success" type="button">Gửi</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- modal -->

      </form>

    </div>
</body>