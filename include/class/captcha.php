<?php

/**
 * 生成验证码类
 * Class class_captcha
 */
class class_captcha{
    // 图片宽度
    var $width = 80;

    // 图片高度
    var $height = 20;

    // 字体大小
    var $fontSize = '14,16';
    var $wordLength = '4,4';

    // 字体旋转
    var $fontAngle = '0,1';
    var $font = null;
    var $adden = 0.84;
    var $wang = 0;
    /**
     * 构造函数
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function __construct($info = array())
    {
        foreach($info as $key=>$val){
            $this->$key = $val;
        }

        $this->font = INCLUDE_PATH.'font/font.ttf';

    }

    /**
     * 运行并返回验证码的字符串
     * @return bool|string
     */
    function run(){
        // 取随机长度的 字符串
        mt_srand((double) microtime() * 1000000);

        if(strpos($this->wordLength , ',')){
            list($min , $max) = explode(',' , $this->wordLength);
            $length = mt_rand(intval(trim($min)), intval(trim($max)));
        }else{
            $length = intval($this->wordLength);
        }

        $word = $this->get_word($length);
        if (function_exists('imagecreatetruecolor'))
        {
            $img  = imagecreatetruecolor($this->width, $this->height);
        }
        elseif(function_exists('imagecreate'))
        {
            $img  = imagecreate($this->width , $this->height);
        }else{
            return false;
        }

        $direction=array('horizontal' , 'vertical' , 'ellipse' , 'ellipse2' , 'circle' , 'circle2' , 'rectangle' , 'diamond');
        $type = mt_rand(0, count($direction)-1);
        $start = array();
        $end = array();

        $start[] = mt_rand(80,200);
        $start[] = mt_rand(80,200);
        $start[] = mt_rand(80,200);
        $end[] = mt_rand(0,125);
        $end[] = mt_rand(0,125);
        $end[] = mt_rand(0,125);

        $this->step = 0;

        $this->fill($img , $direction[$type] , $start , $end );


        $this->writeString($img , $word);

        if($this->wang){
            $this->Background($img);
        }


        $this->img = $img;
        return implode('',$word);
    }
    // 输出验证码
    function display(){

        //$this->_wirteSinLine($img , imagecolorallocate($img , $start[0] , $end[1] , $start[2]) , $this->width);
        //$this->_wirteSinLine($img , imagecolorallocate($img , $start[1] , $end[2] , $start[0]) , $this->width);
        $img = $this->img;
        header('Expires: Thu, 01 Jan 1970 00:00:00 GMT');
        header('Cache-Control: private, no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0, max-age=0', false);
        header('Pragma: no-cache');


        $type = array('png' , 'gif' , 'jpeg' , 'bmp');
        foreach($type as $t){
            $func = 'image'.$t;
            if(function_exists($func)){
                header("Content-type: image/".$t);
                $func($img);
            }
        }
        imagedestroy($img);
    }

    /**
     * 写入字符串
     * @param $img 图片资源。
     * @param $word  字符串
     */
    function writeString($img , $word){
        list($sizeMin , $sizeMax) = explode(',' , $this->fontSize);
        list($angMin , $angMax)   = explode(',' , $this->fontAngle);
        $sizeMin = intval(trim($sizeMin));
        $sizeMax = intval(trim($sizeMax));
        $angMin = intval(trim($angMin));
        $angMax = intval(trim($angMax));
        $basex  = 10;
        $TPadden = $this->adden;

        foreach($word as $str){
            $fontsize = mt_rand($sizeMin , $sizeMax );
            $angle = mt_rand($angMin, $angMax);
            $fontcolor = array(mt_rand(125,255) , mt_rand(125,255) , mt_rand(125,255));
            $bound=$this->_calculateTextBox($fontsize , $angle , $this->font , $str);

            $color = imagecolorallocate($img , $fontcolor[0] , $fontcolor[1] , $fontcolor[2]);
            imagettftext($img, $fontsize , $angle , $basex, $bound['height'] , $color ,  $this->font, $str);
            $basex=$basex+$bound['width']*$TPadden-$bound['left'];///计算下一个左边距
        }
    }


