<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		$this->load->view('index');
	}

	public function create()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules('first_name', 'first name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'last name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[8]|matches[confirm_password]');
		$this->form_validation->set_rules('confirm_password', 'confirm password', 'trim|required');

		$this->form_validation->set_message('is_unique', 'The user already exists.');

		if($this->form_validation->run() === false)
		{
			$this->session->set_flashdata('errors', validation_errors());
		}
		else
		{
			$new_user = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				);
			$this->User->add_user($new_user);

			$user = $this->User->get_last_entry();

			$user_info = array(
				'id' => $user['id'],
				'first_name' => $user['first_name'],
				'last_name' => $user['last_name'],
				'email' => $user['email'],
				'is_logged_in' => true
				);

			$this->session->set_userdata($user_info);

			$this->session->set_flashdata('success', 'You have successfully registered. You may now login.');
		}
		redirect('/');
	}

	public function login()
	{
		$password = md5($this->input->post('password'));
		$email = $this->input->post('email');
		$user = $this->User->get_user_by_email($email);

		if($user && $user['password'] == $password)
		{
			$user_info = array(
				'id' => $user['id'],
				'first_name' => $user['first_name'],
				'last_name' => $user['last_name'],
				'email' => $user['email'],
				'is_logged_in' => true
				);
			$this->session->set_userdata($user_info);

			redirect('/home');
		}
		else
		{
			if(!$user)
			{
				$this->session->set_flashdata('errors', 'That user does not exist.');
			}
			else if($user['password'] != $password)
			{
				$this->session->set_flashdata('errors', 'Email and password do not match.');
			}
			redirect('/');
		}
	}

	public function add_friend()
	{
		$user_id = $this->session->userdata('id');
		$friend_id = $this->input->post('friend_id');
		$this->User->add_friend($user_id, $friend_id);
		$this->User->add_friend($friend_id, $user_id);
		redirect('/home');
	}

	public function home()
	{
		$user_id = $this->session->userdata('id');
		$non_friends = $this->User->non_friends($user_id);
		$friends = $this->User->friends($user_id);

		$this->load->view('home', array('friends' => $friends, 'non_friends' => $non_friends));
	}

	public function destroy()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */