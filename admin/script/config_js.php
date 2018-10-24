<script>


    $('#default-next-1').click(function(e) {
        var ReupChannelID = $("#ChannelIDADD").val();
        var ReupMusicChannelID = $("#ChannelReupMusic").val();
        var url = $("#url").val();
        if (document.getElementById("ReupMusic").checked)        {
            var img = $("#ImageAdd").val();


            if(!img) {
                alert("Bạn chưa chọn ảnh");
                e.preventDefault();
                return false;
            }
            if (!url)
            {
                alert("Bạn chưa chọn link nhạc");
                e.preventDefault();
            }
            else {
                if (url.includes("https://www.youtube.com/watch?v=")==false)
                {
                    alert("Link nhạc không đúng định dạng");
                    e.preventDefault();
                }
            }
            if(ReupMusicChannelID == null)
            {
                alert("Bạn chưa chọn kênh");
                e.preventDefault();
            }
        }
        else
        {
            if(ReupChannelID == null)
            {
                alert("Bạn chưa chọn kênh");
                e.preventDefault();
            }
        }
        if (document.getElementById("ReupFromPLL").checked){
            if (url.includes("https://www.youtube.com/playlist?list=")==false)
            {
                alert("Link playlist không đúng định dạng");
                e.preventDefault();
            }
        }
        if (document.getElementById("ReupFromLinkAdd").checked)
        {
            if ((url.includes("https://www.youtube.com/channel/")==false))
            {
                alert("Link channel không đúng định dạng");
                e.preventDefault();
            }
        }



            });
    function checkInputVideo() {
         var reupkey = document.getElementById("ReupFromKeyWord");
         var reuplink = document.getElementById("ReupFromLinkAdd");
         var reuppll = document.getElementById("ReupFromPLL");
         if(reupkey.checked == true)
         {
             document.getElementById('reup_lable').innerHTML = 'Vui lòng điền <strong>Keyword</strong> theo từng dòng, tối đa là 3 Keyword!';
             $('#UploadImage').hide();
             $('#AudioAdd').hide();
             //
             $('#filterVideo').show();
             $('#thumbnail').show();
             $('#ReplaceTitleByPart').show();
             $('#ReplaceDesByPart').show();
             $('#ReplaceTagByPart').show();
             $('#url').show();
             $('#UploadAudio').hide();
             $('#SplitVideo').show();

             $('#ReplaceLinkInDes').show();
             $('#ChannelIDADD').show();
             $('#ChannelReupMusic').hide();
         }
         else if (reuplink.checked == true)
         {
             document.getElementById('reup_lable').innerHTML = 'Vui lòng điền <strong>Link Channel</strong> hoặc <strong>Link Playlist</strong> Hoặc <strong>Link Video</strong> đầy đủ dạng ID. Ví dụ: https://www.youtube.com/channel/UCANLZYMidaCbLQFWXBC95Jg';
             $('#UploadImage').hide();
             $('#AudioAdd').hide();
             //
             $('#filterVideo').show();
             $('#thumbnail').show();
             $('#ReplaceTitleByPart').show();
             $('#ReplaceDesByPart').show();
             $('#ReplaceTagByPart').show();
             $('#url').show();
             $('#UploadAudio').hide();
             $('#SplitVideo').show();

             $('#ReplaceLinkInDes').show();
             $('#ChannelIDADD').show();
             $('#ChannelReupMusic').hide();
         }
          // create video file
         else if (reuppll.checked == true)
         {
             document.getElementById('reup_lable').innerHTML = 'Vui lòng điền <strong>Link playlist</strong> đầy đủ dạng ID. Ví dụ: https://www.youtube.com/playlist?list=PLxCJlGM56UTOWqkHoTirHfBNLRzy2cydQ';
             $('#UploadImage').hide();
             $('#AudioAdd').hide();
             //
             $('#filterVideo').hide();
             $('#ReplaceTitleByPart').show();
             $('#thumbnail').show();
             $('#ReplaceDesByPart').show();
             $('#ReplaceTagByPart').show();
             $('#url').show();
             $('#UploadAudio').hide();
             $('#SplitVideo').show();

             $('#ReplaceLinkInDes').show();
             $('#ChannelIDADD').show();
             $('#ChannelReupMusic').hide();


         }
         //reup music
         else {
             document.getElementById('reup_lable').innerHTML = 'Vui lòng điền <strong>Link nhạc</strong> đầy đủ dạng ID. Ví dụ: https://www.youtube.com/watch?v=-UCavUgqolo';
             $('#AudioAdd').hide();
             $('#UploadImage').show();
             $('#UploadAudio').hide();
             $('#ChannelIDADD').hide();
             $('#ChannelReupMusic').show();

             //
             $('#filterVideo').hide();
             $('#ReplaceTitleByPart').show();
             $('#ReplaceDesByPart').show();
             $('#ReplaceTagByPart').show();
             $('#url').show();
             $('#SplitVideo').hide();
             $('#thumbnail').hide();

             $('#ReplaceLinkInDes').show();

         }
     };

    var clipboard = new ClipboardJS('.copyText');

    clipboard.on('success', function(e) {
        alert("Đã copy : " +e.text);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });
    function checkfilter() {
        if (document.getElementById("FilterVideoAdd").checked) {
            $('#div_filter_res').show();
            $('#ck_filter_time').show();
            $('#AdvanceFilter').show();
        }
        else {
            $('#div_filter_res').hide();
            $('#ck_filter_time').hide();
            $('#AdvanceFilter').hide();
            document.getElementById("FilterViewValue").value = '';
        }
        if (document.getElementById("FilterMode").checked) {
            $('#filterQuality').show();
        }
        else {
            $('#filterQuality').hide();
        }
        if (document.getElementById("filtertimeck").checked) {
            $('#div_filter_time').show();
        }
        else {
            $('#div_filter_time').hide();
        }

        if (document.getElementById("filteradvance").checked) {
            $('#div_filter_advance').show();

        }
        else {
            $('#div_filter_advance').hide();
            document.getElementById("FilterViewValue").value = '';
        }

        if (document.getElementById("filterVideoViews").checked) {
            //FilterViewValue
            $('#FilterViewValue').show();
        }
        else {
            $('#FilterViewValue').hide();
        }
        if (document.getElementById("filterAdvanceValue").checked) {
            $('#FilterViewValue').hide();
            document.getElementById("FilterViewValue").value = '';
        }
        checkInputVideo();
    }

    function checkTitle() {

        if (document.getElementById("ck_add_local_title").checked == true)
        {
            $('#part_replacetilte').show();
        }
        else {
            $('#part_replacetilte').hide();
        }

        if (document.getElementById("ck_add_all_title").checked == true)
        {
            $('#box_add_all_title').show();
        }
        else {
            $('#box_add_all_title').hide();
        }
    }
    function checkDes() {

        if (document.getElementById("ck_add_local_des").checked == true)
        {
            $('#part_replaceDes').show();
        }
        else {
            $('#part_replaceDes').hide();
        }

        if (document.getElementById("ck_add_all_des").checked == true)
        {
            $('#box_add_all_des').show();
        }
        else {
            $('#box_add_all_des').hide();
        }
    }
    function checkTag() {

        if (document.getElementById("ck_add_local_tag").checked == true)
        {
            $('#part_replacetag').show();
        }
        else {
            $('#part_replacetag').hide();
        }

        if (document.getElementById("ck_add_all_tag").checked == true)
        {
            $('#box_add_all_tag').show();
        }
        else {
            $('#box_add_all_tag').hide();
        }
    }
    function checkTime() {
        var sec_first = document.getElementById("FirstSecAdd");
        var sec_last  = document.getElementById("EndSecAdd");
        if (sec_first.value > 59)
        {
            alert("Không được nhập giây quá 59");
            sec_first.value = 59;
        }
        if (sec_last.value > 59)
        {
            alert("Không được nhập giây quá 59");
            sec_last.value = 59;
        }
    }
    function checkAllForm() {
        checkfilter();
        checkTitle();
        checkDes();
        checkTag();
        checkInputVideo();
}

    function CheckForm(form_id)
    {
        var cansubmit = true;
        switch(form_id)
        {
            case 1:
                var data = document.getElementById("text_add_all_title");
                if(data.value.length > 100)
                {
                    //Hiden submit of buttom
                    cansubmit = false;
                    alert('Tiêu đề dài quá 100 ký tự!');
                }else
                    cansubmit = true;
                break;
            case 2:
                var data = document.getElementById("text_add_all_des");
                if(data.value.length > 5000)
                {
                    //Hiden submit of buttom
                    cansubmit = false;
                    alert('Mô tả dài quá 5000 ký tự!');
                }else
                    cansubmit = true;
                break;
            case 3:
                //Count command
                var data = document.getElementById("text_add_all_tag");
                var count_comman = data.value.split(",").length-1;
                if(data.value.length+count_comman > 500)
                {
                    //Hiden submit of buttom
                    cansubmit = false;
                    alert('Thẻ tag dài quá 500 ký tự!');
                }else
                    cansubmit = true;
                break;
            default:
                cansubmit = true;
                break;
        }

        document.getElementById('btn_update_video').disabled = !cansubmit;
        return cansubmit;
    }
    function CheckFormBeforSubmit()
    {
        if(CheckForm(1) == false)
            return;
        if(CheckForm(2) == false)
            return;
        if(CheckForm(3) == false)
            return;
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#btn_edit_config').click(function(e) {
        alert("Link nhạc không đúng định dạng");
        e.preventDefault();
        // if (document.getElementById("ReupMusic").checked)        {
        //     var img = $("#ImageAdd").val();
        //     var url = $("#url").val();
        //
        //     if (url.includes("https://www.youtube.com/watch?v=")==false)
        //     {
        //         alert("Link nhạc không đúng định dạng");
        //         e.preventDefault();
        //     }
        //
        // }
    });
    function ChooseSearchConfig(){
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
</script>