<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Facebook extends CI_Controller
{

	private $fb;
	public function __construct()
	{
		parent::__construct();
		$this->load->library('facebooksdk');
		$this->fb = $this->facebooksdk;
	}
	public function index()
	{
		$cb = "http://localhost/CIlogin/index.php/facebook/callback";
		$url = $this->fb->getLoginUrl($cb);
		echo "<a href='$url'>login with faceook</a>";
	}

	public function callback()
	{
		$act = $this->fb->getAccessToken();
		$data = $this->fb->getUserData($act);
		print_r($data);
	}
}
