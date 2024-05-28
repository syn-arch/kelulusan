<div class="row">
	<div class="col-md-12">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<div class="float-left">
					<h4>Data Role Akses</h4>
				</div>
				<div class="float-right">
					<a href="<?php echo base_url('role') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
				</div>
			</div>
			<div class="card-body">
				<h5>Akses</h5>
				<div class="row">
					<div class="col-md-12">
						<table class="table">
							<?php $id_role = $this->uri->segment(3) ?>
							<?php foreach ($menu as $row): ?>
								<tr>
									<td><?php echo $row['nama_menu'] ?>
									<table>

										<?php $id_menu = $row['id_menu']; $this->db->order_by('urutan','asc'); $submenu = $this->db->get_where('submenu',['id_menu' => $id_menu ])->result_array(); ?>
										<?php foreach ($submenu as $row_submenu): ?>
											<tr>
												<td><?php echo $row_submenu['nama_submenu'] ?></td>
												<td>
													<div class="custom-control custom-checkbox">
														<input <?= check_submenu($id_role, $row_submenu['id_submenu']) ?> data-id_submenu="<?php echo $row_submenu['id_submenu'] ?>" data-id_role="<?php echo $id_role ?>" class="form-sub custom-control-input" type="checkbox" id="<?php echo $row_submenu['nama_submenu'] ?>">
														<label for="<?php echo $row_submenu['nama_submenu'] ?>" class="custom-control-label"><i class="fa fa-check"></i></label>
													</div>
												</td>
											</tr>
										<?php endforeach ?>
									</table>
								</td>
								<td>
									<div class="custom-control custom-checkbox">
										<input <?= check_menu($id_role, $row['id_menu']) ?> data-id_menu="<?php echo $row['id_menu'] ?>" data-id_role="<?php echo $id_role ?>" class="form-menu custom-control-input access_menu" type="checkbox" id="<?php echo $row['nama_menu'] ?>">
										<label for="<?php echo $row['nama_menu'] ?>" class="custom-control-label"><i class="fa fa-check"></i></label>
									</div>
								</td>
							</tr>
						<?php endforeach ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>