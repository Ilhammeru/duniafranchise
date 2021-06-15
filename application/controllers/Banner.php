<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Banner extends CI_Controller {

	private $sessionData;
	private $attribPage;
	private $attribThisPage;
	private $accessName = 'Banner';
	private $activityName = 'Visit';

	private $bannerImagePath = './images/franchise/banner/';

	private $topBannerImagePath = './images/top_banner/';

	function __construct() {

		parent::__construct();

		$this->load->library(array(
								'throttle_lib'
							));

		$this->load->model(array(
								'franchise_model',
								'top_banner_model'
							));

		$this->sessionData = $this->session_lib->get_session();

		$this->attribPage = $this->web_config_lib->attrib_page();

		$this->attribThisPage = array(
									'sessionData' => $this->sessionData,
									'accessName' => $this->accessName,
									'titlePageRight' => $this->accessName,
									'titleMenu' => $this->accessName,
									'linkMenu' => '<li>
													<a href="' . site_url('banner') . '" data-toggle="tooltip" data-placement="top" title="Visit to ' . $this->accessName . ' Menu">
														' . $this->accessName . '
													</a>
												</li>',
									);

	}
	// End of function __construct

	function view() {

		$accessName = 'View Banner';

		$this->session_lib->check_permission_with_redirect_page($accessName);

		$this->log_activity_lib->log($accessName, $this->activityName);

		$addAttribPage = array(
								'subtitleMenu' => '<i class="fa fa-list-alt"></i> View',
								'sublinkMenu' => '<li class="active">
													<i class="fa fa-list-alt"></i> View
												</li>',
								'franchiseListLeft' => $this->franchise_model->get_franchise_banner_by_position_and_sort_by_banner_number('franchise.id, franchise_name', 'left'),
								'franchiseListRight' => $this->franchise_model->get_franchise_banner_by_position_and_sort_by_banner_number('franchise.id, franchise_name', 'right')
							);

		$viewData = array_merge($this->attribPage, $this->attribThisPage, $addAttribPage);

		$this->template_lib->webadmin_default_template('webadmin/content/banner/view', $viewData);

	}
	// End of function view

	function get_data_franchise() {

		$field = 'franchise.id, franchise_name';

		$getDataFranchise = $this->franchise_model->get_all_franchise($field);

		$data = array();

		foreach ($getDataFranchise as $field):

			$row = array();

			$row[] = $field->franchise_name;

			$data[] = $row;

		endforeach;

		$output = array(
						"draw" => $_POST['draw'],
            			"recordsTotal" => $this->franchise_model->count_all_data(),
						"data" => $data
					);

		echo json_encode($output);

	}
	// End of function get_data_franchise

	function display_banner_franchise() {

		$franchiseName = str_replace('["', '', 
							str_replace('"]', '', json_encode($this->input->post('franchiseName')))
						);

		$getFranchiseData = $this->franchise_model->get_franchise_by_name($franchiseName, 'id, franchise_name');

		$franchiseId = $getFranchiseData['id'];

		$countBannerByFranchiseId = $this->franchise_model->count_banner_by_franchise_id($franchiseId);

        if ($countBannerByFranchiseId == 1) {

        	$getBannerByFranchiseId = $this->franchise_model->get_banner_by_franchise_id($franchiseId);

			$data['img_url'] = base_url() . substr($this->bannerImagePath, 2) . $getBannerByFranchiseId['image_source'];

			$data['banner_showing'] = $getBannerByFranchiseId['banner_showing'];

			$data['banner_position'] = $getBannerByFranchiseId['banner_position'];

		}

		$data['countFranchiseBanner'] = $countBannerByFranchiseId;

		$data['franchise'] = $getFranchiseData;

		$data['sessionData'] = $this->sessionData;

		$this->load->view('webadmin/content/banner/view_image_franchise', $data);

	}
	// End of function display_banner_franchise

	function upload_banner() {

		$franchiseId = $this->input->post('inputFranchiseId');

		$activityName = 'Edit';

		$countBannerByFranchiseId = $this->franchise_model->count_banner_by_franchise_id($franchiseId);

		$fileName = 'banner-franchise-' . $franchiseId;

		$config['upload_path'] = $this->bannerImagePath;
        $config['allowed_types'] = '*';
        $config['file_name'] = $fileName;
         
        $this->load->library('upload',$config);

        if ($countBannerByFranchiseId == 1) {

        	$getBannerByFranchiseId = $this->franchise_model->get_banner_by_franchise_id($franchiseId);

        	unlink($this->bannerImagePath . $getBannerByFranchiseId['image_source']);

        	$this->franchise_model->delete_banner($franchiseId);

        }

        $getFranchiseById = $this->franchise_model->get_franchise_by_id($franchiseId, 'franchise_name');
        			
		$getLastBannerNumber = $this->franchise_model->get_last_banner_number();

        $this->upload->do_upload("file");

        $data = array(
        			'franchise_id' => $franchiseId,
        			'image_source' => $this->upload->data('file_name'),
        			'banner_number' => $getLastBannerNumber['banner_number'] + 1,
					'updated_time' => date('Y-m-d H:i:s'),
					'updated_by' => $this->sessionData['userId']
        		);

        $this->franchise_model->insert_data_banner($data);

		$this->log_activity_lib->log($this->accessName, $activityName, $getFranchiseById['franchise_name']);

	}
	// End of function upload_banner

	function get_data_top_banner() {

		$field = 'name';

		$getDataTopBanner = $this->top_banner_model->get_all_top_banner($field);

		$data = array();

		foreach ($getDataTopBanner as $field):

			$row = array();

			$row[] = $field->name;

			$data[] = $row;

		endforeach;

		$output = array(
						"draw" => $_POST['draw'],
            			"recordsTotal" => $this->top_banner_model->count_all_data(),
						"data" => $data
					);

		echo json_encode($output);

	}
	// End of function get_data_top_banner

	function add_top_banner() {

		$activityName = 'Add';

		$countData = $this->top_banner_model->count_all_data();

		$getLastId = $this->top_banner_model->get_last_id();

		if ($countData == 0) {

			$id = 1;

		} else {

			$id = $getLastId['id'] + 1;

		}

		$bannerName = 'Top Banner ' . $id;

		$data = array(
					'name' => $bannerName,
					'updated_time' => date('Y-m-d H:i:s'),
					'updated_by' => $this->sessionData['userId']
				);		

		$this->top_banner_model->insert_data($data);

		$this->log_activity_lib->log($this->accessName, $activityName, $bannerName);

	}
	// End of function add_top_banner

	function display_top_banner() {

		$topBannerName = str_replace('["', '', 
							str_replace('"]', '', json_encode($this->input->post('topBannerName')))
						);

		$getTopBannerData = $this->top_banner_model->get_top_banner_by_name_join_franchise($topBannerName, 'top_banner.id, name, image_source, top_banner.status, franchise_id, franchise_name');

		if ($getTopBannerData['image_source'] == '') {

			$data['img_url'] = '';

		} else {

			$data['img_url'] = base_url() . substr($this->topBannerImagePath, 2) . $getTopBannerData['image_source'];

		}

		$data['franchise'] = $this->franchise_model->get_all_franchise('id, franchise_name');

		$data['topBannerUrl'] = $getTopBannerData['franchise_id'];

		$data['topBannerUrlName'] = $getTopBannerData['franchise_name'];

		$data['topBanner'] = $getTopBannerData;

		$data['sessionData'] = $this->sessionData;

		$this->load->view('webadmin/content/banner/view_image_top_banner', $data);

	}
	// End of function display_banner_franchise

	function upload_top_banner() {

		$topBannerId = $this->input->post('inputTopBannerId');

		$activityName = 'Edit';

		$fileName = 'top-banner-' . $topBannerId;

		$config['upload_path'] = $this->topBannerImagePath;
        $config['allowed_types'] = '*';
        $config['file_name'] = $fileName;
         
        $this->load->library('upload',$config);

        $getTopBannerData = $this->top_banner_model->get_top_banner_by_id($topBannerId, 'name, image_source');

        if ($getTopBannerData['image_source'] != '') {

        	unlink($this->topBannerImagePath . $getTopBannerData['image_source']);

        }

        $this->upload->do_upload("file");

        // $config['image_library'] = 'gd2';
        // $config['source_image'] = $this->topBannerImagePath . $this->upload->data('file_name');
        // $config['new_image'] = $this->topBannerImagePath . $this->upload->data('file_name');
        // $config['width'] = 1400;
        // $config['height'] = 800;

        // $this->load->library('image_lib', $config);
        // $this->image_lib->resize();
        
        $data = array(
        			'image_source' => $this->upload->data('file_name'),
        			'status' => 1,
					'updated_time' => date('Y-m-d H:i:s'),
					'updated_by' => $this->sessionData['userId']
        		);

        $this->top_banner_model->update_data($data, $topBannerId);
 
		$this->log_activity_lib->log($this->accessName, $activityName, $getTopBannerData['name']);

	}
	// End of function upload_top_banner

	function change_status_top_banner() {

		$topBannerId = $this->input->post('topBannerId');

		$status = $this->input->post('status');

		$url = $this->input->post('inputUrl');

		$data = array(
					'status' => $status,
					'franchise_id' => $url,
					'updated_time' => date('Y-m-d H:i:s'),
					'updated_by' => $this->sessionData['userId']
					); 

        $this->top_banner_model->update_data($data, $topBannerId);

	}
	// End of function change_status_top_banner

	function change_status_banner_franchise() {

		$franchiseId = $this->input->post('franchiseId');

		$status = $this->input->post('status');

		$data = array(
					'banner_showing' => $status,
					'updated_time' => date('Y-m-d H:i:s'),
					'updated_by' => $this->sessionData['userId']
					); 

        $this->franchise_model->update_data_franchise_banner($data, $franchiseId);

	}
	// End of function change_status_banner_franchise

	function change_position_banner() {

		$franchiseId = $this->input->post('franchiseId');

		$position = $this->input->post('position');

		$data = array(
					'banner_position' => $position,
					'updated_time' => date('Y-m-d H:i:s'),
					'updated_by' => $this->sessionData['userId']
					); 

        $this->franchise_model->update_data_franchise_banner($data, $franchiseId);

	}
	// End of function change_position_banner

	function set_sorting_banner() {

		$bannerSortLeft = $this->input->post('bannerSortLeft');

		$bannerSortRight = $this->input->post('bannerSortRight');

		$this->franchise_model->update_data_franchise_banner_by_name($bannerSortLeft, $bannerSortRight);

	}
	// End of function set_sorting_banner

}

/*
	End of class Banner
	End of file Banner.php
	Location: ./application/controllers/Banner.php
*/