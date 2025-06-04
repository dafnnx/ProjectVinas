<?php
include("sess.php");
include("tools.php");
$login = new Login();
if ($login->isUserLoggedIn()==true) {
   header("location:dashboard.php");
} else { ?>   
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
   <link href="css/login.css" type="text/css" rel="stylesheet" />
</head>
<body >
  <section>
    <div class="container">    
      <div class="user signinBx">
        <div class="imgBx"></div>
        <div class="formBx">
          <form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" >
            <input type="hidden" name="ipip" value="<?php echo $ipip?>">
            <input placeholder="Usuario" name="user_name" type="text" value="" required>
            <input placeholder="Contraseña" name="user_password" type="password" value="" placeholder="Password" autocomplete="off" required>
            <input type="submit"  name="login" id="submit" value="Ingresar">
            <?php
        if (isset($login)) {
          if ($login->errors) {         ?>
            <div class="dismissible" role="alert">                   
            <?php 
            foreach ($login->errors as $error) {
              echo $error;
            }            ?>
            </div>
            <?php         }
          if ($login->messages) {            ?>
            <div class="dismissible" role="alert">
            <?php
            foreach ($login->messages as $message) {
              echo $message;            }            ?>
            </div> 
            <?php           }        }        ?>
          </form>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
<?php   }  ?>