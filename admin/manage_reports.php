<?php include 'db_connect.php' ?>
<?php 

if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM reports where id=".$_GET['id']);
	foreach($qry->fetch_array() as $k => $val){
		$$k = $val;
	}
}

?>
<div class="container-fluid">
	<div class="col-lg-12">
		<form id="manage-report">
			<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<label for="" class="control-label">Reports_sheet</label>
						<select name="report" id="report" class="custom-select browser-default select2">
							<option></option>
							<?php 
							$report = $conn->query("SELECT * FROM reports order by report asc");
							while($row = $report->fetch_assoc()):
							?>
								<option value="<?php echo $row['id'] ?>" <?php echo isset($report_id) && $report == $row['id'] ? "selected" : '' ?>><?php echo $row['report'] ?></option>
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
	 $('#manage-report').submit(function(e){
	 	e.preventDefault()
	 	start_load()
	 	$.ajax({
	 		url:'ajax.php?action=save_report',
	 		method:'POST',
	 		data:$(this).serialize(),
	 		success:function(resp){
	 			if(resp == 1){
	 				alert_toast("Reports successfully saved.","success");
	 				setTimeout(function(e){
	 					location.reload()
	 				},1500)
	 			}
	 		}
	 	})
	 })
	 $('.datetimepicker').attr('autocomplete','off')
</script>