<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-airports">
				<div class="card">
					<div class="card-header">
						  <b> MVT МЭДЭЭ ОРУУЛАХ / Insert MVT email</b>
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label"><b>MVT МЭДЭЭ / MVT email</b></label>
								<textarea name="airport" id="" cols="30" rows="2" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label class="control-label"><b>МЭДЭЭЭНИЙ ТӨРӨЛ / MVT email type </b></label>
								<textarea name="location" id="" cols="30" rows="2" class="form-control"></textarea>
							</div>
							
							
							
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Хадгал/Save </button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="_reset()"> Цуцал/Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">ДУГААР / INDEX</th>
									<th class="text-center">MVT МЭДЭЭ / MVT EMAIL</th>
									<th class="text-center">МЭДЭЭНИЙ ТӨРӨЛ / MVT EMAIL TYPE</th>
									<th class="text-center">ЗАСАХ / EDIT</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$cats = $conn->query("SELECT * FROM mvt_instruction order by id asc");
								while($row=$cats->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									
									<td class="">
										 <b><?php echo $row['mvt_type'] ?></b>
									</td>

									<td class="">
										 <b><?php echo $row['mvt_instruction'] ?></b>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_airline" type="button" data-id="<?php echo $row['id'] ?>" data-airport="<?php echo $row['mvt_type'] ?>" data-location="<?php echo $row['mvt_instruction'] ?>" >ЗАСАХ</button>
										<button class="btn btn-sm btn-danger delete_airline" type="button" data-id="<?php echo $row['id'] ?>">УСТГАХ</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
<script>
	function _reset(){
		$('#cimg').attr('src','');
		$('[name="id"]').val('');
		$('#manage-airports').get(0).reset();
	}
	
	$('#manage-airports').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_airports',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	$('.edit_airline').click(function(){
		start_load()
		var cat = $('#manage-airports')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='airport']").val($(this).attr('data-airport'))
		cat.find("[name='location']").val($(this).attr('data-location'))
		end_load()
	})
	$('.delete_airline').click(function(){
		_conf("Are you sure to delete this airline?","delete_airline",[$(this).attr('data-id')])
	})
	function displayImg(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        	$('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
	function delete_airline($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_airports',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>