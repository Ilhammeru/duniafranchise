<?php 
defined("BASEPATH") OR exit('No direct script allowed');

class Home extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        // center banner limit 1
        $base = 'https://duniafranchise.com/ayowaral-images/';
        $baseImg = 'https://duniafranchise.com/images/';
        
        $c1 = $this->db->query("SELECT image_banner, franchise_id
                                    FROM wm_centerbanner
                                    WHERE is_active = 1
                                    ORDER BY RAND()
                                    LIMIT 1");

        if ($c1->num_rows() > 0) {
            foreach ($c1->result() as $cb1) {
                $cImg1    = $base . 'centerbanner/' . $cb1->image_banner;
                $cId1     = $cb1->franchise_id;
            } 
        } else {
            $cId1 = 0;
            $cImg1 = '';
        }
        // end center banner limit 1

        // news 
        $news1 = $this->db->query("SELECT id, title, updated_time, content 
                                        FROM article
                                        WHERE status = 1
                                        LIMIT 3 OFFSET 0");

        $news2 = $this->db->query("SELECT id, title, updated_time, content 
                                        FROM article
                                        WHERE status = 1
                                        LIMIT 3 OFFSET 3");

        if ($news1->num_rows() > 0) {
            foreach ($news1->result() as $nw1) {
                $nwTitle[]  = $nw1->title;
                $nwId[]     = $nw1->id;
                $nwTime[]   = change_indo_calendar(date('Y-m-d', strtotime($nw1->updated_time)), 'd m Y');
                
                $replaceContent = str_replace('<p style="text-align: justify;">', '', $nw1->content);
                $replaceContentt = str_replace('<strong>', '', $replaceContent);
                $replaceContenttt = str_replace('<li>', '', $replaceContentt);
                $replaceContentttt = str_replace(
                '<ol style="text-align: justify;" start="3">', '', $replaceContenttt);
                $replaceContentttt = str_replace('<ol style="text-align: justify;" start="3">', '', $replaceContenttt);
                $start = 50;
                $last = strlen($replaceContentttt);
                $cut = substr($replaceContentttt, $start, $last);
                $fixContent = str_replace($cut, '...', $replaceContentttt);
                $nwContent[] = $fixContent;
            }
        } 
        
        if ($news2->num_rows() > 0) {
            foreach ($news2->result() as $nw2) {
                $nwTitle2[]  = $nw2->title;
                $nwId2[]     = $nw2->id;
                $nwTime2[]   = change_indo_calendar(date('Y-m-d', strtotime($nw2->updated_time)), 'd m Y');

                $replaceContent2 = str_replace('<p style="text-align: justify;">', '', $nw2->content);
                $replaceContentt2 = str_replace('<strong>', '', $replaceContent2);
                $start2 = 50;
                $last2 = strlen($replaceContentt2);
                $cut2 = substr($replaceContentt2, $start2, $last2);
                $fixContent2 = str_replace($cut2, '...', $replaceContentt2);
                $nwContent2[] = $fixContent2;
            }
        }
        // end news

        //center banner limit 4
        $center4 = $this->db->query("SELECT image_banner, franchise_id
                                            FROM wm_centerbanner
                                            WHERE is_active = 1
                                            AND franchise_id <> $cId1
                                            LIMIT 4");

        if ($center4->num_rows() > 0) {
            foreach ($center4->result() as $c4) {
                $cImg4[]    = $base . 'centerbanner/' . $c4->image_banner;
                $cId4[]     = $c4->franchise_id;
            }
        } else {
            $cId4[] = 0;
            $cImg4[] = '';
        }
        // end center banner limit 4

        // thumbnail franchise
        $thumb = $this->db->query("SELECT thumbnail, id
                                        FROM franchise
                                        WHERE status = 1
                                        LIMIT 8");

        if ($thumb->num_rows() > 0) {
            foreach ($thumb->result() as $tm) {
                $thumbImg[] = $baseImg . 'franchise/thumbnail/' . $tm->thumbnail;
                $thumbId[]  = $tm->id;
            }
        }
        // end thumbnail franchise

        // last center banner
        $wherenot = ' is_active = 1 ';
        for ($xx = 0; $xx < count($cId4); $xx++) {
            $wherenot .= " AND franchise_id <> $cId4[$xx]";
        }

        $centerLast = $this->db->query("SELECT image_banner, franchise_id
                                            FROM wm_centerbanner
                                            WHERE $wherenot");

        if ($centerLast->num_rows() > 0) {
            foreach ($centerLast->result() as $cl) {
                $clImg[]    = $base . 'centerbanner/' . $cl->image_banner;
                $clId[]     = $cl->franchise_id;
            }
        } else {
            $clImg[] = '';
            $clId[] = 0;
        }
        // end last center banner

        $attr['title']          = "Ayowaralaba";
        $attr['cImg1']          = $cImg1;
        $attr['cId1']           = $cId1;
        $attr['nwTitle']        = $nwTitle;
        $attr['nwId']           = $nwId;
        $attr['nwTime']         = $nwTime;
        $attr['nwContent']      = $nwContent;
        $attr['nwTitle2']       = $nwTitle2;
        $attr['nwId2']          = $nwId2;
        $attr['nwTime2']        = $nwTime2;
        $attr['nwContent2']     = $nwContent2;
        $attr['cImg4']          = $cImg4;
        $attr['cId4']           = $cId4;
        $attr['thumbImg']       = $thumbImg;
        $attr['thumbId']        = $thumbId;      
        $attr['clImg']          = $clImg;
        $attr['clId']           = $clId;

        $this->template_lib->ayo_header($attr);
        $this->template_lib->ayo_top_banner($attr, 'ayowaral/home/topBanner');
        //$this->template_lib->ayo_main_content($attr, 'ayowaral/home/leftBanner'); // left banner
        $this->template_lib->ayo_main_content($attr, 'ayowaral/home/mainContent'); // main content
        $this->template_lib->ayo_main_content($attr, 'ayowaral/home/rightBanner'); // right banner
        $this->template_lib->ayo_footer($attr);
    }
}
