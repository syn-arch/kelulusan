<div class="row">
	<div class="col-md-12">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<div class="float-left">
					<h4>Data Role</h4>
				</div>
				<div class="float-right">
					<a href="#modal-role" data-toggle="modal" class="btn btn-primary tambah-role"><i class="fa fa-plus"></i> Tambah Role</a>
				</div>
			</div>
			<div class="card-body">

				<?php if($pesan =  $this->session->flashdata('pesan')) : ?>
					<div class="alert-message d-none"><?php echo $pesan ?></div>
				<?php endif; ?>

				<div class="table-responsive">
					<table class="table table-hover table-striped table-bordered tables" id="table-role">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Role</th>
								<th><i class="fa fa-cogs"></i></th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach ($role as $row): ?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $row['nama_role'] ?></td>
								<td>
									<a href="<?php echo base_url('role/ubah/') . $row['id_role'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
									<a data-href="<?php echo base_url('role/hapus/') . $row['id_role'] ?>" data-id="<?php echo $row['id_role'] ?>" class="btn btn-danger hapus_role"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>

		</div>
	</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-role">
	<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah role</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" class="form-role">
					<div class="form-group">
						<label for="nama_role">Nama Role</label>
						<input type="text" id="nama_role" name="nama_role" class="form-control nama_role <?php if(form_error('nama_role')) echo 'is-invalid'?>" placeholder="Nama Role">
						<?php echo form_error('nama_role', '<small style="color:red">','</small>') ?>
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