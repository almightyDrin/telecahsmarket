<?php
require(BASEPATH.'helpers/string_helper.php');
/**
 * It is used to encode html entities and to display new line properly
 * 
 * @param  string $string
 * @return string
 */
function entity_nl($string){
    return nl2br(htmlentities($string,ENT_QUOTES,'UTF-8'));
}
/**
 * It is used to encode html entities
 * 
 * @param  string $string
 * @return string
 */
function entity($string){
    return htmlentities($string,ENT_QUOTES,'UTF-8');
}
/**
 * It is used to truncate strings
 * 
 * @param string $string, integer $desired_length
 * @return string
 */
function truncateString($varname, $maxlength = 30){
    if (strlen($varname) > $maxlength) {
        $truncated = substr($varname, 0, ($maxlength - 3));
        $truncated .= '...';
    } else {
        $truncated = $varname;
    }
    return $truncated;
}
/**
 * It is used to display array in neat form
 * 
 * @param array $array
 * @echo $string
 */
function print_return($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
/**
 * It is used to remove all white spaces
 * 
 * @param array $array
 * @echo $string
 */
function uscore_spaces($string){
    return $string = str_replace(' ', '_', $string);
}
/**
 * It is used replace youtube links to embed links
 * 
 * @param array $array
 * @echo $string
 */
function yt_embed($string){
    return $string = preg_replace('#(.*?)(?:href="https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch?.*?v=))([\w\-]{10,12}).*#x', 'http://www.youtube.com/embed/$2', $string);
}
/**
 * It is used to get the video id / video key from youtube link
 * 
 * @param array $array
 * @echo $string
 */
function yt_vid_id($string){
    $link_string = explode('v=', $string);
    return $link_string[1];
}