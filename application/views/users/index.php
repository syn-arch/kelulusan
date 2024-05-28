<div class="row">
	<div class="col-md-12">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<div class="float-left">
					<h4>Data User</h4>
				</div>
				<div class="float-right">
					<a href="#modal-user" data-toggle="modal" class="btn btn-primary tambah-user"><i class="fa fa-plus"></i> Tambah User</a>
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
					<table class="table table-hover table-striped table-bordered" id="table-user">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Petugas</th>
								<th>Email</th>
								<th>Telepon</th>
								<th>Level</th>
								<th><i class="fa fa-cogs"></i></th>
							</tr>
						</thead>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-user">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo base_url('user/simpan') ?>" class="form-user" enctype="multipart/form-data">
        	<div class="form-group">
        		<label for="nama_petugas">Nama</label>
        		<input type="text" id="nama_petugas" name="nama_petugas" class="form-control nama_petugas <?php if(form_error('nama_petugas')) echo 'is-invalid'?>" placeholder="Nama" value="<?php echo set_value('nama_petugas') ?>">
        		<?php echo form_error('nama_petugas', '<small style="color:red">','</small>') ?>
        	</div>
        	<div class="form-group">
        		<label for="telepon">Telepon</label>
        		<input type="text" id="telepon" name="telepon" class="form-control telepon <?php if(form_error('telepon')) echo 'is-invalid'?>" placeholder="Telepon" value="<?php echo set_value('telepon') ?>">
        		<?php echo form_error('telepon', '<small style="color:red">','</small>') ?>
        	</div>
        	<div class="form-group">
        		<label for="email">Email</label>
        		<input type="text" id="email" name="email" class="form-control email <?php if(form_error('email')) echo 'is-invalid'?>" placeholder="Email" value="<?php echo set_value('email') ?>">
        		<?php echo form_error('email', '<small style="color:red">','</small>') ?>
        	</div>
        	<div class="form-group">
        		<label for="jk">Jenis Kelamin</label>
        		<select name="jk" id="jk" class="form-control jk <?php if(form_error('jk')) echo 'is-invalid'?>">
        			<option value="pilih_jk">-- Silahkan Pilih Jenis Kelamin --</option>
        			<option value="L">Laki-Laki</option>
        			<option value="P">Perempuan</option>
        		</select>
        		<?php echo form_error('jk', '<small style="color:red">','</small>') ?>
        	</div>
        	<div class="form-group">
        		<label for="alamat">Alamat</label>
        		<textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control alamat <?php if(form_error('alamat')) echo 'is-invalid'?>" placeholder="Alamat"></textarea>
        		<?php echo form_error('alamat', '<small style="color:red">','</small>') ?>
        	</div>
        	<div class="form-group pw1">
        		<label for="pw1">Password</label>
        		<input type="password" id="pw1" name="pw1" class="form-control pw1 <?php if(form_error('pw1')) echo 'is-invalid'?>" placeholder="Password">
        		<?php echo form_error('pw1', '<small style="color:red">','</small>') ?>
        	</div>
            <div class="form-group pw2">
                <label for="pw2">Konfirmasi Password</label>
                <input type="password" id="pw2" name="pw2" class="form-control pw2 <?php if(form_error('pw2')) echo 'is-invalid'?>" placeholder="Konfirmasi Password">
                <?php echo form_error('pw2', '<small style="color:red">','</small>') ?>
            </div>
			<div class="form-group">
				<label for="id_role">Role</label>
				<select name="id_role" id="id_role" class="form-control id_role">
					<option value="pilih_role">-- Silahkan Pilih Role --</option>
					<?php foreach ($role as $row): ?>
						<option value="<?php echo $row['id_role'] ?>"><?php echo $row['nama_role'] ?></option>
					<?php endforeach ?>
				</select>
				<?php echo form_error('id_role', '<small style="color:red">','</small>') ?>
			</div>
            <div class="form-group">
                <label for="petugas">Petugas ?</label>
                <select name="petugas" id="petugas" class="form-control petugas <?php if(form_error('petugas')) echo 'is-invalid'?>">
                    <option value="0">TIDAK</option>
                    <option value="1">IYA</option>
                </select>
                <?php echo form_error('petugas', '<small style="color:red">','</small>') ?>
            </div>
            <div class="form-group jurusan-petugas">
                <label for="id_jurusan">Jurusan</label>
                <select name="id_jurusan" id="id_jurusan" class="form-control id_jurusan">
                    <option value="pilih_jurusan">-- Silahkan Pilih jurusan --</option>
                    <?php foreach ($jurusan as $row): ?>
                        <option value="<?php echo $row['id_jurusan'] ?>"><?php echo $row['nama_jurusan'] ?></option>
                    <?php endforeach ?>
                </select>
                <?php echo form_error('id_role', '<small style="color:red">','</small>') ?>
            </div>
			<div class="form-group">
				<label for="gambar">Gambar</label>
				<input type="file" id="gambar" name="gambar" class="form-control gambar <?php if(form_error('gambar')) echo 'is-invalid'?>" placeholder="Gambar" value="<?php echo set_value('gambar') ?>">
				<?php echo form_error('gambar', '<small style="color:red">','</small>') ?>
			</div>
			<div class="gambar-petugas mt-4">
				<img src="" alt="Gambar Petugas" class="petugas_img" width="200">
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>