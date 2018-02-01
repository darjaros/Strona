		<nav class="navbar navbar-inverse">
		<div class="container-fluid">
		<div class="collapse navbar-collapse" id="myNavbar">
		<div class="row">
		<ul class="nav navbar-nav navbar-">
		
<?php
	include 'logtosql.php';
	if ($_SESSION['user'] != 0){
		$sql = 'SELECT `UserId`, `UserName`,`Admin`
				FROM `users` 
				WHERE `UserId` = "' . $_SESSION['user'] .
				'" ORDER BY `UserId` ASC;';	
		$wynik = mysqli_query($polaczenie, $sql);
		$user = @mysqli_fetch_array($wynik);
	$sql = 'SELECT `Id`, `Name`, `Havingcategories`
			FROM `sub` WHERE `Admin` ='.$user['Admin'].
			' ORDER BY `ID` ASC';
			
	}
	else{
		$sql = 'SELECT `Id`, `Name`, `Havingcategories`
			FROM `sub` WHERE `Admin` = 0
			ORDER BY `ID` ASC';
	}
	
	$wynik = mysqli_query($polaczenie, $sql);
	if (mysqli_num_rows($wynik) > 0) {
		while (($sub = @mysqli_fetch_array($wynik))) {
			if($sub['Havingcategories']){
				echo '<li class="dropdown">' . PHP_EOL;
				echo '<button type="button" class="btn btn-primary dropdown-toggle btn-md col-sm-12"  data-toggle="dropdown">'.$sub['Name'] .'</button>'. PHP_EOL;
				echo '<ul class="dropdown-menu"> '. PHP_EOL;
				echo '<div class="btn-group-vertical btn-group-justified ">'. PHP_EOL;
				include 'logtosql.php';
				$sql = 'SELECT `Id`, `Name`
						FROM `categories` 
						WHERE `Sub_Id` ='. $sub['Id'].
						' ORDER BY `ID` ASC';
				
				$wynik2 = mysqli_query($polaczenie, $sql);
				if (mysqli_num_rows($wynik2) > 0) {
					while (($categories = @mysqli_fetch_array($wynik2))) {
						echo '<li><button type="button" class="btn btn-primary  col-sm-12 bluebutton " onclick="loadDoc('.$sub['Id']. ','. $categories['Id'].')">'.$categories['Name' ]. '</button>'. PHP_EOL;
				}}
				echo "</div>" . PHP_EOL;
				echo "</ul>" . PHP_EOL;
				
				}
			else{ 
				echo '<li><button type="button" class="btn btn-primary btn-md col-sm-12" onclick="loadDoc('.$sub['Id'].')">'.$sub['Name']. '</button>'. PHP_EOL;
			}
		}
		echo "</ul>" . PHP_EOL;
				} 		
		else {
			echo 'wyników 0';
		}
		mysqli_close($polaczenie); 
		?>
		</div>
    </div>
  </div>
  </nav>