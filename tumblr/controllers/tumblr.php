<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tumblr extends Public_Controller
{	
	protected $limit = 5;

	function __construct()
	{
		parent::__construct();

		$this->load->model('tumblr_m');
		$this->lang->load('tumblr');
		$this->load->helper('text');
	}
	
	// posts/page/x also routes here
	function index()
	{	
		$this->data->pagination = create_pagination($this->uri->segment(1), $this->tumblr_m->count_all(), $this->limit, 2);

		$this->data->posts = $this->tumblr_m->get_all($this->uri->segment(2), $this->limit);

		//set module layout
		$this->template->set_module_layout('default');

                //display
		$this->template->build('index', $this->data);
	}
	
	
	// Public: View a post
	function view($id = NULL)
	{	
		if (!isset($id) || !$post = $this->tumblr_m->get($id))
		{
			redirect('tumblr');
		}
		
		$this->session->set_flashdata(array('referrer' => $this->uri->uri_string));	
		
		$this->data->post =& $post;

		$this->template->set_module_layout('default')
			       ->title($post->regular_title, $this->lang->line('tumblr_posts_title'))	
			       ->set_breadcrumb($this->lang->line('tumblr_posts_title'), 'tumblr')
			       ->set_breadcrumb($post->regular_title, 'tumblr/'.$post->id)
			       ->build('view', $this->data);
	}
}
?>
