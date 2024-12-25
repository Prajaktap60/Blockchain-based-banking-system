 <div class="product" id="myproduct"  >
					<h1>Payment Transfer</h1>	    
<hr>		    

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">
$(function() {

$("#Detailsbutton").click(function() {
var info=$('#Detailsform').serialize();
$.ajax({
type: "POST",
url: "Detailspage.php",
data: info,
cache: true,
success: function(html){
$("#Showdetails").html(html);
}  
});
});

});
</script>


<form class="loginbox form-horizontal" id="Detailsform" style="font-size: 14px;">
 
 						<div class="form-group">
							<label class="control-label col-md-4" for="inputEmail">Enter Account Number<span class="required">*</span></label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="Accid">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
							<button class="btn btn-primary" type="button" id="Detailsbutton" style="color:#fff;background-color: #004F91;border-radius: 5px;width:100%;">Verify Account Holder</button>
							</div>
						</div>
			        </form>

<div id="Showdetails">

</div>

</div>