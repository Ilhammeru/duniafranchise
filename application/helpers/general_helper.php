<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// back Button Handle
if(! function_exists('backButtonHandle')) {

    function backButtonHandle(){
        $CI =& get_instance();
        $CI->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $CI->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $CI->output->set_header('Pragma: no-cache');
        $CI->output->set_header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    }

    function change_indo_calendar($date, $format) {
        $expDate = explode('-', $date);
        $month = $expDate[1];
        $day = $expDate[2];
        $year = $expDate[0];

        switch ($month) {
            case '01':
                $m = 'Januari';
                break;

            case '02':
                $m = 'Febuari';
                break;

            case '03': 
                $m = 'Maret';
                break;

            case '04':
                $m = 'April';
                break;

            case '05':
                $m = 'Mei';
                break;

            case '06':
                $m = 'Juni';
                break;

            case '07':
                $m = 'Juli';
                break;

            case '08':
                $m = 'Agustus';
                break;

            case '09': 
                $m = 'September';
                break;

            case '10': 
                $m = 'Oktober';
                break;

            case '11':
                $m = 'November';
                break;

            case '12': 
                $m = 'Desember';
                break;
            
            default:
                $m = 'Januari';
                break;
        }

        if ($format == 'Y m d') {
            $new = $year . ' ' . $m . ' ' . $day;
        } else if ($format == 'Y-m-d') {
            $new = $year . '-' . $m . '-' . $day;
        } else if ($format == 'd m Y') {
            $new = $day . ' ' . $m . ' ' . $year;
        }

        return $new;
    }

}

