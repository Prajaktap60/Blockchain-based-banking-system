<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include("db.php");

$a= $_POST["FullNam"];
$b= $_POST["Emailid"];
$c= $_POST["MobNo"];
$d= $_POST["Pass"];
$e= $_POST["Cpass"];
$ee= $_POST['Address'];

$mess="";
$h="";
$h1="";
if(isset($_FILES['Aadhar']['name']))
	{
$h=time().$_FILES['Aadhar']['name'];
move_uploaded_file($_FILES['Aadhar']['tmp_name'],"upload/".$h);
	}
	else{
	$mess.="* Select Aadhar Card Image,<br>";
	}

if (isset($_FILES['Aadhar']['name']) and $_FILES['Aadhar']['size'] < 2048)
{
$mess.="* Aadhar Card Image Max Size 2mb<br>";
}

if(isset($_FILES['PanCard']['name']))
	{
$h1=time().$_FILES['PanCard']['name'];
move_uploaded_file($_FILES['PanCard']['tmp_name'],"upload/".$h1);
	}
	else{
	$mess.="* Select Pan Card Image,<br>";	
	}

if (isset($_FILES['PanCard']['name']) and $_FILES['PanCard']['size'] < 2048)
{
$mess.="* Pan Card Image Max Size 2mb<br>";
}

$mess.=Fullnamevalid($a,"* Enter Full Name");
$mess.=EmailValid($b,"* Plz Enter valid Email");
$mess.=DatbaseValid($b,"* Email All Ready Register");
$mess.=Passvalid($d,"* Plz Enter Password",8);
$mess.=PasswordStrengthValid($d,"* Enter Valid Password[(One Special Character - '!@#$%^&*-')(One Capital Letter)(One Numric)]");

$mess.=EqualValid($d,$e,"* Password Conformation Fail");

	//++++++++Full Name Only+++++++++++++++
	function Fullnamevalid($names,$nametital)
	{
         if(!preg_match('/^[_a-z]+( [_a-z]+)$/i',$names))
         {
         return $nametital.",<br>";
         }
	}

	//++++++++Email Valid+++++++++++++++
	function EmailValid($names,$nametital)
	{
		if(!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $names))
		{
			 return $nametital.",<br>";
		}
	}

		//++++++++Not Empty+++++++++++++++
	function nullvalid($names,$nametital)
	{
		if($names=="")
		{
         return $nametital.",<br>";
		}	
	}

//++++++++Data Base Valid+++++++++++++++
	function DatbaseValid($valuechk,$nametital)
	{
	global $conn;
	$result = $conn->query("select * from  customer where Email='".$valuechk."'");
 
	if($result->num_rows>=1)
		{
		 return $nametital.",<br>";
		}
	}

//++++++++Data Base Valid+++++++++++++++
	function DatbaseValid1($valuechk,$nametital)
	{
	global $conn;
	$result = $conn->query("select * from  customer where Accid='".$valuechk."'");
	if($result->num_rows>=1)
		{
		 return $nametital.",<br>";
		}
	}

	function Passvalid($names,$nametital,$length)
	{
		$x=strlen($names);
		if($x<$length)
		{
			return $nametital."(Min Length $length),<br>";
		}
	}

//++++++++Equal Valid+++++++++++++++
	function EqualValid($names1,$names2,$nametital)
	{
		if($names1!=$names2 || $names1=="")
		{
			 return $nametital.",<br>";
		}
	}

	//++++++++Password Strength Valid+++++++++++++++
	function PasswordStrengthValid($names,$nametital)
	{
		if(!preg_match('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $names))
		{
			 return $nametital.",<br>";
		}
	}
	
if($mess=="")
{

$aa=$conn->query("INSERT INTO customer(Name,Email,Mob,pass,Address,Aadhar,PanCard,UserVerify) VALUES ('$a','$b','$c','$d','$ee','$h','$h1','')");

$OTPkeys=rand(111111,999999);
$_SESSION['OTPSignup'] = $OTPkeys;
$_SESSION['OTPEmail'] = $b;

$emailmess="hi,".$a.". Thank For Signup, Now verify account using OTP is - ".$OTPkeys;
myCode1($emailmess,$b,$a);



echo "<script> alert('Thank For Registration.!'); location.href='index.php?page=14';</script>";
}
else
{
echo "<font color='#8B0000' style='font-size:12px' >Registration Fail:<br>".$mess."</font>";
}

?>
