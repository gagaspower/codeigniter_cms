<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hubungi extends CI_Controller {
   
    	public function index()
    	   {
    	      $vals = array(
                        'img_path'   => './captcha/',
                        'img_url'    => base_url().'captcha/',
                        'font_path' => './public/assets/font/Tahoma.ttf',
                        'font_size'     => 16,
                        'img_width'  => '100',
                        'img_height' => 30,
                        'border' => 0, 
                        'word_length'   => 5,
                        'expiration' => 7200
                );

                $cap = create_captcha($vals);
                $data['captcha'] = $cap['image'];
                $this->session->set_userdata('mycaptcha', $cap['word']);
        		$this->template->load('front/media','front/hubungi',$data);
    	   }


}
