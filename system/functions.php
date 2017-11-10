<?php
    function getPage()
    {
        if(isset($_GET['page']))
        {
            $page=$_GET['page'];
            if($page=="index")
            {
                 require_once("frontend/pages/index.php");
            }
            elseif($page=="contact")
            {
                require_once("frontend/pages/contact.php");
            }
            elseif($page=="register")
            {
                require_once("frontend/pages/register.php");
            }
            elseif($page=="login")
            {
                require_once("frontend/pages/login.php");
            }
            elseif($page=="logout")
            {
                session_destroy();
                echo "Logged out.";
                header("Location:index.php?msg=logoutsuccess");
            }
            elseif($page=="account")
            {
                require_once("frontend/pages/account.php");
            }
            elseif($page=="airport-upgrade")
            {
                require_once("frontend/pages/airport-upgrade.php");
            }
        }
        else
        {
            require_once("frontend/pages/index.php");
        }
    }
    //---------------------------------------------------------------------------------------
    
  ?>

<?php
function switch_up($id,$imgname,$type,$building)
{   
if(isset($_SESSION['loggedin']))

{   
    //Dane do Polaczenia z baza danych /data to connection to db
    $db_server="localhost";
    $db_username="root";
    $db_password="";
    $db="mmorts";

    //Create connection/Polaczenie z baza danych
    $conn=new mysqli($db_server,$db_username,$db_password,$db);

    //Check connection /sprawdzanie polaczenia
    if($conn->connect_error)
    {
        die("Connection Failed: ".$conn->connect_error);
    }
    else
    {
        $username=$_SESSION['loggedin'];
        //Connection to Database works/ Polaczono z baza danych DODAC SEPARATOR
        $query="SELECT id FROM uzytkownicy WHERE user='$username'" ;
        $result=mysqli_query($conn,$query);
        $row=mysqli_fetch_assoc($result);

        $userId=$row['id'];

        
        $query="SELECT cash, passtart,hangar1,hangar2,hangar3,wiezakontroli FROM airport WHERE user_id='$userId'" ;
        $result=mysqli_query($conn,$query);
        $row=mysqli_fetch_assoc($result);
        //Airport Data
        $kasa=$row['cash'];
        $pas_start=$row['passtart'];
        $hangar1=$row['hangar1'];
        $hangar2=$row['hangar2'];
        $hangar3=$row['hangar3'];
        $wieza_kontroli=$row['wiezakontroli'];
        




    }  

    if ($building=="pas")
        {   $level=$pas_start;}
    elseif($building=="hangar1")
        {
             $level=$hangar1;
        }
    elseif($building=="hangar2")
        {
              $level=$hangar2;
        }
    elseif($building=="hangar3")
        {
               $level=$hangar3;
        }
    elseif($building=="wieza")
        {
           $level=$wieza_kontroli;
        }
  
    if($type==1)
    {

        ?>
        <script>
                var obraz=<?php echo $imgname.$level; ?>;
                var ident=<?php echo'"'.$id.'"'?>;
                var obraz = <?php echo $obraz ?>
                //var source="frontend/images/obraz";
            
            <?php

                  echo "<script>";
                    echo 'document.getElementById(ident).innerHTML=<img src="frontend/images/"+obraz+".png alt="" width="150" height="130"/>"';
                    echo "</script>";
                ?>
            </script>		
        <?php
    }
    else if($type==2)
    {
        ?>
         <script>
        var poziom=<?php echo $level?>;
        var obraz=<?php echo $imgname?>+poziom+".png";
        document.getElementById(<?php echo $id?>).innerHTML='<img src="frontend/images/'+obraz+'" alt="" width="150" height="130"/>';
        </script>	
        <?php
    }
}
}
?>