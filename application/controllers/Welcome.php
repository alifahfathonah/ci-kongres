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
				$parsing['fotos'] = $this->galeri_model->get_limit_foto(6);
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
			// redirect kembali
			$this->load->view('front/v_registrasi');
		} else {
			// cek jumlah asal delegasi
			$jum_data = $this->peserta_model->count_asal($this->input->post('asal', true));

			if ($jum_data < 3) {
				$input_email = $this->input->post('email', true);

				$data = array(
					'id'        => rand(111111, 199999),
					'delegasi'  => ucwords($this->input->post('delegasi', true)),
					'asal'      => ucwords($this->input->post('asal', true)),
					'nama'      => ucwords($this->input->post('nama', true)),
					'telp'      => $this->input->post('telp', true),
					'email'     => $input_email,
					'jabatan'   => ucwords($this->input->post('jabatan', true)),
					'periode'   => $this->input->post('periode', true),
					'foto'      => $this->_upload_image(),
					'aktif'     => 0
				);

				// insert data registrasi sebelum aktif
				$this->db->insert('peserta', $data);

				// buat token verifikasi
				$token = base64_encode(random_bytes(32));

				$user_token = array(
					'email' => $input_email,
					'token' => $token,
					'date_created' => time()
				);

				// insert data registrasi dengan token 
				$this->db->insert('peserta_token', $user_token);

				// kirim email untuk verifikasi peserta
				$this->_sendEmail($token, $input_email);

				// berikan alert notif untuk pemberitahuan 
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Selamat, </strong> silakan cek email anda (1x24 Jam) untuk verifikasi pendaftaran! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(site_url('welcome/index/registrasi'));
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oops, </strong> Asal Delagasi Sudah Penuh ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(site_url('/'));
			}
		}
	}

	public function detail_peserta($id_peserta)
	{
		$show = $this->peserta_model->get_id($id_peserta);
		echo json_encode($show);
	}

	private function _sendEmail($token, $email)
	{
		$config = array(
			'protocol' 	=> 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'kongrespmiixx@gmail.com',
			'smtp_pass' => 'irfan020412',
			'smtp_port' => 465,
			'mailtype' 	=> 'html',
			'charset' 	=> 'utf-8',
			'newline' 	=> "\r\n"
		);

		$this->load->library('email', $config);

		$this->email->from('kongrespmiixx@gmail.com', 'Panitia Daerah Kongres');
		$this->email->to($email);
		$this->email->subject('Verifikasi Registrasi Peserta');
		$this->email->message('silakan klik link berikut untuk verifikasi registrasi sebagai peserta kongres <a href="' . base_url() . 'welcome/verifikasi?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Register</a>');

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	public function verifikasi()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		// validasi peserta
		$peserta = $this->db->get_where('peserta', array('email' => $email))->row();

		if ($peserta) {
			$peserta_token = $this->db->get_where('peserta_token', array('token' => $token))->row();

			if ($peserta_token) {
				if (time() - $peserta_token->date_created < (60 * 60 * 24)) {
					$this->db->set('aktif', 1);
					$this->db->where('email', $email);
					$this->db->update('peserta');

					// hapus email di table peserta token
					$this->db->delete('peserta_token', array('email' => $email));

					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Selamat, </strong> Verifikasi pendaftaran Anda berhasil ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect(site_url('/'));
				} else {
					// hapus email di table peserta token
					$this->db->delete('peserta', array('email' => $email));
					$this->db->delete('peserta_token', array('email' => $email));

					// berikan alert notif untuk pemberitahuan 
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oopss, </strong>verifikasi pendaftaran anda gagal, token expired! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect(site_url('welcome/index/registrasi'));
				}
			} else {
				// berikan alert notif untuk pemberitahuan 
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oopss, </strong>verifikasi pendaftaran anda gagal, token salah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(site_url('welcome/index/registrasi'));
			}
		} else {
			// berikan alert notif untuk pemberitahuan 
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oopss, </strong>verifikasi pendaftaran anda gagal, email salah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect(site_url('welcome/index/registrasi'));
		}
	}


	/**
	 * function membuat upload image yang hanya dapat diakses di dalam class ini
	 * dan terdapat fitur untuk compress ukuran pixel gambar
	 */
	private function _upload_image()
	{
		$config['upload_path']          = './upload/peserta';
		$config['allowed_types']        = 'jpg|png|jpeg';

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('foto')) {
			$gbr = $this->upload->data();

			// config compress image
			$config['image_library'] = 'gd2';
			$config['source_image'] = './upload/peserta/' . $gbr['file_name'];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['quality'] = '100%';
			$config['width'] = 750;
			$config['height'] = 750;
			$config['new_image'] = './upload/peserta/' . $gbr['file_name'];

			// load library resize codeigniter
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			return $this->upload->data("file_name");
		}
	}
}
