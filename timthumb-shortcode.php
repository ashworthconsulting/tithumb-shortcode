<?php
/*
 * TimThumb Shortcode
 */
function timthumb_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'width' => '894',
        'height' => '',
        'crop' => '',
        'filter' => '',
        'sharpen' => '',
        'zoom' => '',
        'quality' => '90',
        'align' => 'left',
        'alt' => '',
        'title' => '',
        'caption' => '',
        'link' => '',
        'hspace' => '0',
        'vspace' => '0',
    ), $atts ) );

    // Path to the timthumb.php directory
    if($_SERVER['SERVER_PORT'] == '80'){
        $protocol = 'http://';
    }else{
        $protocol = 'https://';
    }
    $path = $protocol . $_SERVER['HTTP_HOST'] . get_template_directory_uri();

    $ext = strtolower(pathinfo(trim($content), PATHINFO_EXTENSION));

    if (($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif")) {
        $myimage = trim($content);
        if($width)   $myimage .= '&w='  . $width;
        if($height)  $myimage .= '&h='  . $height;
        if($crop)    $myimage .= '&a='  . $crop;
        if($filter)  $myimage .= '&f='  . $filter;
        if($sharpen) $myimage .= '&s='  . $sharpen;
        if($zoom)    $myimage .= '&zc=' . $zoom;
        if($quality) $myimage .= '&q='  . $quality;

        if ($caption != "") {

            if ($align == "center") $align = "wp-caption aligncenter";
            if ($align == "left") $align = "wp-caption alignleft";
            if ($align == "right") $align = "wp-caption alignright";

            return '<div class="'.$align.'" style="width: '.$width.'px;"><img src="'.$path.'/timthumb.php?src='.$myimage.'" alt="'.$alt.'" title="'.$title.'" width="'.$width.'" /><p class="wp-caption-text">'.$caption.'</p></div>';

        } else if ($caption == "") {

            if ($align == "center") $align = "aligncenter";
            if ($align == "left") $align = "alignleft";
            if ($align == "right") $align = "alignright";
            return '<img src="'.$path.'/timthumb.php?src='.$myimage.'" alt="'.$alt.'" title="'.$title.'" width="'.$width.'" hspace="'.$hspace.'" vspace="'.$vspace.'" class="'.$align.'" />';
        }
    }

    else {
        return '<img class="'.$align.'" src="'.$path.'/error.jpg" alt="Error Image" width="'.$width.'" />';
    }
}
add_shortcode('image', 'timthumb_shortcode');