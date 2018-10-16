<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	/* 
	* class ini digunakan untuk menampilkan seluruh isi pada halaman admin
	*/

class Admin extends CI_Controller {
	protected $logged_in=false;
	//user data
	protected $id_users;
	protected $nama_user;
	protected $password;
	protected $level;


	function __construct()
	{
    	parent::__construct();
  		if ($this->session->userdata('username') === "" || $this->session->userdata('level') != "admin")
  		{
    		redirect(''.base_url().'masukruangan');
   		}
 	}
   
   /* menampilkan halaman utama pada dashboard admin
   *  load file home.php pada folder views/adminweb/home.php
   */

	function index()
	{
		$this->template->load('adminweb/media','adminweb/home');	
		
	}


	/*
	* Fungsi dibawah ini digunakan hanya untuk menampilkan data artikel
	* List artikel akan ditampilkan di file artikel pada folder views/adminweb/mod_artikel/artikel.php
	*/

	function artikel()
	{
		$data['konten'] = $this->admin_model->beritaadmin();
       	$this->template->load('adminweb/media','adminweb/mod_artikel/artikel',$data);
	} /* Penutup fungsi menampilkan artikel */
	

	/*
	* Fungsi dibawah ini digunakan untuk menampilkan data kategori artikel
	* List kategori artikel akan ditampilkan di file kategori.php yang berada di folder views/adminweb/mod_kategori/view_kategori.php
	*/

	function kategori()
	{
		$data['category']=$this->admin_model->datakategori();
		$this->template->load('adminweb/media','adminweb/mod_kategori/view_kategori',$data);
	} /* Penutup fungsi kategori artikel */

	/*
	* Fungsi dibawah ini digunakan untuk menampilkan tag artikel
	* List tag artikel akan ditampilkan di file tag.php yang berada pada folder views/adminweb/mod_tag/view_tag.php
	*/

	function tag()
	{
		$data['tagcloud'] = $this->admin_model->tag();
       	$this->template->load('adminweb/media','adminweb/mod_tag/view_tag',$data);
	} /* Penutup fungsi menampilkan data tag artikel */

	/*
	* Fungsi dibawah ini digunakan untuk menampilkan list komentar artikel
	*/

	function komentar()
	{
		$data['komen'] = $this->admin_model->datakomentar();
      	$this->template->load('adminweb/media','adminweb/mod_komentar/komentar',$data);
	}

	/*
	* Fungsi dibawah ini digunakan untuk menampilkan data pesan masuk pada tabel hubungi
	*/

	function hubungi()
	{
		$data['message'] = $this->admin_model->datahubungi();
      	$this->template->load('adminweb/media','adminweb/mod_hubungi/hubungi',$data);
	}


	/*
	*
	* Fungsi dibawah ini digunakan untuk menampilkan data menu utama website
	*/

	function mainmenu()
	{
		$data['menus'] = $this->admin_model->Menuutama();
		$this->template->load('adminweb/media','adminweb/mod_mainmenu/menuutama',$data);
	} /* Penutup fungsi untuk menampilkan menu */


	/*
	**	Fungsi menampilkan submenu website
	*/

	function submenu()
	{
		$data['menusubs'] = $this->admin_model->menusub();
		$this->template->load('adminweb/media','adminweb/mod_submenu/submenu',$data);
	} /* Penutup submenu */





	/*
	* Menu Halaman statis
	*/
	function halaman()
	{
		$data['statis'] = $this->admin_model->halamanstatis();
    	$this->template->load('adminweb/media','adminweb/mod_halaman/halaman',$data);
	}


	/* 
	* Menu Pengguna atau data user 
	*/

	function user()
	{
		    $data['author'] = $this->admin_model->dataadmin();
        	$this->template->load('adminweb/media','adminweb/mod_user/user',$data);
	}

	/*
	*	Menu Pengaturan Website digunakan untuk merubah deskripsi, judul, logo
	*/

	function pengaturan()
	{
        $data['seting']=$this->admin_model->ambilidentitas();
        $this->template->load('adminweb/media','adminweb/mod_identitas/identitas',$data);

    }

	/*
	* Fungsi dibawah ini digunakan untuk menampilkan form tambah artikel baru (hanya form).
	* Pada baris 84 terdapat variabel 'categories' yang berfungsi untuk mengambil data kategori untuk ditampilkan pada combobox
	* Sama halnya pada baris 85 untuk mengambil data tag artikel 
	*/

