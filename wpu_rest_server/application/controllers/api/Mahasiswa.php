<?php 
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

/**
 * 
 */
class Mahasiswa extends REST_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mahasiswa_model', 'mhs');
		$this->methods['index_get']['limit'] = 100;
	}

	public function index_get()
	{

		$id = $this->get('id');
		if ($id === null) {
			$mahasiswa = $this->mhs->getMahasiswa();	
		}else{
			$mahasiswa = $this->mhs->getMahasiswa($id);
		}
		
		//var_dump($mahasiswa);

		if ($mahasiswa) {
			$this->response([
                    'status' => true,
                    'data' => $mahasiswa
                ], REST_Controller::HTTP_OK);
		}else{
			$this->response([
                    'status' => false,
                    'message' => 'ID Not Found'
                ], REST_Controller::HTTP_NOT_FOUND);
		}
	}

		public function search_get()
	{

		$keyword = $this->get('s');
		if ($keyword === null) {
			$mahasiswa = $this->mhs->getMahasiswa();	
		}else{
			$mahasiswa = $this->mhs->searchMahasiswa($keyword);
		}
		
		//var_dump($mahasiswa);

		if ($mahasiswa) {
			$this->response([
                    'status' => true,
                    'data' => $mahasiswa
                ], REST_Controller::HTTP_OK);
		}else{
			$this->response([
                    'status' => false,
                    'message' => 'Data Not Found'
                ], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_delete()
	{
		$id = $this->delete('id');
		if ($id === null) {
			$this->response([
                    'status' => false,
                    'message' => 'Provide an id!'
                ], REST_Controller::HTTP_BAD_REQUEST);
		}else{
			if ($this->mhs->delMahasiswa($id) > 0) {
				$this->response([
                    'status' => true,
                    'id' => $id,
                    'massage' => 'Deleted'
                ], REST_Controller::HTTP_NO_CONTENT);
			}else{
				$this->response([
                    'status' => false,
                    'message' => 'ID Not Found'
                ], REST_Controller::HTTP_BAD_REQUEST);

			}
		}
	}

	public function index_post()
	{
		$data = [
			'nrp' => $this->post('nrp'),
			'nama' => $this->post('nama'),
			'email' => $this->post('email'),
			'jurusan' => $this->post('jurusan')
		];

		if ($this->mhs->createMahasiswa($data) > 0) {
			$this->response([
                    'status' => true,
                    'massage' => 'New Mahasiswa has been created'
                ], REST_Controller::HTTP_CREATED);
		}else{
			$this->response([
                    'status' => false,
                    'message' => 'FAILED to Create mahasiswa'
                ], REST_Controller::HTTP_BAD_REQUEST);	
		}
	}

	public function index_put()
	{
		$id = $this->put('id');
		$data = [
			'nrp' => $this->put('nrp'),
			'nama' => $this->put('nama'),
			'email' => $this->put('email'),
			'jurusan' => $this->put('jurusan')
		];

		if ($this->mhs->updateMahasiswa($data, $id) > 0) {
			$this->response([
                    'status' => true,
                    'massage' => 'Data Mahsiswa has been updated'
                ], REST_Controller::HTTP_NO_CONTENT);
		}else{
			$this->response([
                    'status' => false,
                    'message' => 'FAILED to Update mahasiswa'
                ], REST_Controller::HTTP_BAD_REQUEST);	
		}
	}


}