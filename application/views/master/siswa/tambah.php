<div class="row">
	<div class="col-md-12">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<div class="float-left">
					<h4 class="card-title"><?php echo $judul ?></h4>
				</div>
				<div class="float-right">
					<a href="<?php echo base_url('master/siswa') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
				</div>
			</div>
			<div class="card-body">

				<?php if($pesan =  $this->session->flashdata('pesan')) : ?>
					<div class="alert-message d-none"><?php echo $pesan ?></div>
				<?php endif; ?>

				<?php if($error =  $this->session->flashdata('error')) : ?>
					<div class="alert-message-error d-none"><?php echo $error ?></div>
				<?php endif; ?>
				<form method="POST">

					<div class="row">
						<div class="col-md-8 offset-md-2">
							<div class="form-group">
								<label for="nama_siswa">Nama Siswa</label>
								<input type="text" class="form-control <?php if(form_error('nama_siswa')) echo 'is-invalid'?>" name="nama_siswa" id="nama_siswa" placeholder="Nama Siswa" value="<?php echo set_value('nama_siswa') ?>">
								<?php echo form_error('nama_siswa', '<small style="color:red">','</small>') ?>
							</div>
							<div class="form-group">
								<label for="nis">NIS</label>
								<input type="text" class="form-control <?php if(form_error('nis')) echo 'is-invalid'?>" name="nis" id="nis" placeholder="NIS" value="<?php echo set_value('nis') ?>">
								<?php echo form_error('nis', '<small style="color:red">','</small>') ?>
							</div>
							<div class="form-group">
								<label for="nisn">NISN</label>
								<input type="text" class="form-control <?php if(form_error('nisn')) echo 'is-invalid'?>" name="nisn" id="nisn" placeholder="NISN" value="<?php echo set_value('nisn') ?>">
								<?php echo form_error('nisn', '<small style="color:red">','</small>') ?>
							</div>
							<div class="form-group">
								<label for="tgl">Tanggal Lahir</label>
								<input type="date" class="form-control <?php if(form_error('tgl')) echo 'is-invalid'?>" name="tgl" id="tgl" placeholder="tgl" value="<?php echo set_value('tgl') ?>">
								<?php echo form_error('tgl', '<small style="color:red">','</small>') ?>
							</div>
							<div class="form-group">
								<label for="no_peserta_ujian">No Peserta Ujian</label>
								<input type="text" class="form-control <?php if(form_error('no_peserta_ujian')) echo 'is-invalid'?>" name="no_peserta_ujian" id="no_peserta_ujian" placeholder="No Peserta Ujian" value="<?php echo set_value('no_peserta_ujian') ?>">
								<?php echo form_error('no_peserta_ujian', '<small style="color:red">','</small>') ?>
							</div>
							<div class="form-group">
								<label for="jk">Jenis Kelamin</label>
								<select name="jk" id="jk" class="form-control jk <?php if(form_error('jk')) echo 'is-invalid'?>">
									<option value="">-- Pilih Jenis Kelamin --</option>
									<option value="L">L</option>
									<option value="P">P</option>
								</select>
								<?php echo form_error('jk', '<small style="color:red">','</small>') ?>
							</div>
							<div class="form-group">
								<label for="id_jurusan">Jurusan</label>
								<select name="id_jurusan" id="id_jurusan" class="form-control id_jurusan <?php if(form_error('id_jurusan')) echo 'is-invalid'?>">
									<option value="">-- Pilih Jurusan --</option>
									<?php foreach ($jurusan as $row): ?>
										<option value="<?php echo $row['id_jurusan'] ?>"><?php echo $row['nama_jurusan'] ?></option>
									<?php endforeach ?>
								</select>
								<?php echo form_error('id_jurusan', '<small style="color:red">','</small>') ?>
							</div>
							<div class="form-group">
								<label for="id_kelas">kelas</label>
								<select name="id_kelas" id="id_kelas" class="form-control id_kelas <?php if(form_error('id_kelas')) echo 'is-invalid'?>">
									<option value="">-- Pilih Kelas --</option>
									<?php foreach ($kelas as $row): ?>
										<option value="<?php echo $row['id_kelas'] ?>"><?php echo $row['nama_kelas'] ?></option>
									<?php endforeach ?>
								</select>
								<?php echo form_error('id_kelas', '<small style="color:red">','</small>') ?>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Submit</button>
							</div>
						</div>
					</div>

					

				</form>
			</div>
		</div>
	</div>
</div>