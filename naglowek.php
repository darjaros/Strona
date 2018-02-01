		<header>
		<div class="row">
		<div class="col-sm-2" >
				<a href="index.php " class="header-left"><h1>Logo</h1></a>
				</div>
				<div class="col-sm-10 to-right form-inline" style= "text-align:right; float:right;" >
				<?php
					$eror ="";
					if(!isset($_SESSION['user'])&&!(isset($_POST['usr'])&&isset($_POST['pass']))){
						// Sesja się zaczyna, wiec inicjujemy użytkownika anonimowego
						session_start();
						$_SESSION['user'] = 0;
					}
					else{
					include 'logtosql.php';
					if(isset($_POST['usr'])&&isset($_POST['pass'])){
						session_start();
						$usr = $_POST['usr'];
						$pass = sha1($_POST['pass']);
						$sql = 'SELECT `UserId`, `UserName`,`Admin`
								FROM `users` 
								WHERE `UserName` = "' . $usr .
								'" AND `UserPass` = "'. $pass.
								'" ORDER BY `UserId` ASC;';		
						$wynik = mysqli_query($polaczenie, $sql);
						$user = @mysqli_fetch_array($wynik);
						if(mysqli_num_rows($wynik) > 0){
							$eror ="Błędna nazwa użytkownika lub hasło";
							$_SESSION['user'] = $user['UserId'];
						}
					
					}}
						if($_SESSION['user'] != 0){
							include 'logtosql.php';
							$sql = 'SELECT `UserId`, `UserName`,`Admin`
									FROM `users` 
									WHERE `UserId` = "' . $_SESSION['user'] .
									'" ORDER BY `UserId` ASC;';	
							$wynik = mysqli_query($polaczenie, $sql);
							$user = @mysqli_fetch_array($wynik);
							
							echo ' <form class="form-group header-right" method="post" action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" >
							<label>Witaj, '.$user['UserName'].'</label>
							<button type="submit" class="btn btn-default header-right" onclick="login()"> Wyloguj</button>';
						} 
						else{
							echo '<form method="post" action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" >
					<div class="form-group header-right ">
						<label for="usr">Nazwa użytkownika:</label>
						<input type="text"   class="form-control ex2 input-sm" name="usr">
					</div>
				<div class="form-group header-right">
						<label for="pass">Hasło:</label>
						<input type="password" class="form-control ex2 input-sm" name="pass">
				</div>
				
					<button type="submit" class="btn btn-default header-right" onclick="login()" >Zaloguj</button>
					<button type="button" class="btn btn-default header-right" onclick="SigInbutton()" >Zarejestruj</button>
					</form>
				</div>';
				
					}
						
				?>
				
		</div>
		</header>
