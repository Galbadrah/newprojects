<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-fuel">
				<div class="card">
					<div class="card-header">
						  <b> Түлшний мэдээлэл / Fueling sheet</b>
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label"><b> Түлшний үлдэгдэл/cумалгааны хэмжээ/ Аяллын дугаар/ Онгоцны дугаар/ Сумалгаа хийсэн нийт цаг /Fueling imformation</b></label>
								<textarea name="fuel" id="" cols="30" rows="2" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label for="" class="control-label"><b>Upload fueling sheet / Бөгөлсөн маягтийг оруулах</b></label>
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
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="_reset()"> Цуцал /Cancel</button>
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
									<th class="text-center">Түлшний маягтын зураг / Fueling sheet image</th>
									<th class="text-center">Тайлбар</th>
									<th class="text-center">Засах / Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$cats = $conn->query("SELECT * FROM fueling_sheet order by id asc");
								while($row=$cats->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="text-center">
										<img src="../assets/img/<?php echo $row['upload_fuel'] ?>" alt="">
									</td>
									<td class="">
										 <b><?php echo $row['fuel'] ?></b>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_fuel" type="button" data-id="<?php echo $row['id'] ?>" data-fuel="<?php echo $row['fuel'] ?>" data-upload_fuel="<?php echo $row['upload_fuel'] ?>" >Edit</button>
										<button class="btn btn-sm btn-danger delete_fuel" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
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
		$('#manage-fuel').get(0).reset();
	}
	
	$('#manage-fuel').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_fuel',
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
	$('.edit_fuel').click(function(){
		start_load()
		var cat = $('#manage-fuel')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='fuel']").val($(this).attr('data-fuel'))
		cat.find("#cimg").attr("src","../assets/img/"+$(this).attr('data-upload_fuel'))
		end_load()
	})
	$('.delete_fuel').click(function(){
		_conf("Are you sure to delete this fuel?","delete_fuel",[$(this).attr('data-id')])
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
	function delete_fuel($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_fuel',
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