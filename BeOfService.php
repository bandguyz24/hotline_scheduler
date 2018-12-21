<?php 

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
if (empty($_POST["UserName"]))
   { header("Location: http://contracostaaa.org/cc-aa-test-empty/Volunteer_Login.php");
     exit;
   }
?>
<HTML>
<HEAD>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
 <TITLE>Contra Costa Alcoholics Anonymous :  Be Of Service Main</TITLE>
</HEAD>
<BODY style = "background-color:#EAFAF1;">
 <h1 style = "color:blue; text-align:center;"> Contra Costa Alcoholics Anonymous</h1>
 <h2 style = "color:blue; text-align:center;">Note : if you just created your account today your access will be limited until the chair person verifies your account</h2>
  <h2 style = "color:blue; text-align:center;"> You will only be able to volunteer for hotline shifts...viewing the schedule and internal messaging will be disabled</h2>
<?php
  include 'DB_Connect.php';
$dbname = 'CCAA0003';
$DB = new DB_Connect();
$conn = $DB->Connect_To_Data_Base($dbname);
$UserName = $_POST["UserName"];
$PassWord = $_POST["PassWord"];

$sql = "SELECT id FROM Login WHERE UserName = '{$UserName}' AND PassWord = '{$PassWord}'";
$result = $conn->query($sql);
if ($result->num_rows === 0)
{ echo "INVALID PASSWORD {$UserName} <a href=\"Volunteer_Login.php\" >BACK TO LOGIN PAGE</a>" ;
exit; }
else  echo "you are logged in";

$ID = $result->fetch_row();
echo  "<th> your user id = {$ID[0]} </th>";
$result->close();
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


