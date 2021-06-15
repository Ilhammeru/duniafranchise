<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Franchise extends CI_Controller {

	private $attribThisPage;

    private $accessName = 'Franchise';

	private $topBannerImgPath = './images/top_banner/';
	private $franchiseThumbnailImgPath = './images/franchise/thumbnail/';
    private $franchiseBannerImgPath = './images/franchise/banner/';
    private $articleThumbnailImgPath = './images/article/thumbnail/';
	private $videosPath = './images/franchise/videos/';

	function __construct() {

		parent::__construct();

		$this->load->model(array(
								'top_banner_model',
								'about_us_model',
								'franchise_model',
								'article_model'
							));

        $this->attribPage = $this->web_config_lib->attrib_page();

        $this->attribThisPage = array(
                                    'titlePageRight' => $this->accessName,
                                );

       $this->load->helper('url');
       $this->load->library('pagination');
       $this->load->database();

	}
	// End of function __construct

	function index() {

        if ($this->agent->is_mobile()) {

            $addAttribPage = array(
                            'topBannerImgPath' => $this->topBannerImgPath,
                            'topBanner' => $this->top_banner_model->get_top_banner_rand(),
                            'franchiseThumbnailImgPath' => base_url() . substr($this->franchiseThumbnailImgPath, 2),
                            'articleRand' => $this->article_model->get_article_rand('*', 4),
                            'articleThumbnailImgPath' => base_url() . substr($this->articleThumbnailImgPath, 2),
                            'log' => $this->accessName,
                            'franchiseBannerImgPath' => base_url() . substr($this->franchiseBannerImgPath, 2)
                        );

        } else {

            $addAttribPage = array(
							'topBannerImgPath' => $this->topBannerImgPath,
							'topBanner' => $this->top_banner_model->get_all_top_banner_active(),
							'franchiseThumbnailImgPath' => base_url() . substr($this->franchiseThumbnailImgPath, 2),
                            'log' => $this->accessName,
                            'franchiseBannerImgPath' => base_url() . substr($this->franchiseBannerImgPath, 2)
						);

        }

		$data = array_merge($this->attribPage, $this->attribThisPage, $addAttribPage);

        if ($this->agent->is_mobile()) {

            $this->template_lib->webpublic_header_mobile_app($data);
            $this->load->view('webpublic/template-mobile/franchise-list-mobile-app', $data);
            $this->template_lib->webpublic_footer_mobile_app($data);

        } else {

    		$this->template_lib->webpublic_header_app($data);
    		$this->template_lib->webpublic_top_banner_app($data);
    		$this->load->view('webpublic/franchise/franchise-list', $data);
    		$this->template_lib->webpublic_footer_app($data);

        }
	}
	// End of function index

	public function loadRecord($rowno = 0){

        $sort = $this->input->post('sort');
    
        $rowperpage = $this->input->post('rowperpage');
 
        if($rowno != 0){
          $rowno = ($rowno - 1) * $rowperpage;
        }
  
        $allcount = $this->franchise_model->count_all_data_active();

        $this->db->where('status', 1);

        switch ($sort) :

            case 'alfabet-asc';

                $this->db->order_by('franchise_name', 'asc');

                break;

            case 'alfabet-desc':

                $this->db->order_by('franchise_name', 'desc');

                break;

            case 'populer':

                $this->db->order_by('hits', 'desc');

                break;

            default :

                $this->db->order_by('id', 'desc');

                break;

        endswitch;
         
        $this->db->limit($rowperpage, $rowno);

        $users_record = $this->db->get('franchise')->result_array();
  
        $config['base_url'] = site_url('webpublic/franchise/loadRecord');
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowperpage;
 
        $config['full_tag_open'] = '<div class="text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';

        $config['num_tag_open'] = '<span class="page-link">';
        $config['num_tag_close'] = '</span>';

        $config['cur_tag_open'] = '<span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span>';

        $config['next_tag_open'] = '<span class="page-link">';
        $config['next_tag_close'] = '<span aria-hidden="true"></span></span>';

        $config['prev_tag_open'] = '<span class="page-link">';
        $config['prev_tag_close'] = '</span>';

        $config['first_tag_open'] = '<span class="page-link">';
        $config['first_tag_close'] = '</span>';

        $config['last_tag_open'] = '<span class="page-link">';
        $config['last_tag_close'] = '</span>';
 
        $this->pagination->initialize($config);
 
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $users_record;
        $data['row'] = $rowno;
 
        echo json_encode($data);
  	}

    function detail($slug = "") {

        $query = $this->db->query("SELECT id FROM franchise WHERE slug = '$slug'")->num_rows();

        if ($query > 0) {

            $getFranchiseDetail = $this->franchise_model->get_franchise_by_slug($slug, "id, franchise_name, hits, chat_script_df");

            $data = array(
                        'hits' => $getFranchiseDetail['hits'] + 1
                    );

            $this->franchise_model->update_data_by_slug($data, $slug);

            if ($this->agent->is_mobile()) {

                $queryPhone = $this->db->query("SELECT title, phone FROM franchise_phone WHERE franchise_id = " . $getFranchiseDetail['id']);

                $phone = $queryPhone->num_rows();
                $franchisePhone = $queryPhone->result();

                $messageContent = str_replace('[franchise]', $getFranchiseDetail['franchise_name'], $getFranchiseDetail['chat_script_df']);
                $messageContent = str_replace(' ', '+', $messageContent);
                $messageContent = str_replace('&', '%26', $messageContent);
                $messageContent = str_replace(',', '%2C', $messageContent);
                $messageContent = str_replace('<br />', '%0A', nl2br($messageContent));
                $messageContent = str_replace(':', '%3A', $messageContent);


                $addAttribPage = array(
                                    'franchiseBannerImgPath' => base_url() . substr($this->franchiseBannerImgPath, 2),
                                    'article' => $this->article_model->get_article_recently_added('title, slug'),
                                    'franchiseHits' => $this->franchise_model->get_franchise_hits('*', 4),
                                    'franchiseThumbnailImgPath' => base_url() . substr($this->franchiseThumbnailImgPath, 2),
                                    'slug' => $slug,
                                    'log' => $slug,
                                    'messageContent' => $messageContent,
                                    'franchisePhone' => $franchisePhone,
                                    'phone' => $phone,
                                    'name_url' => str_replace(" ", "+", $getFranchiseDetail['franchise_name']),
                                    'franchise_id' => $getFranchiseDetail['id']
                                );

            } else {

                $addAttribPage = array(
                                    'franchiseBannerImgPath' => base_url() . substr($this->franchiseBannerImgPath, 2),
                                    'article' => $this->article_model->get_article_recently_added('title, slug'),
                                    'slug' => $slug,
                                    'log' => $slug,
                                    'franchise_id' => $getFranchiseDetail['id']
                                );

            }

            $data = array_merge($this->attribPage, $this->attribThisPage, $addAttribPage);

            if ($this->agent->is_mobile()) {

                $this->template_lib->webpublic_header_mobile_app($data);
                $this->load->view('webpublic/template-mobile/franchise-detail-mobile-app', $data);
                $this->template_lib->webpublic_footer_mobile_app($data);

            } else {

                $this->template_lib->webpublic_header_app($data);
                $this->load->view('webpublic/franchise/franchise-detail', $data);
                $this->template_lib->webpublic_footer_app($data);

            }

        } else {
            redirect('404_override');
        }

    }
    // End of function detail
    
    function loadLeftBanner() {

        $getLeftBanner = $this->franchise_model->get_banner('left');

        $data['result'] = $getLeftBanner;

        echo json_encode($data);

    }
    // End of function loadLeftBanner

    function loadRightBanner() {

        $getRightBanner = $this->franchise_model->get_banner('right');

        $data['result'] = $getRightBanner;

        echo json_encode($data);

    }
    // End of function loadRightBanner

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

    // function replaced($img, $video) {

	// 	$html = '<table class="video-content"><tbody><tr><td background="' . $img . '" style="background-size:100%; text-align:center">';
    //     $html .= '<iframe width="80%"';
    //     $html .= 'height="300"';
    //     $html .= 'src="' . base_url() . substr($this->videosPath, 2) . $video . '"';
    //     $html .= 'frameborder="0"';
    //     $html .= 'allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    //     $html .= '</td></tr></tbody></table>';

    //     return $html;
    // }

}

/*
	End of class Franchise
	End of file Franchise.php
	Location: ./application/controllers/webpublic/Franchise.php
*/