    //画正弦干扰线
    private function _wirteSinLine( $img , $color , $w)
    {
        $h=$this->height;
        $h1=rand(-5,5);
        $h2=rand(-1,1);
        $w2=rand(10,15);
        $h3=rand(4,6);

        for($i=-$w/2;$i<$w/2;$i=$i+0.1)
        {
            $y=$h/$h3*sin($i/$w2)+$h/2+$h1;
            imagesetpixel($img,$i+$w/2,$y,$color);
            $h2!=0?imagesetpixel($img,$i+$w/2,$y+$h2,$color):null;
        }
    }

    /**
     *通过字体角度得到字体矩形宽度*
     *
     * @param int $font_size 字体尺寸
     * @param float $font_angle 旋转角度
     * @param string $font_file 字体文件路径
     * @param string $text 写入字符
     * @return array 返回长宽高
     */
    private function _calculateTextBox($font_size, $font_angle, $font_file, $text) {
        $box = imagettfbbox($font_size, $font_angle, $font_file, $text);

        $min_x = min(array($box[0], $box[2], $box[4], $box[6]));
        $max_x = max(array($box[0], $box[2], $box[4], $box[6]));
        $min_y = min(array($box[1], $box[3], $box[5], $box[7]));
        $max_y = max(array($box[1], $box[3], $box[5], $box[7]));

        return array(
            'left' => ($min_x >= -1) ? -abs($min_x + 1) : abs($min_x + 2),
            'top' => abs($min_y),
            'width' => $max_x - $min_x,
            'height' => $max_y - $min_y,
            'box' => $box
        );
    }

    function Background( $img ){
        $width = $this->width;
        $height = $this->height;
        $spc = mt_rand(8,13);
        $grey = imagecolorallocate($img, 211, 211, 211);
        for($i=0;$i<$width;$i=$i+$spc){
            imageline($img, $i , 0 , $i , $height , $grey);
        }
        for($i=0;$i<$height;$i=$i+$spc){
            imageline($img, 0 , $i , $width , $i , $grey);
        }
    }

    // 随机取一个数
    function get_word( $length ){
        //$str = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
        $str = '0123456789';
        mt_srand((double) microtime() * 1000000);
        $ret = array();

        // 随机写入
        for($i=0;$i<$length;$i++){
            $num = mt_rand(1, strlen($str));
            $ret[] = substr($str , $num-1 , 1);
        }
        return $ret;
    }

