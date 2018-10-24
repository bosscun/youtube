<script>
    $(document).ready(function(){
        $('#IsUploadChannelAdd').on('change', function() {
            var channelType = $('#IsUploadChannelAdd').val();
            if(channelType == 0){
                $("#fromchannelid").hide();
            }else{
                $("#fromchannelid").show();
            }
        });
    });
	//check add Country
	$('#default-next-1').click(function(e) {
        var channelType = $('#IsUploadChannelAdd').val();
		if (channelType == 1)
		{
            var fromchannel = $('#FromChannelIdAdd').val();
            if(fromchannel == "") {
                alert("Bạn chưa chọn kênh download video");
                e.preventDefault();
                return false;
            }
		}

	});
    $('#default-next-0').click(function(e) {
        var channelType = $('#IsUploadChannelAdd').val();
        if (channelType == 1)
        {
            var fromchannel = $('#FromChannelIdAdd').val();
            if(fromchannel == "") {
                alert("Bạn chưa chọn kênh download video");
                e.preventDefault();
                return false;
            }
        }
    });
	
	function UpdateSchedule(channelID){
			// Gửi ajax
			$.ajax({
				type : "post",
				dataType : "html",
				url : "../ajax/channel_ajax.php",
				data : {channelId : channelID,
						type : "init"
						},
				success : function(result)
				{
					$("#scheduleUpload").html(result);
				}
			});
		};
	function ChangeTotalVideoPublic(channelID){
			var TotalVideo = $('#TotalVideoPublish').val();
			// Gửi ajax
			$.ajax({
				type : "post",
				dataType : "html",
				url : "../ajax/channel_ajax.php",
				data : {channelId : channelID,
						TotalVideo: TotalVideo,
						type : "change"
						},
				success : function(result)
				{
					$("#configTimePublic").html(result);
				}
			});
		};

    var clipboard = new ClipboardJS('.copyText');

    clipboard.on('success', function(e) {
        alert("Đã copy : " +e.text);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });

    function ChooseSearch(){
        //$('#UploadImage').hide();
        var searchByChannel = document.getElementById("SearchByChannel");
        var searchByUsername= document.getElementById("SearchByName");
        if (searchByChannel.checked== true)
        {
            $('#SearchByChannelID').show();
            $('#SearchByUserID').hide();

        }
        else {
            $('#SearchByChannelID').hide();
            $('#SearchByUserID').show();
        }
    }

    function addPublishschedule(){
        var newdiv = document.createElement('createForm');
        var htmlT ='<div class="form-group" >' +
            '<div class="col-sm-4">' +
            ' <label>Giờ:</label>' +

            ' <select class="form-control m-bot15" id="Hours" name="Hours[]">' +
            ' <option value="0" >00</option>'+
                    <?php for($i = 0; $i<=23; $i++)
            {
            if($i < 10)
            {
            ?>
            ' <option value="0<?php echo $i; ?>" >0<?php echo $i; ?></option>' +
            <?php
            }else{
            ?>
            ' <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>' +
            <?php
            }
            }
            ?>

            '</select>' +
            ' </div>' +
            '  <div class="col-sm-4">' +
            '  <label>Phút:</label>' +

            ' <select class="form-control m-bot15" id="Minutes" name="Minutes[]">' +
            ' <option value="00" >00</option>'+
            <?php for($i = 0; $i<=59; $i+=15)
            {
				if($i < 10)
				{
			?>
				' <option value="0<?php echo $i; ?>" >0<?php echo $i; ?></option>' +
				<?php
				}else{
				?>
				' <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>' +
			<?php
				}
            }
            ?>
            '</select> </div> ' +
            ' <div class="col-sm-4">' +
            ' <label>TimeZone:</label>' +
            ' <select class="form-control m-bot15" id="Zone" name="Zone[]">' +
            '     <option value="0" disabled selected hidden>TimeZone...</option>' +
            '     <option value="-12">-12</option>' +
            '     <option value="-11">-11</option>' +
            '     <option value="-10">-10</option>' +
            '     <option value="-9">-9</option>' +
            '     <option value="-8">-8</option>' +
            '     <option value="-7">-7</option>' +
            '     <option value="-6">-6</option>' +
            '     <option value="-5">-5</option>' +
            '     <option value="-4">-4</option>' +
            '     <option value="-3">-3</option>' +
            '     <option value="-2">-2</option>' +
            '     <option value="-1">-1</option>' +
            '     <option value="0">0</option>' +
            '     <option value="+1">+1</option>' +
            '     <option value="+2">+2</option>' +
            '     <option value="+3">+3</option>' +
            '     <option value="+4">+4</option>' +
            '     <option value="+5">+5</option>' +
            '     <option value="+6">+6</option>' +
            '     <option value="+7" selected>+7</option>' +
            '     <option value="+8">+8</option>' +
            '     <option value="+9">+9</option>' +
            '     <option value="+10">+10</option>' +
            '     <option value="+11">+11</option>' +
            '     <option value="+12">+12</option>' +
            ' </select>' +
            '                                    </div>' +
            '                                </div>';

        var TotalVideoPublish = $('#TotalVideoPublish').val();
        document.getElementById("publishTime").innerHTML = "";
        newdiv.innerHTML = "";
        if(TotalVideoPublish > 0)
            $('#setAfterDays').show();
        else
            $('#setAfterDays').hide();
        for($i=0;$i<TotalVideoPublish; $i++) {
            newdiv.innerHTML +=htmlT;
        }
        document.getElementById('publishTime').appendChild(newdiv);
    }
    $('#saveSchedule').click(function(e) {
        var TotalVideoUpload=$('#TotalVideoUpload').val();
        var TotalVideoPublish= $('#TotalVideoPublish').val();


        if (TotalVideoUpload=="0")
        {
            alert("Bạn chưa chọn tổng video upload");
            e.preventDefault();
        }
        else if(TotalVideoPublish> TotalVideoUpload)
        {
            alert("Số video publish không được lớn hơn tổng số video upload ");
            e.preventDefault();

        }
    });




</script>