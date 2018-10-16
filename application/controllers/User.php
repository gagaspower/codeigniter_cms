<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	/* 
	* class ini digunakan untuk menampilkan seluruh isi pada halaman user
	*/

	class User extends CI_Controller {
	protected $logged_in=false;
	//user data
	protected $id_users;
	protected $nama_user;
	protected $password;
	protected $level;


	function __construct()
	{
    	parent::__construct();
  		if ($this->session->userdata('username') === "" || $this->session->userdata('level') != "user")
  		{
    		redirect(''.base_url().'masukruangan');
   		}
 	}
   
   /* menampilkan halaman utama pada dashboard user
   */

	function index()
	{
		$this->template->load('user/media_user','user/home_user');	
		
	}


	/*
	* Fungsi dibawah ini digunakan hanya untuk menampilkan data artikel
	* List artikel akan ditampilkan di file artikel pada folder views/user/mod_artikel/artikel.php
	*/

	function artikel()
	{
		$data['konten'] = $this->user_model->beritauser();
       	$this->template->load('user/media_user','user/mod_artikel/artikel',$data);
	} /* Penutup fungsi menampilkan artikel */
	


	/*
	* Fungsi dibawah ini digunakan untuk menampilkan tag artikel
	* List tag artikel akan ditampilkan di file tag.php yang berada pada folder views/user/mod_tag/view_tag.php
	*/

	function tag()
	{
		$data['tagcloud'] = $this->user_model->tag();
       	$this->template->load('user/media_user','user/mod_tag/view_tag',$data);
	} /* Penutup fungsi menampilkan data tag artikel */

	/*
	* Fungsi dibawah ini digunakan untuk menampilkan list komentar artikel
	*/

	function komentar()
	{
		$data['komen'] = $this->user_model->datakomentar();
      	$this->template->load('user/media_user','user/mod_komentar/komentar',$data);
	}

	


	/*
	* Fungsi dibawah ini digunakan untuk menampilkan form tambah artikel baru (hanya form).
	* Pada baris 84 terdapat variabel 'categories' yang berfungsi untuk mengambil data kategori untuk ditampilkan pada combobox
	* Sama halnya pada baris 85 untuk mengambil data tag artikel 
	*/

	function tambahartikel()
	{
		$data=array(
       				'categories'  => $this->user_model->datakategori(), 
       				'tagnews'	  => $this->user_model->tag()
       				);
       	$this->template->load('user/media_user','user/mod_artikel/tambah_artikel',$data);
	}

	/* 
	* Fungsi dibawah ini digunakan untuk menyimpan artikel yang diinputkan dari form diatas.
	*/

	function simpanartikel()
	{
		/* 
		* buat validasi input 
		* Validasi hanya untuk judul, kategori, dan isi artikel saja
		*/
		$this->form_validation->set_rules('judul','judul','trim|required|xss_clean');
       	$this->form_validation->set_rules('id_kategori','kategori','required');
       	$this->form_validation->set_rules('isi_berita','isi','trim|required');

       	/* 
       	*	Fungsi dibawah ini digunakan untuk pengaturan upload gambar atau thumbnail gambar artikel
       	*/

       	$namafile = "file_".time(); //nama file beri nama langsung dan diikuti fungsi time
        $config['upload_path'] 		= './public/upload/gambar_artikel/'; //path folder
        $config['allowed_types'] 	= 'gif|jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] 		= '3072'; //maksimum besar file 3M
        $config['max_width']  		= '5000'; //lebar maksimum 5000 px
        $config['max_height']  		= '5000'; //tinggi maksimu 5000 px
        $config['file_name'] 		= $namafile; //nama yang terupload nantinya
        $this->upload->initialize($config);
      	$tgl_sekarang			= date('Y-m-d');
      	$jam_sekarang			= date('H:i:s');
      	$tag_seo     			= $this->input->post('tag_seo');
 		$tag         			= implode(',',$tag_seo); // merubah spasi menjadi koma (,).

 		// Jika validasi tidak berjalan akan di redirect ke halaman view artikel
 		if($this->form_validation->run() == FALSE)
 			{
       			$this->session->set_flashdata("k", "<div class='alert alert-danger'>
              	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong><i class='ace-icon fa fa-times'></i> Gagal !</strong> Judul, kategori dan isi berita harus diisi.<br />
            	</div>");
       			redirect(''.base_url().'user/artikel');
       		}
       	// jika gambar thumbnail diisi
       	elseif($_FILES['fupload']['name']){
       	// Jika gambar thumbnail yang di inputkan tidak sesuai dengan ketentuan diatas
       	if(!$this->upload->do_upload('fupload'))
       		{
        		$this->session->set_flashdata("k", "<div class='alert alert-danger'>
              	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong><i class='ace-icon fa fa-times'></i> Gagal !</strong> Gambar Yang Di upload tidak di ijinkan<br />
            	</div>");
        		redirect(''.base_url().'user/artikel/');
        	}
        else{
        	// buat data array dari input formnya
		        	$data = array(
		       				'id_kategori' 	=> $this->db->escape_str($this->input->post('id_kategori', TRUE)),
		       				'username' 		=> $this->db->escape_str($this->session->userdata('username', TRUE)),
		       				'judul' 		=> $this->db->escape_str($this->input->post('judul', TRUE)),
		       				'judul_seo'		=> seo_title($this->input->post('judul')),
		       				'isi_berita'	=> stripslashes(htmlspecialchars(trim($this->input->post('isi_berita', FALSE),ENT_QUOTES))),
		       				'tanggal' 		=> $tgl_sekarang,
		       				'jam' 			=> $jam_sekarang,
		       				'gambar' 		=> $this->upload->data('file_name'),
		       				'tag' 			=> $tag
		       					);
		        	// mulai proses menyimpan dengan memanggil nama method modelnya
		        	$this->user_model->simpandata('berita',$data);
		        	// dan selanjutnya buat fungsi untuk merisize gambar thumbnailnya
		        	// disini di resize dengan dua versi yaitu ukuran medium dan kecil
	        	 	$config2['image_library']   = 'gd2'; 
	                $config2['source_image']    = $this->upload->upload_path.$this->upload->file_name;
	                $config2['new_image'] 	    = './public/upload/gambar_artikel/medium/'; // folder tempat menyimpan hasil resize
	                //$config2['create_thumb']  = TRUE;
	                $config2['maintain_ratio']  = FALSE;
	                $config2['width'] 			= 850; //lebar setelah resize menjadi 100 px
	                $config2['height'] 			= 300; //lebar setelah resize menjadi 100 px
	                $this->load->library('image_lib',$config2); 
	                $this->image_lib->initialize($config2);
	                $this->image_lib->resize();

	                $config3['image_library'] 	= 'gd2'; 
	                $config3['source_image'] 	= $this->upload->upload_path.$this->upload->file_name;
	                $config3['new_image'] 		= './public/upload/gambar_artikel/thumb/'; // folder tempat menyimpan hasil resize
	                //$config3['create_thumb'] 	= TRUE;
	                $config3['maintain_ratio'] 	= FALSE;
	                $config3['width'] 			= 70; //lebar setelah resize menjadi 100 px
	                $config3['height'] 			= 70; //lebar setelah resize menjadi 100 px
	                $this->load->library('image_lib',$config3); 
	                $this->image_lib->initialize($config3);
	                $this->image_lib->resize();

                	$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Disimpan !<br />
            		</div>");
					redirect(''.base_url().'user/artikel/');
        	}
        }else{
        			// Jika gambar thumbnail tidak di isi

	        		$data=array(
	       				'id_kategori' 	=> $this->db->escape_str($this->input->post('id_kategori', TRUE)),
	       				'username' 		=> $this->db->escape_str($this->session->userdata('username', TRUE)),
	       				'judul' 		=> $this->db->escape_str($this->input->post('judul', TRUE)),
	       				'judul_seo'		=> seo_title($this->input->post('judul')),
	       				'isi_berita'	=> stripslashes(htmlspecialchars(trim($this->input->post('isi_berita', FALSE),ENT_QUOTES))),
	       				'tanggal' 		=> $tgl_sekarang,
	       				'jam' 			=> $jam_sekarang,
	       				'tag' 			=> $tag
	       				);
       				$this->user_model->simpandata('berita',$data);
		       			$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              			<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                		<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Disimpan !<br />
           			 	</div>");
					redirect(''.base_url().'user/artikel/');
        }


	} /* Penutup fungsi simpan artikel */


	/*
	* Fungsi dibawah digunakan untuk mengedit artikel (Fungsi ini hanya untuk menampilkan datanya pada form).
	*/

	function editartikel($id=0)
	{
		$result = $this->user_model->Get_data_byid('berita WHERE id_berita="'.$id.'"')->result_array();
		$data=array(
					'id_berita'		=> $result[0]['id_berita'],
					'kategori' 		=> $this->user_model->datakategori(),
					'id_kategori'	=> $result[0]['id_kategori'],
					'username' 		=> $result[0]['username'],
					'judul' 		=> $result[0]['judul'],
					'judul_seo'		=> $result[0]['judul_seo'],
					'isi_berita'	=> $result[0]['isi_berita'],
					'tanggal' 		=> $result[0]['tanggal'],
					'jam'			=> $result[0]['jam'],
					'gambar'		=> $result[0]['gambar'],
					'katakunci' 	=> $this->user_model->katakunci(),
					'tag' 			=> $result[0]['tag']
					);
		$this->template->load('user/media_user','user/mod_artikel/edit_artikel',$data);
	} /* Penutup fungsi edit artikel */


	/* 
	* Fungsi Dibawah ini adalah aksi yang digunakan untuk merubah artikel
	*/

	function aksi_editartikel()
	{
			$namafile 					= "file_".time(); //nama file beri nama langsung dan diikuti fungsi time
	        $config['upload_path'] 		= './public/upload/gambar_artikel/'; //path folder
	        $config['allowed_types'] 	= 'gif|jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
	        $config['max_size'] 		= '3072'; //maksimum besar file 3M
	        $config['max_width']  		= '5000'; //lebar maksimum 5000 px
	        $config['max_height']  		= '5000'; //tinggi maksimu 5000 px
	        $config['file_name'] 		= $namafile; //nama yang terupload nantinya
	        $this->upload->initialize($config);
	      	$tgl_sekarang		= date('Y-m-d');
	      	$jam_sekarang		=date('H:i:s');

	      	$tag_seo     	= $this->input->post('tag_seo');
	 		$tag         	= implode(',',$tag_seo);
	 		$this->upload->initialize($config);
	 		if($_FILES['fupload']['name'])
	 		{
	 			if($this->upload->do_upload('fupload'))
	 		{
	 			$data = array
	 					(
   						'id_berita' 	=> $this->db->escape_str($this->input->post('id_berita', TRUE)),
   						'id_kategori' 	=> $this->db->escape_str($this->input->post('id_kategori', TRUE)),
         				'username' 		=> $this->db->escape_str($this->session->userdata('username', TRUE)),
         				'judul' 		=> $this->db->escape_str($this->input->post('judul', TRUE)),
         				'judul_seo'		=> seo_title($this->input->post('judul')),
         				'isi_berita'	=> stripslashes(htmlspecialchars(trim($this->input->post('isi_berita', FALSE),ENT_QUOTES))),
         				'tanggal' 		=> $tgl_sekarang,
         				'jam' 			=> $jam_sekarang,
         				'gambar' 		=> $this->upload->data('file_name'),
         				'tag' 			=> $tag
         				);
         		// mengambil data gambar lama dari id artikel yang diambil dan hapus dengan fungsi unlink
       			$hasil = $this->user_model->ambilGambar("where id_berita ='".$this->db->escape_str($this->input->post('id_berita', TRUE))."'")->result();
       			foreach ($hasil as $g )
       				{
	 					@unlink('./public/upload/gambar_artikel/'.$g->gambar);
	        			@unlink('./public/upload/gambar_artikel/medium/'.$g->gambar);
	        			@unlink('./public/upload/gambar_artikel/thumb/'.$g->gambar);
 					}
	 				// mulai proses update data artikel berdasarkan id yang diambil
	 				$this->user_model->updateData('berita',$data,array('id_berita' => $this->db->escape_str($this->input->post('id_berita'))));
	                $config2['image_library'] = 'gd2'; 
	                $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
	                $config2['new_image'] = './public/upload/gambar_artikel/medium/'; // folder tempat menyimpan hasil resize
	                //$config2['create_thumb'] = TRUE;
	                $config2['maintain_ratio'] = FALSE;
	                $config2['width'] = 850; //lebar setelah resize menjadi 100 px
	                $config2['height'] = 300; //lebar setelah resize menjadi 100 px
	                $this->load->library('image_lib',$config2); 
	                $this->image_lib->initialize($config2);
	                $this->image_lib->resize();

	                $config3['image_library'] = 'gd2'; 
	                $config3['source_image'] = $this->upload->upload_path.$this->upload->file_name;
	                $config3['new_image'] = './public/upload/gambar_artikel/thumb/'; // folder tempat menyimpan hasil resize
	                //$config3['create_thumb'] = TRUE;
	                $config3['maintain_ratio'] = FALSE;
	                $config3['width'] = 70; //lebar setelah resize menjadi 100 px
	                $config3['height'] = 70; //lebar setelah resize menjadi 100 px
	                $this->load->library('image_lib',$config3); 
	                $this->image_lib->initialize($config3);
	                $this->image_lib->resize();

        			$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              			<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                		<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Disimpan !<br />
            			</div>");
					redirect(''.base_url().'user/artikel/');
 				}

 			}
 			else
 			{
 				$data = array
 					(
	 					'id_berita' 	=> $this->db->escape_str($this->input->post('id_berita', TRUE)),
	 					'id_kategori' 	=> $this->db->escape_str($this->input->post('id_kategori', TRUE)),
	       				'username' 		=> $this->db->escape_str($this->session->userdata('username', TRUE)),
	       				'judul' 		=> $this->db->escape_str($this->input->post('judul', TRUE)),
	       				'judul_seo'		=> seo_title($this->input->post('judul')),
	       				'isi_berita'	=> stripslashes(htmlspecialchars(trim($this->input->post('isi_berita', FALSE),ENT_QUOTES))),
	       				'tanggal' 		=> $tgl_sekarang,
	       				'jam' 			=> $jam_sekarang,
	       				'tag' 			=> $tag
       				);
       	 		$this->user_model->updateData('berita',$data,array('id_berita' => $this->input->post('id_berita', TRUE)));
      	 		$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Disimpan !<br />
            		</div>");
				redirect(''.base_url().'user/artikel/');
 			}


	} /* Penutup aksi edit artikel */


	/*
	*
	* Fungsi dibawah digunakan untuk menghapus artikel.
	*
	*/

	function hapusartikel($id)
	{
		/* Ambil gambar artikel dari id yang diambil */
		$gbr = $this->user_model->ambilGambar("where id_berita ='$id'")->result();
 		foreach($gbr as $g)
 				{
 				/* Hapus gambar thumbnail lama dengan fungsi unlink */
 				@unlink('./public/upload/gambar_artikel/'.$g->gambar);
        		@unlink('./public/upload/gambar_artikel/medium/'.$g->gambar);
        		@unlink('./public/upload/gambar_artikel/thumb/'.$g->gambar);
 				}

 		/* Mulai proses menghapus artikel dari tabel */
 		$query = $this->user_model->hapusData('berita',array('id_berita' => $id));
 		if($query)
 		{
        	$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Di Hapus !<br />
            	</div>");
			redirect(''.base_url().'user/artikel');
		}
			else
			{
				$this->session->set_flashdata("k", "<div class='alert alert-block alert-danger'>
              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Di Hapus !<br />
            		</div>");
				redirect(''.base_url().'user/artikel');
			}
	} /* penutup fungsi hapus artikel selesai */


	/*
	*
	* Fungsi Menampilkan form untuk menambah tag artikel
	*
	*/

	function tambahtag()
	{
		$this->template->load('user/media_user','user/mod_tag/tambah_tag');
	} /* Penutup tambah tag artikel */


	/*
	*
	* Fungsi dibawah ini digunakan untuk aksi menyimpan tag baru
	*
	*/

	function simpantag()
	{

		/* Validasi nama tag jika sudah digunakan */
		$this->form_validation->set_rules('nama_tag','nama tag','trim|required|xss_clean|is_unique[tag.nama_tag]');

		/* Jika Validasi tidak berjalan sesuai permintaan maka: */
		if($this->form_validation->run() == FALSE)
			{

		       	$this->session->set_flashdata("t", "<div class='alert alert-danger'>
				        <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
				        <strong><i class='ace-icon fa fa-times'></i> Gagal Menyimpan Data</strong><br> Pastikan data sudah diisi, dan nama belum digunakan.
				        </div>");
		       	redirect(''.base_url().'user/tag');
		    }
		    /* Jika validasi berjalan sesuai permintaan maka: */
		    else
		    {
		    	/* Jalankan proses penyimpanan data tag */
		    	$this->user_model->simpandata('tag',$data);
		    	$this->session->set_flashdata("t", "<div class='alert alert-block alert-success'>
              			<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                		<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Disimpan!<br />
            			</div>");
				redirect(''.base_url().'user/tag');
		    }
	} /* Penutup fungsi simpan tag */



	/*
	*
	* Fungsi dibawah ini digunakan untuk mengedit tag artikel
	*
	*/

	function edittag($id=0)
	{
		/* ambil data tag berdasarkan ID yang dipilih */
		   $r = $this->user_model->Get_data_byid('tag WHERE id_tag="'.$id.'"')->result_array();
       	$data = array(
       				'id_tag' 	=> $r[0]['id_tag'],
       				'nama_tag'	=> $r[0]['nama_tag']
       				);
       	$this->template->load('user/media_user','user/mod_tag/edit_tag',$data);
	} /* Penutup fungsi edti tag */


	/*
	*
	* Fungsi dibawah ini digunakan untuk menyimpan perubahan tag dari fungsi diatas.
	*
	*/

	function aksi_edittag()
	{
		$data = array(
       			'id_tag' 	=> cetak($this->input->post('id_tag', TRUE)),
       			'nama_tag'	=> cetak(trim($this->input->post('nama_tag', TRUE))),
       			'tag_seo' 	=> cetak(seo_title($this->input->post('nama_tag')))
       				);
		$query = $this->user_model->updateData('tag',$data,array('id_tag'=>$this->input->post('id_tag', TRUE)));
		if($query)
		{
			$this->session->set_flashdata("t", "<div class='alert alert-block alert-success'>
              							 <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                						 <strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Perubahan Berhasil Disimpan.<br />
            							 </div>");
			redirect(''.base_url().'user/tag');
		}
		else
		{
			$this->session->set_flashdata("t", "<div class='alert alert-block alert-danger'>
              							 <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                						 <strong><i class='ace-icon fa fa-check'></i> Gagal !</strong> Tidak Bisa Menyimpan Perubahan.<br />
            							 </div>");
			redirect(''.base_url().'user/tag');
		}
	} /* penutup fungsi aksi edit tag artikel */


	/*
	*
	* Fungsi dibawah digunakan untuk menghapus tag artike
	*
	*/
	function hapustag($id)
	{
		$result = $this->user_model->hapusData('tag',array('id_tag'=>validasi($id)));
       	if($result)
       		{
       			$this->session->set_flashdata("t", "<div class='alert alert-block alert-success'>
             		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Dihapus!<br />
            		</div>");
				redirect(''.base_url().'useri/tag');

       		}
       			else
       			{

       			$this->session->set_flashdata("t", "<div class='alert alert-danger'>
				              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
				               Gagal menghapus data !
				            	</div>");
				redirect(''.base_url().'user/tag');

       			}
	} /* Penutup fungsi hapus tag artikel */

	

	

	/*
	** Fungsi dibawah ini digunakan untuk menampilkan detail komentar dan form membalas komentar.
	*/

	function balaskomentar($id=0)
	{
		 	$r = $this->user_model->editkomen($id)->result_array();
          	$data = array(
              	'id_komentar' 	=> $r[0]['id_komentar'],
              	'isi_komentar' 	=> $r[0]['isi_komentar'],
              	'email'       	=> $r[0]['email'],
              	'id_berita'   	=> $r[0]['id_berita'],
              	'nama'        	=> $r[0]['nama'],
              	'judul' 		=>$r[0]['judul']
                );
          $this->template->load('user/media_user','user/mod_komentar/balas_komentar',$data);

	} /* Fungsi balas komentar selesai */



	/* 
	** Fungsi dibawah ini digunakan untuk mengirim balasan komentar, sekaligus mengirim ke email komentar.
	*/
	function userbalaskomen()
	{
			require_once(APPPATH.'libraries/PHPMailerAutoload.php');
	        $pesan = $this->input->post('isi_komentar');
	        $subjek = $this->input->post('judul');
	        $mail = new PHPMailer();
			$mail->SMTPDebug =0;
	        $mail->isSMTP();
	        $mail->Host = 'smtp.gmail.com';
	        $mail->SMTPAuth = true;
	        $mail->Username = 'pahlitamanata@gmail.com'; // email pengirim
	        $mail->Password = 'uoto2305'; // password email pengirim
	        $mail->SMTPSecure = 'tls'; // secure access
	        $mail->Port =587;           // port gmail
	        $mail->SetFrom('gagas.power92@gmail.com', 'Gagas');  //Who is sending the email
	        $mail->AddReplyTo("user@ruangpojok.net","No Replay");  //email address that receives the response
	        $mail->Subject    = $subjek;
	        $mail->Body       = $pesan;
	        $mail->AltBody    = $pesan;
	        //$to = $emailpenerima; // Who is addressed the email to
	        $mail->AddAddress($this->input->post('email'), $this->input->post('nama'));
	         
	        /* Jika email tidak berhasil dikirim maka : */
	        if(!$mail->send())
	        {
	        	$this->session->set_flashdata("k", "<div class='alert alert-danger'>
                      	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                         Gagal membalas komentar.
                    	</div>");
    			redirect(''.base_url().'user/komentar');
	        }
	        else
	        /* Jika email berhasil dikirim maka: */
	        {
	        	$tgl_sekarang= date('Y-m-d');
        		$jam_sekarang=date('H:i:s');
        		$data=array(
                   'id_berita'      => $this->input->post('id_berita', TRUE),
                   'nama'           => $this->session->userdata('username'),
                   'moderator'      => $this->input->post('moderator'),
                   'isi_komentar'   => stripslashes(htmlspecialchars(trim($this->input->post('isi_komentar', FALSE),ENT_QUOTES))),
                   'tgl_komentar'   => $tgl_sekarang,
                   'jam_komentar'   => $jam_sekarang,
                   'publish'        => 'Y'
                  );
        		$res = $this->user_model->simpandata('komentar',$data);
        		$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Komentar Berhasil dibalas dan di kirim ke email!<br />
            		</div>");
        		redirect(''.base_url().'user/komentar/');
	        }
	} /* fungsi mengirim balasan selesai */



	/*
	**	 Fungsi dibawah ini merupakan fungsi untuk approve komentar masuk
	**	 Jika komentar di approve maka komentar akan ditampilkan
	*/

	function approve($id)
	{
		$result = $this->user_model->komenaprove($id);
        if($result)
        {
        	$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
                <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Komentar Di Publish!<br />
                </div>");
        	redirect(''.base_url().'user/komentar/');
    	}
    	else
    	{
    		$this->session->set_flashdata("k", "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                    Terjadi kesalahan saat merubah status komentar
                    </div>");
        	redirect(''.base_url().'user/komentar/');
    	}
	} /* Fungsi approve komentar selesai */



	/*
	** Fungsi dibawah ini merupakan fungsi untuk unapprove komentar
	** Jika komentar di unapprove maka komentar tidak akan di publikasikan.
	*/

	function unapprove($id)
	{
			$result = $this->user_model->komenunaprove($id);
          	if($result)
          	{
          		$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
                	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                  	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Komentar Telah di Unapprove!<br />
                	</div>");
        		redirect(''.base_url().'user/komentar/');
          	}
          	else
          	{
          		$this->session->set_flashdata("k", "<div class='alert alert-danger'>
                      	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                      	Terjadi kesalahan saat merubah status komentar
                    	</div>");
        		redirect(''.base_url().'user/komentar/');
          	}
	} /* Fungsi unapprove komentar selesai */


	/*
	**	Fungsi dibawah digunakan untuk menghapus komentar.
	*/

	function hapuskomen($id)
	{
			$result = $this->user_model->hapusData('komentar',array('id_komentar'=>validasi($id)));
          	if($result)
          	{
          		$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
                	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                  	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Dihapus!<br />
                	</div>");
        		redirect(''.base_url().'user/komentar/');
          	}
          	else
          	{
          		$this->session->set_flashdata("k", "<div class='alert alert-danger'>
                      	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                      	Gagal menghapus data.
                    	</div>");
        		redirect(''.base_url().'user/komentar/');
          	}
	} /* Fungsi hapus komentar selesai */




	/* 
	** Fungsi dibawah ini digunakan untuk merubah password sesuai session username loginnya.
	** Ini hanya digunakan untuk menampilkan form saja.
	*/


	function gantipaswod()
	{
      	$data['uid']=$this->user_model->ambilakun('where username="'.$this->session->userdata('username').'"');
      	$this->template->load('user/media_user','user/mod_password/password',$data);
   	} /* penutup ganti password */



   	/*
   	** Fungsi dibawah ini merupakan aksi dari fungsi ganti password.
   	*/


   function aksi_gantipaswod()
   	{

   		$this->form_validation->set_rules('password','password','trim|xss_clean|required|alpha_numeric');
    	$this->form_validation->set_rules('pass_conf','pass_conf','trim|xss_clean|required|matches[password]|alpha_numeric');
    	if($this->form_validation->run() == FALSE){
      	$this->session->set_flashdata("k", "<div class='alert alert-danger'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong><i class='ace-icon fa fa-times'></i> Gagal !</strong><br>* Password hanya boleh menggunakan angka dan atau huruf.<br>* Pastikan password yang anda masukan sama.<br />
            </div>");
          redirect(''.base_url().'user/gantipaswod');

    	}else{
   		$username = $this->session->userdata('username');
   		$password = $this->db->escape_str(trim($this->input->post('password')));
   		$pass_conf= $this->db->escape_str(trim($this->input->post('pass_conf')));
       	$pengacak 			="gagasPower!@#$%^&#$@$%^&5$#JHIY*kjkjbkjhi"; // pengacak terserah kpd sang programmer
		$password_pertama 	=sha1($pengacak.md5($password)).md5($pengacak).crc32($password); 
		$password_kedua 	=sha1($pengacak.md5($pass_conf)).md5($pengacak).crc32($pass_conf); 

       		$data=array(
                	'password' => $password_pertama
                	);

       		$query = $this->admin_model->updatePassword('users',$data,array('username'=>$username));
       		if($query)
       		{
       		$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
                              	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                              	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Perubahan Berhasil Disimpan!<br />
                            	</div>");
       		redirect(''.base_url().'user/gantipaswod');
       		}
       	
       	else
       	{
       		$this->session->set_flashdata("k", "<div class='alert alert-block alert-danger'>
                              	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                              	<strong><i class='ace-icon fa fa-check'></i> Gagal !</strong> Tidak bisa menyimpan perubahan.<br />
                            	</div>");
       		redirect(''.base_url().'user/gantipaswod');
       	} 
       }
   	} /* Ganti aksi update/ganti password selesa */





   	function logout()
   	{
   		$this->session->unset_userdata('username');
        $this->session->unset_userdata('level');
        $this->session->unset_userdata('password');
        $this->session->unset_userdata('nama_users');
        $this->session->unset_userdata('id_users');
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect(''.base_url().'adminweb');
   	}

	/*
	* important !!
	* Kurung kurawal dibawah adalah penutup class user_utama
	* Location: application/controller/user.php
	*/
}

