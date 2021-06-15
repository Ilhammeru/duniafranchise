<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class About_us extends CI_Controller {

	private $sessionData;
	private $attribPage;
	private $attribThisPage;
	private $accessName = 'About Us';
	private $activityName = 'Visit';

	private $aboutUsImagePath = './images/about_us/';

	function __construct() {

		parent::__construct();

		$this->load->library(array(
								'throttle_lib'
							));

		$this->load->model(array(
								'about_us_model'
							));

		$this->sessionData = $this->session_lib->get_session();

		$this->attribPage = $this->web_config_lib->attrib_page();

		$this->attribThisPage = array(
									'sessionData' => $this->sessionData,
									'accessName' => $this->accessName,
									'titlePageRight' => $this->accessName,
									'titleMenu' => $this->accessName,
									'linkMenu' => '<li>
													<a href="' . site_url('about_us') . '" data-toggle="tooltip" data-placement="top" title="Visit to ' . $this->accessName . ' Menu">
														' . $this->accessName . '
													</a>
												</li>',
									'helpMode' => $this->sessionData['helpModeValue']
									);

	}
	// End of function __construct

	function view() {

		$accessName = 'View About Us';

		$this->session_lib->check_permission_with_redirect_page($accessName);

		$this->log_activity_lib->log($accessName, $this->activityName);

		$getAboutUs = $this->about_us_model->get_about_us();

		$addAttribPage = array(
								'subtitleMenu' => '<i class="fa fa-list-alt"></i> View',
								'sublinkMenu' => '<li class="active">
													<i class="fa fa-list-alt"></i> View
												</li>',
								'aboutUs' => $getAboutUs
							);

		$viewData = array_merge($this->attribPage, $this->attribThisPage, $addAttribPage);

		$this->template_lib->webadmin_default_template('webadmin/content/about_us/view', $viewData);

	}
	// End of function view

	function edit_about_us() {

		$accessName = 'Edit About Us';

		$this->session_lib->check_permission_with_redirect_page($accessName);

		$this->log_activity_lib->log($accessName, $this->activityName);

		$getAboutUs = $this->about_us_model->get_about_us();

		$addAttribPage = array(
							'subtitleMenu' => '<i class="fa fa-plus"></i> Edit About Us',
							'sublinkMenu' => '<li class="active">
												<i class="fa fa-plus"></i> Edit About Us
											</li>',
							'aboutUs' => $getAboutUs
						);

		$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

		$this->template_lib->webadmin_default_template('webadmin/content/about_us/edit', $viewData);

	}
	// End of function edit_about_us

	function image_upload($franchiseId = 0) {

		$config['upload_path'] = $this->aboutUsImagePath;
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = 0;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file')) {

			$this->output->set_header('HTTP/1.0 500 Server Error');
			exit;

		} else {

			$file = $this->upload->data();

			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode(['location' => base_url() . substr($this->aboutUsImagePath, 2) . '/' . $file['file_name']]))
				->_display();
			exit;

		}

	}
	// End of function image_upload

	function save_content() {

		$activityName = 'Edit';

		$accessName = 'Edit About Us';

		$postContent = $this->input->post('post_content');

		$imageUpload = $this->matching_image_upload($postContent);

		$data = array (
						'content' => $postContent,
						'updated_time' => date('Y-m-d H:i:s'),
						'updated_by' => $this->sessionData['userId']
					);

		$this->about_us_model->update_data($data);

		$this->log_activity_lib->log($accessName, $activityName);

		$this->web_config_lib->alert_successfully('saved');

		redirect('about_us');

	}
	// End of function save_content

	function matching_image_upload($postContent = '') {

		$dom = new DOMDocument();

		$dom->loadHTML($postContent);

		$element = $dom->getElementsByTagName('img');

		for ($i = 0; $i < count($element); $i++) {

			$value[] = str_replace(base_url() . substr($this->aboutUsImagePath, 2) . '/', '' , $element[$i]->getAttribute('src'));

		}

		// Get File in About Us Image Path
		$files = glob($this->aboutUsImagePath . '/*.{jpg,jpeg,png}', GLOB_BRACE);

		for ($i = 0; $i < count($files); $i++) :

			$x = str_replace($this->aboutUsImagePath . '/', '' , $files[$i]);

			if (! in_array($x, $value)){

				unlink($this->aboutUsImagePath . '/' . $x);

			}

		endfor;

		return $value;

	}
	// End of function matching_image_upload

}

/*
	End of class About_us
	End of file About_us.php
	Location: ./application/controllers/About_us.php
*/