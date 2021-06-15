<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Franchise extends CI_Controller {

	private $sessionData;
	private $attribPage;
	private $attribThisPage;
	private $accessName = 'Franchise';
	private $activityName = 'Visit';
	private $franchiseImagePath = './images/franchise/detail/';
	private $franchiseImagePath2 = './images/franchise/website/';
	private $thumbnailImagePath = './images/franchise/thumbnail/';
	private $videosPath = './images/franchise/videos/';

	function __construct() {

		parent::__construct();

		$this->load->model(array(
								'franchise_model'
							));

		$this->load->library(array(
								'throttle_lib'
							));

		$this->sessionData = $this->session_lib->get_session();

		$this->attribPage = $this->web_config_lib->attrib_page();

		$this->attribThisPage = array(
									'sessionData' => $this->sessionData,
									'accessName' => $this->accessName,
									'titlePageRight' => $this->accessName,
									'titleMenu' => $this->accessName,
									'linkMenu' => '<li>
													<a href="' . site_url('franchise') . '" data-toggle="tooltip" data-placement="top" title="Visit to ' . $this->accessName . ' Menu">
														' . $this->accessName . '
													</a>
												</li>',
									'helpMode' => $this->sessionData['helpModeValue']
									);

	}
	// End of function __construct

	function franchise_report() {

		$this->session_lib->check_permission_with_redirect_page($this->accessName);

		$this->log_activity_lib->log($this->accessName, $this->activityName);

		$addAttribPage = array(
								'subtitleMenu' => '<i class="fa fa-list-alt"></i> Report',
								'sublinkMenu' => '<li class="active">
													<i class="fa fa-list-alt"></i> Report
												</li>',
								'filterUser' => $this->web_config_lib->get_updated_by('franchise'),
								'filterStatus' => $this->web_config_lib->get_filter_status()
							);

		$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

		$this->template_lib->webadmin_default_template('webadmin/content/franchise/index.php', $viewData);

	}
	// End of function role_report

	function franchise_add_form() {

		$accessName = 'New Franchise';

		$this->session_lib->check_permission_with_redirect_page($accessName);

		$this->log_activity_lib->log($accessName, $this->activityName);

		$addAttribPage = array(
							'subtitleMenu' => '<i class="fa fa-plus"></i> New Franchise',
							'sublinkMenu' => '<li class="active">
												<i class="fa fa-plus"></i> New Franchise
											</li>'
						);

		$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

		$this->template_lib->webadmin_default_template('webadmin/content/franchise/add', $viewData);

	}
	// End of function franchise_add_form

	function image_upload($franchiseId = 0) {

		$config['upload_path'] = $this->franchiseImagePath . $franchiseId;
		$config['allowed_types'] = '*';
		$config['max_size'] = 0;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file')) {

			$this->output->set_header('HTTP/1.0 500 Server Error');
			exit;

		} else {

			$file = $this->upload->data();

			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_status_header(200)
				->set_output(json_encode(['location' => base_url() . substr($this->franchiseImagePath, 2) . $franchiseId . '/' . $file['file_name']]))
				->_display();
			exit;

		}

	}
	// End of function image_upload

	function image_upload_2($franchiseId = 0) {

		$config['upload_path'] = $this->franchiseImagePath2 . $franchiseId;
		$config['allowed_types'] = '*';
		$config['max_size'] = 0;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file')) {

			$this->output->set_header('HTTP/1.0 500 Server Error');
			exit;

		} else {

			$file = $this->upload->data();

			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_status_header(200)
				->set_output(json_encode(['location' => base_url() . substr($this->franchiseImagePath2, 2) . $franchiseId . '/' . $file['file_name']]))
				->_display();
			exit;

		}

	}
	// End of function image_upload_2

	function get_data_franchise() {

		$getDataFranchise = $this->franchise_model->get_franchise_using_server_side();

		$data = array();

		foreach ($getDataFranchise as $field):

			$row = array();

			if ($field->status == 1) {

				$status = '<label class="label label-success">Active</label>';

			} else {

				$status = '<label class="label label-danger">Not Active</label>';

			}

			$row[] = date_format(date_create($field->updated_time), 'd M Y H:i:s');

			$row[] = $field->franchise_name;

			$row[] = $field->hits;

			$row[] = $status;

			$row[] = $field->user_fullname;

			$row[] = $this->button_field($field->franchise_id);

			$data[] = $row;

		endforeach;

		$output = array(
						"draw" => $_POST['draw'],
            			"recordsTotal" => $this->franchise_model->count_all_data(),
            			"recordsFiltered" => $this->franchise_model->count_filtered(),
						"data" => $data
					);

		echo json_encode($output);

	}
	// End of function get_data_franchise

	function save_franchise() {

		$accessName = 'New Franchise';

		$activityName = 'Add';

		if ($this->session_lib->check_permission($accessName) == 1) {

			$franchiseName = $this->input->post('inputFranchiseName');

			$franchiseText = $this->input->post('inputFranchiseText');

			$countFranchiseByName = $this->franchise_model->count_by_name($franchiseName);

			if ($countFranchiseByName == 0){

				$slug =  preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(" ", "-", strtolower($franchiseName)));

				$franchiseData = array(
								'franchise_name' => $franchiseName,
								'slug' => $slug,
								'text' => $franchiseText,
								'status' => 1,
								'created_time' => date('Y-m-d H:i:s'),
								'creator' => $this->sessionData['userId'],
								'updated_time' => date('Y-m-d H:i:s'),
								'updated_by' => $this->sessionData['userId']
							);

				$franchiseId = $this->franchise_model->insert_data($franchiseData);

				$this->log_activity_lib->log($this->accessName, $activityName, $franchiseName);

				$status = 'success';

				$msg = $this->web_config_lib->alert_successfully_modal('saved');

				mkdir($this->franchiseImagePath . $franchiseId);
				mkdir($this->franchiseImagePath2 . $franchiseId);

			} else {

				$status = 'failed';

				$msg = $franchiseName . ' already exists.';

				$txtMsg = $this->web_config_lib->alert_error($msg, 'text');

				$franchiseId = 0;
					
			}

		} else {

			$status = 'failed';

			$msg = 'Your account does not have access to add franchise data.';

			$txtMsg = $this->web_config_lib->alert_error($msg, 'text');

			$franchiseId = 0;

		}

		$this->output->set_content_type('application/json')->set_output(json_encode(array(
	        																				'status' => $status,
	        																				'msg' => $msg,
	        																				'id' => $franchiseId
	        																			)
	    																			));

	}
	// End of function save_franchise

	function add_content($id = 0, $mode = 'add') {

		$accessName = 'Edit Franchise';

		$this->session_lib->check_permission_with_redirect_page($accessName);

		$this->log_activity_lib->log($accessName, $this->activityName);

		$franchise = $this->franchise_model->get_franchise_by_id($id, 
																'id, franchise_name, text, description, thumbnail, hits, hits_ayo, invesment, total_outlet, status, chat_script_df, chat_script_join, chat_script_ayo, chat_script_web, url_website, url_join, instagram, content_join, color');

		$addAttribPage = array(
							'subtitleMenu' 	=> $franchise['franchise_name'],
							'sublinkMenu' 	=> '<li class="active">
												' . $franchise['franchise_name'] . '
											</li>',
							'franchise' 	=> $franchise,
							'thumbnailUrl' 	=> base_url() . substr($this->thumbnailImagePath, 2) . $franchise['thumbnail'],
							'mode' 			=> $mode
						);

		$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);
		
		$this->load->view('webadmin/template/header-app', $viewData);
		// $this->load->view('webadmin/template/sidebar-app', $viewData);
		$this->load->view('webadmin/content/franchise/setting', $viewData);
		// $this->load->view('webadmin/content/franchise/add_content', $viewData);
		$this->load->view('webadmin/template/footer-app', $viewData);
	}
	// End of function add_content

	/**
	 * @param post => id
	 */
	public function get_phone() {

		$id = $this->input->post('id');

		$query = $this->db->query("SELECT id, title, phone
										FROM franchise_phone
										WHERE franchise_id = " . $id)->result();

		echo json_encode($query);
	}
	// End of function get_phone

	/**
	 * @param post => franchise_id
	 * @param post => phone
	 * @param post => title
	 */
	public function insert_phone() {

		$franchise_id = $this->input->post('franchise_id');
		$phone = $this->input->post('phone');
		$title = $this->input->post('title');

		$data = array(
						'franchise_id' => $franchise_id,
						'phone' => $phone,
						'title' => $title
		);

		$this->db->insert('franchise_phone', $data);
	}
	// End of function insert_phone

	/**
	 * @param post => id
	 * @param post => phone
	 * @param post => title
	 */
	public function update_phone() {

		$id = $this->input->post('id');
		$phone = $this->input->post('phone');
		$title = $this->input->post('title');

		$data = array(
						'phone' => $phone,
						'title' => $title
		);

		$this->db->where('id', $id);
		$this->db->update('franchise_phone', $data);
	}
	// End of function update_phone

	/**
	 * @param post => id
	 */
	public function delete_phone() {

		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$this->db->delete('franchise_phone');
	}
	// End of function delete_phone

	function save_content($id = 0) {

		$activityName = 'Edit';

		$accessName = 'Edit Franchise';

		$postContent = $this->input->post('post_content');

		$imageUpload = $this->matching_image_upload($id, $postContent);

		$data = array (
						'description' => $postContent,
						'updated_time' => date('Y-m-d H:i:s'),
						'updated_by' => $this->sessionData['userId']
					);

		$this->franchise_model->save_content($data, $imageUpload, $id);

		$getFranchiseById = $this->franchise_model->get_franchise_by_id($id, 'franchise_name');

		$this->log_activity_lib->log($accessName, $activityName, $getFranchiseById['franchise_name']);

		$this->web_config_lib->alert_successfully('saved');

		redirect('franchise');
	}
	// End of function save_content

	function save_content_2($id = 0) {

		$activityName = 'Edit';

		$accessName = 'Edit Franchise';

		$postContent = $this->input->post('content');

		$imageUpload = $this->matching_image_upload_2($id, $postContent);

		$data = array (
						'content_join' => $postContent,
						'updated_time' => date('Y-m-d H:i:s'),
						'updated_by' => $this->sessionData['userId']
					);

		$this->franchise_model->save_content($data, $imageUpload, $id);

		$getFranchiseById = $this->franchise_model->get_franchise_by_id($id, 'franchise_name');

		$this->web_config_lib->alert_successfully('saved');

		redirect('franchise');
	}
	// End of function save_content_2

	function matching_image_upload($id = 0, $postContent = '') {

		$dom = new DOMDocument();

		$dom->loadHTML($postContent);

		$element = $dom->getElementsByTagName('img');

		for ($i = 0; $i < count($element); $i++) {

			$value[] = str_replace(base_url() . substr($this->franchiseImagePath, 2) . $id . '/', '' , $element[$i]->getAttribute('src'));

		}

		// Get File in Franchise Image Path
		$files = glob($this->franchiseImagePath . $id . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE);

		for ($i = 0; $i < count($files); $i++) :

			$x = str_replace($this->franchiseImagePath . $id . '/', '' , $files[$i]);

			if (! in_array($x, $value)){

				unlink($this->franchiseImagePath . $id . '/' . $x);

			}

		endfor;

		return $value;
	}
	// End of function matching_image_upload

	function matching_image_upload_2($id = 0, $postContent = '') {

		$dom = new DOMDocument();

		$dom->loadHTML($postContent);

		$element = $dom->getElementsByTagName('img');

		for ($i = 0; $i < count($element); $i++) {

			$value[] = str_replace(base_url() . substr($this->franchiseImagePath2, 2) . $id . '/', '' , $element[$i]->getAttribute('src'));

		}

		// Get File in Franchise Image Path
		$files = glob($this->franchiseImagePath2 . $id . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE);

		for ($i = 0; $i < count($files); $i++) :

			$x = str_replace($this->franchiseImagePath2 . $id . '/', '' , $files[$i]);

			if (! in_array($x, $value)){

				unlink($this->franchiseImagePath2 . $id . '/' . $x);

			}

		endfor;

		return $value;

	}
	// End of function matching_image_upload_2

	function button_edit($id = 0) {

		$accessName = 'Edit Franchise';

		$url = 'franchise/add_content/' . $id . '/edit/';

		$string = $this->web_config_lib->button_edit($accessName, $url);

		return $string;
	}
	// End of function button_edit

	function button_delete($id = 0) {

		$accessName = 'Delete Franchise';

		$className = 'franchise-delete';

		$string = $this->web_config_lib->button_delete($accessName, $id, $className);

		return $string;
	}
	// End of function button_delete

	function button_detail($id = 0) {

		$accessName = 'View Franchise';

		$url = 'franchise/detail/' . $id;

		$string = $this->web_config_lib->button_detail($accessName, $url);

		return $string;
	}
	// End of function button_detail

	function button_field($id = 0) {

		$buttonEdit = $this->button_edit($id);

		$buttonDelete = $this->button_delete($id);

		$buttonDetail = $this->button_detail($id);

		return $buttonDetail . ' ' . $buttonEdit . ' ' . $buttonDelete;

	}
	// End of function button_field

	function unlink_all($id = 0) {

		// Get File in Franchise Image Path
		$files = glob($this->franchiseImagePath . $id . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE);

		for ($i = 0; $i < count($files); $i++) :

			$x = str_replace($this->franchiseImagePath . $id . '/', '' , $files[$i]);

			unlink($this->franchiseImagePath . $id . '/' . $x);

		endfor;

	}
	// End of function unlink_all

	function franchise_detail($id = 0) {

		$accessName = 'View Franchise';

		$this->session_lib->check_permission_with_redirect_page($accessName);

		$this->log_activity_lib->log($accessName, $this->activityName);

		$franchise = $this->franchise_model->get_franchise_by_id($id, 'franchise_name, description');

		$addAttribPage = array(
							'subtitleMenu' => $franchise['franchise_name'],
							'sublinkMenu' => '<li class="active">
												' . $franchise['franchise_name'] . '
											</li>',
							'franchiseName' => $franchise['franchise_name'],
							'franchiseId' => $id
						);

		$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

		$this->template_lib->webadmin_default_template('webadmin/content/franchise/detail_franchise', $viewData);
	}
	// End of function franchise_detail

	function delete_franchise($id = 0) {

		$accessName = 'Delete Franchise';

		$activityName = 'Delete';

		$getFranchiseById = $this->franchise_model->get_franchise_by_id($id, 'franchise_name');

		$franchiseName = $getFranchiseById['franchise_name'];

		if ($this->session_lib->check_permission($accessName) == 1) {

			$this->franchise_model->delete_data($id);

			$this->unlink_all($id);

			rmdir(substr($this->franchiseImagePath, 2) . $id);

			$this->log_activity_lib->log($accessName, $activityName, $franchiseName);

			$this->web_config_lib->alert_successfully('deleted');

			redirect('franchise', 'refresh');

		} else {

			$this->web_config_lib->alert_error('Can not delete data.
											Your account does not have access to delete franchise data.');

			redirect('franchise', 'location');

		}

	}// End of function delete_franchise

	function upload_thumbnail() {

		$activityName = 'Edit';

		$franchiseId = $this->input->post('inputFranchiseId');

		$getFranchiseData = $this->franchise_model->get_franchise_by_id($franchiseId, 'franchise_name, thumbnail');

		$fileName = 'thumbnail-franchise-' . $franchiseId;

		$config['upload_path'] = $this->thumbnailImagePath;
        $config['allowed_types'] = '*';
        $config['file_name'] = $fileName;
         
        $this->load->library('upload',$config);

        if ($getFranchiseData['thumbnail'] != '') {

        	unlink($this->thumbnailImagePath . $getFranchiseData['thumbnail']);

        }

        $this->upload->do_upload("file");

        // $config['image_library'] = 'gd2';
        // $config['source_image'] = $this->thumbnailImagePath . $this->upload->data('file_name');
        // $config['new_image'] = $this->thumbnailImagePath . $this->upload->data('file_name');
        // $config['width'] = 700;
        // $config['height'] = 400;

        // $this->load->library('image_lib', $config);
        // $this->image_lib->resize();

        $data = array(
        			'thumbnail' => $this->upload->data('file_name'),
					'updated_time' => date('Y-m-d H:i:s'),
					'updated_by' => $this->sessionData['userId']
        		);

        $this->franchise_model->update_data($data, $franchiseId);

		$this->log_activity_lib->log($this->accessName, $activityName, $getFranchiseData['franchise_name']);

	}
	// End of function upload_thumbnail

	/**
	 * @param post => status
	 * @param post => franchise_desc
	 * @param post => hits
	 * @param post => hits_ayo
	 * @param post => invesment
	 * @param post => total_outlet
	 * @param post => instagram
	 * @param post => url_website
	 * @param post => url_join
	 */
	function update_franchise($id = 0) {

		$activityName = 'Edit';

		$getFranchiseData = $this->franchise_model->get_franchise_by_id($id, 'franchise_name');

		$status 		= $this->input->post('status');
		$franchise_desc = $this->input->post('franchise_desc');
		$hits 			= $this->input->post('hits');
		$hits_ayo		= $this->input->post('hits_ayo');
		$invesment		= $this->input->post('invesment');
		$total_outlet	= $this->input->post('total_outlet');
		$instagram		= $this->input->post('instagram');
		$url_website	= $this->input->post('url_website');
		$url_join		= $this->input->post('url_join');

		$data = array (
						'status'			=> $status,
						'text' 				=> $franchise_desc,
						'hits' 				=> $hits,
						'hits_ayo'			=> $hits_ayo,
						'invesment'			=> $invesment,
						'total_outlet'		=> $total_outlet,
						'instagram'			=> $instagram,
						'url_website'		=> $url_website,
						'url_join'			=> $url_join,
						'updated_time' 		=> date('Y-m-d H:i:s'),
						'updated_by' 		=> $this->sessionData['userId']
					);

		$this->franchise_model->update_data($data, $id);
		$this->log_activity_lib->log($this->accessName, $activityName, $getFranchiseData['franchise_name']);
	}
	// End of function update_franchise

	/**
	 * @param post => chat_df
	 * @param post => chat_web
	 * @param post => chat_join
	 * @param post => chat_ayo
	 */
	function update_chat($id) {

		$chat_df	= $this->input->post('chat_df');
		$chat_web	= $this->input->post('chat_web');
		$chat_join	= $this->input->post('chat_join');
		$chat_ayo	= $this->input->post('chat_ayo');

		$data = array(		
						'chat_df'			=> $chat_df,
						'chat_web'			=> $chat_web,
						'chat_join'			=> $chat_join,
						'chat_ayo'			=> $chat_ayo,
						'updated_time' 		=> date('Y-m-d H:i:s'),
						'updated_by' 		=> $this->sessionData['userId']
		);

		$this->db->where('id', $id);
		$this->db->update('franchise', $data);
	}
	// End of function update_chat

	/**
	 * @param post => value
	 */
	function update_status($id) {

		$data = array(
						'status'			=> $this->input->post('value'),
						'updated_time' 		=> date('Y-m-d H:i:s'),
						'updated_by' 		=> $this->sessionData['userId']
		);

		$this->db->where('id', $id);
		$this->db->update('franchise', $data);
	}
	// End of function update_status

	public function upload_video() {

		$franchiseId = $this->input->post('franchise_id');

		$fileName = 'video-franchise-' . $franchiseId . '-' . date('YmdHis');

		$config['upload_path'] = $this->videosPath;
        $config['allowed_types'] = '*';
        $config['file_name'] = $fileName;
         
        $this->load->library('upload',$config);

        $this->upload->do_upload("file");

		$query = $this->db->query("SELECT videos
									FROM franchise
									WHERE id = " . $franchiseId)->row_array();

		if ($query['videos'] != null) {
			$data = json_decode($query['videos'], TRUE);
		} else {
			$data = array();
		}

		$data[] = $this->upload->data('file_name');

        $data = array(
        			'videos' => json_encode($data),
					'updated_time' => date('Y-m-d H:i:s'),
					'updated_by' => $this->sessionData['userId']
        		);

        $this->franchise_model->update_data($data, $franchiseId);
	}
	// End of function upload_video

	public function get_data_videos() {
		$franchise_id = $this->input->post('franchise_id');

		$query = $this->db->query("SELECT videos
								FROM franchise 
								WHERE id = " . $franchise_id)->row_array();

		if ($query['videos'] != null) {

			$data = array(
							'response' => 'success',
							'videos'	=> json_decode($query['videos'], TRUE),
			);
		} else {
			$data['response'] = 'error-null';
		}

		echo json_encode($data);
	}
	// End of function get_data_videos

	public function delete_video() {

		$franchise_id = $this->input->post('franchise_id');
		$i = $this->input->post('i');

		$query = $this->db->query("SELECT videos
								FROM franchise
								WHERE id = " . $franchise_id)->row_array();

		$videos = json_decode($query['videos'], TRUE);
		
		unlink($this->videosPath . $videos[$i]);

		unset($videos[$i]);
		// array_values($videos);

		$data = array(
        			'videos' => json_encode($videos),
					'updated_time' => date('Y-m-d H:i:s'),
					'updated_by' => $this->sessionData['userId']
        		);

        $this->franchise_model->update_data($data, $franchise_id);
	}
	// End of function delete_video
	
	public function get_content($id, $default = 0) {

		// $id = $this->input->post('franchise_id');

		$query = $this->db->query("SELECT description, videos
								FROM franchise
								WHERE id = " . $id)->row_array(); 

		$videos = $query['videos'];

		$description = str_replace('</p>', '', str_replace('<p>', '' ,$query['description']));
		$description = str_replace('<br />', '' ,$description);

		if ($videos != '' || ! empty($videos)) {
			$videos = json_decode($videos, TRUE);

			for ($i = 0; $i < count($videos); $i++) {

				$key = $this->get_string_between($description, '[VIDEO]', '[/VIDEO]');
				$url_image = $this->get_string_between($key, 'src="', '"');

				$description = str_replace($key, $this->replaced($url_image, $videos[$i]), $description);
				$description = str_replace('[VIDEO]<table', '<table', $description);
				$description = str_replace('</table>[/VIDEO]', '</table>', $description);
			}
		}

		$description = str_replace('img src', 'img class="lazyload" data-src', $description);

		if ($default = 0) {

			return $description;
		} else {
			echo $description;
		}
	}
	// End of function get_content

	function save_color($id) {

		$color = $this->input->post('color');

		$data = array(
						'color' => $color,
						'updated_time' => date('Y-m-d H:i:s'),
						'updated_by' => $this->sessionData['userId']
		);

		$this->db->where('id', $id);
		$this->db->update('franchise', $data);
	}
	// End of function save_color

	function get_franchise_by_id($id, $param) {

		$query = $this->db->query("SELECT franchise_name, thumbnail, chat_script_join, url_website, content_join, description, videos, color
									FROM franchise
									WHERE id = " . $id)->row_array();

		$queryPhone = $this->db->query("SELECT title, phone
										FROM franchise_phone
										WHERE franchise_id = " . $id);

		$franchiseName 	= $query['franchise_name'];
		$chatContent 	= $query['chat_script_join'];
		$urlWebsite 	= $query['url_website'];
		$contentJoin	= $query['content_join'];
		$description 	= $query['description'];
		$videos			= $query['videos'];
		$color			= $query['color'];

		$messageContent = str_replace('[franchise]', $franchiseName, $chatContent);
        $messageContent = str_replace(' ', '+', $messageContent);
        $messageContent = str_replace('&', '%26', $messageContent);
        $messageContent = str_replace(',', '%2C', $messageContent);
        $messageContent = str_replace('<br />', '%0A', nl2br($messageContent));
        $messageContent = str_replace(':', '%3A', $messageContent);

		$thumbnail = '<div class="col-md-2"></div><div class="col-md-8 mb-5"><img src="' . base_url() . substr($this->thumbnailImagePath, 2) . $query['thumbnail'] . '" style="width: 100%"></div><div class="col-md-2"></div>';

		$title = '<div class="col-md-12 mb-5 text-center"><h4 class="ff-sfpd-semibold text-upper clr-dim-gray">HUBUNGI MARKETING<br><span class="brand">' . $franchiseName . '</span></h4></div>';

		if ($queryPhone->num_rows() > 0 && $messageContent != '') {

			$queryPhone = $queryPhone->result();

			$phone = '';
			foreach ($queryPhone as $row) :

				if ($param == 'page') {
					$btnColorClass = '';
					$btnStyle = 'style="background-color:' . $color . ';color:white"';
				} else {
					$btnColorClass = 'btn-primary';
					$btnStyle = '';
				}
				$phone .= '<div class="col-md-12 mb-3" style="padding: 0 2rem"><a href="https://api.whatsapp.com/send/?phone=' . $row->phone . '&text=' . $messageContent . '" target="_blank" class="btn ' . $btnColorClass . ' btn-block" ' . $btnStyle . '>WHATSAPP ' . $row->title . '</a></div>';
			endforeach;
		}

		$staticPhone = '<div id="franchise-phone">' . $phone . '</div>';

		$website = '<div class="col-md-12 mb-5" style="padding: 0 2rem"><a class="btn btn-primary btn-block" target="_blank" id="link-website" href="' . $urlWebsite . '">WEBSITE ' . $franchiseName . '</a></div>';

		$content = '<div class="col-md-1"></div><div class="col-md-10">' . $contentJoin . '</div><div class="col-md-1"></div>';

		if ($videos != '' || ! empty($videos)) {
			$videos = json_decode($videos, TRUE);

			for ($i = 0; $i < count($videos); $i++) {

				$key = $this->get_string_between($description, '[VIDEO]', '[/VIDEO]');
				$url_image = $this->get_string_between($key, 'src="', '"');

				$description = str_replace($key, $this->replaced($url_image, $videos[$i]), $description);
				$description = str_replace('[VIDEO]<table', '<table', $description);
				$description = str_replace('</table>[/VIDEO]', '</table>', $description);
			}
		}

		$page	= '<div class="col-md-12" style="padding: 0">' . $description . '</div>';

		$data = array(
						'thumbnail' => $thumbnail,
						'title'		=> $title,
						'phone' 	=> $phone,
						'website'	=> $website,
						'content'	=> $content,
						'page'		=> $page,
						'staticPhone'=> $staticPhone
		);

		echo json_encode($data);
	}
	// End of function get_franchise_by_id

	function get_string_between($string, $start, $end){
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if ($ini == 0) return '';
		$ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}
	// End of function get_string_between

	function replaced($img, $video) {
		$html = '<table class="video-content"><tbody><tr><td background="' . $img . '" style="background-size:100%; text-align:center">';
		$html .= '<video class="responsive-video" preload="metadata" controls loop playsinline controlsList="nodownload"><source src="' . base_url() . substr($this->videosPath, 2) . $video . '" type="video/mp4"></video>';
        $html .= '</td></tr></tbody></table>';
		return $html;
	}
	// End of function replaced

}

/*
	End of class Franchise
	End of file Franchise.php
	Location: ./application/controllers/Franchise.php
*/