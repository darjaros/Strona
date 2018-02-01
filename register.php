<?php
 ob_start();
 session_start();
 if( isset($_SESSION['user']) && $_SESSION['user'] != 0  ){
  header("Location: cheater.php");
 }
 include_once 'logtosql.php';

 $error = false;
  $emailError = "";
  $nameError ="";
  $passError ="";

 if ( isset($_POST['email']) || isset($_POST['name']) || isset($_POST['pass']) ) {
  
  // clean user inputs to prevent sql injections
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);
  
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);

  // basic name validation
  if (empty($name)) {
   $error = true;
   $nameError = "Wpisz swoją nazwe użytkownika.";
  } else if (strlen($name) < 3) {
   $error = true;
   $nameError = "Nazwa użytkownika musi posiadać co najmniej 3 znaki.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
   $nameError = "Nazwa użytkownika musi posiadać tylko litery i spacje.";
  }
  
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Wpisz prawidłowy adres email.";
  } else {
   // check email exist or not
   $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
   $result = mysqli_query($polaczenie,$query);
   $count = mysqli_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Podany adres email został już wykorzystany.";
   }
  }
  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "Wpisz hasło.";
  } else if(strlen($pass) < 6) {
   $error = true;
   $passError = "Hasło musi zawierać co najmniej 6 znaków.";
  }
  
  // password encrypt using SHA1();
  $password = sha1($pass);
  
  // if there's no error, continue to signup
  if( !$error ) {
   
   $query = "INSERT INTO `users`(`userId`,`userName`,`userEmail`,`userPass`,`Admin`) VALUES( NULL, '".$name. "','".$email."','".$password."',0);";
   $res = mysqli_query($polaczenie,$query);
   if ($res) {
    $errTyp = "Sukcces";
    $errMSG = "Rejestracja przebiegła prawidłowo, możesz się zalogować";
    unset($name);
    unset($email);
    unset($pass);
   } else {
    $errTyp = "Błąd";
    $errMSG = "Coś poszło nie tak, spróbój później..."; 
   } 
    
  }
  
  
 }
 else {
	 $name="";
	 $email="";
 }
 ?>
 <div id="login-form">
	<form  name="sigIn" action="#" autocomplete="off">
   
    
     <div class="col-md-12">
        
         <div class="form-group">
             <h2 class="">Rejestracja</h2>
            </div>
        
         <div class="form-group">
             <hr />
            </div>
            
            <?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="name" class="form-control"  maxlength="50" />
                </div>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="email" name="email" class="form-control" maxlength="40"  />
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="pass" class="form-control" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <button type="button" class="btn btn-block btn-primary" onclick="SigIn()">ZAREJESTRUJ</button>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <a href="index.php">Sign in Here...</a>
            </div>
        
        </div>
   
    </form>
    </div> 

<?php ob_end_flush(); ?>