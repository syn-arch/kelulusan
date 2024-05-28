<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load library phpspreadsheet
require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Excel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Siswa_m','sm');
		$this->load->model('Kelas_m','km');
		$this->load->model('Jurusan_m','jm');
	}

	public function eksport_siswa() // ekspor siswa
	{
		$siswa = $this->sm->get_siswa();
		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();
		// Add some data
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'NIS')
		->setCellValue('B1', 'NISN')
		->setCellValue('C1', 'Nama Siswa')
		->setCellValue('D1', 'Jenis Kelamin')
		->setCellValue('E1', 'No Peserta Ujian')
		->setCellValue('F1', 'Nama Jurusan')
		->setCellValue('G1', 'Nama Kelas')
		;
		// Miscellaneous glyphs, UTF-8
		$i=2; 
		foreach($siswa as $row) {
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $i, $row['nis'])
			->setCellValue('B' . $i, $row['nisn'])
			->setCellValue('C' . $i, $row['nama_siswa'])
			->setCellValue('D' . $i, $row['jk'])
			->setCellValue('E' . $i, $row['no_peserta_ujian'])
			->setCellValue('F' . $i, $row['nama_jurusan'])
			->setCellValue('G' . $i, $row['nama_kelas'])
			->setCellValue('H' . $i, $row['tgl']);
			$i++;
		}                           

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('Data Siswa');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Data Siswa.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		exit;
	}

	public function template_siswa() // ekspor template
	{
		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();
		// Add some data
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'NIS')
		->setCellValue('B1', 'NISN')
		->setCellValue('C1', 'Nama Siswa')
		->setCellValue('D1', 'Jenis Kelamin')
		->setCellValue('E1', 'No Peserta Ujian')
		->setCellValue('F1', 'ID Jurusan')
		->setCellValue('G1', 'ID Kelas')
		->setCellValue('H1', 'Tanggal Lahir');

		// Miscellaneous glyphs, UTF-8
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A2', '')
		->setCellValue('B2', '')
		->setCellValue('C2', '')
		->setCellValue('D2', '')
		->setCellValue('E2', '')
		->setCellValue('F2', '')
		->setCellValue('G2', '')
		->setCellValue('H2', '');

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('Template Siswa');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Template Siswa.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		exit;
	}

	public function import_siswa()
	{

		$file = explode('.', $_FILES['file']['name']);

		$extension = end($file);

		if($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}

		$spreadsheet = $reader->load($_FILES['file']['tmp_name']);

		$sheetData = $spreadsheet->getActiveSheet()->toArray();

		for($i = 1;$i < count($sheetData); $i++)
		{
			$data = [
				'nis' => $sheetData[$i]['0'],
				'nisn' => $sheetData[$i]['1'],
				'nama_siswa' => $sheetData[$i]['2'],
				'jk' => $sheetData[$i]['3'],
				'no_peserta_ujian' => $sheetData[$i]['4'],
				'id_jurusan' => $sheetData[$i]['5'],
				'id_kelas' => $sheetData[$i]['6'],
				'tgl' => $sheetData[$i]['7']
			];

			$this->db->insert('siswa', $data);
		}

		$this->session->set_flashdata('message', 'Diimpor');
		redirect('master/siswa','refresh');
	}

	public function eksport_jurusan()
	{
		$jurusan = $this->jm->get_jurusan();
		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();
		// Add some data
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'ID Jurusan')
		->setCellValue('B1', 'Nama Jurusan')
		->setCellValue('C1', 'Singkatan')
		;
		// Miscellaneous glyphs, UTF-8
		$i=2; 
		foreach($jurusan as $row) {
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $i, $row['id_jurusan'])
			->setCellValue('B' . $i, $row['nama_jurusan'])
			->setCellValue('C' . $i, $row['singkatan']);
			$i++;
		}                           

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('Data Jurusan');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Data Jurusan.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		exit;
	}

	public function eksport_kelas()
	{
		$kelas = $this->km->get_kelas();
		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();
		// Add some data
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'ID kelas')
		->setCellValue('B1', 'Nama kelas')
		->setCellValue('C1', 'Nama Jurusan')
		;
		// Miscellaneous glyphs, UTF-8
		$i=2; 
		foreach($kelas as $row) {
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $i, $row['id_kelas'])
			->setCellValue('B' . $i, $row['nama_kelas'])
			->setCellValue('C' . $i, $row['nama_jurusan']);
			$i++;
		}                           

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('Data kelas');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Data kelas.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		exit;
	}

}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */