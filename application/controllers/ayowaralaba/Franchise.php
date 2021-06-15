<?php 
defined("BASEPATH") OR exit('No direct script allowed');

class Franchise extends CI_Controller {

    private $franchiseId = 2;
    private $videosPath = 'http://localhost/duniafranchise/images/franchise/videos/';
    // private $videosPath = 'https://duniafranchise.com/images/franchise/videos/';

    public function index() {
        $base = 'https://duniafranchise.com/ayowaral-images/';
        // top banner 
        $topBanner = $this->db->query("SELECT image_banner, franchise_id
                                            FROM wm_topbanner
                                            WHERE is_active = 1");

        if ($topBanner->num_rows() > 0) {
            foreach ($topBanner->result() as $tp) {
                $topImg[] = $base . 'topbanner/' . $tp->image_banner;
                $topId[] = $tp->franchise_id;
            }
        }

        $firstTopImg = $topImg[0];
        // end top banner

        //center banner
        $center = $this->db->query("SELECT image_banner, franchise_id
                                        FROM wm_centerbanner
                                        WHERE is_active = 1
                                        ORDER BY RAND()
                                        LIMIT 2");

        if ($center->num_rows() > 0) {
            foreach ($center->result() as $c) {
                $centerImg[]    = $base . 'centerbanner/' . $c->image_banner;
                $centerId[]     = $c->franchise_id;
            }
        }
        // end center banner

        $attr['title']      = 'Daftar franchise';
        $attr['centerImg']  = $centerImg;
        $attr['centerId']   = $centerId;

        $this->template_lib->ayo_header($attr);
        $this->template_lib->ayo_top_banner($attr, 'ayowaral/home/topBanner');
        $this->template_lib->ayo_main_content($attr, 'ayowaral/franchise/mainContent');
        $this->template_lib->ayo_main_content($attr, 'ayowaral/franchise/rightContent');
        $this->template_lib->ayo_footer($attr);
    }

    public function get_franchise($sorting, $page) {
        $perPage = 24;
        if ($page != 0) {
            $page = ($page - 1) * $perPage;
        }

        // condition sorting
        switch ($sorting) {
            case '1':
                $where = " ORDER BY hits DESC";
                break;

            case '2':
                $where = ' ORDER BY hits ASC';
                break;

            case '3':
                $where = ' ORDER BY franchise_name ASC';
                break;

            case '4':
                $where = ' ORDER BY franchise_name DESC';
                break;
            
            default:
                $where = " ORDER BY hits DESC";
                break;
        }

        $all = $this->db->query("SELECT id 
                                        FROM franchise
                                        WHERE status = 1")->num_rows();

        $query = $this->db->query("SELECT id, franchise_name, text, thumbnail
                                        FROM franchise
                                        WHERE status = 1
                                        $where
                                        LIMIT $perPage OFFSET $page");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $fName[]    = $row->franchise_name;
                $fId[]      = $row->id;
                $fImg[]     = 'https://duniafranchise/images/franchise/thumbnail/' . $row->thumbnail;
                $replace    = $row->text;
                $sub        = substr($replace, 90, strlen($replace));
                $fix        = str_replace($sub, '...', $replace);
                $fText[]    = $fix;
            }
        }

        //pagination configuration
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'ayowaralaba/franchise';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $all;
        $config['per_page'] = $perPage;

        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close']  = '<span aria-hidden="true"></span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close']  = '</span></li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close']  = '</span></li>';

        $this->pagination->initialize($config);

        $pagination = $this->pagination->create_links();

        $data['pagination']     = $pagination;
        $data['fName']          = $fName;
        $data['fText']          = $fText;
        $data['fId']            = $fId;
        $data['fImg']           = $fImg;

        echo json_encode($data);
    }
    // end of function get_franchise

    /**
    * @param id
    */
    public function detail_brand($id) {

        $query = $this->db->query("SELECT franchise_name, slug, thumbnail, id, invesment, text, description
                                        FROM franchise
                                        WHERE status = 1
                                        AND id = $id");

        $data = array();
        if ($query->num_rows() > 0) {

            foreach ($query->result() as $row) {
                $data['fName']    = $row->franchise_name;
                $data['fSlug']    = $row->slug;
                $data['fImg']     = 'https://duniafranchise.com/images/franchise/thumbnail/' . $row->thumbnail;
                $data['fText']    = $row->text;
                $data['fId']      = $row->id;
                $data['fInvest']  = $row->invesment;
                $data['desc']     = $row->description;
                $target_id = $row->id;
            }

            $queryPhone = $this->db->query("SELECT phone, title 
                                                    FROM franchise_phone 
                                                    WHERE franchise_id = $target_id");

            if ($queryPhone->num_rows() > 0) {
                foreach ($queryPhone->result() as $p) {
                    $ph[] = $p->phone;
                    $ar[] = $p->title;
                }

                $data['phone'] = $ph;
                $data['area']  = $ar;
            }
        } else {
            $err = 'brand-null';

            $data['message'] = $err;
        }

        // top banner 
        $topBanner = $this->db->query("SELECT image_banner, franchise_id
                                            FROM wm_topbanner
                                            WHERE is_active = 1");

        if ($topBanner->num_rows() > 0) {
            foreach ($topBanner->result() as $tp) {
                $topImg[] = base_url('ayowaral-images/topbanner/') . $tp->image_banner;
                $topId[] = $tp->franchise_id;
            }
        }

        $firstTopImg = $topImg[0];
        // end top banner

        //center banner
        $center = $this->db->query("SELECT image_banner, franchise_id
                                        FROM wm_centerbanner
                                        WHERE is_active = 1
                                        ORDER BY RAND()
                                        LIMIT 2");

        if ($center->num_rows() > 0) {
            foreach ($center->result() as $c) {
                $centerImg[]    = base_url('ayowaral-images/centerbanner/') . $c->image_banner;
                $centerId[]     = $c->franchise_id;
            }
        }
        // end center banner

        $attr['title']      = 'Daftar franchise';
        $attr['centerImg']  = $centerImg;
        $attr['centerId']   = $centerId;
        $attr['detail']     = $data;

        $this->template_lib->ayo_header($attr);
        $this->template_lib->ayo_top_banner($attr, 'ayowaral/home/topBanner');
        $this->template_lib->ayo_main_content($attr, 'ayowaral/franchise/detailBrand');
        $this->template_lib->ayo_main_content($attr, 'ayowaral/franchise/rightContent');
        $this->template_lib->ayo_footer($attr);
    }

    /**
     * @param id
     */
    public function view_brand()
    {
        $id = $_POST['id']; // detail brand to view really detail brand

        $query = $this->db->query("SELECT franchise_name, slug, thumbnail, id, invesment, text, description
                                        FROM franchise
                                        WHERE status = 1
                                        AND id = $id");

        $data = array();
        if ($query->num_rows() > 0) {

            foreach ($query->result() as $row) {
                $data['fName']    = $row->franchise_name;
                $data['fSlug']    = $row->slug;
                $data['fImg']     = base_url('images/franchise/thumbnail/') . $row->thumbnail;
                $data['fText']    = $row->text;
                $data['fId']      = $row->id;
                $data['fInvest']  = $row->invesment;
                $target_id = $row->id;
            }

            $queryPhone = $this->db->query("SELECT phone, title 
                                                    FROM franchise_phone 
                                                    WHERE franchise_id = $target_id");

            if ($queryPhone->num_rows() > 0) {
                foreach ($queryPhone->result() as $p) {
                    $ph[] = $p->phone;
                    $ar[] = $p->title;
                }

                $data['phone'] = $ph;
                $data['area']  = $ar;
            }

            // get description 
            $desc = $this->get_videos();
            $data['desc'] = $desc;
        } else {
            $err = 'brand-null';

            $data['message'] = $err;
        }
        echo json_encode($data);
    }

    public function get_videos()
    {

        $query = $this->db->query("SELECT description, videos
								FROM franchise
								WHERE id = " . $this->franchiseId)->row_array();

        $videos = $query['videos'];

        $description = str_replace('</p>', '', str_replace('<p>', '', $query['description']));
        $description = str_replace('<br />', '', $description);

        if ($videos != '' || !empty($videos)) {
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

        return $description;
    }
    // End of function get_content

    function get_string_between($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
    // End of function get_string_between

    function replaced($img, $video)
    {
        $html = '<table class="video-content"><tbody><tr><td background="' . $img . '" style="background-size:100%; text-align:center">';
        $html .= '<video class="responsive-video" controls controlsList="nodownload"><source src="' . $this->videosPath . $video . '" type="video/webm"></video>';
        $html .= '</td></tr></tbody></table>';
        return $html;
    }
	// End of function replaced
}
?>