<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
//use Restserver\Libraries\REST_Controller;

class Customer extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $customer = $this->db->get('customer')->result();
        } else {
            $this->db->where('id', $id);
            $customer = $this->db->get('customer')->result();
        }
        $this->response($customer, 200);
    }

    function index_post() {
        $data = array(
                    //'id'            => $this->post('id'),
                    'nama'          => $this->post('nama'),
                    'created_date'  => $this->post('created_date'),
                    'created_by'    => $this->post('created_by'),
                    'updated_date'  => $this->post('updated_date'),
                    'updated_by'    => $this->post('updated_by')
                    );
        $insert = $this->db->insert('customer', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id'            => $this->put('id'),
                    'nama'          => $this->put('nama'),
                    'created_date'  => $this->put('created_date'),
                    'created_by'    => $this->put('created_by'),
                    'updated_date'  => $this->put('updated_date'),
                    'updated_by'    => $this->put('updated_by')
                    );
        $this->db->where('id', $id);
        $update = $this->db->update('customer', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('customer');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>