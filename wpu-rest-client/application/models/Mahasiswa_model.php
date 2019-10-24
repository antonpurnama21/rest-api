<?php 

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

class Mahasiswa_model extends CI_model {

    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://localhost/rest-api/wpu_rest_server/api/',
            'auth' => ['admin' , '1234'],
        ]);
    }

    public function getAllMahasiswa()
    {
        // return $this->db->get('mahasiswa')->result_array();
        $response = $this->_client->request('GET', 'mahasiswa', [
            'query' => [
                'api-key' => 'APIKEY21'
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'];


    }

        public function getMahasiswaById($id)
    {
        // return $this->db->get_where('mahasiswa', ['id' => $id])->row_array();
        $response = $this->_client->request('GET', 'mahasiswa', [
            'query' => [
                'api-key' => 'APIKEY21',
                'id' => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'][0];
    }

    public function tambahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            "api-key" => 'APIKEY21'
        ];

        $response = $this->_client->request('POST', 'mahasiswa', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
        // $this->db->insert('mahasiswa', $data);
    }

    public function hapusDataMahasiswa($id)
    {
        // $this->db->where('id', $id);
        //$this->db->delete('mahasiswa', ['id' => $id]);
        $response = $this->_client->request('DELETE', 'mahasiswa', [
            'form_params' => [
                'api-key' => 'APIKEY21',
                'id' => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;

    }

    public function ubahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            "id" => $this->input->post('id', true),
            "api-key" => 'APIKEY21'

        ];

        $response = $this->_client->request('PUT', 'mahasiswa', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function cariDataMahasiswa()
    {
        try {

            $response = $this->_client->request('GET', 'mahasiswa/search', [
                'query' => [
                    'api-key' => 'APIKEY21',
                    's' => $this->input->post('keyword', true)
                ]
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result['data'];
            
        } catch (ClientException $e) {
            return false;
        }
        
    }
    
}
    

    // try {
    //         $promise = $client->requestAsync('GET', 'post/' . $value, [
    //             'proxy' => [
    //                 'http'  => 'tcp://216.190.97.3:3128'
    //             ]
    //         ]);

    //         $promise->then(
    //             function (ResponseInterface $res) {
    //                 echo $res->getStatusCode() . "\n";
    //             },
    //             function (RequestException $e) {
    //                 echo $e->getMessage() . "\n";
    //                 echo $e->getRequest()->getMethod();
    //             }
    //         );
    //     } catch ( $e) {
            // echo $e->getMessage() . "\n";
            // echo $e->getRequest()->getMethod();        
    //     }
    //$response->wait();