<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/REST_Controller.php';

class Barang extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data barang
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $barang = $this->db->get('barang')->result();
        } else {
            $this->db->where('id', $id);
            $barang = $this->db->get('barang')->result();
        }
        $this->response($barang, 200);
    }

    //Mengirim atau menambah data kontak baru
    function index_post() {
        $data = array(
                    // 'id'            => $this->post('id'),
                    'nama'          => $this->post('nama'),
                    'kode'          => $this->post('kode'),
                    'detail'        => $this->post('detail'),
                    'created_date'  => $this->post('created_date'),
                    'created_by'    => $this->post('created_by'),
                    'updated_date'  => $this->post('updated_date'),
                    'updated_by'    => $this->post('updated_by')
                );
        $insert = $this->db->insert('barang', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }


    //Memperbarui data kontak yang telah ada
    function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id'            => $this->put('id'),
                    'nama'          => $this->put('nama'),
                    'kode'          => $this->put('kode'),
                    'detail'        => $this->put('detail'),
                    'created_date'  => $this->put('created_date'),
                    'created_by'    => $this->put('created_by'),
                    'updated_date'  => $this->put('updated_date'),
                    'updated_by'    => $this->put('updated_by')     
                );
        $this->db->where('id', $id);
        $update = $this->db->update('barang', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Menghapus salah satu data kontak
    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('barang');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>