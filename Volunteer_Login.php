<?php
//Volunteer_Login.php
echo<<<END
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<head>
</head>
<body style="background-color : lightblue;"><h1 style = "margin-left:200px; color : blue;" >BE OF SERVICE</h1><br>

<div >
<h2 style ="color:blue; "> VOLUNTEER LOGIN</h2>
<a href = "http://contracostaaa.org/" > Back To CONTRACOSTAAA.ORG</a><br><br>
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
