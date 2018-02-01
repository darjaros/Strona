<?php
include 'logtosql.php';
if(isset($_POST['usr'])){
	$usr = $_POST['usr'];
}
else{
	echo "nie podano nazwy użytkownika";
}
if(isset($_POST['pass'])){
	$pass = sha1($_POST['pass']);
}
else{
	echo "nie podano hasła użytkownika";
}
$sql = 'SELECT `UserId`, `UserName`,`Admin`
		FROM `users` 
		WHERE `UserName` = "' . $usr .
		'" AND `UserPass` = "'. $pass.
		'" ORDER BY `UserId` ASC;';		
		echo $sql;
		echo $_SESSION['user'];
		
$wynik = mysqli_query($polaczenie, $sql);
$user = @mysqli_fetch_array($wynik);
		
if(mysqli_num_rows($wynik) > 0)
{
	$_SESSION['user'] = $user['UserId'];
	
	echo "zalogowałeś sie poprawnie";
}
	echo $_SESSION['user'];
	echo $user['UserId'];

	?>