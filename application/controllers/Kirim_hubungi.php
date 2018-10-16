<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kirim_hubungi extends CI_Controller {

	public function index(){
		$this->form_validation->set_rules('nama','Nama','trim|required|xss_clean|max_length[15]');
		$this->form_validation->set_rules('email','Email','trim|required|xss_clean|valid_email');
	if($this->form_validation->run() == FALSE){
        $this->session->set_flashdata("h", "<div class='alert alert-block alert-danger'>
                <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                  <strong><i class='ace-icon fa fa-check'></i> Gagal !</strong> Nama Maksimal panjang 15 Karakter dan/atau email tidak valid<br />
              </div>");
     redirect(''.base_url().'hubungi');
    }else{  
    if ($this->input->post() && (strtolower($this->input->post('secutity_code')) == strtolower($this->session->userdata('mycaptcha')))) {
        $tgl_sekarang= date('Y-m-d');
        $jam_sekarang=date('H:i:s');
        $data=array(
                  'tgl_hubungi' => $tgl_sekarang,
                  'jam_hubungi' => $jam_sekarang,
                  'nama'        => $this->input->post('nama', TRUE),
                  'email'       => $this->input->post('email', TRUE),
                  'subjek'      => $this->input->post('subjek', TRUE),
                  'pesan'       => stripslashes(htmlspecialchars(trim($this->input->post('pesan', FALSE),ENT_QUOTES))),
                  );
      $query = $this->user_model->simpandata('hubungi',$data);
        $this->session->set_flashdata("h", "<div class='alert alert-block alert-success'>
                <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                  <strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Terima kasih, pesan sudah terkirim saya akan segera membalas<br />
              </div>");
     redirect(''.base_url().'hubungi');
    }
    
    else{
      
       $this->session->set_flashdata("h", "<div class='alert alert-block alert-danger'>
                <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                  <strong><i class='ace-icon fa fa-check'></i> Oops !</strong> Terjadi Kesalahan Saat mengirim pesan<br />
              </div>");
        redirect(''.base_url().'hubungi');
      }

    }

	}
}
