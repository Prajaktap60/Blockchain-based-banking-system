<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include("db.php");

$d= $_POST["UserEmail"];
$e= $_POST["UserPass"];

$result = $conn->query("select * From customer where Email='$d' and Pass ='$e' and UserVerify='Y'");
$Eth=0;
while($row = $result->fetch_assoc())
	{	
		if($row["EthereumAddr"]!='')
		{
			$_SESSION['userid'] = $row['CID'];
			$_SESSION['username']= $row['Name'];
			$_SESSION['usereaddre']= $row["EthereumAddr"];
		}else{
			$Eth=1;
		}
	}
		

if($_SESSION['userid']!="" and $_SESSION['username']!="")
	{
		echo "<script> location.href=\"index.php?page=6&M=4\";</script>";
	}
	if($Eth==1)
	{
	echo "<font color='#FF0000' >Wait To Login Approval Is Pending.!</font>";
	}
	else
	{
	    echo "<font color='#FF0000' >Login Fail plz Check Email and Password.!</font>";
	}

?>
