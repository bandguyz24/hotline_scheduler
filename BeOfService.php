<?php 
//the below header line stops the browser from caching the page
//because the site requires a username and password
//I use an internal back button on subsequent pages
//also this ensures the most current database data is reflected

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

//if the post is empty redirect the user
if (empty($_POST["UserName"]))
	
//the redirection url has been removed from the below line	
//add your url for redirection
   { header("Location: http://"); 
     exit;
   }
?>
<HTML>
<HEAD>
<meta charset="UTF-8">
<!-- the viewport meta below allows viewing on an android or iphone -->	
<meta name="viewport" content="width=device-width">
 <TITLE>The title of your website here</TITLE>
</HEAD>
<BODY style = "background-color:#EAFAF1;">
 <h1 style = "color:blue; text-align:center;"> Your Organization here</h1>

<!--there is an administrative feature on this site on Permissions.php page
    when a user creates an account their permission will automatically set to [B]  
    Blocked which limits which pages they can access someone with Administraive access has to
    manually set their permission to [U]  this feature can be removed if desired-->
	
 <h2 style = "color:blue; text-align:center;">Note : if you just created your account today your access will be limited until the chair person verifies your account</h2>
  <h2 style = "color:blue; text-align:center;"> You will only be able to volunteer for hotline shifts...viewing the schedule and internal messaging will be disabled</h2>

<?php
 
include 'DB_Connect.php';

//the database schema name has been removed from the below line

$dbname = '';
//DB_Connect is a class that stores the database username, password,location
//the connect to database function returns a mysqli object to the $conn variable
$DB = new DB_Connect();
$conn = $DB->Connect_To_Data_Base($dbname);
$UserName = $_POST["UserName"];
$PassWord = $_POST["PassWord"];

//the code below should be changed into a prepared statement to prevent injection
//the connectsoion is currently open and here is the correct code
/*
$sql = "SELECT id FROM Login WHERE UserName = '{$UserName}' AND PassWord = '{$PassWord}'";
if (!($stmnt = $conn->prepare($sql)))
   {echo "Error connecting to database\n";}
 else
 {$stmnt->execute();
   $result = $stmnt->get_result();
  $stmnt->close();}
  
  //use this above commented out code instead of the 2 lines below
*/
// change the below 2 lines to a prepared statement	
$sql = "SELECT id FROM Login WHERE UserName = '{$UserName}' AND PassWord = '{$PassWord}'";
$result = $conn->query($sql);

 if ($result->num_rows === 0)
{ echo "INVALID PASSWORD {$UserName} <a href=\"Volunteer_Login.php\" >BACK TO LOGIN PAGE</a>" ;
exit; }
else  echo "you are logged in";

$ID = $result->fetch_row();
	
//comment out the below line if you are not testing or do not need to see the user id
echo  "<th> your user id = {$ID[0]} </th>";

//close the result after finished	
$result->close();

//now display the users first and last name based on their id fetch
//this should be changed into a prepared statement
$sql = "SELECT FirstName, LastName FROM Volunteer WHERE id = '{$ID[0]}'";
$result = $conn->query($sql);
$FullName = $result->fetch_row();
$FirstName = $FullName[0];
$LastName = $FullName[1];



echo "<h2 style = \"color:blue; text-align:center;\"> Welcome! {$FirstName} {$LastName} Thank You For Your Service</h2>";
echo<<<END
<ul>
<li><button type = "submit" form = "view_schedule"
style = "border : none; background : none; color : blue; text-decoration: underline; font-size : 14px; margin-left : -5px">View Schedule</button> </li>
<li><button id = "message" style = "border : none; background : none; color : blue; text-decoration: underline; font-size : 14px; margin-left : -5px"
     onclick = "gotoMessages()">Message Chairperson</button></li>
<li><a href = "Volunteer_Login.php" style = "font-size : 14px; color : blue">Back To Volunteer Login</a></li>
<li><a href = "http://www.contracostaaa.org/" style = "font-size : 14px; color : blue">Back To ContraCostaAA.org</a></li>
<li><button form = "myForm" style = "border : none; background : none; color : blue; text-decoration: underline; font-size : 14px; margin-left : -5px"
     >Volunteer For The Hotline</button></li>


     <li><button form = "ChairPersonLogin" style = "border : none; background : none; color : blue; text-decoration: underline; font-size : 14px; margin-left : -5px"
     >Chair Person / Administrator Page</button></li>


</ul>
<div style = "display : none">
<form action = "Message_Chair.php" method = "post">
<input type = "hidden" name = "UserName" value = "{$UserName}"></input>
<input type = "hidden" name = "PassWord" value = "{$PassWord}"></input>
<input type = "submit" id = "SendMessage"></input>
</form>
</div>
<div style = "display : none;">
<form id = "view_schedule" action = "View_Schedule.php" method = "post">
<input type = "hidden" name = "UserName" value = "{$UserName}"></input>
<input type = "hidden" name = "PassWord" value = "{$PassWord}"></input>
<input type = "hidden" name = "PageFrom" value = "BeOfService.php"></input>
</form>
</div>

END;
$result->close();
$conn->close();
?>
<div style ="display : none">   <table><tr>
  <td> <form id="myForm" method="post" action= "Volunteer_Main02.php"  >
      <input type = "hidden" name="UserName" value="<?php echo $UserName?>">
      <input type = "hidden" name="PassWord" value="<?php echo $PassWord?>" >
      <input type = "hidden" name = "PageFrom" value = "BeOfService.php"> </input>
      <button type="submit">Volunteer For The Hotline</button>
    </form> </td>
    <!--add html here  to remove the javascript ;ogin post the user name and on chairperson page check the login table for permission -->
    <td><form id ="ChairPersonLogin" method ="post" action = "Chair_Person.php">
    <input type = "hidden" name="UserName2" value="<?php echo $UserName?>">
    <input type = "hidden" name="PassWord" value="<?php echo $PassWord?>" >
    <button type = "submit">Chair Person Page</button>
    </form></td>
    </tr>
    </table>
</div>
<script>
 function gotoMessages()
 {document.getElementById("SendMessage").click();
 }
        </script>
</body>


</HTML>


