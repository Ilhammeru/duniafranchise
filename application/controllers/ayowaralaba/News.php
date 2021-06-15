<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class News extends CI_Controller {
    public function index() {
        $attr['title']      = 'Berita';
        $attr['col']        = 'col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10';

        $this->template_lib->ayo_header($attr);
        $this->template_lib->ayo_top_banner($attr, 'ayowaral/home/topBanner');
        $this->template_lib->ayo_main_content($attr, 'ayowaral/news/mainContent');
        $this->template_lib->ayo_main_content($attr, 'ayowaral/news/rightContent');
        $this->template_lib->ayo_footer($attr);
    }

    public function get_news($page) {
        $perPage = 20;
        if ($page != 0) {
            $page = ($page - 1) * $perPage;
        }

        $all = $this->db->query("SELECT id
                                        FROM article 
                                        WHERE status = 1")->num_rows();

        $query = $this->db->query("SELECT id, title, slug, thumbnail, content, updated_time
                                            FROM article 
                                            WHERE status = 1
                                            LIMIT $perPage OFFSET $page");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $id[]       = $row->id;
                $title[]    = $row->title;
                $slug[]     = $row->slug;
                $thumb[]    = base_url('images/article/thumbnail/') . $row->thumbnail;
                $time[]     = change_indo_calendar(date('Y-m-d', strtotime($row->updated_time)), 'd m Y');

                $replace    = str_replace('<p style="text-align: justify;">', '', $row->content);
                $start      = 60;
                $last       = strlen($row->content);
                $sub        = substr($replace, $start, $last);
                $change     = str_replace($sub, '...', $replace);
                $content[]  = $change;
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

        $data['idNews']     = $id;
        $data['titleNews']  = $title;
        $data['slugNews']   = $slug;
        $data['thumbNews']  = $thumb;
        $data['timeNews']   = $time;
        $data['contNews']   = $content; 
        $data['pagination'] = $pagination;

        echo json_encode($data);
    }
    // end of function get_news

    /**
    * @param id
    */
    public function detail_brand() {
        $id = $_POST['id'];

        $query = $this->db->query("SELECT title, slug, thumbnail, content, updated_time, creator
                                            FROM article 
                                            WHERE status = 1
                                            AND id = $id");

        if ($query->num_rows() > 0) {
            $result = $query->row_array();

            $data['title']      = $result['title'];
            $data['slug']       = $result['slug'];
            $data['image']      = base_url('images/article/thumbnail/') . $result['thumbnail'];
            $data['content']    = $result['content'];
            $data['time']       = change_indo_calendar(date('Y-m-d', strtotime($result['updated_time'])), 'd m Y');
            $creatorId          = $result['creator'];

            $queryCreator = $this->db->query("SELECT name 
                                                    FROM users
                                                    WHERE id = $creatorId")->row_array();

            $data['creator'] = $queryCreator['name'];
        }

        echo json_encode($data);
    }
    // end of function detail_brand
}
?>