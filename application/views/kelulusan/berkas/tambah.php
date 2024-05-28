<div class="row">
	<div class="col-md-12">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<div class="float-left">
					<h4 class="card-title"><?php echo $judul ?></h4>
				</div>
				<div class="float-right">
					<a href="<?php echo base_url('kelulusan/berkas') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
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
								<label for="id_siswa">Siswa</label>
								<select name="id_siswa" id="id_siswa" class="form-control id_siswa <?php if(form_error('id_siswa')) echo 'is-invalid'?>">
									<option value="">-- Pilih siswa --</option>
									<?php foreach ($siswa as $row): ?>
										<option value="<?php echo $row['id_siswa'] ?>"><?php echo $row['nama_siswa'] ?></option>
									<?php endforeach ?>
								</select>
								<?php echo form_error('id_siswa', '<small style="color:red">','</small>') ?>
							</div>
							<div class="form-group">
								<label for="berkas">Berkas</label>
								<input type="file" class="form-control berkas" name="berkas">
								<?php echo form_error('berkas', '<small style="color:red">','</small>') ?>
							</div>
							<div class="form-group">
								<label for="keterangan">Keterangan</label>
								<textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control textarea <?php if(form_error('keterangan')) echo 'is-invalid'?>" placeholder="keterangan"><?php echo set_value('keterangan') ?></textarea>
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