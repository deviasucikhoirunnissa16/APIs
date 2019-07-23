<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
//use Restserver\Libraries\REST_Controller;

class Ktg_brg extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $ktg_brg = $this->db->get('ktg_brg')->result();
        } else {
            $this->db->where('id', $id);
            $ktg_brg = $this->db->get('ktg_brg')->result();
        }
        $this->response($ktg_brg, 200);
    }

    function index_post() {
        $data = array(
                    // 'id'           => $this->post('id'),
                    'nama' => $this->post('nama'),
                    'detail' => $this->post('detail'),
                    'created_by' => $this->post('created_by'),
                    'created_date' => $this->post('created_date'),
                    'updated_by' => $this->post('updated_by'),
                    'updated_date' => $this->post('updated_date')
                );

        $insert = $this->db->insert('ktg_brg', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('id');
        $data = array(
                    // 'id'       => $this->put('id'),
                    'nama'          => $this->put('nama'),
                    'detail'    => $this->put('detail'),
                    'created_by' => $this->put('created_by'),
                    'created_date' => $this->put('created_date'),
                    'updated_by' => $this->put('updated_by'),
                    'updated_date' => $this->put('updated_date')
                );
        $this->db->where('id', $id);
        $update = $this->db->update('ktg_brg', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('ktg_brg');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>