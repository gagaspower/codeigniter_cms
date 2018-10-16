<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
   
    	public function index()
    	   {
        		$data['news']=$this->blog_model->berita();
        		$this->template->load('front/media','front/home',$data);
    	   }

        public function detail(){

                $id = $this->uri->segment('3');
                $dat = $this->db->query("SELECT * FROM berita where judul_seo='".$this->db->escape_str($id)."' OR id_berita='".$this->db->escape_str($id)."'");
                $row = $dat->row();
                $total = $dat->num_rows();
                if ($total == 0){
                        redirect(''.base_url().'');
                }
                $data['record'] = $this->blog_model->detailblog($id);
                //$this->load->helper('captcha');
    		    $vals = array(
                        'img_path'	 => './captcha/',
                        'img_url'	 => base_url().'captcha/',
                        'font_path' => './public/assets/font/Tahoma.ttf',
                        'font_size'     => 16,
                        'img_width'	 => '100',
                        'img_height' => 30,
                        'border' => 0, 
                        'word_length'   => 5,
                        'expiration' => 7200
                );

                $cap = create_captcha($vals);
                $data['captcha'] = $cap['image'];
                $this->session->set_userdata('mycaptcha', $cap['word']);
                $this->blog_model->updatebaca($id);
                $this->template->load('front/media','front/blogdetail',$data);
        }



        public function category() {
            $ids = $this->uri->segment(3);
            $dat = $this->db->query("SELECT * FROM kategori where kategori_seo='".$this->db->escape_str($ids)."'");
            $row = $dat->row();
            $total = $dat->num_rows();
            if ($total == 0){
                redirect(''.base_url().'');
            }
            $jumlah= $this->blog_model->hitungberitakategori($row->id_kategori)->num_rows();
            $config['base_url'] = base_url().'blog/category/'.$row->kategori_seo;
            $config['total_rows'] = $jumlah;
            $config['per_page'] = 3;
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close']= '</li>';
            $config['prev_link']    = '&laquo;';
            $config['prev_tag_open']='<li>';
            $config['prev_tag_close']='</li>';
            $config['next_link']    = '&raquo;';
            $config['next_tag_open']='<li>';
            $config['next_tag_close']='</li>';
            $config['cur_tag_open']='<li class="active"><a href="#">';
            $config['cur_tag_close']='</a></li>';
            $config['first_tag_open']='<li>';
            $config['first_tag_close']='</li>';
            $config['last_tag_open']='<li>';
            $config['last_tag_close']='</li>';   
            if ($this->uri->segment('4')!=''){
                $dari = $this->uri->segment('4');
            }else{
                $dari = 0;
            }
            if (is_numeric($dari)) {
                $data['cat'] = $this->blog_model->detail_kategori($row->id_kategori, $dari, $config['per_page']);
            }else{
               redirect(''.base_url().'');
            }
            $this->pagination->initialize($config);
            $data['paging']= $this->pagination->create_links();
            $this->template->load('front/media','front/kategoriberita',$data);
        }

            public function pencarian(){
                if(isset($_POST)){  
                $keyword = $this->db->escape_str(trim($this->input->post('cari',TRUE)));
                $data['title'] = 'Pencarian keyword : '.$keyword;
                $data['artikel'] = $this->blog_model->search($keyword);
                $this->template->load('front/media','front/search',$data);
                }
        }


           public function kirimkomentar(){
            $this->form_validation->set_rules('email','Email','trim|required|xss_clean|valid_email');
            if($this->form_validation->run() == FALSE){
            $this->template->load('front/media','front/commentfailed');
            }else{
            $cek = $this->db->query("SELECT * FROM berita WHERE id_berita = '".$this->input->post('id_berita')."'");
            $row = $cek->row_array();
            if ($cek->num_rows() < 1){
                redirect(''.base_url().'');
            }else{
            if ($this->input->post() && (strtolower($this->input->post('secutity_code')) == strtolower($this->session->userdata('mycaptcha')))) {
                $tgl_sekarang= date('Y-m-d');
                $jam_sekarang=date('H:i:s');
                $data=array(
                           'id_berita'      => $this->input->post('id_berita', TRUE),
                           'nama'           => $this->input->post('nama',TRUE),
                           'email'          => $this->input->post('email',TRUE),
                           'isi_komentar'   => stripslashes(htmlspecialchars(trim($this->input->post('isi_komentar', FALSE),ENT_QUOTES))),
                           'tgl_komentar'   => $tgl_sekarang,
                           'jam_komentar'   => $jam_sekarang
                          );
                $this->blog_model->simpandata('komentar',$data);
                
                $this->template->load('front/media','front/commentsuccess');
                }else{
                  $this->template->load('front/media','front/commentfailed');

                }

            }
        }
    }

}


