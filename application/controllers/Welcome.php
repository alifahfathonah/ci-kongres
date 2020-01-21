<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index($view = 'index')
	{
		switch ($view) {
			case 'registrasi':
				$this->load->view('front/v_registrasi');
				break;

			case 'peserta':
				$this->load->view('front/v_peserta');
				break;

			case 'galeri':
				$parsing['galeris'] 	= $this->galeri_model->get_limit(25);
				$this->load->view('front/v_galeri', $parsing);
				break;

			case 'peserta_korcab':
				$parsing['delegasis'] = $this->korcab_model->get_limit();
				$this->load->view('front/v_peserta_korcab', $parsing);
				break;

			case 'peserta_cabang':
				$parsing['delegasis'] = $this->cabang_model->get_limit();
				$this->load->view('front/v_peserta_cabang', $parsing);
				break;

			case 'tor':
				$parsing['tor'] = $this->tor_model->get_id(1);
				$this->load->view('front/v_tor', $parsing);
				break;

			default:
				$parsing['galeris'] = $this->galeri_model->get_all();
				$this->load->view('front/v_welcome', $parsing);
				break;
		}
	}

	public function load_galeri($posisi)
	{
		$more = $this->galeri_model->get_load($posisi);

		foreach ($more as $data) {
			echo '<div class="card shadow mb-4">
						<img class="card-img-top lazyload" data-src="' . base_url() . '/upload/galeri/' . $data->foto_galeri . '">
						<div class="card-body">
							<p class="card-text"><strong><i class="fa fa-commenting"></i></strong><br>' . $data->judul_galeri . '</p>
							<a href="#" class="card-link"><i class="fa fa-calendar"></i>&nbsp;' . tanggal($data->tgl_galeri) . ', ' . $data->wkt_galeri . ' WITA</a>
						</div>
					</div>';
		}
	}

	public function load_korcab($posisi)
	{
		$more = $this->korcab_model->get_load($posisi);
		foreach ($more as $data) {
			echo '<div class="my-3 p-3 bg-white rounded shadow">
						<h6 class="border-bottom border-dark pb-2 mb-0">' . $data->nama_korcab . '</h6>';
			$asals = $this->peserta_model->get_join_korcab($data->nama_korcab);
			foreach ($asals as $asal) {
				echo '<div class="media text-muted pt-3">
							<img class="bd-placeholder-img mr-2 rounded lazyload" width="65" height="65" data-src="' . base_url() . '/upload/peserta/' . $asal->foto . '">
							<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-dark">
								<div class="d-flex justify-content-between align-items-center w-100">
									<strong class="text-gray-dark">' . $asal->nama . '</strong>
									<button class="btn btn-sm btn-success" onclick="getDetail(' . $asal->id . ')"><i class="fa fa-eye"></i></button>
								</div>
								<span class="d-block">' . $asal->jabatan . '</span>
							</div>
						</div>';
			}
			echo '</div>';
		}
	}

	public function search_korcab()
	{
		$data = $this->korcab_model->get_where($this->input->post('asal', true));

		echo '<div class="my-3 p-3 bg-white rounded shadow">
						<h6 class="border-bottom border-dark pb-2 mb-0">' . $data->nama_korcab . '</h6>';
		$asals = $this->peserta_model->get_join_korcab($data->nama_korcab);
		foreach ($asals as $asal) {
			echo '<div class="media text-muted pt-3">
						<img class="bd-placeholder-img mr-2 rounded lazyload" width="65" height="65" data-src="' . base_url() . '/upload/peserta/' . $asal->foto . '">
						<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-dark">
							<div class="d-flex justify-content-between align-items-center w-100">
								<strong class="text-gray-dark">' . $asal->nama . '</strong>
								<button class="btn btn-sm btn-success" onclick="getDetail(' . $asal->id . ')"><i class="fa fa-eye"></i></button>
							</div>
							<span class="d-block">' . $asal->jabatan . '</span>
						</div>
					</div>';
		}
		echo '</div>';
	}

	public function load_cabang($posisi)
	{
		$more = $this->cabang_model->get_load($posisi);
		foreach ($more as $data) {
			echo '<div class="my-3 p-3 bg-white rounded shadow">
						<h6 class="border-bottom border-dark pb-2 mb-0">' . $data->nama_cab . '</h6>';
			$asals = $this->peserta_model->get_join_cabang($data->nama_cab);
			foreach ($asals as $asal) {
				echo '<div class="media text-muted pt-3">
							<img class="bd-placeholder-img mr-2 rounded lazyload" width="65" height="65" data-src="' . base_url() . '/upload/peserta/' . $asal->foto . '">
							<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-dark">
								<div class="d-flex justify-content-between align-items-center w-100">
									<strong class="text-gray-dark">' . $asal->nama . '</strong>
									<button class="btn btn-sm btn-success" onclick="getDetail(' . $asal->id . ')"><i class="fa fa-eye"></i></button>
								</div>
								<span class="d-block">' . $asal->jabatan . '</span>
							</div>
						</div>';
			}
			echo '</div>';
		}
	}

	public function search_cabang()
	{
		$data = $this->cabang_model->get_where($this->input->post('asal', true));

		echo '<div class="my-3 p-3 bg-white rounded shadow">
						<h6 class="border-bottom border-dark pb-2 mb-0">' . $data->nama_cab . '</h6>';
		$asals = $this->peserta_model->get_join_cabang($data->nama_cab);
		foreach ($asals as $asal) {
			echo '<div class="media text-muted pt-3">
						<img class="bd-placeholder-img mr-2 rounded lazyload" width="65" height="65" data-src="' . base_url() . '/upload/peserta/' . $asal->foto . '">
						<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-dark">
							<div class="d-flex justify-content-between align-items-center w-100">
								<strong class="text-gray-dark">' . $asal->nama . '</strong>
								<button class="btn btn-sm btn-success" onclick="getDetail(' . $asal->id . ')"><i class="fa fa-eye"></i></button>
							</div>
							<span class="d-block">' . $asal->jabatan . '</span>
						</div>
					</div>';
		}
		echo '</div>';
	}

	public function autocomplete($delegasi)
	{
		if ($delegasi == 'korcab') {
			if (isset($_GET['term'])) {
				$result = $this->korcab_model->get_autocomplete($_GET['term']);

				if (count($result) > 0) {
					foreach ($result as $row)
						$arr_result[] = $row->nama_korcab;
					echo json_encode($arr_result);
				}
			}
		} else if ($delegasi == 'cabang') {
			if (isset($_GET['term'])) {
				$result = $this->cabang_model->get_autocomplete($_GET['term']);

				if (count($result) > 0) {
					foreach ($result as $row)
						$arr_result[] = $row->nama_cab;
					echo json_encode($arr_result);
				}
			}
		}
	}

	public function registrasi()
	{
		$this->form_validation->set_rules(
			'delegasi',
			'Delegasi',
			'required|trim',
			array(
				'required' => '%s harus diisi.'
			)
		);
		$this->form_validation->set_rules(
			'asal',
			'Asal Delegasi',
			'required|trim',
			array(
				'required' => '%s harus diisi.'
			)
		);
		$this->form_validation->set_rules(
			'nama',
			'Nama Peserta',
			'required|trim',
			array(
				'required' => '%s harus diisi.'
			)
		);
		$this->form_validation->set_rules(
			'telp',
			'Nomer Telepon atau WA',
			'required|trim',
			array(
				'required' => '%s harus diisi.'
			)
		);
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|valid_email|is_unique[peserta.email]',
			array(
				'required' => '%s harus diisi.',
				'valid_email' => '%s harus valid.',
				'is_unique' => '%s tersebut sudah terdaftar.'
			)
		);
		$this->form_validation->set_rules(
			'jabatan',
			'Jabatan',
			'required|trim',
			array(
				'required' => '%s harus diisi.'
			)
		);
		$this->form_validation->set_rules(
			'periode',
			'Periode',
			'required|trim',
			array(
				'required' => '%s harus diisi.'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('front/v_registrasi');
		} else {
			$jum_data = $this->peserta_model->count_asal($this->input->post('asal', true));

			if ($jum_data < 3) {
				$this->peserta_model->go_insert();
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Selamat, </strong> registrasi berhasil ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(site_url('/'));
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oops, </strong> Asal Delagasi Penuh ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(site_url('/'));
			}
		}
	}

	public function detail_peserta($id_peserta)
	{
		$show = $this->peserta_model->get_id($id_peserta);
		echo json_encode($show);
	}
}
