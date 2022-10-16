<?php include 'db_connect.php' ?>
<?php 

if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM fueling_sheet where id=".$_GET['id']);
	foreach($qry->fetch_array() as $k => $val){
		$$k = $val;
	}
}

?>
<div class="container-fluid">
	<div class="col-lg-12">
		<form id="manage-fuel">
			<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<label for="" class="control-label">Fueling_sheet</label>
						<select name="fuel" id="fuel" class="custom-select browser-default select2">
							<option></option>
							<?php 
							$fuels = $conn->query("SELECT * FROM fueling_sheet order by fuel asc");
							while($row = $fuels->fetch_assoc()):
							?>
								<option value="<?php echo $row['id'] ?>" <?php echo isset($fuels_id) && $fuels_id == $row['id'] ? "selected" : '' ?>><?php echo $row['fuel'] ?></option>
							<?php endwhile; ?>
						</select>
					</div>
				</div>
			</div>	
		</form>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('.select2').each(function(){
		$(this).select2({
		    placeholder:"Please select here",
		    width: "100%"
		  })
	})
	})
	 $('.datetimepicker').datetimepicker({
      format:'Y-m-d H:i',
  })
	 $('#manage-fuel').submit(function(e){
	 	e.preventDefault()
	 	start_load()
	 	$.ajax({
	 		url:'ajax.php?action=save_fuel',
	 		method:'POST',
	 		data:$(this).serialize(),
	 		success:function(resp){
	 			if(resp == 1){
	 				alert_toast("Fuel sheet successfully saved.","success");
	 				setTimeout(function(e){
	 					location.reload()
	 				},1500)
	 			}
	 		}
	 	})
	 })
	 $('.datetimepicker').attr('autocomplete','off')
</script>