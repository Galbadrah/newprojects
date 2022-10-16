
<style>
</style>
<nav id="sidebar" class='mx-lt-5 bg-dark' >
		
		<div class="sidebar-list" style="overflow: scroll; height: 100%;">

				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
				<a href="index.php?page=airlines" class="nav-item nav-airlines"><span class='icon-field'><i class="fa fa-map-marked-alt"></i></span> Шинэ онгоц нэмэх/ New aircraft type</a>	
				<a href="index.php?page=airport" class="nav-item nav-airport"><span class='icon-field'><i class="fa fa-map-marked-alt"></i></span> Шинэ нисэх буудал нэмэх/ New Airport</a>		
				<a href="index.php?page=flights" class="nav-item nav-flights"><span class='icon-field'><i class="fa fa-plane-departure"></i></span> Нислэг/Flights</a>
			    <a href="index.php?page=mvt_instruction" class="nav-item nav-mvt_instruction"><span class='icon-field'><i class="fa fa-book"></i></span> Movement мэдээ явуулах заавар /Movement email instruction</a>	
				<a href="index.php?page=company_log_book" class="nav-item nav-company_log_book"><span class='icon-field'><i class="fa fa-book"></i></span> Мэдээ дамжуулсан бүртгэл/ Company Log Book</a>
                <a href="index.php?page=fueling_sheet" class="nav-item nav-fueling_sheet"><span class='icon-field'><i class="fa fa-list"></i></span> Түлшний хуудас/Fueling Sheet</a>	
                <a href="index.php?page=report_sheet" class="nav-item nav-report_sheet"><span class='icon-field'><i class="fa fa-building"></i></span> Тайлан/ Movement Reports</a>					 
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
				<a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cog"></i></span> Site Settings</a>
			<?php endif; ?>
		</div>

</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
