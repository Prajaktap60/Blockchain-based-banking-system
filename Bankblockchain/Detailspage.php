<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include("db.php");

$d= $_POST["Accid"];
$y=0;
$result = $conn->query("select * From customer where CID='$d'");

while($row = $result->fetch_assoc())
	{	
$y=1;
?>
<script src="https://rawgit.com/ethereumjs/browser-builds/master/dist/ethereumjs-abi/ethereumjs-abi-0.6.5.js"></script> 
<script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js/dist/web3.min.js"></script>
<?php echo '<script type="text/javascript"> var usereaddre="'.$_SESSION['usereaddre'].'"; </script>'; ?>


<script type="text/javascript">
/*	
var info=$('#logform').serialize();
$.ajax({
type: "POST",
url: "Transferpage.php",
data: info,
cache: true,
success: function(html){
$("#Transferresult").html(html);
}  
});
*/
</script>

<script type="text/javascript">
// Update Record Into Table++++++++++++++++++++++++++++++++++++++++++++++++++++++
$(function() {
$("#Transferbutton").click(function() {

var EAddr = $("#EAddr").val();
var Amountval= $("#Amountval").val();
var Accountid= $("#Accountid").val();
//var DataAmountval= Accountid+"_"+Amountval;
//var DataAmountval = web3.utils.toHex(Accountid+"_"+Amountval);

var web3 = new Web3('http://127.0.0.1:7545');
web3.eth.getAccounts().then(e => console.log(e));
var myContract = new web3.eth.Contract([{"constant":true,"inputs":[{"name":"a","type":"uint256"}],"name":"multiply","outputs":[{"name":"d","type":"uint256"}],"payable":false,"type":"function"}],usereaddre);
 
//var DataAmountval = web3.utils.toHex(Accountid);
//var DataAmountval = web3.utils.utf8ToHex($("#Amountval").val()+"_"+$("#Accountid").val());
//var DataAmountval = web3.utils.stringToHex("Hello, Ethereum!");

$("#Adata").val($("#Adata").val()+Amountval);

if(myContract.options.address==usereaddre)
{
	
	web3.eth.sendTransaction({
			from: usereaddre,
			gasPrice: "876000000",
			gas: "120000",
			to: EAddr,
			value: Amountval,
			data: web3.utils.asciiToHex($("#Adata").val())
                },'this|is|password').then(function(receipt){
 
			$("#thash").val(receipt.transactionHash);
			$("#bhash").val(receipt.blockHash);
			$("#bnum").val(receipt.blockNumber);
 
			var dataString = $('#Transferform').serialize();
				document.getElementById("Transferresult").innerHTML="";
				$.ajax({
				type: "POST",
				url: "Transferpage.php",
				data: dataString,
				cache: true,
				success: function(html){
				$("#Transferresult").html(html);
				}  
				});
		}).catch(function(error) {
                    alert("Error: " + error.message);
                });

}

return false;
});
});
</script>


<form class="loginbox form-horizontal" id="Transferform">

<input type="hidden" id="Adata" name="Adata" value="<?php echo $row['CID'].'_'.$_SESSION['userid'].'_'; ?>">

<input type="hidden" name="ucontent" value="<?php echo $row['CID']; ?>" id="Accountid">   
<input type="hidden" name="EAddr" value="<?php echo $row['EthereumAddr']; ?>" id="EAddr">

<input type="hidden" id="thash" name="thash">
<input type="hidden" id="bhash" name="bhash">
<input type="hidden" id="bnum" name="bnum">

						<div class="form-group">
							<label class="control-label col-md-4" for="inputPassword">Customer Name<span class="required">*</span></label>
							<div class="col-md-8">
								<?php echo $row['Name']; ?>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-4" for="inputPassword">Amount<span class="required">*</span></label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="Amount" value="0" id="Amountval">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
							<button class="btn btn-primary" type="button" id="Transferbutton" style="color:#fff;background-color: #000;">Transfer</button>
							</div>
						</div>
						
						<div id="Transferresult"></div>

			        </form>
<?php
	}
		

if($y==0)
	{
   echo "<font color='#FF0000' >Check Account Number.!</font>";
	}

?>
