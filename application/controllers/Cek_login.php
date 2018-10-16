<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cek_login extends CI_Controller {
   
	public function index()

	{
		// mulai proses validasi
		$this->form_validation->set_rules('username','username','trim|required|xss_clean|alpha_numeric');
		$this->form_validation->set_rules('password','password','trim|required|xss_clean|alpha_numeric');

		if($this->form_validation->run() == FALSE ){
		echo "<script>alert('Anda Belum Mengisikan Usename & password dengan benar');
				history.go(-1);
				</script>";
		}else{
			    $password 			= trim($this->input->post('password',TRUE));
       			$pengacak 			="gagasPower!@#$%^&#$@$%^&5$#JHIY*kjkjbkjhi"; // pengacak terserah kpd sang programmer
				$password_enkripsi 	=sha1($pengacak.md5($password)).md5($pengacak).crc32($password); 
			$data=array(
						'username' =>$this->input->post('username',TRUE),
						'password' =>$password_enkripsi
						);
			$hasil = $this->login_model->ambiluser($data);
			if($hasil->num_rows() == 1){
				foreach($hasil->result() as $sess){
					$sess_data['logged_in']=TRUE;
					$sess_data['username'] = $sess->username;
					$sess_data['level'] = $sess->level;
					$sess_data['id_users'] = $sess->id_users;
					$sess_data['blokir'] ='N';
					$sess_data['nama_users']=$sess->nama_users;
					$this->session->set_userdata($sess_data);

				}
				if($this->session->userdata('level') === 'admin'){
				redirect(''.base_url().'admin');
				}
				elseif($this->session->userdata('level') === 'user'){
					redirect(''.base_url().'user');
				}
			}else{

				echo "<script>alert('Gagal login: Silahkan cek username dan password anda, atau anda sedang di blokir');
				history.go(-1);
				</script>";
				}

			}
		}

}
