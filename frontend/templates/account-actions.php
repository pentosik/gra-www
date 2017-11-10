<?php
    if(isset($_SESSION['loggedin']))
        {    
           // echo $_SESSION['loggedin'];
?>
            <div class="account-actions">
                        <a href="index.php?page=logout">Logout</a>
                        <a href="index.php?page=account">Account</a>
                        <?php
                        echo "Witaj ".$_SESSION['loggedin'];
                        ?>
            </div>
<?php
        }
    else
    {
?>

            <div class="account-actions">
                        <a href="index.php?page=login">login</a>
                        <a href="index.php?page=register">Registration</a>
            </div>
<?php
    }
?>
