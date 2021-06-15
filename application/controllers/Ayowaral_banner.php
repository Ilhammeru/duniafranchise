<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Ayowaral_banner extends CI_Controller {

	private $sessionData;
	private $attribPage;
	private $attribThisPage;
	private $accessName = 'Ayo Waralaba Banner';
	private $activityName = 'Visit';

    private $premiumBannerPath  = './ayowaral-images/premiumbanner/';
    private $topBannerPath      = './ayowaral-images/topbanner/';
    private $centerBannerPath   = './ayowaral-images/centerbanner/';
    private $leftBannerPath     = './ayowaral-images/leftbanner/';
    private $rightBannerPath    = './ayowaral-images/rightbanner/';

	function __construct() {

		parent::__construct();

		$this->load->library(array(
								'throttle_lib'
							));

		$this->sessionData = $this->session_lib->get_session();

		$this->attribPage = $this->web_config_lib->attrib_page();

        $this->load->model('multiple_db_model');

		$this->attribThisPage = array(
									'sessionData' => $this->sessionData,
									'accessName' => $this->accessName,
									'titlePageRight' => $this->accessName,
									'titleMenu' => $this->accessName,
									'linkMenu' => '<li>
													<a href="' . site_url('ayowaral_banner') . '" data-toggle="tooltip" data-placement="top" title="Visit to ' . $this->accessName . ' Menu">
														' . $this->accessName . '
													</a>
												</li>',
									);

	}
	// End of function __construct

	public function index() {

        // Skip for permission
        // Skip for log

        $franchise = $this->multiple_db_model->custom_query("SELECT franchise_id, name
                                                            FROM wm_franchise
                                                            ORDER BY name ASC", "ayowaral")->result();

		$addAttribPage = array(
								'subtitleMenu' => '<i class="fa fa-list-alt"></i> Index',
								'sublinkMenu' => '<li class="active">
													<i class="fa fa-list-alt"></i> Index
												</li>',
                                'franchise' => $franchise
							);

		$viewData = array_merge($this->attribPage, $this->attribThisPage, $addAttribPage);

		$this->template_lib->webadmin_default_template('ayowaral/banner/index', $viewData);

	}
	// End of function index

    /******************************************************* API *******************************************************/

    /**
     * @param post => param
     */
    public function get_banner() {

        $param = $this->input->post('param');

        switch ($param) :

            case 1 :
                $sintax = 'SELECT banner_id, 
                            wm_topbanner.franchise_id, 
                            wm_franchise.name AS franchise_name,
                            image_banner, 
                            wm_topbanner.is_active
                            FROM wm_topbanner
                            JOIN wm_franchise ON wm_franchise.franchise_id = wm_topbanner.franchise_id';
                break;
            case 2 :
                $sintax = 'SELECT banner_id, 
                            wm_centerbanner.franchise_id, 
                            wm_franchise.name AS franchise_name,
                            image_banner, 
                            sort, 
                            wm_centerbanner.is_active
                            FROM wm_centerbanner
                            JOIN wm_franchise ON wm_franchise.franchise_id = wm_centerbanner.franchise_id';
                break;
            case 3 : 
                $sintax = 'SELECT banner_id, 
                            wm_leftbanner.franchise_id, 
                            wm_franchise.name AS franchise_name,
                            image_banner, 
                            sort, 
                            wm_leftbanner.is_active
                            FROM wm_leftbanner
                            JOIN wm_franchise ON wm_franchise.franchise_id = wm_leftbanner.franchise_id';
                break;
            case 4 :   
                $sintax = 'SELECT banner_id, 
                            wm_rightbanner.franchise_id, 
                            wm_franchise.name AS franchise_name,
                            image_banner, 
                            wm_rightbanner.is_active
                            FROM wm_rightbanner
                            JOIN wm_franchise ON wm_franchise.franchise_id = wm_rightbanner.franchise_id';
                break;
            case 0 :   
                $sintax = 'SELECT banner_id, 
                            wm_premiumbanner.franchise_id, 
                            wm_franchise.name AS franchise_name,
                            image_banner, 
                            wm_premiumbanner.is_active
                            FROM wm_premiumbanner
                            JOIN wm_franchise ON wm_franchise.franchise_id = wm_premiumbanner.franchise_id';
                break;
            
        endswitch;

        $query = $this->multiple_db_model->custom_query($sintax, "ayowaral");

        if ($query->num_rows() > 0) {

            $result = $query->result();

            $attr = array(
                            'banner'    => $result,
                            'param'     => $param
            );

            echo json_encode($attr);

        } else {

            echo json_encode('error-null');
        }
    }
    // End of function get_banner

    /**
     * @param post => id
     * @param post => param
     */
    public function get_data_banner() {

        $id = $this->input->post('id');
        $param = $this->input->post('param');

        switch ($param) :

            case 1 :
                $sintax = 'SELECT banner_id, 
                            wm_topbanner.franchise_id, 
                            wm_franchise.name AS franchise_name,
                            image_banner, 
                            wm_topbanner.is_active
                            FROM wm_topbanner
                            JOIN wm_franchise ON wm_franchise.franchise_id = wm_topbanner.franchise_id
                            WHERE banner_id = ' . $id;

                break;
            case 2 :
                $sintax = 'SELECT banner_id, 
                            wm_centerbanner.franchise_id, 
                            wm_franchise.name AS franchise_name,
                            image_banner, 
                            sort, 
                            wm_centerbanner.is_active
                            FROM wm_centerbanner
                            JOIN wm_franchise ON wm_franchise.franchise_id = wm_centerbanner.franchise_id
                            WHERE banner_id = ' . $id;

                break;
            case 3 : 
                $sintax = 'SELECT banner_id, 
                            wm_leftbanner.franchise_id, 
                            wm_franchise.name AS franchise_name,
                            image_banner, 
                            sort, 
                            wm_leftbanner.is_active
                            FROM wm_leftbanner
                            JOIN wm_franchise ON wm_franchise.franchise_id = wm_leftbanner.franchise_id
                            WHERE banner_id = ' . $id;

                break;
            case 4 :   
                $sintax = 'SELECT banner_id, 
                            wm_rightbanner.franchise_id, 
                            wm_franchise.name AS franchise_name,
                            image_banner, 
                            wm_rightbanner.is_active
                            FROM wm_rightbanner
                            JOIN wm_franchise ON wm_franchise.franchise_id = wm_rightbanner.franchise_id
                            WHERE banner_id = ' . $id;
                break;
            case 0 :   
                $sintax = 'SELECT banner_id, 
                            wm_premiumbanner.franchise_id, 
                            wm_franchise.name AS franchise_name,
                            image_banner, 
                            wm_premiumbanner.is_active
                            FROM wm_premiumbanner
                            JOIN wm_franchise ON wm_franchise.franchise_id = wm_premiumbanner.franchise_id
                            WHERE banner_id = ' . $id;
                break;
            
        endswitch;

        $query = $this->multiple_db_model->custom_query($sintax, "ayowaral")->row_array();

        $attr = array(
                        'banner' => $query,
                        'path'  => substr($this->get_path_param($param), 2),
                        'param' => $param
        );

        $this->load->view('ayowaral/banner/get-banner', $attr);
    }
    // End of function get_data_banner

    /**
     * @param post => id
     * @param post => status
     * @param post => param
     */
    public function update_status() {

        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $param = $this->input->post('param');

        $table = $this->get_table_param($param);

        $this->multiple_db_model->custom_query("UPDATE " . $table . " SET is_active = " . $status . "
                                                WHERE banner_id = " . $id, "ayowaral");
    }
    // End of function update_status

    /**
     * @param slug => param
     * @return => string
     */
    public function get_table_param($param) {

        switch ($param) : 
            case 1 : 
                $table = 'wm_topbanner';
                break;
            case 2 : 
                $table = 'wm_centerbanner';
                break; 
            case 3 : 
                $table = 'wm_leftbanner';
                break;
            case 4 : 
                $table = 'wm_rightbanner';
                break; 
            case 0 : 
                $table = 'wm_premiumbanner';
                break;
        endswitch;

        return $table;
    }
    // End of function get_table_param

    /**
     * @param slug => param
     * @return => string
     */
    public function get_path_param($param) {
    
        switch ($param) : 
            case 1 : 
                $path = $this->topBannerPath;
                break;
            case 2 : 
                $path = $this->centerBannerPath;
                break; 
            case 3 : 
                $path = $this->leftBannerPath;
                break;
            case 4 : 
                $path = $this->rightBannerPath;
                break; 
            case 0 : 
                $path = $this->premiumBannerPath;
                break;
        endswitch;

        return $path;
    }
    // End of function get_path_pram

    /**
     * @param post => banner_id
     * @param post => param
     * @param post => file
     */
	function upload_banner() {

        $bannerId = $this->input->post('banner_id');
        $param = $this->input->post('param');

        $path = $this->path;

		$config['upload_path'] = $path;
        $config['allowed_types'] = 'jpeg|jpg|png|gif';
         
        $this->load->library('upload', $config);

        if (! $this->upload->do_upload("file")) {
            echo 'error';
        } else {

            $imageBanner = $this->upload->data('file_name');

            $table = $this->get_table_param($param);

            $query = $this->db->query("SELECT image_banner
                                                            FROM " . $table . "
                                                            WHERE banner_id = " . $bannerId, "ayowaral")->row_array();

            $imageBannerBefore = $query['image_banner'];

            if ($imageBannerBefore != '') {
                unlink($path . $imageBannerBefore);
            }
            
            $this->db->query("UPDATE " . $table . " SET image_banner = '" . $imageBanner . "'
                                                    WHERE banner_id = " . $bannerId, "ayowaral");

            echo 'success';
        }
	}
	// End of function upload_banner

    /**
     * @param post => file
     * @param post => franchise_id
     * @param post => param
     */
    public function insert_banner() {

        $franchiseId = $this->input->post('franchise_id');
        $param = $this->input->post('param');

        $table = $this->get_table_param($param);

        $checkDuplicate = $this->multiple_db_model->custom_query("SELECT banner_id
                                                                FROM " . $table . "
                                                                WHERE franchise_id = " . $franchiseId, "ayowaral");

        if ($checkDuplicate->num_rows() > 0) {
            echo 'error-duplicate';
        } else {

            $path = $this->get_path_param($param);

            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpeg|jpg|png|gif';
            
            $this->load->library('upload', $config);

            if (! $this->upload->do_upload("file")) {
                echo 'error';
            } else {

                $imageBanner = $this->upload->data('file_name');

                // Premium Banner
                if ($param == 0) {
                    $count = $this->multiple_db_model->custom_query("SELECT banner_id
                                                                    FROM " . $table, "ayowaral")->num_rows();

                    $sort = $count + 1;

                    $this->multiple_db_model->custom_query("INSERT INTO " . $table . " (franchise_id, image_banner, sort, is_active) VALUES
                                                            (" . $franchiseId . ", '" . $imageBanner . "', " . $sort . ", 1)", "ayowaral");

                } else {

                    $this->multiple_db_model->custom_query("INSERT INTO " . $table . " (franchise_id, image_banner, is_active) VALUES
                                                            (" . $franchiseId . ", '" . $imageBanner . "', 1)", "ayowaral");
                }

                echo 'success';
            }

        }
    }
    // End of function insert_banner

    /**
     * @param post => id
     * @param post => param
     */
    public function delete_banner() {

        $id = $this->input->post('id');
        $param = $this->input->post('param');

        $table = $this->get_table_param($param);
        $path = $this->get_path_param($param);

        $query = $this->multiple_db_model->custom_query("SELECT image_banner
                                                        FROM " . $table . "
                                                        WHERE banner_id = " . $id, "ayowaral")->row_array();
        
        $imageBanner = $query['image_banner'];

        if ($imageBanner != '') {
            unlink($path . $imageBanner);
        }

        $this->multiple_db_model->custom_query("DELETE FROM " . $table . " WHERE banner_id = " . $id, "ayowaral");

        echo 'success';
    }
    // End of function delete_banner

    /**
     * @param post => banner
     */
    public function set_sorting_banner() {

        $banner = $this->input->post('banner');

        $i = 1;
        foreach ($banner as $name) : 

            $name = str_replace('&amp;', '&', $name);

            $this->multiple_db_model->custom_query("UPDATE wm_premiumbanner
                                                    JOIN wm_franchise ON wm_franchise.franchise_id = wm_premiumbanner.franchise_id
                                                    SET sort = " . $i . "
                                                    WHERE wm_franchise.name = '" . $name . "'", "ayowaral");

            $i++;
        endforeach;

    }
    // End of function set_sorting_banner

}

/*
	End of class Ayowaral_banner
	End of file Ayowaral_banner.php
	Location: ./application/controllers/Ayowaral_banner.php
*/