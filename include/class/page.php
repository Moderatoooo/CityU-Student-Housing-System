<?php

/**
 * 分页生成类
 * Class class_page
 */
class class_page {
    // 起始行数
    public $firstRow	;
    // 列表每页显示行数
    public $listRows	;
    // 页数跳转时要带的参数
    public $parameter  ;
    // 分页总页面数

    public $page_item = '页';
    public $previous = '上一页';
    public $next = '下一页';


    protected $totalPages  ;
    // 总行数
    protected $totalRows  ;
    // 当前页数
    protected $nowPage  ;
    // 分页的栏的总页数
    protected $coolPages   ;
    // 分页栏每页显示的页数
    protected $rollPage   ;
    // 分页url定制
    public $urlrule;

    public $tag='[page]';

    /**
    +----------------------------------------------------------
     * 架构函数
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @param array $totalRows  总的记录数
     * @param array $listRows  每页显示记录数
     * @param array $parameter  分页跳转的参数
    +----------------------------------------------------------
     */
    public function __construct($totalRows,$listRows,$p='') {

        $this->totalRows = $totalRows;
        $this->parameter = '&_TotalCount='.$totalRows.'&_Timeout='.(DATETIME+3600).'&';
        $this->rollPage = 2;
        $this->listRows = !empty($listRows)?$listRows:12;
        $this->totalPages = ceil($this->totalRows/$this->listRows);     //总页数
        if (!defined('PAGESTOTAL')) define('PAGESTOTAL', $this->totalPages);
        $this->coolPages  = ceil($this->totalPages/$this->rollPage);
        if($p){
            $this->nowPage =$p;
        }else{
            $this->nowPage  = max(intval($_GET['page']),1);
        }
        if(!empty($this->totalPages) && $this->nowPage>$this->totalPages) {
            $this->nowPage = $this->totalPages;
        }
        $this->firstRow = $this->listRows*($this->nowPage-1);
    }

    public function showScroll($loadtext , $loadsuccess , $param = array())
    {
        if($this->totalRows == 0 OR $this->listRows == 0 OR $this->totalPages <= 1){
            //return array();
        }
        $urlrule =  $this->urlrule; //urldecode
        if(!$urlrule){
            $p = 'page';
            $nowCoolPage      = ceil($this->nowPage/$this->rollPage);
            $url  =  $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':"?").$this->parameter;
            $parse = parse_url($url);

            if(isset($parse['query'])) {
                parse_str($parse['query'],$params);
                $params[$p] = '{page}';
                $urlrule   =  $parse['path'].'?'.http_build_query($params);
            }else{
                $urlrule   =  $parse['path'] . '?' . $p.'={page}';
            }
        }else{
            if($this->tag!='{page}'){
                $urlrule = str_replace('[page]' , '{page}' , $urlrule);
            }
        }
        $urlrule =  str_replace('%7Bpage%7D','{page}',$urlrule);

        $page = array(
            'url'=>$urlrule,
            'loadtext'=>$loadtext ,
            'loadsuccess'=>$loadsuccess,
            'tag'=>'{page}',
            'countPage'=>$this->totalPages,
        );
        if(!empty($param)){
            $page['param'] = http_build_query($param);
        }
        return $page;
    }

