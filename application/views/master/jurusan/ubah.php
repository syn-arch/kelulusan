
<div class="row">
	<div class="col-md-12">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<div class="float-left">
					<h4>Tambah Data</h4>
				</div>
				<div class="float-right">
					<a href="<?php echo base_url('master/jurusan') ?>"class="btn btn-primary tambah-jurusan"><i class="fa fa-arrow-left"></i> Kembali</a>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-8 offset-md-2">
						<form method="POST">
							<div class="form-group">
								<label for="nama_jurusan">Nama Jurusan</label>
								<input type="text" id="nama_jurusan" name="nama_jurusan" class="form-control nama_jurusan <?php if(form_error('nama_jurusan')) echo 'is-invalid'?>" placeholder="Nama Jurusan" value="<?php echo $jurusan['nama_jurusan'] ?>">
								<?php echo form_error('nama_jurusan', '<small style="color:red">','</small>') ?>
							</div>
							<div class="form-group">
								<label for="singkatan">Singkatan</label>
								<input type="text" id="singkatan" name="singkatan" class="form-control singkatan <?php if(form_error('singkatan')) echo 'is-invalid'?>" placeholder="Singkatan" value="<?php echo $jurusan['singkatan'] ?>">
								<?php echo form_error('singkatan', '<small style="color:red">','</small>') ?>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>