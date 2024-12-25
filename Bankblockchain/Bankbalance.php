 <div class="product" id="myproduct"  >
<h1>My Balance</h1>	    
<hr>
<script type="text/javascript" src="jquery.min.js"></script>



<div  >

<div class="row">
<div class="col-md-12">
<div  >
<?php
$Uid=$_SESSION['userid'];
$CAmount=0;
$DAmount=0;

$result = $conn->query("select sum(Amount) as CAmount From transaction where CUID='$Uid'");
while($row = $result->fetch_assoc())
{
	$CAmount=$row['CAmount'];
}

$result1 = $conn->query("select sum(Amount) as DAmount From transaction where DUID='$Uid'");
while($row1 = $result1->fetch_assoc())
{
	$DAmount=$row1['DAmount'];
}

$FAmount=$CAmount-($DAmount+$Amount);

?>
<table class="table" style="font-size: 14px;">
<thead>
<tr>
<th>Account Balance - </th>
<th><?php echo $FAmount; ?>/-</th>
</tr>
</thead>
</table>
		
</div> 			
</div>					
</div>
		
</div>

</div>