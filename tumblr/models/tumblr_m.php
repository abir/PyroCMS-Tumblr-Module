<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tumblr_m extends MY_Model
{
    protected $username;

    function __construct()
    {
	parent::__construct();

	$this->load->library('settings');

	$this->username = $this->settings->item('tumblr_username');
    }

    function get_all($start=NULL,$num=NULL)
    {
	$url = 'http://'. $this->username .'.tumblr.com/api/read/json';

        if (isset($start) && isset($num))
        {
            $url .= "?start=$start&num=$num";
        }

        $result =  $this->_get_data($url);
	
	return (isset($result->posts)) ? $result->posts : array();
    }

    function count_all()
    {
        $url = 'http://'. $this->username .'.tumblr.com/api/read/json';

        $result = $this->_get_data($url);

	return (isset($result->posts_total)) ? $result->posts_total : 0;
    }
	
    function get($id)
    {
        $url = 'http://'. $this->username .'.tumblr.com/api/read/json?id='. $id;

        $result =  $this->_get_data($url);

	return $result->posts[0];
    }

    function _get_data($url)
    {
        if(function_exists("curl_version"))
        {
            $c = curl_init($url);
            curl_setopt($c,CURLOPT_RETURNTRANSFER,1);
	
            $return = curl_exec($c);

	    //clean up data
	    $return = str_replace('var tumblr_api_read = ','',$return);
	    $return = str_replace(';','',$return);
	    $return = str_replace('-','_',$return);

	    return json_decode($return);
        }
    }

}

?>
