<script>
function LoadPublishTime()
{
	alert("load date form");
	var date = new Date();
	var day = date.getDate();
	var month = date.getMonth() + 1;
	var year = date.getFullYear();
	if (month < 10) month = "0" + month;
	if (day < 10) day = "0" + day;
	var today = year + "-" + month + "-" + day;       
	document.getElementById("publishdate").value = "08/06/2018";
}
</script>