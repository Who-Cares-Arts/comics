<?php
    function img_favicon($site = "web", $ext = "png"){
        $ext = ".".$ext;
        $site = $site."/";
        return img_getImage($site."favicon".$ext);
    }
    function img_logo($site = "web", $nav = FALSE, $ext = "gif"){
        $ext = ".".$ext;
        if($nav)
            $ext = "-nav".$ext;
         $site = $site."/";
        return img_getImage($site."/logo/logo".$ext);
    }
    function img_character($name, $site = "web", $ext = "gif"){
        $ext = ".".$ext;
        return img_getImage($site."/characters/".$name.$ext);
    }
    function img_banner($section, $subSection, $subject, $ext = "gif"){
        $ext = ".".$ext;
        if($subSection !== NULL)
            $subSection = $subSection."/";
        return img_getImage($section.'/banners/'.$subSection.$subject.$ext);
    }
    function img_news($month, $day, $year, $article = "00", $index = 0, $ext = "gif"){
        $ext = ".".$ext;
        return img_getImage("news/".$year."/".$article.$month.$day.$index.$ext);
    }
    function img_comic($series, $issue, $page, $ext = "png"){
        $ext = ".".$ext;
        return img_getImage("comics/$series/$issue/$page.$ext");
    }
    function img_series($series, $ext = "thumbs"){
        $extension = ".".$ext;
        if(strpos($ext, ".thumb") !== FALSE)
            return img_getImage("$series/series.$extension");
        $extension = "$ext.gif";
        return img_getImage("$series/series-$extension");
    }
    function img_getImage($subPath){
        return 'http://img.whocaresarts.com/'.$subPath;
    }
?>