    /**
     * 生成分页并返回
     * @return string
     */
    public function show(){

        if($this->totalRows == 0 OR $this->listRows == 0 OR $this->totalPages <= 1){
            return '<div style="width:100%;text-align:center;"><span class="label label-info">总计'.$this->totalRows.'条数据</span></div>';
        }

        $urlrule =  str_replace(urlencode($this->tag),$this->tag,$this->urlrule); //urldecode
        if(!$urlrule){
            $p = 'page';
            $nowCoolPage      = ceil($this->nowPage/$this->rollPage);
            $url  =  $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':"?").$this->parameter;
            $parse = parse_url($url);

            if(isset($parse['query'])) {
                parse_str($parse['query'],$params);
                $params[$p] = $this->tag;
                //unset($params[$p]);
                $urlrule   =  $parse['path'].'?'.http_build_query($params);
            }else{
                $urlrule   =  $parse['path'] . '?' . $p.'='.$this->tag;
            }
            $this->urlrule = $urlrule =  str_replace(array(urlencode('[page]'),'index.php'),array('[page]',''),$urlrule); //urldecode
        }

        $pre_page = $this->nowPage-1;
        $next_page = $this->nowPage +1;

        if($this->nowPage >=$this->totalPages){
            $next_page =  $this->nowPage = $this->totalPages;
        }
        if($this->nowPage <= 1){
            $pre_page =  $this->nowPage = 1;
        }

        $url = $this->pageurl($urlrule , 1,$this->parameter);
        $parser = parse_url($url);
        $param = array();
        if($parser['query']){
            parse_str($parser['query'] , $param);
        }
        $output = "<form action=\"?\" method=\"get\">";
        foreach($param as $key=>$value){
            $output.= '<input type="hidden" name="'.$key.'" value="'.$value.'" />';
        }
        $output .= '<div class="pages">';

        //$output .= '<a class="a1">'.$this->totalRows.$this->page_item.'</a>';
        if($this->nowPage == 1)
            $output .= '<a href="javascript:;" class="disabled">'.$this->previous.'</a>';
        if($this->nowPage > 1)
            $output .= '<a href="'.$this->pageurl($urlrule, $pre_page,$this->parameter).'">'.$this->previous.'</a>';
//		if($this->totalPages > 5)
//			$output .= '<li><a href="'.$this->pageurl($urlrule, 1,$this->parameter).'">1</a> ...</li>';


        $show_nums = $this->rollPage*2+1;// 显示页码的个数

        if($this->totalPages <= $show_nums){
            for($i = 1;$i<=$this->totalPages;$i++){
                if($i == $this->nowPage){
                    $output .= '<a href="javascript:;" class="active">'.$i.'</a>';
                }else{
                    $output .= '<a href="'.$this->pageurl($urlrule,$i,$this->parameter).'">'.$i.'</a>';
                }
            }
        }else{
            if($this->nowPage < (1+$this->rollPage)){
                for($i = 1;$i<=$show_nums;$i++){
                    if($i == $this->nowPage){
                        $output .=  '<a href="javascript:;" class="active">'.$i.'</a>';
                    }else{
                        $output .= '<a href="'.$this->pageurl($urlrule,$i,$this->parameter).'">'.$i.'</a>';
                    }
                }
            }else if($this->nowPage >= ($this->totalPages - $this->rollPage)){
                for($i = $this->totalPages - $show_nums ; $i <= $this->totalPages ; $i++){
                    if($i == $this->nowPage){
                        $output .=  '<a href="javascript:;" class="active">'.$i.'</a>';
                    }else{
                        $output .= '<a href="'.$this->pageurl($urlrule,$i,$this->parameter).'">'.$i.'</a>';
                    }
                }
            }else{
                $start_page = $this->nowPage - $this->rollPage;
                $end_page = $this->nowPage + $this->rollPage;
                for($i = $start_page ; $i<=$end_page ; $i++){
                    if($i == $this->nowPage){
                        $output .=  '<a href="javascript:;" class="active">'.$i.'</a>';
                    }else{
                        $output .= '<a href="'.$this->pageurl($urlrule,$i,$this->parameter).'">'.$i.'</a>';
                    }
                }
            }
        }
//		if($this->totalPages > 5)
//			$output .='<li>...<a href="'.$this->pageurl($urlrule,$this->totalPages,$this->parameter).'">'.$this->totalPages."</a></li>";
        if($this->totalPages == $this->nowPage)
            $output .='<a href="javascript:;" class="disabled">'.$this->next.'</a>';
        if($this->totalPages > $this->nowPage)
            $output .='<a href="'.$this->pageurl($urlrule,$next_page,$this->parameter).'">'.$this->next."</a>";

        $output.= '</div>';
        $output .= '</form>';
        //$output.= '<script>$(function(){$("#page_go").css("cursor","pointer").click(function(){var page_url="'.$urlrule.'";location.href=page_url.replace(/\[page\]/g,$("#page_value").val());});});</script>';
        return $output;
    }

