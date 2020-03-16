<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('load_script'))
{
    
    function load_script($current_page)
    {
        switch ($current_page) {
            case '':
                echo '';
                break;
            case 'home':
                // echo '<script async="" src="./assets/js/home.js"></script>';
                echo '';
                break;
            case 'customers':
                echo '<script async defer src="./assets/js/customer.js"></script>';
                break;
            case 'telesales':
                echo '<script async defer src="./assets/js/telesales.js"></script>';
                break;
            case 'show_telesale':
                echo '<script async defer src="./assets/js/telesales.js"></script>';
                break;
            case 'users':
                echo '<script async defer src="./assets/js/users.js"></script>';
                break;
            case 'admin':
                echo '<script async defer src="./assets/js/login.js"></script>';
                break;
            case 'login':
                echo '<script async defer src="./assets/js/login.js"></script>';
                break;
            
            default:
                echo ' ';
                break;
        }
    }
}
if ( ! function_exists('load_css'))
{
    
    function load_css($current_page)
    {
        switch ($current_page) {
            case '':
                echo '';
                break;
            case 'home':
                // echo '<link rel="stylesheet" href="./assets/css/home.css">';
                echo '';
                break;
            case 'customers':
                echo '<link rel="stylesheet" rel="preload" crossorigin="anonymous" href="./assets/css/cms/cms_customers.css" as="style" onload="this.rel = \'stylesheet\'">';
                break;
            case 'telesales':
                echo '<link rel="stylesheet" rel="preload" crossorigin="anonymous" href="./assets/css/cms/cms_telesales.css" as="style" onload="this.rel = \'stylesheet\'">';
                break;
            case 'results':
                echo '<link rel="preload" crossorigin="anonymous" href="./assets/css/results.css" as="style" onload="this.rel = \'stylesheet\'">';
                echo '<noscript><link rel="stylesheet" href="./assets/css/results.css"></noscript>';
                break;
            
            default:
                echo ' ';
                break; 
        }
    }
}

if ( ! function_exists('load_meta') ) {
    
    function load_meta($current_page) {

        if ($current_page == '' || $current_page == 'home') {
            echo '
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta property="og:title" content="website nonton pertandingan basket online terbaik no buffer">
                <meta property="og:type" content="blog">
                <meta property="og:site_name" content="website nonton pertandingan basket online terbaik no buffer">
                <meta property="og:description" content="situs nonton online pertandingan basket dan berbagai macam jenis olahraga lain seperti pertandingan sepak bola, motogp, f1, dan ufc, Ayo nonton disini.">
                <meta name="google-site-verification" content="gQaufLB6HP-KJzCTZpniucaM6Vte3_UodUW4IRvpf-Y" />
                <meta name="keywords" content="nonton online, nonton basket online, nonton pertandingan basket, nonton basket, basket online, streaming basket, streaming motogp, streaming pertandingan sepak bola, nonton bola online, nonton pertandingan bola online, nonton basket">
                <meta name="description" content="situs nonton online pertandingan basket dan berbagai macam jenis olahraga lain seperti pertandingan sepak bola, motogp, f1, dan ufc, Ayo nonton disini.">
                <meta name="keywords" content="Nonton Piala Dunia">
                <meta name="description" content=" Nonton Gratis Piala Dunia">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name="msapplication-TileColor" content="#ffffff">
                <meta name="theme-color" content="#ffffff">
                <meta name="google-site-verification" content="mHStTI1Wv3Gnnqvqo8jGuq56f67tWKm_s5KBx9P-P-M">';
        } else {
            echo '
                <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
                <meta name="keywords" content="prediksicepat, live streaming, live streaming bola, live stream sports, live streaming bein sport, live soccer tv, live football streaming, nonton bola, afc u-19, premier league, champions league, bundesliga, serie a, la liga, uefa europa league, fifa world cup, liga 1, ligue 1, mls, f1, formula one, motogp, badminton, soccer, sport tv, Watch Live Football, Stream Free Online, yalla shoot" />
                <meta name="description" content=" Nonton Gratis Piala Dunia dong bro">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta property="og:image" content="../2.bp.blogspot.com/-rvWazcI4Rxg/Wx-SrgiP9uI/AAAAAAAACUA/__d2AG141d84fSVjWM3i_afEFn9xjQAxQCLcBGAs/s1600/bgwp.jpg">
                <meta name="theme-color" content="#ffffff">';
        }
    }
}

if ( ! function_exists('create_uid'))
{
    
    function create_uid(){
        return sprintf(
            '%08x-%04x-%04x-%02x%02x-%012x',
            mt_rand(),
            mt_rand(0, 65535),
            bindec(substr_replace(
                sprintf('%016b', mt_rand(0, 65535)), '0100', 11, 4)
            ),
            bindec(substr_replace(sprintf('%08b', mt_rand(0, 255)), '01', 5, 2)),
            mt_rand(0, 255),
            mt_rand()
        );
     }
}
