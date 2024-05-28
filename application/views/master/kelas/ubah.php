
<div class="row">
	<div class="col-md-12">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<div class="float-left">
					<h4>Tambah Data</h4>
				</div>
				<div class="float-right">
					<a href="<?php echo base_url('master/kelas') ?>"class="btn btn-primary tambah-kelas"><i class="fa fa-arrow-left"></i> Kembali</a>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-8 offset-md-2">
						<form method="POST">
							<div class="form-group">
								<label for="nama_kelas">Nama kelas</label>
								<input type="text" id="nama_kelas" name="nama_kelas" class="form-control nama_kelas <?php if(form_error('nama_kelas')) echo 'is-invalid'?>" placeholder="Nama kelas" value="<?php echo $kelas['nama_kelas'] ?>">
								<?php echo form_error('nama_kelas', '<small style="color:red">','</small>') ?>
							</div>
							<div class="form-group">
								<label for="id_jurusan">Jurusan</label>
								<select name="id_jurusan" id="id_jurusan" class="form-control">
									<option value="">-- Pilih Jurusan --</option>
									<?php foreach ($jurusan as $row): ?>
										<option value="<?php echo $row['id_jurusan'] ?>" <?= $row['id_jurusan'] == $kelas['id_jurusan'] ?'selected' : '' ?>><?php echo $row['nama_jurusan'] ?></option>
									<?php endforeach ?>
								</select>
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