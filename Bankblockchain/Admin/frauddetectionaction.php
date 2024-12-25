<?php
include('db.php');
?>
<div id="flash" class="flash"></div>

<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery.form.js"></script>

<script type="text/javascript">
// Update selection Record Into Table++++++++++++++++++++++++++++++++++++++++++++++++++++++
$(function() {
$(".Edit").click(function() {
var element = $(this);
var del_id = element.attr("id");
var info = 'ide=' + del_id;
if(info=='')
{
alert("Select For Edit..");
}
else
{
document.getElementById("show").innerHTML="";
$("#flash").fadeIn(400).html('<span class="load"><img src="load.gif"></span>');
$.ajax({
type: "POST",
url: "frauddetectionaction.php",
data: info,
cache: true,
success: function(html){
$("#flash").fadeIn(400).html('');
$("#show").append(html);
}  
});
}
return false;
});
});
</script>

<?php
if(isset($_POST['ide']))
{
$id=$_POST['ide'];
//$select_table = "select * from applypassport,customer where applypassport.UID=customer.CID and AID=".$id;
$select_table="select * From transaction where TID='$id'";
$fetch = $conn->query($select_table);
while($row = $fetch->fetch_assoc())
{
?>
<div class="table-responsive">
<script src="https://rawgit.com/ethereumjs/browser-builds/master/dist/ethereumjs-abi/ethereumjs-abi-0.6.5.js"></script> 
<script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js/dist/web3.min.js"></script>

<?php echo '<script type="text/javascript"> var systemaddre="'.$system_address.'"; </script>'; ?>


<script type="text/javascript">
// Insert Record Into Table++++++++++++++++++++++++++++++++++++++++++++++++++++++
$(function() {
$(".Updatesubmit_button").click(function() {

//alert("Yes");
var web3 = new Web3('http://127.0.0.1:7545');
web3.eth.getAccounts().then(e => console.log(e));
var myContract = new web3.eth.Contract([{"constant":true,"inputs":[{"name":"a","type":"uint256"}],"name":"multiply","outputs":[{"name":"d","type":"uint256"}],"payable":false,"type":"function"}],systemaddre);

var thash=$("#thash").val();
var bhash=$("#bhash").val();
var bnum=$("#bnum").val();
var Adata=$("#Adata").val();


web3.eth.getBlock(bnum).then(function(receipt){

	if (receipt) {
			//alert(receipt.hash);
			//alert(receipt.number);
			//alert(receipt.transactions);
			
			/*
			// Prepare block information to display in alert
			var blockInfo = "Block Number: " + receipt.number + "\n";
			blockInfo += "Hash: " + receipt.hash + "\n";
			blockInfo += "Timestamp: " + new Date(receipt.timestamp * 1000) + "\n";
			blockInfo += "Transactions: " + receipt.transactions.length + "\n";
			// Add more block properties as needed
			// Show block information in alert
			alert(blockInfo);
			*/
			
			//var dataField = receipt.extraData;
			//alert(dataField);
			

			
			if(receipt.hash==bhash)
			{
				
				// Get transaction details
				web3.eth.getTransaction(thash).then(function(transaction) {
					// Check if transaction exists
					if (transaction) {
						// Get data field from transaction input
						var dataField = web3.utils.hexToAscii(transaction.input);
						//alert("Data in transaction: " + dataField);
						if(dataField==Adata)
						{
							alert("Authorized Transaction Verify,No Change.!");
						}
						else{
							alert("Unauthorized Transaction Detect,Change In Transaction.!");
						}
						
					} else {
						alert("Transaction not found");
					}
				}).catch(function(error) {
					console.error(error);
				});
			

			}
			else
			{
				alert("Unauthorized Person Try to Access and Modify.!");
			}
		} 
		else {
        alert("Block not found");
		}
		
		});
	


return false;
});
});
</script>


<form action="frauddetectionaction.php" method="post" name="form" id="form" enctype="multipart/form-data">

<input type="hidden" id="Adata" name="Adata" value="<?php echo $row['CUID'].'_'.$row['DUID'].'_'.$row['Amount']; ?>">

<input type="hidden" id="thash" name="thash" value="<?php echo $row['thash']; ?>">
<input type="hidden" id="bhash" name="bhash" value="<?php echo $row['bhash']; ?>">
<input type="hidden" id="bnum" name="bnum" value="<?php echo $row['bnum']; ?>">
<input type="hidden" id="TID" name="TID" value="<?php echo $row['TID']; ?>">

<?php
$result1 = $conn->query("select * From customer where CID='".$row['CUID']."'");
while($row1 = $result1->fetch_assoc())
	{	
?>
<table class="table table-striped table-hover table-bordered">
<TR><TD><b>Credit CID</b></TD><TD><?php echo $row1['AID']; ?></TD></TR>
<TR><TD><b>Credit Name</b></TD><TD><?php echo $row1['Name']; ?></TD></TR>
<TR><TD><b>Credit Email</b></TD><TD><?php echo $row1['Email']; ?></TD></TR>
<TR><TD><b>Credit Mobile</b></TD><TD><?php echo $row1['Mob']; ?></TD></TR>

<?php
	}	
?>

<?php
$result1 = $conn->query("select * From customer where CID='".$row['DUID']."'");
while($row1 = $result1->fetch_assoc())
	{	
?>

<TR><TD><b>Debit CID</b></TD><TD><?php echo $row1['AID']; ?></TD></TR>
<TR><TD><b>Debit Name</b></TD><TD><?php echo $row1['Name']; ?></TD></TR>
<TR><TD><b>Debit Email</b></TD><TD><?php echo $row1['Email']; ?></TD></TR>
<TR><TD><b>Debit Mobile</b></TD><TD><?php echo $row1['Mob']; ?></TD></TR>
</table>
<?php
	}	
?>

<table class="table table-striped table-hover table-bordered">
<TR><TD><b>Transaction Date</b></TD><TD><?php echo $row['Tdt']; ?></TD></TR>
<TR><TD><b>Transaction Amount</b></TD><TD><?php echo $row['Amount']; ?></TD></TR>

<TR><TD></TD><TD>
<input type="button" value="Verify" name="submit" class="Updatesubmit_button" style="width:74px;height:35px;border:1px #C0C0C0 solid;background-color:#000000;color:#FFFFFF;font-family:Arial;font-weight:bold;font-size:13px;">


</TD></TR>

 

 

</table>
<div id="show1"></div> 
</form>
</div>
<?php
}
}
?>


