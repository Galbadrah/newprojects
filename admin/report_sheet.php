<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-report">
				<div class="card">
					<div class="card-header">
						  <b> Тайлангийн хуудас / Report sheet</b>
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label"><b>  Тайлбар / Report  </b></label>
								<textarea name="report" id="" cols="30" rows="2" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label for="" class="control-label"><b>Тайланг оруулах / Upload report</b></label>
								<input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
							</div>
							<div class="form-group">
								<img src="" alt="" id="cimg">
							</div>	
							
							
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Хадгал / Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="_reset()"> Цуцал / Cancel</button>
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
									<th class="text-center">Дугаар / Index</th>
									<th class="text-center">Тайлангийн маягт/ Report form</th>
									<th class="text-center">Тайлангийн нэр / Report name</th>
									<th class="text-center"> Засах / Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$cats = $conn->query("SELECT * FROM reports order by id asc");
								while($row=$cats->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="text-center">
										<img src="../assets/img/<?php echo $row['upload_report'] ?>" alt="">
									</td>
									<td class="">
										 <b><?php echo $row['report'] ?></b>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_report" type="button" data-id="<?php echo $row['id'] ?>" data-report="<?php echo $row['report'] ?>" data-upload_report="<?php echo $row['upload_report'] ?>" >Edit</button>
										<button class="btn btn-sm btn-danger delete_report" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
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
		$('#manage-report').get(0).reset();
	}
	
	$('#manage-report').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_report',
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
	$('.edit_report').click(function(){
		start_load()
		var cat = $('#manage-report')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='report']").val($(this).attr('data-report'))
		cat.find("#cimg").attr("src","../assets/img/"+$(this).attr('data-upload_report'))
		end_load()
	})
	$('.delete_report').click(function(){
		_conf("Are you sure to delete this report?","delete_report",[$(this).attr('data-id')])
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
	function delete_report($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_report',
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