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

				<?php if($pesan =  $this->session->flashdata('error')) : ?>
					<div class="alert-message-error d-none"><?php echo $pesan ?></div>
				<?php endif; ?>
				<div class="row">
					<div class="col-md-8 offset-md-2">
						<form method="POST">
							<div class="form-group">
								<label for="password_lama">Password Lama</label>
								<input type="password" id="password_lama" name="password_lama" class="form-control password_lama <?php if(form_error('password_lama')) echo 'is-invalid'?>" placeholder="Password Lama" value="<?php echo set_value('password_lama') ?>">
								<?php echo form_error('password_lama', '<small style="color:red">','</small>') ?>
							</div>
							<div class="form-group">
								<label for="password_baru">Password Baru</label>
								<input type="password" id="password_baru" name="password_baru" class="form-control password_baru <?php if(form_error('password_baru')) echo 'is-invalid'?>" placeholder="Password Baru" value="<?php echo set_value('password_baru') ?>">
								<?php echo form_error('password_baru', '<small style="color:red">','</small>') ?>
							</div>
							<div class="form-group">
								<label for="konfirmasi_password_baru">Konfirmasi Password Baru</label>
								<input type="password" id="konfirmasi_password_baru" name="konfirmasi_password_baru" class="form-control konfirmasi_password_baru <?php if(form_error('konfirmasi_password_baru')) echo 'is-invalid'?>" placeholder="Konfirmasi Password Baru" value="<?php echo set_value('konfirmasi_password_baru') ?>">
								<?php echo form_error('konfirmasi_password_baru', '<small style="color:red">','</small>') ?>
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