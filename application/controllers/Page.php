<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
  		public function detail(){

            $id=$this->uri->segment('3');
            $cek = $this->db->query("select * from halamanstatis where judul_seo ='".$this->db->escape_str($id)."' 
            	OR id_halaman='".$this->db->escape_str($id)."'");
                $row = $cek->row();
                $total=$cek->num_rows();
                if($total == 0){
                        redirect(''.base_url().'');

                }
                $data['page'] = $this->blog_model->detailhalaman($id);
                $this->template->load('front/media','front/halaman',$data);
        }
}
