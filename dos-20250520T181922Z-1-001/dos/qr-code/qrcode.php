<?php
require_once 'connection.php';
require_once 'phpqrcode/qrlib.php';
$path = 'images/';
$qrcode = $path.time().".png";
$qrimage = time().".png";

if(isset($_REQUEST['sbt-btn']))
{
	$qrtext = $_REQUEST['qrtext'];
	$query = mysqli_query($connection,"insert into qrcode set qrtext='$qrtext', qrimage='$qrimage'");
	if($query)
	{
		?>
		<script>
			alert("Data save successfully");
		</script>
		<?php
	}
}

QRcode :: png($qrtext, $qrcode, 'H',4 , 4);
echo "<img src='".$qrcode."'>";
?>