	function tambahartikel()
	{
		$data=array(
       				'categories'  => $this->admin_model->datakategori(), 
       				'tagnews'	  => $this->admin_model->tag()
       				);
       	$this->template->load('adminweb/media','adminweb/mod_artikel/tambah_artikel',$data);
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
       			redirect(''.base_url().'admin/artikel');
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
        		redirect(''.base_url().'admin/artikel/');
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
		        	$this->admin_model->simpandata('berita',$data);
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
					redirect(''.base_url().'admin/artikel/');
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
       				$this->admin_model->simpandata('berita',$data);
		       			$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              			<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                		<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Disimpan !<br />
           			 	</div>");
					redirect(''.base_url().'admin/artikel/');
        }


	} /* Penutup fungsi simpan artikel */


	/*
	* Fungsi dibawah digunakan untuk mengedit artikel (Fungsi ini hanya untuk menampilkan datanya pada form).
	*/

	function editartikel($id=0)
	{
		$result = $this->admin_model->Get_data_byid('berita WHERE id_berita="'.$id.'"')->result_array();
		$data=array(
					'id_berita'		=> $result[0]['id_berita'],
					'kategori' 		=> $this->admin_model->datakategori(),
					'id_kategori'	=> $result[0]['id_kategori'],
					'username' 		=> $result[0]['username'],
					'judul' 		=> $result[0]['judul'],
					'judul_seo'		=> $result[0]['judul_seo'],
					'isi_berita'	=> $result[0]['isi_berita'],
					'tanggal' 		=> $result[0]['tanggal'],
					'jam'			=> $result[0]['jam'],
					'gambar'		=> $result[0]['gambar'],
					'katakunci' 	=> $this->admin_model->katakunci(),
					'tag' 			=> $result[0]['tag']
					);
		$this->template->load('adminweb/media','adminweb/mod_artikel/edit_artikel',$data);
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
       			$hasil = $this->admin_model->ambilGambar("where id_berita ='".$this->db->escape_str($this->input->post('id_berita', TRUE))."'")->result();
       			foreach ($hasil as $g )
       				{
	 					@unlink('./public/upload/gambar_artikel/'.$g->gambar);
	        			@unlink('./public/upload/gambar_artikel/medium/'.$g->gambar);
	        			@unlink('./public/upload/gambar_artikel/thumb/'.$g->gambar);
 					}
	 				// mulai proses update data artikel berdasarkan id yang diambil
	 				$this->admin_model->updateData('berita',$data,array('id_berita' => $this->db->escape_str($this->input->post('id_berita'))));
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
					redirect(''.base_url().'admin/artikel/');
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
       	 		$this->admin_model->updateData('berita',$data,array('id_berita' => $this->input->post('id_berita', TRUE)));
      	 		$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Disimpan !<br />
            		</div>");
				redirect(''.base_url().'admin/artikel/');
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
		$gbr = $this->admin_model->ambilGambar("where id_berita ='$id'")->result();
 		foreach($gbr as $g)
 				{
 				/* Hapus gambar thumbnail lama dengan fungsi unlink */
 				@unlink('./public/upload/gambar_artikel/'.$g->gambar);
        		@unlink('./public/upload/gambar_artikel/medium/'.$g->gambar);
        		@unlink('./public/upload/gambar_artikel/thumb/'.$g->gambar);
 				}

 		/* Mulai proses menghapus artikel dari tabel */
 		$query = $this->admin_model->hapusData('berita',array('id_berita' => $id));
 		if($query)
 		{
        	$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Di Hapus !<br />
            	</div>");
			redirect(''.base_url().'admin/artikel');
		}
			else
			{
				$this->session->set_flashdata("k", "<div class='alert alert-block alert-danger'>
              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Di Hapus !<br />
            		</div>");
				redirect(''.base_url().'admin/artikel');
			}
	} /* penutup fungsi hapus artikel selesai */


	/*
	*
	* Fungsi Menampilkan form untuk menambah tag artikel
	*
	*/

	function tambahtag()
	{
		$this->template->load('adminweb/media','adminweb/mod_tag/tambah_tag');
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
		       	redirect(''.base_url().'admin/tag');
		    }
		    /* Jika validasi berjalan sesuai permintaan maka: */
		    else
		    {
		    	/* Jalankan proses penyimpanan data tag */
		    	$this->admin_model->simpandata('tag',$data);
		    	$this->session->set_flashdata("t", "<div class='alert alert-block alert-success'>
              			<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                		<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Disimpan!<br />
            			</div>");
				redirect(''.base_url().'admin/tag');
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
		   $r = $this->admin_model->Get_data_byid('tag WHERE id_tag="'.$id.'"')->result_array();
       	$data = array(
       				'id_tag' 	=> $r[0]['id_tag'],
       				'nama_tag'	=> $r[0]['nama_tag']
       				);
       	$this->template->load('adminweb/media','adminweb/mod_tag/edit_tag',$data);
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
		$query = $this->admin_model->updateData('tag',$data,array('id_tag'=>$this->input->post('id_tag', TRUE)));
		if($query)
		{
			$this->session->set_flashdata("t", "<div class='alert alert-block alert-success'>
              							 <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                						 <strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Perubahan Berhasil Disimpan.<br />
            							 </div>");
			redirect(''.base_url().'admin/tag');
		}
		else
		{
			$this->session->set_flashdata("t", "<div class='alert alert-block alert-danger'>
              							 <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                						 <strong><i class='ace-icon fa fa-check'></i> Gagal !</strong> Tidak Bisa Menyimpan Perubahan.<br />
            							 </div>");
			redirect(''.base_url().'admin/tag');
		}
	} /* penutup fungsi aksi edit tag artikel */


	/*
	*
	* Fungsi dibawah digunakan untuk menghapus tag artike
	*
	*/
	function hapustag($id)
	{
		$result = $this->admin_model->hapusData('tag',array('id_tag'=>validasi($id)));
       	if($result)
       		{
       			$this->session->set_flashdata("t", "<div class='alert alert-block alert-success'>
             		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Dihapus!<br />
            		</div>");
				redirect(''.base_url().'admini/tag');

       		}
       			else
       			{

       			$this->session->set_flashdata("t", "<div class='alert alert-danger'>
				              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
				               Gagal menghapus data !
				            	</div>");
				redirect(''.base_url().'admin/tag');

       			}
	} /* Penutup fungsi hapus tag artikel */

	

	/*
	*	Fungsi Tambah kategori artikel
	*/

	function tambahkategori()
	{
		$this->template->load('adminweb/media','adminweb/mod_kategori/tambah_kategori');
	} /* Penutup tambah kategori */


	/*
	*	Fungsi untuk menyimpan kategori baru	
	*/

	function simpankategori()
	{
			$this->form_validation->set_rules('nama_kategori','nama kategori','trim|required|xss_clean|is_unique[kategori.nama_kategori]');
			if ($this->form_validation->run() == FALSE) 
			{
				$this->session->set_flashdata("k", "<div class='alert alert-danger'>
						              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
						                <strong><i class='ace-icon fa fa-times'></i> Gagal Menyimpan data</strong><br> Pastikan nama kategori belum digunakan, dan harus diisi
						            </div>");
				redirect(''.base_url().'admin/kategori/');
			
			}
			else
			{
				$data=array(
						'nama_kategori'	=> cetak($this->input->post('nama_kategori', TRUE)),
						'kategori_seo'	=> seo_title($this->input->post('nama_kategori'))
        				);
				$this->admin_model->simpandata('kategori',$data);
				$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Disimpan!<br />
            		</div>");
				redirect(''.base_url().'admin/kategori/');
			}
	} /* Penutup fungsi simpan kategori */


	/*
	*	Fungsi mengambil data kategori berdasarkan ID untuk di rubah
	*/

	function editkategori($id=0)
	{
		    $r = $this->admin_model->Get_data_byid("kategori where id_kategori = '".$id."'")->result_array();
      		$data = array(
      				'id_kategori'	=> $r[0]['id_kategori'],
      				'nama_kategori'	=> $r[0]['nama_kategori']
        				);
        	$this->template->load('adminweb/media','adminweb/mod_kategori/edit_kategori',$data);
	} /* Penutup fungsi edit kategori */


	/*
	*	Dibawah ini adalah fungsi atau aksi untuk mengedit kategori
	*/

	function aksi_editkategori()
	{
			$data=array(
        				'id_kategori'	=> validasi($this->input->post('id_kategori', TRUE)),
        				'nama_kategori'	=> cetak(trim($this->input->post('nama_kategori', TRUE))),
        				'kategori_seo'	=> seo_title($this->input->post('nama_kategori'))
        				);
        	// mulai proses penyimpanan update data dengan model update data
        	$query = $this->admin_model->updateData('kategori',$data,array('id_kategori'=>$this->input->post('id_kategori', TRUE)));
        	if($query)
        	{
        		$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              								<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                							<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Perubahan Berhasil disimpan!<br />
            								</div>");
				redirect(''.base_url().'admin/kategori/');
        	}
        	else
        	{
        		$this->session->set_flashdata("k", "<div class='alert alert-block alert-danger'>
              								<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                							<strong><i class='ace-icon fa fa-check'></i> Gagal !</strong> Perubahan Gagal Di simpan!<br />
            								</div>");
				redirect(''.base_url().'admin/kategori/');
        	}
	} /* Penutup aksi edit kategori */



	/* 
	* 	Fungsi hapus kategori artikel
	*/

	function hapuskategori($id)
	{
		$result = $this->admin_model->hapusData('kategori',array('id_kategori'=>validasi($id)));
		if($result)
		{
				$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
             		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Dihapus!<br />
            		</div>");
				redirect(''.base_url().'admin/kategori/');
		}
		else
		{
				$this->session->set_flashdata("k", "<div class='alert alert-block alert-danger'>
             		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Gagal !</strong> Tidak bisa menghapus data.<br />
            		</div>");
				redirect(''.base_url().'admin/kategori/');
		}
	} /* Penutup fungsi hapus kategori */


	/* 
	**	Fungsi Tambah mainmenu / menuutama website
	*/


	function tambahmenu()
	{
		$this->template->load('adminweb/media','adminweb/mod_mainmenu/tambah_menuutama');
	} /* Penutup tambah mainmenu/menuutama website */


	function simpanmenu()
	{
			$this->form_validation->set_rules('nama_menu','nama menu','trim|required|is_unique[mainmenu.nama_menu]');
			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata("k", "<div class='alert alert-danger'>
	              	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
	                <strong><i class='ace-icon fa fa-times'></i> Gagal !</strong> Pastikan nama menu sudah diisi dan belum digunakan.<br />
	            	</div>");
	       		redirect(''.base_url().'admin/mainmenu');
			}
			else
			{
				$data=array(
						'nama_menu' => $this->db->escape_str($this->input->post('nama_menu', TRUE)),
						'link' 		=> $this->db->escape_str(trim($this->input->post('link',TRUE))),
						'aktif'		=> $this->db->escape_str($this->input->post('aktif',TRUE))
						);
				$query = $this->admin_model->simpandata('mainmenu',$data);
				if($query)
				{
					$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              			<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                		<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Disimpan.<br />
            			</div>");
					redirect(''.base_url().'admin/mainmenu');
				}
				else
				{
					$this->session->set_flashdata("k", "<div class='alert alert-block alert-danger'>
              			<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                		<strong><i class='ace-icon fa fa-check'></i> Gagal !</strong> Gagal Menambah Data.<br />
            			</div>");
					redirect(''.base_url().'admin/mainmenu');
				}
			}
	} /* Penutup menyimpan menu utama website */




	/*
	**	Fungsi Edit data menuutama website
	*/

	function editmenu($id=0)
	{
		$ketemu = $this->admin_model->Get_data_byid('mainmenu WHERE id_main="'.$id.'"')->result_array();
		$data = array(

						'id_main'	=> $ketemu[0]['id_main'],
						'nama_menu'	=> $ketemu[0]['nama_menu'],
						'link' 		=> $ketemu[0]['link'],
						'aktif' 	=> $ketemu[0]['aktif']
					);
		$this->template->load('adminweb/media','adminweb/mod_mainmenu/edit_menuutama',$data);
	} /* Penutup fungsi edit menu */


	/*
	**	Fungsi dibawah merupakan fungsi aksi dari fungsi diatas. 
	*/

	function aksi_editmenu()
	{
		$data = array(
				'id_main'   => $this->db->escape_str($this->input->post('id_main',TRUE)),
				'nama_menu' => $this->db->escape_str(trim($this->input->post('nama_menu',TRUE))),
				'link' 		=> $this->db->escape_str(trim($this->input->post('link',TRUE))),
				'aktif'		=> $this->db->escape_str($this->input->post('aktif',TRUE))
				);
		$query = $this->admin_model->updateData('mainmenu',$data,array('id_main'=>$this->db->escape_str($this->input->post('id_main', TRUE))));
		if($query)
		{
			$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Perubahan Berhasil Disimpan!<br />
           		 	</div>");
			redirect(''.base_url().'admin/mainmenu');
		}
		else
		{
			$this->session->set_flashdata("k", "<div class='alert alert-block alert-danger'>
              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Gagal !</strong> Tidak bisa menyimpan perubahan.<br />
           		 	</div>");
			redirect(''.base_url().'admin/mainmenu');
		}
	} /* Penutup aksi edit menuutama website */



	/*
	**	Fungsi hapus menuutama website.
	*/


	function hapusmain($id)
	{
		$result = $this->admin_model->hapusData('mainmenu',array('id_main'=>validasi($id)));
		if($result)
		{
			$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
             	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Dihapus!<br />
            	</div>");
			redirect(''.base_url().'admin/mainmenu');
		}
		else
		{
			$this->session->set_flashdata("k", "<div class='alert alert-block alert-danger'>
             	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong><i class='ace-icon fa fa-check'></i> Gagal !</strong> Tidak bisa menghapus data.<br />
            	</div>");
			redirect(''.base_url().'admin/mainmenu');
		}
	} /* Penutup fungsi hapus menuutama */


	/*
	**	Fungsi tambah submenu
	*/

	function tambahsubmenu()
	{
		$data = array(
					'menuutama'	=> $this->admin_model->mainmenuaktif()->result_array()
					 );
		$this->template->load('adminweb/media','adminweb/mod_submenu/tambah_submenu',$data);
	} /* Penutup tambah submenu */



	/*
	**	Fungsi dibawah ini digunakan untuk menyimpan submenu baru
	*/


	function simpansubmenu()
	{
				$this->form_validation->set_rules('nama_sub','nama sub','trim|is_unique[submenu.nama_sub]');
				if($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata("k", "<div class='alert alert-danger'>
		              	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
		                <strong><i class='ace-icon fa fa-times'></i> Gagal !</strong> Pastikan nama submenu sudah diisi dan belum digunakan.<br />
		            	</div>");
		       		redirect(''.base_url().'admin/submenu');
				}
				else
				{
					$data=array(
							'id_main'	=> $this->db->escape_str(trim($this->input->post('id_main',TRUE))),
							'nama_sub'	=> $this->db->escape_str(trim($this->input->post('nama_sub',TRUE))),
							'link_sub'	=> $this->db->escape_str(trim($this->input->post('link_sub',TRUE)))
        					);
					$query = $this->admin_model->simpandata('submenu',$data);
					if($query)
					{
						$this->session->set_flashdata("k", "<div class='alert alert-success'>
		              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
		                	<strong><i class='ace-icon fa fa-times'></i> Berhasil !</strong> Data Berhasil disimpan.<br />
		            		</div>");
		       			redirect(''.base_url().'admin/submenu');
					}
					else
					{
						$this->session->set_flashdata("k", "<div class='alert alert-danger'>
		              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
		                	<strong><i class='ace-icon fa fa-times'></i> Gagal !</strong> Gagal menyimpan data.<br />
		            		</div>");
		       			redirect(''.base_url().'admin/submenu');
					}
					
				}
	} /* penutup simpan submenu */



	/* 
	**	Fungsi dibawah digunakan untuk mengambil data submenu yang akan diedit berdasarkan ID yang diambil
	*/

	function editsubmenu($id=0)
	{

		$result = $this->admin_model->Get_data_byid('submenu WHERE id_sub="'.$this->db->escape_str($id).'"')->result_array();
		$data=array(
					'id_sub'		=> $result[0]['id_sub'],
					'id_main' 		=> $result[0]['id_main'],
					'nama_sub'		=> $result[0]['nama_sub'],
					'link_sub'		=> $result[0]['link_sub'],
					'utama'			=> $this->admin_model->mainmenuaktif()->result_array()

					);
		$this->template->load('adminweb/media','adminweb/mod_submenu/edit_submenu',$data);
	} /* Penutup edit submenu selesai */



	/*
	**	Dibawah ini fungsi aksi edit submenu
	*/


	function aksi_editsubmenu()
	{
		$data = array(
       			'id_sub' 	=> $this->db->escape_str(trim($this->input->post('id_sub', TRUE))),
       			'id_main' 	=> $this->db->escape_str(trim($this->input->post('id_main', TRUE))),
       			'nama_sub'	=> $this->db->escape_str(trim($this->input->post('nama_sub', TRUE))),
       			'link_sub' 	=> $this->db->escape_str(trim($this->input->post('link_sub', TRUE)))
       				);
		$query = $this->admin_model->updateData('submenu',$data,array('id_sub'=>$this->input->post('id_sub', TRUE)));
		if($query)
		{
			$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              							 <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                						 <strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Perubahan Berhasil Disimpan.<br />
            							 </div>");
			redirect(''.base_url().'admin/submenu');
		}
		else
		{
			$this->session->set_flashdata("k", "<div class='alert alert-block alert-danger'>
              							 <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                						 <strong><i class='ace-icon fa fa-check'></i> Gagal !</strong> Tidak Bisa Menyimpan Perubahan.<br />
            							 </div>");
			redirect(''.base_url().'admin/submenu');
		}
	} /* Penutup aksi edit submenu */


	/*
	**	 Fungsi hapus submenu
	*/


	function hapussubmenu($id)
	{
		$result = $this->admin_model->hapusData('submenu',array('id_sub'=>validasi($id)));
		if($result)
		{
				$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
             		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Dihapus!<br />
            		</div>");
				redirect(''.base_url().'admin/submenu');
		}
		else
		{
				$this->session->set_flashdata("k", "<div class='alert alert-block alert-danger'>
             		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Gagal !</strong> Tidak bisa menghapus data.<br />
            		</div>");
				redirect(''.base_url().'admin/submenu');
		}
	} /* Penuutp hapus submenu selesai */




	/*
	**	Fungsi tambah halaman statis
	*/

	function tambahhalaman()
	{
		$this->template->load('adminweb/media','adminweb/mod_halaman/tambah_halaman');
	} /* Penutup tambah halaman selesai */


	/*
	**	Fungsi simpan halaman baru
	*/


	function simpanhalaman()
	{
			$data = array(
					'judul'			=> $this->db->escape_str(trim($this->db->escape_str($this->input->post('judul',TRUE)))),
					'judul_seo'		=> seo_title($this->input->post('judul')),
					'isi_halaman' 	=> stripslashes(htmlspecialchars($this->db->escape_str($this->input->post('isi_halaman', FALSE),ENT_QUOTES))),
					'tgl_posting' 	=> date('Y-m-d')
					);

			$query = $this->admin_model->simpanData('halamanstatis',$data);
			if($query)
			{
				$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Disimpan !<br />
            		</div>");
				redirect(''.base_url().'admin/halaman');
			}
			else
			{
				$this->session->set_flashdata("k", "<div class='alert alert-block alert-danger'>
              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Gagal !</strong> Tidak Bisa Menyimpan Data.<br />
            		</div>");
				redirect(''.base_url().'admin/halaman');
			}
	} /* Penutup fungsi simpan halaman */





	/*
	**	Fungsi dibawah digunakan untuk mengedit data halaman statis berdasarkan ID
	*/

	function edithalaman($id=0)
	{
		$hasil = $this->admin_model->Get_data_byid('halamanstatis WHERE id_halaman="'.$id.'"')->result_array();
		$data = array(
					'id_halaman' => $hasil[0]['id_halaman'],
					'judul'		 => $hasil[0]['judul'],
					'isi_halaman'=> $hasil[0]['isi_halaman']
					);
		$this->template->load('adminweb/media','adminweb/mod_halaman/edit_halaman',$data);
	} /* Penutup fungsi edit halaman selesai */





	/*
	**	Dibawah ini adalah aksi untuk update/edit halaman
	*/

	function aksi_edithalaman()
	{
			$data = array(
					'id_halaman' 	=> $this->db->escape_str($this->input->post('id_halaman',TRUE)),
					'judul' 	 	=> trim($this->db->escape_str($this->input->post('judul',TRUE))),
					'judul_seo'	 	=> seo_title($this->input->post('judul')),
					'isi_halaman'	=> stripslashes(htmlspecialchars($this->db->escape_str($this->input->post('isi_halaman',FALSE),ENT_QUOTES))),
					'tgl_posting' 	=> date('Y-m-d')
					);
			$hasil = $this->admin_model->updateData('halamanstatis',$data,array('id_halaman'=>$this->db->escape_str($this->input->post('id_halaman', TRUE))));
			if($hasil)
			{
				$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
		              	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
		                <strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Perubahan Berhasil Disimpan!<br />
		           		 </div>");
				redirect(''.base_url().'admin/halaman');
			}
			else
			{
				$this->session->set_flashdata("k", "<div class='alert alert-block alert-danger'>
		              	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
		                <strong><i class='ace-icon fa fa-check'></i> Gagal !</strong> Tidak bisa menghapus data.<br />
		           		 </div>");
				redirect(''.base_url().'admin/halaman');
			}
	} /* Aksi edit halaman selesai */



	/*
	** Dibawah ini adalah Fungsi menghapus halaman berdasarkan ID yang di ambil
	*/

	function hapushalaman($id)
	{
			$result = $this->admin_model->hapusData('halamanstatis',array('id_halaman'=>validasi($id)));
        	if($result)
        	{
        		$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
             		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Dihapus!<br />
            		</div>");
				redirect(''.base_url().'admin/halaman');
			}
			else
			{
				$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
             		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Dihapus!<br />
            		</div>");
				redirect(''.base_url().'admin/halaman');
			}
	} /* Hapus halaman selesai */




	/*
	** Fungsi dibawah ini digunakan untuk menampilkan detail komentar dan form membalas komentar.
	*/

	function balaskomentar($id=0)
	{
		 	$r = $this->admin_model->editkomen($id)->result_array();
          	$data = array(
              	'id_komentar' 	=> $r[0]['id_komentar'],
              	'isi_komentar' 	=> $r[0]['isi_komentar'],
              	'email'       	=> $r[0]['email'],
              	'id_berita'   	=> $r[0]['id_berita'],
              	'nama'        	=> $r[0]['nama'],
              	'judul' 		=>$r[0]['judul']
                );
          $this->template->load('adminweb/media','adminweb/mod_komentar/balas_komentar',$data);

	} /* Fungsi balas komentar selesai */



	/* 
	** Fungsi dibawah ini digunakan untuk mengirim balasan komentar, sekaligus mengirim ke email komentar.
	*/
	function adminbalaskomen()
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
	        $mail->AddReplyTo("admin@ruangpojok.net","No Replay");  //email address that receives the response
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
    			redirect(''.base_url().'admin/komentar');
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
        		$res = $this->admin_model->simpandata('komentar',$data);
        		$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Komentar Berhasil dibalas dan di kirim ke email!<br />
            		</div>");
        		redirect(''.base_url().'admin/komentar/');
	        }
	} /* fungsi mengirim balasan selesai */



	/*
	**	 Fungsi dibawah ini merupakan fungsi untuk approve komentar masuk
	**	 Jika komentar di approve maka komentar akan ditampilkan
	*/

	function approve($id)
	{
		$result = $this->admin_model->komenaprove($id);
        if($result)
        {
        	$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
                <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Komentar Di Publish!<br />
                </div>");
        	redirect(''.base_url().'admin/komentar/');
    	}
    	else
    	{
    		$this->session->set_flashdata("k", "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                    Terjadi kesalahan saat merubah status komentar
                    </div>");
        	redirect(''.base_url().'admin/komentar/');
    	}
	} /* Fungsi approve komentar selesai */



	/*
	** Fungsi dibawah ini merupakan fungsi untuk unapprove komentar
	** Jika komentar di unapprove maka komentar tidak akan di publikasikan.
	*/

	function unapprove($id)
	{
			$result = $this->admin_model->komenunaprove($id);
          	if($result)
          	{
          		$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
                	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                  	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Komentar Telah di Unapprove!<br />
                	</div>");
        		redirect(''.base_url().'admin/komentar/');
          	}
          	else
          	{
          		$this->session->set_flashdata("k", "<div class='alert alert-danger'>
                      	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                      	Terjadi kesalahan saat merubah status komentar
                    	</div>");
        		redirect(''.base_url().'admin/komentar/');
          	}
	} /* Fungsi unapprove komentar selesai */


	/*
	**	Fungsi dibawah digunakan untuk menghapus komentar.
	*/

	function hapuskomen($id)
	{
			$result = $this->admin_model->hapusData('komentar',array('id_komentar'=>validasi($id)));
          	if($result)
          	{
          		$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
                	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                  	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Dihapus!<br />
                	</div>");
        		redirect(''.base_url().'admin/komentar/');
          	}
          	else
          	{
          		$this->session->set_flashdata("k", "<div class='alert alert-danger'>
                      	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                      	Gagal menghapus data.
                    	</div>");
        		redirect(''.base_url().'admin/komentar/');
          	}
	} /* Fungsi hapus komentar selesai */



	/*
	**	Fungsi dibawah ini digunakan untuk menampilkan form tambah user.
	*/

	function tambahuser()
	{
		$this->template->load('adminweb/media','adminweb/mod_user/tambah_user');
	} /* Fungsi tambah user selesai*/



	/*
	**	Fungsi dibawah ini digunakan untuk menyimpan user baru.
	*/

	function simpanuser()
	{
			/* Mulai lakukan validasi input */
			//$this->form_validation->set_rules('nama_users','nama user','trim|required');
       		$this->form_validation->set_rules('email','email','trim|required|valid_email|is_unique[users.email]');
       		$this->form_validation->set_rules('username','username','trim|required|is_unique[users.username]');
       		//$this->form_validation->set_rules('password', 'password', 'trim|required');

       		if($this->form_validation->run() == FALSE)
       		{
       			$this->session->set_flashdata("k", "<div class='alert alert-danger'>
              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-times'></i> Gagal !</strong>Pastikan data sudah diisi dengan benar, username & email belum digunakan.<br />
            		</div>");
       		redirect(''.base_url().'admin/user');
       		}
       		else
       		{
       			$password 			= trim($this->input->post('password'));
       			$pengacak 			="gagasPower!@#$%^&#$@$%^&5$#JHIY*kjkjbkjhi"; // pengacak terserah kpd sang programmer
				$password_enkripsi 	=sha1($pengacak.md5($password)).md5($pengacak).crc32($password); 
       			$data=array(
       				'nama_users' => $this->db->escape_str(trim($this->input->post('nama_users', TRUE))),
       				'email' 	 => $this->db->escape_str(trim($this->input->post('email', TRUE))),
       				'level'		 => $this->input->post('level',TRUE),
       				'blokir'	 => $this->input->post('blokir',TRUE),
       				'username' 	 => $this->db->escape_str(trim($this->input->post('username', TRUE))),
       				'password'	 => $password_enkripsi
       				);
       			$result = $this->admin_model->simpandata('users',$data);
       			if($result)
       			{
	        		$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
	              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
	                	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Disimpan !<br />
	            		</div>");
					redirect(''.base_url().'admin/user');
				}
				else
				{
					$this->session->set_flashdata("k", "<div class='alert alert-block alert-danger'>
	              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
	                	<strong><i class='ace-icon fa fa-check'></i> Gagal !</strong> Tidak bisa menyimpan data.<br />
	            		</div>");
					redirect(''.base_url().'admin/user');
				}
       		}

	} /* Fungsi simpan user baru selesai */



	/*
	**	Fungsi dibawah digunakan untuk merubah aku pengguna atau user.
	*/

	function edituser($id=0)
	{
			$hasil = $this->admin_model->Get_data_byid('users WHERE id_users="'.$id.'"')->result_array();
        	$data=array(
        				'id_users'  => $hasil[0]['id_users'],
        				'nama_users'=> $hasil[0]['nama_users'],
        				'email' 	=> $hasil[0]['email'],
                        'level'   	=> $hasil[0]['level'],
        				'blokir'	=> $hasil[0]['blokir'],
        				'username'	=> $hasil[0]['username']
        			);
        	$this->template->load('adminweb/media','adminweb/mod_user/edit_user',$data);
	} /* Fungsi mengambil data edit user selesai */



	/*
	**	Fungsi dibawah digunakan untuk aksi merubah data user/pengguna.
	*/




	function aksi_edituser()
	{
			$data = array(
 					'id_users'	 => $this->db->escape_str($this->input->post('id_users',TRUE)),
 					'nama_users' => $this->db->escape_str(trim($this->input->post('nama_users',TRUE))),
       				'email' 	 => $this->db->escape_str(trim($this->input->post('email',TRUE))),
                    'level'    	 => $this->input->post('level',TRUE),
       				'blokir'	 => $this->input->post('blokir',TRUE)
       				);
 			$result = $this->admin_model->updateData('users',$data,array('id_users' => $this->input->post('id_users')));
 			if($result)
 			{
 				$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Perubahan telah disimpan.<br />
            		</div>");
			   redirect(''.base_url().'admin/user');
 			}
 			else
 			{
 				$this->session->set_flashdata("k", "<div class='alert alert-block alert-danger'>
	              		<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
	                	<strong><i class='ace-icon fa fa-check'></i> Gagal !</strong> Tidak bisa menyimpan perubahan.<br />
	            		</div>");
				redirect(''.base_url().'admin/user');
 			}
	} /* fungsi edit user selesai */



	function hapususer($id)
	{
		$result = $this->admin_model->hapusData('users',array('id_users' => $id));
    	if($result)
    	{
        	$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Di Hapus !<br />
            	</div>");
			redirect(''.base_url().'admin/user');
		}
		else
		{
      		$this->session->set_flashdata("k", "<div class='alert alert-danger'>
              	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong><i class='ace-icon fa fa-times'></i> Gagal !</strong> Terjadi kesalahan saat menghapus data.<br />
            	</div>");
      		redirect(''.base_url().'admin/user');
    	}
	} /* fungsi hapus user selesai */



	/*
	**	Fungsi dibawah ini digunakan untuk melihat detail dan membuat pesan balasan hubungi.
	*/


	function balashubungi($id=0)
	{
			$r = $this->admin_model->Get_data_byid("hubungi where id_hubungi = '".$id."'")->result_array();
          	$data = array(
              	'id_hubungi'	=> $r[0]['id_hubungi'],
              	'nama'			=> $r[0]['nama'],
              	'email'			=> $r[0]['email'],
              	'subjek'		=> $r[0]['subjek'],
              	'pesan'			=> $r[0]['pesan']
                	);
          $this->template->load('adminweb/media','adminweb/mod_hubungi/balas_hubungi',$data);
	} /* fungsi melihat detail pesan dan membuat pesan balasan selesai */




	/*
	**	Fungsi dibawah ini digunakan untuk mengirim balasan ke email setiap pesan.
	*/

	function kirim_email()
	{
			require_once(APPPATH.'libraries/PHPMailerAutoload.php');
	        $pesan = $this->input->post('pesan');
	        $emailpenerima = $this->input->post('email');
	        $subjek = $this->input->post('subjek');
	        $id = $this->input->post('id_hubungi');
	        $mail = new PHPMailer();
			$mail->SMTPDebug =0;
	        $mail->isSMTP();
	        $mail->Host = 'smtp.gmail.com';
	        $mail->SMTPAuth = true;
	        $mail->Username = 'pahlitamanata@gmail.com';
	        $mail->Password = 'uoto2305';
	        $mail->SMTPSecure = 'tls';
	        $mail->Port =587;           // password in GMail
	        $mail->SetFrom('gagas.power92@gmail.com', 'Gagas Ruangpojok');  //Who is sending the email
	        $mail->AddReplyTo("admin@ruangpojok.net","No Replay");  //email address that receives the response
	        $mail->Subject    = $subjek;
	        $mail->Body       = $pesan;
	        $mail->AltBody    = $pesan;
	        $mail->AddAddress($this->input->post('email'), $this->input->post('nama'));
         
         	if(!$mail->send())
         	{
         		$this->session->set_flashdata("h", "<div class='alert alert-block alert-danger'>
                	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                  	<strong><i class='ace-icon fa fa-check'></i> Gagal!</strong>Gagal Mengirim Email.<br />
                	</div>");
        		redirect(''.base_url().'admin/hubungi');
        	}
        	else
        	{
        		$this->admin_model->updatemailstatus($id); /* fungsi ini digunakan untuk mengupdate status pesan atau menandai pesan sudah dibaca */
                $this->session->set_flashdata("h", "<div class='alert alert-block alert-success'>
                	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                  	<strong><i class='ace-icon fa fa-check'></i> Berhasil!</strong>Email berhasil dikirim ke <strong>$emailpenerima</strong>.
                	</div>");
          		redirect(''.base_url().'admin/hubungi');
        	}
	} /* Fungsi mengirim email selesai */



	/*
	**	Fungsi dibawah ini digunakan untuk menghapus pesan.
	*/

	function hapuspesan($id)
	{
			$result = $this->admin_model->hapusData('hubungi',array('id_hubungi'=>validasi($id)));
          	if($result)
          	{
          		$this->session->set_flashdata("h", "<div class='alert alert-block alert-success'>
                	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                  	<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Data Berhasil Dihapus!<br />
                	</div>");
        	redirect(''.base_url().'admin/hubungi');
          	}
          	else
          	{
            	$this->session->set_flashdata("h", "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                    Gagal menghapus data.
                    </div>");
        		redirect(''.base_url().'admin/hubungi');
          	}
	} /* fungsi menghapus pesan hubungi selesai */




	/*
	**	Fungsi aksi pengaturan
	*/


	function aksi_editpengaturan()
	{
		 	$namafile = "logo_".time(); //nama file beri nama langsung dan diikuti fungsi time
        	$config['upload_path'] = './public/upload/'; //path folder
        	$config['allowed_types'] = 'gif|jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
        	$config['max_size'] = '3072'; //maksimum besar file 3M
        	$config['max_width']  = '5000'; //lebar maksimum 5000 px
        	$config['max_height']  = '5000'; //tinggi maksimu 5000 px
        	$config['file_name'] = $namafile; //nama yang terupload nantinya
        	$this->upload->initialize($config);

    		$this->upload->initialize($config);
    		if($_FILES['fupload']['name'])
    		{
    			if($this->upload->do_upload('fupload'))
    			{
    				$data = array
    						(
              				'id_identitas' 	=> $this->db->escape_str(trim($this->input->post('id_identitas', TRUE))),
              				'nama_website' 	=> $this->db->escape_str(trim($this->input->post('nama_website', TRUE))),
              				'alamat_website'=> $this->db->escape_str(trim($this->input->post('alamat_website', TRUE))),
              				'meta_deskripsi'=> $this->db->escape_str(trim($this->input->post('meta_deskripsi', TRUE))),
              				'meta_keyword' 	=> $this->db->escape_str(trim($this->input->post('meta_keyword', TRUE))),
              				'logo' 			=> $this->db->escape_str($this->upload->data('file_name', TRUE))
              				);

    				/* Mengambil data gambar logo lama untuk dihapus */
              		$hasil = $this->admin_model->ambilLogo("where id_identitas ='".$this->input->post('id_identitas')."'")->result();
            		foreach ($hasil as $g )
            		{
              			@unlink('./public/upload/'.$g->logo);
              			@unlink('./public/upload/logo_kecil/'.$g->logo);
              		}
              		/* mulai proses update data pengaturan */
              		$this->admin_model->updateData('identitas',$data,array('id_identitas' => $this->input->post('id_identitas')));

              		/* Disini adalah jika gambar dirubah */
              		$config2['image_library'] = 'gd2'; 
                	$config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                	$config2['new_image'] = './public/upload/logo_kecil/'; // folder tempat menyimpan hasil resize
                	//$config2['create_thumb'] = TRUE;
                	$config2['maintain_ratio'] = FALSE;
                	$config2['width'] = 225; //lebar setelah resize menjadi 100 px
                	$config2['height'] = 40; //lebar setelah resize menjadi 100 px
                	$this->load->library('image_lib',$config2); 
                	$this->image_lib->initialize($config2);
                	$this->image_lib->resize();

                	$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
                  								<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                								<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Pengaturan Berhasil di update !<br />
              									</div>");
      				redirect(''.base_url().'admin/pengaturan');
      			} /* Penutup if pertama */

    		} /* Penutup if kedua */
    		else
    		{
    			/* disini adalah jika gambar tidak dirubah */
    			$data=array(
              			'id_identitas' 	=> $this->db->escape_str(trim($this->input->post('id_identitas', TRUE))),
              			'nama_website' 	=> $this->db->escape_str(trim($this->input->post('nama_website', TRUE))),
              			'alamat_website'=> $this->db->escape_str(trim($this->input->post('alamat_website', TRUE))),
              			'meta_deskripsi'=> $this->db->escape_str(trim($this->input->post('meta_deskripsi', TRUE))),
              			'meta_keyword' 	=> $this->db->escape_str(trim($this->input->post('meta_keyword', TRUE)))
              			);

    			$this->admin_model->updateData('identitas',$data,array('id_identitas' => $this->input->post('id_identitas')));
         		$this->session->set_flashdata("k", "<div class='alert alert-block alert-success'>
              								<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                							<strong><i class='ace-icon fa fa-check'></i> Berhasil !</strong> Pengaturan Berhasil di update !<br />
            								</div>");
    			redirect(''.base_url().'admin/pengaturan');
    		}	
	} /* aksi pengaturan selesai */



	/* 
	** Fungsi dibawah ini digunakan untuk merubah password sesuai session username loginnya.
	** Ini hanya digunakan untuk menampilkan form saja.
	*/


	function gantipaswod()
	{
      	$data['uid']=$this->admin_model->ambilakun('where username="'.$this->session->userdata('username').'"');
      	$this->template->load('adminweb/media','adminweb/mod_password/password',$data);
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
          redirect(''.base_url().'admin/gantipaswod');

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
       		redirect(''.base_url().'admin/gantipaswod');
       		}
       	
       	else
       	{
       		$this->session->set_flashdata("k", "<div class='alert alert-block alert-danger'>
                              	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                              	<strong><i class='ace-icon fa fa-check'></i> Gagal !</strong> Tidak bisa menyimpan perubahan.<br />
                            	</div>");
       		redirect(''.base_url().'admin/gantipaswod');
       	} 
       }
   	} /* Ganti aksi update/ganti password selesa */



    function editor()
    {
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
        $this->ckeditor->basePath = base_url().'public/assets/ckeditor/';
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = '730px';
        $this->ckeditor->config['height'] = '300px';   
        //configure ckfinder with ckeditor config
        $path = base_url().'public/assets/ckfinder/'; //path folder ckfinder
        $this->ckfinder->SetupCKEditor($this->ckeditor,$path); 

    }


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
	* Kurung kurawal dibawah adalah penutup class Admin_utama
	* Location: application/controller/Admin.php
	*/
}

