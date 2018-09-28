<script>
	function ShowPassInput()
	{
			var cansubmit = true;
			var checkchangepass = document.getElementById('ChangePass');
			var strength = document.getElementById('strength');
			
			if(checkchangepass.checked == false)
			{
				$('#PassWordAdd').hide();
				document.getElementById('PassWordAdd').value = '';
				$('#strength').hide();
				cansubmit = true;
			}
			else
			{
				$('#PassWordAdd').show();
				document.getElementById('PassWordAdd').value = '';
				$('#strength').show();
				strength.innerHTML = 'Chú ý: Mật khẩu mới phải có độ dài tối thiểu 8 kí tự, bao gồm kí tự hoa, thường, số, và kí tự đặc biệt';
				cansubmit = false;
			}
			document.getElementById("default-next-0").disabled = !cansubmit;
	}
    function passwordChanged() {
		
		var cansubmit = true;
		
        var strength = document.getElementById('strength');
		var usernotice = document.getElementById('nameNotice');
		var user = document.getElementById('UserNameAdd');
		
        var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

        var pwd = document.getElementById("PassWordAdd");
        if (user.value.length > 3) 
		{
			
			user.value = user.value.toLowerCase();
			usernotice.innerHTML = '<font size="4" color="green">Tên tài khoản hợp lệ</font>'; 
			if (strongRegex.test(pwd.value)) 
			{
				strength.innerHTML = '<font size="4" color="green">Mật khẩu hợp lệ!</font>';
				cansubmit = true;
			}
			else 
			{
				strength.innerHTML = '<font size="4" color="red">Mật khẩu không hợp lệ! Mật khẩu phải có tối thiểu 8 kí tự, bao gồm kí tự hoa, thường, số, và kí tự đặc biệt</font>';
				cansubmit = false;
			}
		}
		else
		{
			usernotice.innerHTML = '<font size="4" color="red">Tên tài khoản phải dài hơn 3 ký tự</font>'; 
			cansubmit = false;
		}
		document.getElementById("default-next-1").disabled = !cansubmit;
		document.getElementById("default-next-0").disabled = !cansubmit;
    }

</script>