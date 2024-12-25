 <div class="product" id="myproduct" style="height:350px;">
				    
<script type="text/javascript" src="jquery.min.js"></script>


<div id="Showdetails">

<div class="row">
<div class="col-md-12">
<div class="cart-info">

<table class="table">
<thead>
<tr>
<th>Transaction ID</th>
<th>Transaction Date</th>
<th>Account</th>
<th>Credit</th>
<th>Debit</th>
<th>Amount</th>
</tr>
</thead>
<tbody>
<?php
$Uid=$_SESSION['userid'];
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

</tr>
<?php
}
?>
</tbody>
</table>
		
</div> 			
</div>					
</div>
		
</div>

</div>