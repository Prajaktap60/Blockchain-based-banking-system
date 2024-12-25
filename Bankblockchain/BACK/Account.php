 <div class="product" id="myproduct" style="height:350px;">
				    
<script type="text/javascript" src="jquery.min.js"></script>



<div id="Showdetails">

<div class="row">
<div class="col-md-12">
<div class="cart-info">
<?php
$Uid=$_SESSION['userid'];
$result = $conn->query("select * From customer where CID='$Uid'");
while($row = $result->fetch_assoc())
{
?>
<table class="table">
<thead>
<tr>
<th>Name - </th>
<th><?php echo $row['Name']; ?></th>
</tr>
<tr>
<th>Email - </th>
<th><?php echo $row['Email']; ?></th>
</tr>
<tr>
<th>Mobile - </th>
<th><?php echo $row['Mob']; ?></th>
</tr>
<tr>
<th>Address - </th>
<th><?php echo $row['Address']; ?></th>
</tr>
<tr>
<th>Account No. - </th>
<th><?php echo $row['CID']; ?></th>
</tr>
</thead>
</table>

<?php
}
?>
</div> 			
</div>					
</div>
		
</div>

</div>