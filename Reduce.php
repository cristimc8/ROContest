<?php
/*function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}*/
ini_set('memory_limit', '256M');
function thumbnail( $img, $source, $dest, $maxw, $maxh ) {
    $jpg = $source.$img;

    if( $jpg ) {
        list( $width, $height  ) = getimagesize( $jpg );
        $source = imagecreatefromjpeg( $jpg );

        if( $maxw >= $width && $maxh >= $height ) {
            $ratio = 1;
        }elseif( $width > $height ) {
            $ratio = $maxw / $width;
        }else {
            $ratio = $maxh / $height;
        }

        $thumb_width = round( $width * $ratio );
        $thumb_height = round( $height * $ratio );

        $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );
        imagecopyresampled( $thumb, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height );

        $path = $dest.$img."_thumb.jpg";
        $_SESSION['path'] = $path;
        imagejpeg( $thumb, $path, 75 );
    }
    imagedestroy( $thumb );
    imagedestroy( $source );
}

?>
