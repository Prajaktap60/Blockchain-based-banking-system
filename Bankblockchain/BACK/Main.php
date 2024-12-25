		<div class="row" style="background: #fff;">
		    <div class="col-md-12" style="background: #fff;">
			    <div class="breadcrumbs">
				    <ul class="breadcrumb" style="background: #fff;">
                        <li><a href="index.php">Home</a> <span class="divider"></span></li>
                        <li class="active">Home</li>
                    </ul>
					
				</div>
			</div><hr>
		</div>
<br>

		<div class="row">
		    <div class="col-md-3 left-menu">
				<div class="">
					<h2></h2>
					
<ul>
<li><a href="index.php?page=6&M=1">Transfer Amount</a></li>
<li><a href="index.php?page=6&M=2">Transaction History</a></li>
<li><a href="index.php?page=6&M=3">Bankbalance</a></li>
<li><a href="index.php?page=6&M=4">My Profile</a></li>

					</ul>




				</div>




		    <div>
			    <div class="product" id="myproduct" >

				</div>
			</div>



			</div>
		
		<div class="col-md-9">
		
				<div class="row"> 
		    <div class="col-md-12">
			    <div class="breadcrumbs">
	
						<div class="row registerbox">
						<div class="form-group col-md-12">

<div class="col-md-12">
			<div class="row">
<?php
if(!isset($_GET["M"]) || $_GET["M"]==1 || $_GET["M"]==0)
{
include("Transfer.php");
}
elseif($_GET["M"]==2)
{
include("Transferhistory.php");
}
elseif($_GET["M"]==3)
{
include("Bankbalance.php");
}
elseif($_GET["M"]==4)
{
include("Account.php");
}
?>



		</div>	</div>	
				
			   
					

					
				
				
			
						</div></div>



				</div>
				
				
				
			</div></div>
			
		












		

	

		


<hr>


<div class="clear1"></div>
 




	   </div>
	 </div>	