<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Article extends CI_Controller {

	private $sessionData;
	private $attribPage;
	private $attribThisPage;
	private $accessName = 'Article';
	private $activityName = 'Visit';

	private $articleImagePath = './images/article/';

	private $thumbnailImagePath = './images/article/thumbnail/';

	function __construct() {

		parent::__construct();

		$this->load->model(array(
								'article_model'
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
													<a href="' . site_url('article') . '" data-toggle="tooltip" data-placement="top" title="Visit to ' . $this->accessName . ' Menu">
														' . $this->accessName . '
													</a>
												</li>',
									'helpMode' => $this->sessionData['helpModeValue']
									);

	}
	// End of function __construct

	function article_report() {

		$this->session_lib->check_permission_with_redirect_page($this->accessName);

		$this->log_activity_lib->log($this->accessName, $this->activityName);

		$addAttribPage = array(
								'subtitleMenu' => '<i class="fa fa-list-alt"></i> Report',
								'sublinkMenu' => '<li class="active">
													<i class="fa fa-list-alt"></i> Report
												</li>',
								'filterUser' => $this->web_config_lib->get_updated_by('article'),
								'filterStatus' => $this->web_config_lib->get_filter_status()
							);

		$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

		$this->template_lib->webadmin_default_template('webadmin/content/article/index.php', $viewData);

	}
	// End of function article_report

	function article_add_form() {

		$accessName = 'New Article';

		$this->session_lib->check_permission_with_redirect_page($accessName);

		$this->log_activity_lib->log($accessName, $this->activityName);

		$addAttribPage = array(
							'subtitleMenu' => '<i class="fa fa-plus"></i> New Article',
							'sublinkMenu' => '<li class="active">
												<i class="fa fa-plus"></i> New Article
											</li>'
						);

		$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

		$this->template_lib->webadmin_default_template('webadmin/content/article/add', $viewData);

	}
	// End of function franchise_add_form

	function add_content($id = 0, $mode = 'add') {

		$accessName = 'Edit Article';

		$this->session_lib->check_permission_with_redirect_page($accessName);

		$this->log_activity_lib->log($accessName, $this->activityName);

		$article = $this->article_model->get_article_by_id($id, 'title, content, thumbnail, status');

		$addAttribPage = array(
							'subtitleMenu' => $article['title'],
							'sublinkMenu' => '<li class="active">
												' . $article['title'] . '
											</li>',
							'articleTitle' => $article['title'],
							'articleId' => $id,
							'thumbnailUrl' => base_url() . substr($this->thumbnailImagePath, 2) . $article['thumbnail'],
							'articleContent' => $article['content'],
							'articleStatus' => $article['status'],
							'mode' => $mode
						);

		$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

		$this->template_lib->webadmin_default_template('webadmin/content/article/add_content', $viewData);

	}
	// End of function add_content

	function save_content($id = 0) {

		$activityName = 'Edit';

		$accessName = 'Edit Article';

		$postContent = $this->input->post('post_content');

		$imageUpload = $this->matching_image_upload($id, $postContent);

		$data = array (
						'content' => $postContent,
						'updated_time' => date('Y-m-d H:i:s'),
						'updated_by' => $this->sessionData['userId']
					);

		$this->article_model->save_content($data, $imageUpload, $id);

		$getArticleById = $this->article_model->get_article_by_id($id, 'title');

		$this->log_activity_lib->log($accessName, $activityName, $getArticleById['title']);

		$this->web_config_lib->alert_successfully('saved');

		redirect('article');

	}
	// End of function save_content

	function image_upload($articleId = 0) {

		$config['upload_path'] = $this->articleImagePath . $articleId;
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
				->set_output(json_encode(['location' => base_url() . substr($this->articleImagePath, 2) . $articleId . '/' . $file['file_name']]))
				->_display();
			exit;

		}

	}
	// End of function image_upload

	function matching_image_upload($id = 0, $postContent = '') {

		$dom = new DOMDocument();

		$dom->loadHTML($postContent);

		$element = $dom->getElementsByTagName('img');

		for ($i = 0; $i < count($element); $i++) {

			$value[] = str_replace(base_url() . substr($this->articleImagePath, 2) . $id . '/', '' , $element[$i]->getAttribute('src'));

		}

		// Get File in Franchise Image Path
		$files = glob($this->articleImagePath . $id . '/*.{jpg,jpeg,png}', GLOB_BRACE);

		for ($i = 0; $i < count($files); $i++) :

			$x = str_replace($this->articleImagePath . $id . '/', '' , $files[$i]);

			if (! in_array($x, $value)){

				unlink($this->articleImagePath . $id . '/' . $x);

			}

		endfor;

		return $value;

	}
	// End of function matching_image_upload

	function get_data_article() {

		$getDataArticle = $this->article_model->get_article_using_server_side();

		$data = array();

		foreach ($getDataArticle as $field):

			$row = array();

			if ($field->status == 1) {

				$status = '<label class="label label-success">Active</label>';

			} else {

				$status = '<label class="label label-danger">Not Active</label>';

			}

			$row[] = date_format(date_create($field->updated_time), 'd M Y H:i:s');

			$row[] = $field->title;

			$row[] = $status;

			$row[] = $field->user_fullname;

			$row[] = $this->button_field($field->article_id);

			$data[] = $row;

		endforeach;

		$output = array(
						"draw" => $_POST['draw'],
            			"recordsTotal" => $this->article_model->count_all_data(),
            			"recordsFiltered" => $this->article_model->count_filtered(),
						"data" => $data
					);

		echo json_encode($output);

	}
	// End of function get_data_article

	function save_article() {

		$accessName = 'New Article';

		$activityName = 'Add';

		if ($this->session_lib->check_permission($accessName) == 1) {

			$activityName = 'Add';

			$articleTitle = $this->input->post('inputArticleTitle');

			$countArticleByTitle = $this->article_model->count_article_by_title($articleTitle);

			if ($countArticleByTitle == 0) {

				$slug =  preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(" ", "-", strtolower($articleTitle)));

				$articleData = array(
									'title' => $articleTitle,
									'slug' => $slug,
									'status' => 1,
									'created_time' => date('Y-m-d H:i:s'),
									'creator' => $this->sessionData['userId'],
									'updated_time' => date('Y-m-d H:i:s'),
									'updated_by' => $this->sessionData['userId']
								);

				$articleId = $this->article_model->insert_data($articleData);

				$this->log_activity_lib->log($this->accessName, $activityName, $articleTitle);

				$status = 'success';

				$msg = $this->web_config_lib->alert_successfully_modal('saved');

				mkdir($this->articleImagePath . $articleId);

			} else {

				$status = 'failed';

				$msg = 'Title already exists';

				$txtMsg = $this->web_config_lib->alert_error($msg, 'text');

				$articleId = 0;

			}

		} else {

			$status = 'failed';

			$msg = 'Your account does not have access to add article data.';

			$txtMsg = $this->web_config_lib->alert_error($msg, 'text');

			$articleId = 0;

		}

		$this->output->set_content_type('application/json')->set_output(json_encode(array(
        																				'status' => $status,
        																				'msg' => $msg,
        																				'id' => $articleId
        																			)
    																			));

	}
	// End of function save_article

	function button_edit($id = 0) {

		$accessName = 'Edit Article';

		$url = 'article/add_content/' . $id . '/edit/';

		$string = $this->web_config_lib->button_edit($accessName, $url);

		return $string;

	}
	// End of function button_edit

	function button_delete($id = 0) {

		$accessName = 'Delete Article';

		$className = 'article-delete';

		$string = $this->web_config_lib->button_delete($accessName, $id, $className);

		return $string;

	}
	// End of function button_delete

	function button_detail($id = 0) {

		$accessName = 'View Article';

		$url = 'article/detail/' . $id;

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

		// Get File in Article Image Path
		$files = glob($this->articleImagePath . $id . '/*.{jpg,jpeg,png}', GLOB_BRACE);

		for ($i = 0; $i < count($files); $i++) :

			$x = str_replace($this->articleImagePath . $id . '/', '' , $files[$i]);

			unlink($this->articleImagePath . $id . '/' . $x);

		endfor;

	}
	// End of function unlink_all

	function article_detail($id = 0) {

		$accessName = 'View Article';

		$this->session_lib->check_permission_with_redirect_page($accessName);

		$this->log_activity_lib->log($accessName, $this->activityName);

		$article = $this->article_model->get_article_by_id($id, 'title, content');

		$addAttribPage = array(
							'subtitleMenu' => $article['title'],
							'sublinkMenu' => '<li class="active">
												' . $article['title']. '
											</li>',
							'articleTitle' => $article['title'] ,
							'articleId' => $id,
							'articleContent' => $article['content']
						);

		$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

		$this->template_lib->webadmin_default_template('webadmin/content/article/detail_article', $viewData);

	}
	// End of function franchise_detail

	function delete_article($id = 0) {

		$accessName = 'Delete Article';

		$activityName = 'Delete';

		$getArticleById = $this->article_model->get_article_by_id($id, 'title');

		$articleTitle = $getArticleById['title'];

		if ($this->session_lib->check_permission($accessName) == 1) {

			$this->article_model->delete_data($id);

			$this->unlink_all($id);

			rmdir(substr($this->articleImagePath, 2) . $id);

			$this->log_activity_lib->log($accessName, $activityName, $articleTitle);

			$this->web_config_lib->alert_successfully('deleted');

			redirect('article', 'refresh');

		} else {

			$this->web_config_lib->alert_error('Can not delete data.
											Your account does not have access to delete article data.');

			redirect('article', 'location');

		}

	}// End of function delete_franchise

	function upload_thumbnail() {

		$activityName = 'Edit';

		$articleId = $this->input->post('inputArticleId');

		$getArticleData = $this->article_model->get_article_by_id($articleId, 'title, thumbnail');

		$fileName = 'thumbnail-article-' . $articleId;

		$config['upload_path'] = $this->thumbnailImagePath;
        $config['allowed_types'] = 'jpeg|jpg|png|gif';
        $config['file_name'] = $fileName;
         
        $this->load->library('upload',$config);

        if ($getArticleData['thumbnail'] != '') {

        	unlink($this->thumbnailImagePath . $getArticleData['thumbnail']);

        }

        $this->upload->do_upload("file");

        $config['image_library']='gd2';
        $config['source_image']=$this->thumbnailImagePath . $this->upload->data('file_name');
        $config['new_image']=$this->thumbnailImagePath . $this->upload->data('file_name');
        $config['width']= 1100;
        $config['height']= 600;

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();

        $data = array(
					'updated_time' => date('Y-m-d H:i:s'),
					'updated_by' => $this->sessionData['userId'],
        			'thumbnail' => $this->upload->data('file_name')
        		);

        $this->article_model->update_data($data, $articleId);

		$this->log_activity_lib->log($this->accessName, $activityName, $getArticleData['title']);

	}
	// End of function upload_thumbnail

	function update_article($id = 0) {

		$activityName = 'Edit';

		$getArticleData = $this->article_model->get_article_by_id($id, 'title');

		$articleStatus = $this->input->post('inputArticleStatus');

		$data = array (
						'status' => $articleStatus,
						'updated_time' => date('Y-m-d H:i:s'),
						'updated_by' => $this->sessionData['userId']
					);

		$this->article_model->update_data($data, $id);

		$this->log_activity_lib->log($this->accessName, $activityName, $getArticleData['title']);

	}
	// End of function update_franchise


}

/*
	End of class Article
	End of file Article.php
	Location: ./application/controllers/Article.php
*/