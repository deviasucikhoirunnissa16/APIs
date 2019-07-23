<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
//use Restserver\Libraries\REST_Controller;

class Admin extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $admin = $this->db->get('admin')->result();
        } else {
            $this->db->where('id', $id);
            $admin = $this->db->get('admin')->result();
        }
        $this->response($admin, 200);
    }

    function index_post() {
        $data = array(
                    //'id'            => $this->post('id'),
                    'username'  => $this->post('username'),
                    'password'  => $this->post('password')
                    );
        $insert = $this->db->insert('admin', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id'        => $this->put('id'),
                    'username'  => $this->put('username'),
                    'password'  => $this->put('password')
                    );
        $this->db->where('id', $id);
        $update = $this->db->update('admin', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id'); 
        $this->db->where('id', $id);
        $delete = $this->db->delete('admin');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>