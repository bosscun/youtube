<script>

    var clipboard = new ClipboardJS('.copyText');

    clipboard.on('success', function(e) {
        alert("Đã copy : " +e.text);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });



    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    function ChooseSearchProcess(){
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