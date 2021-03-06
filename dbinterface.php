<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Simple Web Store</title>
        <style>
            .error {color: #FF0000;}
        </style>
        </head>
        <body>
        <?php include 'contodb.php'; ?>
      <div id="container" style="width: max-content"></div>
        <div id="header" style="background-color:#FFA500;">
        <h1 style="margin-bottom:0;">Simple Web Store</h1></div>
        <p><?php echo '<a href ="index.php" target="_self"> Home </a>'; ?></p>


   <h2>Database Settings </h2>

<?php 
        session_start();
            global $db_host;
            global $db_user; 
            global $db_pass;  
            global $db_name; 

            $db_host= $_SESSION['db_host'];
            $db_user= $_SESSION['db_user'];
            $db_pass= $_SESSION['db_pass']; 
            $db_name= $_SESSION['db_name'];

       $db_hostErr = $db_userErr = $db_passErr = $db_nameErr = "";
       if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if (empty($_POST["db_host"]))
            {
                $db_hostErr = "Server name is required";
                $db_host = "mysql-server-1"; // gethostname() mysql-server-1; // PHP 5.3 onwards
            }
            else
            {
                $db_host = test_input($_POST["db_host"]);
            }
  
            if (empty($_POST["db_user"]))
            {
                $db_userErr = "Database username is required";
                $db_user = 'naf31';
            }
            else
            {
                $db_user = test_input($_POST["db_user"]);
            }
    
            if (empty($_POST["db_pass"]))
            {
                $db_passErr = "Database Password is required";
                $db_pass = 'abcnaf31354';
            }
            else
            {
                $db_pass = test_input($_POST["db_pass"]);
            }

            if (empty($_POST["db_name"]))
            {
                $db_nameErr = "Database Name is required";
                $db_name = 'naf31';
            }
            else
            {
                $db_name = test_input($_POST["db_name"]);
                
            }

        }


        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
 ?>

    <p><span class="error">* required field.</span></p>
    <form style='margin: 0; padding: 0'action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <table>
    <tr>
    <td><label style="vertical-align: middle">Server: </label></td> 
    <td><input type="text" name="db_host" value="<?php echo $db_host;?>" />
    <span class="error">* <?php echo $db_hostErr;?></span>
    </td>
    </tr>

    <tr>
    <td><label>Username: </label></td>
    <td><input type="text" name="db_user" value="<?php echo $db_user;?>"/>
    <span class="error">* <?php echo $db_userErr;?></span>
    </td>
    </tr>

    <tr>
    <td><label>Password:   </label></td>  
    <td><input type="password" name="db_pass" value="<?php echo $db_pass;?>"/>
    <span class="error">* <?php echo $db_passErr;?></span>
    </td>
    </tr>

    <tr>
    <td><label>Database Name  : </label></td>
    <td><input type="text" name="db_name" value="<?php echo $db_name;?>"/>
    <span class="error">* <?php echo $db_nameErr;?></span>
    </td>
    </tr>

    </table> 
    <p><input style='display:inline;' type="submit" name="dbsettings" value="Change"> </p>
     
    </form>

<?php
    
        if(isset($_POST['dbsettings']))
        {
            $_SESSION['db_host'] = $_POST['db_host'];
            $_SESSION['db_user'] = $_POST['db_user'];
            $_SESSION['db_pass'] = $_POST['db_pass'];
            $_SESSION['db_name'] = $_POST['db_name'];
            connToStore();
        }
       


?>


</html>