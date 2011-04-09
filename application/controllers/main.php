<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {	


	public function index()
	{			
		$data->time_class = $this->day_or_night(); //css classes day or night;
		$data->body_class = 'landing'; //css classes for the body
		$data->main_content = 'landing';
		$this->load->view('template/main_animated', $data);
	}
	
	public function store_email(){
		
		if($this->input->post('email')){			

			$u = new User();
			$u->email = $this->input->post('email');
			$u->save();
		
			if($u->id){
				$message = ':) Gracias, ya tenemos tu mail, apenas tengamos mas información te contamos.';
			}else{
				$message = ':( No pudimos guardar tu email, porfavor intenta de nuevo.';
			}
			
			if(is_ajax()){
				echo json_encode(array('message'=>$message));
			}else{
				$this->session->set_flashdata('message',$message);
				redirect('main');
			}
		}else{
			redirect('main');
		}
	}
	
	public function friends(){
		$data->time_class = $this->day_or_night(); //css classes day or night;
		$data->main_content = 'friends';
		$this->load->view('template/main', $data);
	}
	
	protected function day_or_night()
	{
		$current_time = date("G");
		// $current_time = 5;
		
		if ( $current_time == 18 || $current_time == 6)
		{
			$time = 'dusk';
		}
		else if ( $current_time < 7 || 18 < $current_time )
		{
			$time = 'night';
		}
		else
		{
			$time = 'day';
		}
		
		return $time;
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */