<?php


/**
 * 下载远程图片类
 * Class class_download
 */
class class_download {
    protected $content;
    protected $successArray = array();

    public function __construct($content)
    {
        $this->content = $content;
    }


    /**
     * 静态类，执行搜索远程图片，并下载替换返回
     * @param $content
     * @return string
     */
    static public function getContent($content)
    {
        $self = new self($content);
        return $self->downloadImages();
    }

    /**
     * 执行搜索远程图片，并下载替换返回
     * @return string
     */
    public function downloadImages()
    {
        $this->content = preg_replace_callback("/(\<img.*?src=[\"|'|\s])(https?\:\/\/.*?)([\"|'|\s].*?\>)/is" ,
            function ($match){
                return $match[1].$this->handleImage($match[2]).$match[3];
            },
            $this->content
            );
        return $this->content;
    }

    /**
     * 正则表达式搜索到的图片路径
     * @param $src  图片路径
     * @return mixed|string
     */
    protected function handleImage($src)
    {
        if(!$src){
            return '';
        }
        if(isset($this->successArray[$src])) {
            return $this->successArray[$src];
        }

        $pathinfo = pathinfo($src);
        $ext = $pathinfo['extension'];

        if(!$ext){
            $ext = 'png';
        }

        $newFile = date('YmdHis').rand(1000,9999).".".$ext;
        $data    = $this->getFile($src);


        $filepath = ROOT_PATH.'upload/'.$newFile;

        // 将图片写入到upload目录中
        file_put_contents($filepath , $data);
        $saveto = 'upload/'.$newFile;
        $this->successArray[$src] = $saveto;
        return $saveto;

    }

    /**
     * 根据Url 获取图片内容
     * @param $url
     * @return bool|string
     */
    protected function getFile( $url )
    {
        $hander = curl_init();
        $param = parse_url($url);
        curl_setopt($hander,CURLOPT_URL,$url);
        if(stripos($url,"https://")!==FALSE){
            curl_setopt($hander, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($hander, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        //curl_setopt($hander,CURLOPT_FILE,$fp);
        curl_setopt($hander,CURLOPT_HEADER,0);
        curl_setopt($hander,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($hander , CURLOPT_USERAGENT , "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36 Edge/18.17763");
        curl_setopt($hander , CURLOPT_REFERER , $param['scheme']."://".$param['host'].($param['port'] && $param['port']!=80 ? ':'.$param['port']:''));
        curl_setopt($hander,CURLOPT_RETURNTRANSFER,true);//以数据流的方式返回数据,当为false是直接显示出来
        curl_setopt($hander,CURLOPT_TIMEOUT,30);
        $data = curl_exec($hander);
        curl_close($hander);
        return $data;
    }

}




