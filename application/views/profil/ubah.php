<div class="row">
	<div class="col-md-12">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<div class="float-left">
					<h4 class="card-title"><?php echo $judul ?></h4>
				</div>
				<div class="float-right">
					<a href="<?php echo base_url('profil') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
				</div>
			</div>
			<div class="card-body">

				<?php if($pesan =  $this->session->flashdata('pesan')) : ?>
					<div class="alert-message d-none"><?php echo $pesan ?></div>
				<?php endif; ?>

				<?php if($error =  $this->session->flashdata('error')) : ?>
					<div class="alert-message-error d-none"><?php echo $error ?></div>
				<?php endif; ?>
				
				<div class="row">
				<div class="col-md-8 offset-md-2">
					<form method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="nama_petugas">Nama</label>
							<input type="text" id="nama_petugas" name="nama_petugas" class="form-control nama_petugas <?php if(form_error('nama_petugas')) echo 'is-invalid'?>" placeholder="Nama" value="<?php echo $profil['nama_petugas'] ?>">
							<?php echo form_error('nama_petugas', '<small style="color:red">','</small>') ?>
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" id="email" name="email" class="form-control email <?php if(form_error('email')) echo 'is-invalid'?>" placeholder="Email" value="<?php echo $profil['email'] ?>">
							<?php echo form_error('email', '<small style="color:red">','</small>') ?>
						</div>
						<div class="form-group">
							<label for="telepon">Telepon</label>
							<input type="text" id="telepon" name="telepon" class="form-control telepon <?php if(form_error('telepon')) echo 'is-invalid'?>" placeholder="Telepon" value="<?php echo $profil['telepon'] ?>">
							<?php echo form_error('telepon', '<small style="color:red">','</small>') ?>
						</div>
						<div class="form-group">
							<label for="jk">Jenis Kelamin</label>
							<select name="jk" id="jk" class="form-control jk <?php if(form_error('jk')) echo 'is-invalid'?>">
								<option value="pilih_jk">-- Silahkan Pilih Jenis Kelamin --</option>
								<option value="L" <?php if($profil['jk'] == "L") echo "selected"; ?>>Laki - Laki</option>
								<option value="P" <?php if($profil['jk'] == "P") echo "selected"; ?>>Perempuan</option>
							</select>
							<?php echo form_error('jk', '<small style="color:red">','</small>') ?>
						</div>
						<div class="form-group">
							<label for="alamat">Alamat</label>
							<textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control <?php if(form_error('alamat')) echo 'is-invalid'?>" placeholder="Alamat"><?php echo $profil['alamat'] ?></textarea>
							<?php echo form_error('alamat', '<small style="color:red">','</small>') ?>
						</div>
						<div class="form-group">
							<label for="gambar">Gambar</label>
							<input type="file" id="gambar" name="gambar" class="form-control gambar <?php if(form_error('gambar')) echo 'is-invalid'?>" placeholder="gambar" value="<?php echo $profil['gambar'] ?>">
							<?php echo form_error('gambar', '<small style="color:red">','</small>') ?>
						</div>
						<div class="form-group">
							<img src="<?php echo base_url('assets/img/petugas/') . $profil['gambar'] ?>" alt="Profil image" class="img-fluid" width="200">
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