<div class="table-responsive">
<h4 class="margin-bottom-15">Table</h4>
<table class="table table-striped table-hover table-bordered">
<thead><tr>
<th>Transaction ID</th>
<th>Transaction Date</th>
<th>Account</th>
<th>Credit</th>
<th>Debit</th>
<th>Amount</th>
</tr></thead>
<tbody>
<?PHP
$Uid="0";
if(isset($_POST['sertex']))
{
$result=$conn->query("select * From customer where CID='".$_POST['sertex']."'");
while($row = $result->fetch_assoc())
{
	$Uid=$row['CID'];
}

}
$result=$conn->query("select * From transaction where CUID='$Uid' or DUID='$Uid'");
$Tamount=0;
while($row = $result->fetch_assoc())
{
?>
<tr>
<td class="name"><?php echo $row['TID']; ?></td>
<td class="name"><?php echo $row['Tdt']; ?></td>
<?php
if($row['CUID']==$Uid)
{
$Tamount=$Tamount+$row['Amount'];
?>	

<td class="name">
<?php 
if($row['DUID']==0)
{
echo "Pay by Cash"; 
}
else{
echo $row['DUID']; 
}
?>
</td>
<td class="name"><?php echo $row['Amount']; ?>/-</td>
<td class="name"></td>
<td class="name"><?php echo $Tamount; ?>/-</td>
<?php
}
?>

<?php
if($row['DUID']==$Uid)
{
$Tamount=$Tamount-$row['Amount'];
?>	
<td class="name"><?php echo $row['CUID']; ?></td>
<td class="name"></td>
<td class="name"><?php echo $row['Amount']; ?>/-</td>
<td class="name"><?php echo $Tamount; ?>/-</td>
<?php
}
?>

<TD>
<a href="#" class="Edit" id="<?php echo $row['TID']; ?>" alt="<?php echo $row['Accid']; ?>">[ Verify   ]</a>
</TD>
</tr>
<?php
}
?>
</tbody></TABLE> 
              
			  
</div>