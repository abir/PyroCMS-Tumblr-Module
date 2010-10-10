<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller
{	
	function __construct()
	{
		parent::Admin_Controller();

                $this->load->library('settings');
		$this->load->library('form_validation');
		$this->load->language('tumblr');
	}
	
	function index()
	{
            $this->form_validation->set_rules('tumblr_username', 'Username', 'trim|required');

            if ($this->form_validation->run() === TRUE)
            {
                $this->settings->set_item('tumblr_username', $this->input->post('tumblr_username'));
            }

            $this->data->username = $this->settings->item('tumblr_username');
		
            $this->template->build('admin/index', $this->data);
	}	
}
?>