    /**
     * 获取下拉框
     * @param buffer
     */
    protected function getSelect()
    {
        $buffer = "<select name=\"page\" onchange=\"this.form.submit()\">";
        for ($i=1;$i<$this->totalPages;$i++){
            $buffer .= "<option value='".$i."'".($this->nowPage==$i?" selected":"").">".$i."</option>";
        }
        $buffer .= "</select>";
        return $buffer;
    }

    /**
     * 获取页码
     * @return array
     */
    public function getPage(){
        $pages = array(
            'count'=>$this->totalRows,
            'page'=>$this->nowPage,
            'pagesize'=>$this->listRows,
            'countPage'=>$this->totalPages,
        );
        $page = $this->nowPage;

        $pages['prepage'] = $page -1;
        $pages['nextPage'] = $page + 1;

        if($page >= $pages['countPage']){
            unset($pages['nextPage']);
        }
        if($page <= 1){
            unset($pages['prepage']);
        }

        $nums =  $this->rollPage*2+1;
        $pages['num'] = array();
        if($pages['countPage'] <= $nums){
            for($i = 1;$i<=$pages['countPage'];$i++){
                $pages['num'][] = $i;
            }
        }else{
            if($pages['page'] < (1+$this->rollPage)){
                for($i = 1;$i<=$nums;$i++){
                    $pages['num'][] = $i;
                }
            }else if($pages['page'] >= ($pages['countPage'] - $this->rollPage)){
                for($i = $pages['countPage'] - $nums ; $i <= $pages['countPage'] ; $i++){
                    $pages['num'][] = $i;
                }
            }else{
                $start_page = $pages['page'] - $this->rollPage;
                $end_page = $pages['page'] + $this->rollPage;
                for($i = $start_page ; $i<=$end_page ; $i++){
                    $pages['num'][] = $i;
                }
            }
        }

        $urlrule =  str_replace(urlencode($this->tag),$this->tag,$this->urlrule); //urldecode
        if(!$urlrule){
            $p = 'page';
            $nowCoolPage      = ceil($this->nowPage/$this->rollPage);
            $url  =  $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':"?").$this->parameter;
            $parse = parse_url($url);

            if(isset($parse['query'])) {
                parse_str($parse['query'],$params);
                $params[$p] = $this->tag;
                //unset($params[$p]);
                $urlrule   =  $parse['path'].'?'.http_build_query($params);
            }else{
                $urlrule   =  $parse['path'] . '?' . $p.'='.$this->tag;
            }

            $this->urlrule = $urlrule =  str_replace(array(urlencode('[page]'),'index.php'),array('[page]',''),$urlrule); //urldecode

        }
        if($pages['prepage'])
            $pages['str_prepage'] = $this->pageurl($urlrule,$pages['prepage'],$this->parameter);
        if($pages['nextPage'])
            $pages['str_nextPage'] = $this->pageurl($urlrule,$pages['nextPage'],$this->parameter);
        if($pages['countPage']){
            $pages['str_countPage'] = $this->pageurl($urlrule,$pages['countPage'],$this->parameter);
        }else{
            $pages['str_countPage'] = $this->pageurl($urlrule,1,$this->parameter);
        }

        $pages['str_firstPage'] = $this->pageurl($urlrule,1,$this->parameter);
        foreach($pages['num'] as $i){
            $pages['str_num'][$i] = $this->pageurl($urlrule,$i,$this->parameter);
        }

        return $pages;
    }


    /**
     * url 规则
     * @param $urlrule
     * @param $page
     * @param array $array
     * @return mixed
     */
    public function pageurl($urlrule, $page, $array = array())
    {
        if(!empty($array) && is_array($array)){
            @extract($array, EXTR_SKIP);
        }

        if(is_array($urlrule))
        {
            $urlrule = $page < 2 ? $urlrule[0] : $urlrule[1];
        }

        if($page == 1){
            $url = str_replace(array('?page='.$this->tag,'page='.$this->tag), '', $urlrule);
            $url = str_replace($this->tag, $page, $url);
        }else{
            $url = str_replace($this->tag, $page, $urlrule);
        }
        return $url;
    }


}
