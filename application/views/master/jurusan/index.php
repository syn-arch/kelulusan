<div class="row">
	<div class="col-md-12">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<div class="float-left">
					<h4>Data jurusan</h4>
				</div>
				<div class="float-right">
					<a href="<?php echo base_url('excel/eksport_jurusan') ?>"class="btn btn-success"><i class="fa fa-sign-out-alt"></i> Export Jurusan</a>
					<a href="<?php echo base_url('master/tambah_jurusan') ?>"class="btn btn-primary tambah-jurusan"><i class="fa fa-plus"></i> Tambah jurusan</a>
				</div>
			</div>
			<div class="card-body">

				<?php if($pesan =  $this->session->flashdata('pesan')) : ?>
					<div class="alert-message d-none"><?php echo $pesan ?></div>
				<?php endif; ?>

				<?php if($error =  $this->session->flashdata('error')) : ?>
					<div class="alert-message-error d-none"><?php echo $error ?></div>
				<?php endif; ?>

				<div class="table-responsive">
					<table class="table table-hover table-striped table-bordered" id="table-jurusan">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Jurusan</th>
                                <th>Singkatan</th>
								<th><i class="fa fa-cogs"></i></th>
							</tr>
						</thead>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>