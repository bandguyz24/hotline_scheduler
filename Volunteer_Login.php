<?php
//Volunteer_Login.php
//this is the entry point for the web application
//if they have a username and password then they will be taken to BeOfService.php
//otherwise they create an account on New_Volunteer02.html
//or go to Forgot_Password.php
//or back to some sort of main page

//I was just learning some php stuff but there is no particular reason why the html needs to be echoed here
//echoing the html was useful for me later when using php data
echo<<<END
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<head>
</head>
<body style="background-color : lightblue;"><h1 style = "margin-left:200px; color : blue;" >BE OF SERVICE</h1><br>
<div>
<h2 style ="color:blue; "> VOLUNTEER LOGIN</h2>
<a href = "" > Back To Main Site</a><br><br> <!-- The href has been removed from this line put yours here -->
<form action = "BeOfService.php" method = "post">
User Name: <input type="text" style = "margin-left : 18px;" size="32" name= "UserName" id = "User_Name" placeholder="Bill W. 925-123-4567"></input>  <br>
PASSWORD : <input  type="password" size="32" name = "PassWord" id = "Pass_word"
maxlength = "32" pattern = "{8,32}">Must Be At Least 8 Characters</input> <br>
<input type ="submit" name= "submit" > LOG IN </input>
</form><br>
<h3> Dont Have a Password? <a href = "New_Volunteer02.html"> Sign Up Now </a>  </h3>
<h3>Forgot Your Password? <a href = "Forgot_Password.php">Send me my password</a></h3>
</div>
</body>
</html>
END;
 
 
 // names passed to
?>
