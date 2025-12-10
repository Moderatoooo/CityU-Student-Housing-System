<?php


/**
 * 常用类封装
 * Class Info
 */
class Info{

    /**
     * 获取当前日期
     * @return false|string
     */
    static public function getDateStr()
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * 格式化html 字符串
     * @param $html
     * @return string
     */
    static public function html($html)
    {
        return htmlspecialchars($html);
    }

    /**
     * 表单上获取编号所在代码位置
     * @return string
     */
    static public function getID()
    {
        return date('mdHis').rand(1000,9999);
    }

    /**
     * 删除HTML 标签
     * @param $htmlStr
     * @return string
     */
    static public function delHTMLTag($htmlStr)
    {
        return strip_tags($htmlStr);
    }

    /**
     * json数据编码
     * @param $source
     * @return false|string
     */
    public static function jsonEncode($source)
    {
        return json_encode($source);
    }

    /**
     * 获取某表的数据路径
     * @param $table  表名称
     * @param $pid    父字段
     * @param $name   名称字段
     * @param $value  值
     * @return string  返回路径信息
     */
    public static function postion($table , $pid , $name , $value)
    {
        $items = array();
        $parentid = $value;
        do {
            $mp = M($table)->find($parentid);
            if(!$mp){
                break;
            }
            $items[] = $mp[$name];
            $parentid = $mp[$pid];
        }while ( $parentid );

        $result = array();
        for ($i=count($items)-1;$i>=0;$i--){
            $result[] = $items[$i];
        }
        return implode(" ",$result);
    }



    /**
     * 获取当前时间戳
     * @return int
     */
    static public function time()
    {
        return time();
    }

    /**
     * 格式化字符串
     * @param $format
     * @param null $time
     * @return false|string
     */
    static public function date($format , $time = null)
    {
        return $time == null ? date($format) : date($format , $time);
    }

    /**
     * 多个图片获取第一个图片显示
     * @param $images
     * @return string
     */
    static public function images( $images )
    {
        $exp = explode(',' , $images);
        return $exp[0] ? $exp[0] : '';
    }

    /**
     * 获取地理位置的数据
     * @param $add
     * @return string
     */
    static public function address($add){
        $va = json_decode($add,1);
        return $va ? $va['address'] : "";
    }

    /**
     * 字符串截取
     * @param $sourcestr
     * @param $cutlength
     * @param string $suffix
     * @return false|string
     */
    static public function subStr($sourcestr , $cutlength , $suffix = '...')
    {
        $sourcestr = self::delHTMLTag($sourcestr);
        $str_length = strlen($sourcestr);
        if($str_length <= $cutlength) {
            return $sourcestr;
        }
        $returnstr='';
        $n = $i = $noc = 0;
        while($n < $str_length) {
            $t = ord($sourcestr[$n]);
            if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                $i = 1; $n++; $noc++;
            } elseif(194 <= $t && $t <= 223) {
                $i = 2; $n += 2; $noc += 2;
            } elseif(224 <= $t && $t <= 239) {
                $i = 3; $n += 3; $noc += 2;
            } elseif(240 <= $t && $t <= 247) {
                $i = 4; $n += 4; $noc += 2;
            } elseif(248 <= $t && $t <= 251) {
                $i = 5; $n += 5; $noc += 2;
            } elseif($t == 252 || $t == 253) {
                $i = 6; $n += 6; $noc += 2;
            } else {
                $n++;
            }
            if($noc >= $cutlength) {
                break;
            }
        }
        if($noc > $cutlength) {
            $n -= $i;
        }
        $returnstr = substr($sourcestr, 0, $n);
        if ( substr($sourcestr, $n, 6)){
            $returnstr = $returnstr . $suffix;//超过长度时在尾处加上省略号
        }
        return $returnstr;
    }

    static public function getAllChild( $table , $pid , $value)
    {
        $templists = M($table)->field('id,'.$pid)->select();
        return implode(',' , self::_getAllChild($table,$pid,$value , $templists));
    }

    static private function _getAllChild( $table , $pid , $value , $templists)
    {
        $result = array();
        $parentid = $value;
        $result[] = $parentid;
        foreach ($templists as $child){
            if($child[$pid] == $parentid)
            {
                $ret = self::_getAllChild($table , $pid , $child['id'] , $templists);
                if(!empty($ret)){
                    $result = array_merge($result , $ret);
                }
            }
        }
        return $result;
    }


    static public function getTreeOption($table , $pid , $name , $value)
    {
        $result = array();
        $parentid = $value;
        do{
            $map = M($table)->find($parentid);
            if(empty($map)){
                break;
            }
            array_unshift($result , $map[$name]);
            $parentid = $map[$pid];

        }while(!empty($parentid));
        return implode(' ' , $result);
    }
}
