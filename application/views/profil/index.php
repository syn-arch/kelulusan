<div class="row">
	<div class="col-md-5">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<h4 class="card-title"><?php echo $judul ?></h4>
			</div>
			<div class="card-body">
				<div class="text-center">
					<img src="<?php echo base_url('assets/img/petugas/') . $profil['gambar'] ?>" alt="User Image" class="img-fluid mb-3" width="200">
					<h5><?php echo $profil['nama_petugas'] ?></h5>
					<small><?php echo $profil['nama_role'] ?></small>
				</div>
				<div class="button mt-3">
					<a href="<?php echo base_url('profil/ubah') ?>" class="btn btn-dark btn-block"><i class="fa fa-edit"></i> Ubah Profil</a>
					<a href="<?php echo base_url('profil/ubah_password') ?>" class="btn btn-secondary btn-block"><i class="fa fa-key"></i> Ubah Password</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<h4 class="card-title">Deskripsi</h4>
			</div>
			<div class="card-body">
				<form class="form-horizontal">
					<div class="form-group row">
						<label for="email" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
							<input readonly type="email" class="form-control" id="email" placeholder="Email" value="<?php echo $profil['email'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
						<div class="col-sm-10">
							<input readonly type="telepon" class="form-control" id="telepon" placeholder="telepon" value="<?php echo $profil['telepon'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
						<div class="col-sm-10">
							<textarea readonly name="" id="alamat" placeholder="Alamat" cols="30" rows="10" class="form-control"><?php echo $profil['alamat'] ?></textarea>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>