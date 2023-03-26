<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Siswa_model');
    }

    public function index()
    {
        $data['title'] = 'Siswa';
        $data['title_update'] = 'Update Siswa';
        $data['siswa'] = $this->Siswa_model->get_data('tbl_siswa')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('siswa', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Siswa';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('tambah_siswa');
        $this->load->view('templates/footer');
    }

    public function update($id_siswa)
    {

        $this-> _rules();

        if ($this->form_validation->run() == FALSE) {
            // menampilkan halaman utama di function index
            $this->index();
        } else {
            $data = array(
                'id_siswa' => $id_siswa,
                'nama_siswa' => $this->input->post('nama_siswa'),
                'kelas_siswa' => $this->input->post('kelas_siswa'),
                'alamat_siswa' => $this->input->post('alamat_siswa'),
                'nomor_telepon' => $this->input->post('nomor_telepon'),
            );

            $this->Siswa_model->update_data($data, 'tbl_siswa');
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Data '. $data['nama_siswa'] .' Berhasil Diupdate!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>');
              redirect('siswa');
        }
        
    }

    public function tambah_proses()
    {

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            //kalau datanya salah kembali ke form tambaha atau function tambah
            $this->tambah();
        } else {
            $data = array(
                'nama_siswa' => $this->input->post('nama_siswa'),
                'kelas_siswa' => $this->input->post('kelas_siswa'),
                'alamat_siswa' => $this->input->post('alamat_siswa'),
                'nomor_telepon' => $this->input->post('nomor_telepon'),
            );

            //$data dari array
            //insert data adalah function dari Siswa_model
            $this->Siswa_model->insert_data($data, 'tbl_siswa');

            //session ambil dari auto load, alert ambil dari bootsrap 4.6 admin lte
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Data Berhasil Disimpan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>');
              redirect('siswa');
        }
    }

    public function _rules()
    {

        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required', array(
            'required' => '%s harus di isi!!'
        ));
        $this->form_validation->set_rules('kelas_siswa', 'Kelas Siswa', 'required', array(
            'required' => '%s harus di isi!!'
        ));
        $this->form_validation->set_rules('alamat_siswa', 'Alamat Siswa', 'required', array(
            'required' => '%s harus di isi!!'
        ));
        $this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'required', array(
            'required' => '%s harus di isi!!'
        ));
    }

    public function delete($id){
        $where = array('id_siswa => $id');

        $this->Siswa_model->delete($where, 'tbl_siswa');
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Data Berhasil Diupdate!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>');
              redirect('siswa');        
    }
}

/* End of file Controllername.php */
