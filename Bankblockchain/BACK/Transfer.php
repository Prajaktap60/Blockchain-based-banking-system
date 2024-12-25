 <div class="product" id="myproduct" style="height:350px;">
				    
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

<form class="loginbox form-horizontal" id="Detailsform">
						<p>Payment Transfer</p>
 						<div class="form-group">
							<label class="control-label col-md-4" for="inputEmail">User Account Number<span class="required">*</span></label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="Accid">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
							<button class="btn btn-primary" type="button" id="Detailsbutton" style="color:#fff;background-color: #000;">Get Details</button>
							</div>
						</div>
			        </form>

<div id="Showdetails">

</div>

</div>