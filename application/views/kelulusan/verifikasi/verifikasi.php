<div class="row">
	<div class="col-md-12">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<div class="float-left">
					<h4 class="card-title"><?php echo $judul ?></h4>
				</div>
				<div class="float-right">
					<a href="<?php echo base_url('kelulusan/verifikasi') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
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
							<input type="hidden" name="id_siswa" value="<?php echo $siswa['id_siswa'] ?>">
							<div class="form-group">
								<label for="id_siswa">Siswa</label>
								<input readonly type="text" value="<?php echo $siswa['nama_siswa'] ?>" name="nama_siswa" class="form-control">
								<?php echo form_error('id_siswa', '<small style="color:red">','</small>') ?>
							</div>
							<div class="form-group">
								<a href="#modal-berkas" data-toggle="modal">
									<img src="<?php echo base_url('assets/img/berkas/') . $siswa['berkas'] ?>" alt="Berkas Kelulusan" class="img-fluid">
								</a>
							</div>
							<div class="form-group">
								<label for="status_lulus">Status Kelulusan</label>
								<select name="status_lulus" id="status_lulus" class="form-control  <?php if(form_error('status_lulus')) echo 'is-invalid'?>">
									<option value="">-- Pilih Status --</option>
									<option value="1" <?php echo $siswa['status_lulus'] == 1 ? 'selected' : '' ?>>LULUS</option>
									<option value="0" <?php echo $siswa['status_lulus'] == 0 ? 'selected' : '' ?>>TIDAK LULUS</option>
								</select>
								<?php echo form_error('status_lulus', '<small style="color:red">','</small>') ?>
							</div>
							<div class="form-group">
								<label for="keterangan">Keterangan</label>
								<textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control textarea <?php if(form_error('keterangan')) echo 'is-invalid'?>" placeholder="keterangan"><?php echo $siswa['keterangan'] ?></textarea>
								<?php echo form_error('keterangan', '<small style="color:red">','</small>') ?>
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

<<div class="modal fade" id="modal-berkas">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Berkas Kelulusan</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<img src="<?php echo base_url('assets/img/berkas/') . $siswa['berkas'] ?>" alt="" class="img-fluid text-center">
			</div>
			<div class="modal-footer">
				<a href="<?php echo base_url('assets/img/berkas/') . $siswa['berkas'] ?>" download class="btn btn-primary"><i class="fa fa-download"></i> Unduh</a>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->