    /**
     * 按类型画矩形底色
     * @param $im
     * @param $direction
     * @param $start
     * @param $end
     */
    function fill($im,$direction,$start,$end) {
        switch($direction) {
            case 'horizontal':
                $line_numbers = imagesx($im);
                $line_width = imagesy($im);
                list($r1,$g1,$b1) = $this->hex2rgb($start);
                list($r2,$g2,$b2) = $this->hex2rgb($end);
                break;
            case 'vertical':
                $line_numbers = imagesy($im);
                $line_width = imagesx($im);
                list($r1,$g1,$b1) = $this->hex2rgb($start);
                list($r2,$g2,$b2) = $this->hex2rgb($end);
                break;
            case 'ellipse':
                $width = imagesx($im);
                $height = imagesy($im);
                $rh=$height>$width?1:$width/$height;
                $rw=$width>$height?1:$height/$width;
                $line_numbers = min($width,$height);
                $center_x = $width/2;
                $center_y = $height/2;
                list($r1,$g1,$b1) = $this->hex2rgb($end);
                list($r2,$g2,$b2) = $this->hex2rgb($start);
                imagefill($im, 0, 0, imagecolorallocate( $im, $r1, $g1, $b1 ));
                break;
            case 'ellipse2':
                $width = imagesx($im);
                $height = imagesy($im);
                $rh=$height>$width?1:$width/$height;
                $rw=$width>$height?1:$height/$width;
                $line_numbers = sqrt(pow($width,2)+pow($height,2));
                $center_x = $width/2;
                $center_y = $height/2;
                list($r1,$g1,$b1) = $this->hex2rgb($end);
                list($r2,$g2,$b2) = $this->hex2rgb($start);
                break;
            case 'circle':
                $width = imagesx($im);
                $height = imagesy($im);
                $line_numbers = sqrt(pow($width,2)+pow($height,2));
                $center_x = $width/2;
                $center_y = $height/2;
                $rh = $rw = 1;
                list($r1,$g1,$b1) = $this->hex2rgb($end);
                list($r2,$g2,$b2) = $this->hex2rgb($start);
                break;
            case 'circle2':
                $width = imagesx($im);
                $height = imagesy($im);
                $line_numbers = min($width,$height);
                $center_x = $width/2;
                $center_y = $height/2;
                $rh = $rw = 1;
                list($r1,$g1,$b1) = $this->hex2rgb($end);
                list($r2,$g2,$b2) = $this->hex2rgb($start);
                imagefill($im, 0, 0, imagecolorallocate( $im, $r1, $g1, $b1 ));
                break;
            case 'square':
            case 'rectangle':
                $width = imagesx($im);
                $height = imagesy($im);
                $line_numbers = max($width,$height)/2;
                list($r1,$g1,$b1) = $this->hex2rgb($end);
                list($r2,$g2,$b2) = $this->hex2rgb($start);
                break;
            case 'diamond':
                list($r1,$g1,$b1) = $this->hex2rgb($end);
                list($r2,$g2,$b2) = $this->hex2rgb($start);
                $width = imagesx($im);
                $height = imagesy($im);
                $rh=$height>$width?1:$width/$height;
                $rw=$width>$height?1:$height/$width;
                $line_numbers = min($width,$height);
                break;
            default:
        }

        for ( $i = 0; $i < $line_numbers; $i=$i+1+$this->step ) {
            // old values :
            //$old_r=isset($r)?$r:0;
            //$old_g=isset($g)?$g:0;
            //$old_b=isset($b)?$b:0;
            // new values :
            $r = ( $r2 - $r1 != 0 ) ? intval( $r1 + ( $r2 - $r1 ) * ( $i / $line_numbers ) ): $r1;
            $g = ( $g2 - $g1 != 0 ) ? intval( $g1 + ( $g2 - $g1 ) * ( $i / $line_numbers ) ): $g1;
            $b = ( $b2 - $b1 != 0 ) ? intval( $b1 + ( $b2 - $b1 ) * ( $i / $line_numbers ) ): $b1;
            // if new values are really new ones, allocate a new color, otherwise reuse previous color.
            // There's a "feature" in imagecolorallocate that makes this function
            // always returns '-1' after 255 colors have been allocated in an image that was created with
            // imagecreate (everything works fine with imagecreatetruecolor)
            //if ( "$old_r,$old_g,$old_b" != "$r,$g,$b")
            $fill = imagecolorallocate( $im, $r, $g, $b );

            switch($direction) {
                case 'vertical':
                    imagefilledrectangle($im, 0, $i, $line_width, $i+$this->step, $fill);
                    break;
                case 'horizontal':
                    imagefilledrectangle( $im, $i, 0, $i+$this->step, $line_width, $fill );
                    break;
                case 'ellipse':
                case 'ellipse2':
                case 'circle':
                case 'circle2':
                    imagefilledellipse ($im,$center_x, $center_y, ($line_numbers-$i)*$rh, ($line_numbers-$i)*$rw,$fill);
                    break;
                case 'square':
                case 'rectangle':
                    imagefilledrectangle ($im,$i*$width/$height,$i*$height/$width,$width-($i*$width/$height), $height-($i*$height/$width),$fill);
                    break;
                case 'diamond':
                    imagefilledpolygon($im, array (
                        $width/2, $i*$rw-0.5*$height,
                        $i*$rh-0.5*$width, $height/2,
                        $width/2,1.5*$height-$i*$rw,
                        1.5*$width-$i*$rh, $height/2 ), 4, $fill);
                    break;
                default:
            }
        }
    }

    // #ff00ff -> array(255,0,255) or #f0f -> array(255,0,255)

    /**
     * 将颜色转为 数组rgb格式
     * @param $color
     * @return array|mixed
     */
    function hex2rgb($color) {
        if(gettype($color) == 'array'){
            return $color;
        }else{
            $color = str_replace('#','',$color);
            $s = strlen($color) / 3;
            $rgb[]=hexdec(str_repeat(substr($color,0,$s),2/$s));
            $rgb[]=hexdec(str_repeat(substr($color,$s,$s),2/$s));
            $rgb[]=hexdec(str_repeat(substr($color,2*$s,$s),2/$s));
            return $rgb;
        }
    }
}
