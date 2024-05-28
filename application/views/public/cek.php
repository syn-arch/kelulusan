<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, inital-scale=1">
	<title>Cek Kelulusan</title>
	
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/all.min.css">
	<script src="<?php echo base_url() ?>assets/js/jquery-3.4.1.min.js"></script>
	
</head>
<body>
    <div id="gans">
        <!-- cekkelulusan -->
    	<div class="box-cekkelulusan" style="background: url(assets/img/bg.jpg);">
    		<div id="preloading" class="invisible min-vh-100 d-flex justify-content-center align-items-center preloading">
    			<div class="prespinner">
    				<img src="https://www.freeiconspng.com/uploads/graduate-icon-22.png" class="img-fluid" alt="">
    			</div>
    		</div>
    		<style>
    			.preloading{
    				width: 100%;
    				height: 100vh;
    				position: fixed;
    				background: rgba(0,0,0,.7);
    			}
    			.prespinner{
    				width: 100px;
    				height: 100px;
    				animation: preload 2s linear infinite alternate;
    				filter: invert(50%);
    			}
    
    			@keyframes preload{
    				0%{
    					transform: rotate(0deg);
    				}
    				100%{
    					transform: rotate(-360deg);
    				}
    			}
    		</style>
    		<div class="container min-vh-100 d-flex justify-content-center align-items-center flex-column">
    			<div class="row" id="form-cek">
    				<div class="col">
    					<div class="card p-5 rounded-0 shadow">
    						<div class="card-body">
    							<h3 class="card-title font-weight-bold">Cek Kelulusan</h3>
    							<hr>
    							<form id="form-cek-kelulusan">
    								<fieldset class="form-group">
    									<label for="NomorPesertaUjian">Nomor Peserta ujian</label>
    									<input type="text" autocomplete="off" name="no_peserta_ujian" class="form-control rounded-0" id="NomorPesertaUjian" placeholder="Contoh : 01-0123-0123-9">
    								</fieldset>
    								<fieldset class="form-group">
    									<label for="TanggalLahir">Tanggal lahir</label>
    									<input type="date" autocomplete="off" class="form-control rounded-0" id="TanggalLahir" name="tgl">
    								</fieldset>
    								<button type="submit" class="btn btn-block btn-primary rounded-pill shadow" id="btn-cek">Cek Kelulusan</button>
    							</form>
    						</div>
    					</div>
    				</div>
    			</div>
    			<div class="row d-none" id="result-cek">
    				<div class="col">
    					<div class="card p-5 rounded-0 shadow text-center">
    						<div class="card-body">
    
    							<div class="alert-true tidak_lulus">
    								<p class="font-weight-bold text-danger">
    									Mohon maaf kelulusan anda belum dapat ditampilkan, silahkan hubungi pihak sekolah!
    								</p>
    							</div>
    							<div class="alert-true lulus">
    								<p class="font-weight-bold">
    									Selamat anda dinyatakan lulus, silahkan download dokumen di bawah ini!
    								</p>
    							</div>
    
    							<a download class="btn btn-outline-primary rounded-pill shadow my-3 download">
    								<i class="fa fa-download"></i>
    								Download 
    							</a>
    							<br>
    
    							<a href="javascript:void(0)" onclick="location.reload()" class="btn btn-primary rounded-pill shadow my-3">
    								<i class="fa fa-redo"></i>
    								Refresh
    							</a>
    
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
	<!-- endcekkelulusan -->
	
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

	<script src="<?php echo base_url() ?>assets/js/popper.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/all.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jspdf.debug.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jspdf.plugin.autotable.js"></script>

	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<script>
		$(function () {

			$('.tidak_lulus').hide()
			$('.lulus').hide()
			$('.download').hide()

			$("#form-cek-kelulusan").submit(function (e) {
				e.preventDefault();
				if ($("#NomorPesertaUjian").val() == "" || $("#TanggalLahir").val() == "") {

					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Data harus diisi terlebih dahulu!'
					})
					
					setTimeout(function(){
					   window.location.reload()
					}, 3000)

				}else{

					$("#form-cek").addClass("d-none");
					$("#preloading").removeClass("invisible");

					setTimeout(function () {
						$("#preloading").addClass("invisible");
						$("#result-cek").removeClass("d-none");
						$("#result-cek").fadeIn();

						result()
					},5000)

					function result(){
						$.ajax({
							url : '<?php echo base_url() ?>' + 'cek_kelulusan',
							method : 'post',
							data : $('#form-cek-kelulusan').serialize(),
							success : function(datas){
								var data = JSON.parse(datas)
								console.log(datas)
								if (data) {

									if (data.status_lulus == 0) {
										$('.tidak_lulus').show()
										$('.lulus').hide()
									}else{
										$('.lulus').show()
										$('.download').show()
										$('.download').attr('href', '<?php echo base_url("assets/img/berkas/") ?>' + data.berkas)
									}

								}else{

									Swal.fire({
										icon: 'error',
										title: 'Oops...',
										text: 'Data tidak ditemukan!'
									})

									$('.tidak_lulus').hide()
									$('.lulus').hide()
									$('.download').hide()
								}
							}
						})
					}

				}

			})
		})
	</script>
</body>
</html>