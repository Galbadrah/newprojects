<?php include 'db_connect.php' ?>

<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<large class="card-title">
					<b>Company Log Book</b>
				</large>
				<button class="btn btn-primary btn-block col-md-2 float-right" type="button" id="new_log"><i class="fa fa-plus"></i> New log</button>
			</div>
			<div class="card-body">
				<table class="table table-bordered" id="company_log_book">
					<colgroup>
						<col width="10%">
						<col width="35%">
						<col width="10%">
						<col width="10%">
						<col width="10%">
						<col width="10%">
						<col width="15%">
					</colgroup>
					<thead>
						<tr>
							<th class="text-center">Oн-сар-өдөр</th>
							<th class="text-center"> Харьяа байгууллага</th>
							<th class="text-center">Алба</th>
							<th class="text-center">Хэлтсийн нэр</th>
							<th class="text-center">Албан тушаал</th>
							<th class="text-center">Нэр</th>
							<th class="text-center">Утасны дугаар</th>
							<th class="text-center">Мэдээлэл өгсөн цаг</th>
							<th class="text-center">Мэдээлэл</th>

						</tr>
					</thead>
					<tbody>
						<?php
							$company_log_book = $conn->query("SELECT * FROM company_log_book ");
							
							while($row = $qry->fetch_assoc()):
								$utasnii_dugaar = $conn->query("SELECT * FROM company_log_book where log_id = ".$row['id'])->num_rows;

						 ?>
						 <tr>
						 	
						 	<td><?php echo date('M d,Y',strtotime($row['date_created'])) ?></td>
						 	<td>
						 		<div class="row">
						 		<div class="col-sm-6">
						 		<p>Харьяа байгууллага/:<b><?php echo $row['harya'] ?></b></p>
								<p>Алба:<b><?php echo $row['alba'] ?></b></p>
						 		<p><small>Хэлтсийн нэр :<b><?php echo $row['heltes'] ?></small></b></p>
								<p><small>Албан тушаал :<b><?php echo $row['alban_tushaal'] ?></small></b></p>
								<p><small>Нэр :<b><?php echo $row['ner'] ?></small></b></p>
								<p><small>Утасны дугаар :<b><?php echo $row['utasnii_dugaar'] ?></small></b></p>
						 		<p><small>Мэдээлэл өгсөн цаг:<b><?php echo date(' Y-M-d, h:i A',strtotime($row['ugsun_tsag'])) ?></small></b></p>
						 		<<p><small>Мэдээлэл :<b><?php echo $row['medeelel'] ?></small></b></p>
						 		</div>
						 		</div>
						 	</td>
						 	<td class="text-right"><?php echo $row['harya'] ?></td>
							<td class="text-right"><?php echo $row['alba'] ?></td>
						 	<td class="text-right"><?php echo $row['heltes'] ?></td>
							<td class="text-right"><?php echo $row['alban_tushaal'] ?></td>
							<td class="text-right"><?php echo $row['ner'] ?></td>
							<td class="text-right"><?php echo $row['alban_tushaal'] ?></td>
							<td class="text-right"><?php echo $row['ner'] ?></td>
							<td class="varchar-right"><?php echo $row['utasnii_dugaaж'] ?></td>
							<td class="date_time_set-right"><?php echo $row['ugsun_tsag'] ?></td>
							<td class="text-right"><?php echo $row['medeelel'] ?></td>
						 	<td class="text-center">
						 			<button class="btn btn-outline-primary btn-sm edit_log" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></button>
						 			<button class="btn btn-outline-danger btn-sm delete_log" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button>
						 	</td>

						 </tr>

						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<style>
	td p {
		margin:unset;
	}
	td img {
	    width: 8vw;
	    height: 12vh;
	}
	td{
		vertical-align: middle !important;
	}
</style>	
<script>
	$('#log-list').dataTable()
	$('#new_log').click(function(){
		uni_modal("New Flight","manage_log.php",'mid-large')
	})
	$('.edit_log').click(function(){
		uni_modal("Edit Flight","manage_log.php?id="+$(this).attr('data-id'),'mid-large')
	})
	$('.delete_log').click(function(){
		_conf("Are you sure to delete this Flight?","delete_flight",[$(this).attr('data-id')])
	})
function delete_log($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_log',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Log successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>