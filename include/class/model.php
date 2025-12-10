<?php

/**
 * 数据库操作模型
 * Class class_model
 */
class class_model{
    const MODEL_INSERT    =   1;      //  插入模型数据
    const MODEL_UPDATE    =   2;      //  更新模型数据
    const MODEL_BOTH      =   3;      //  包含上面两种方式
    const MUST_VALIDATE         =   1;// 必须验证
    const EXISTS_VAILIDATE      =   0;// 表单存在字段则验证
    const VALUE_VAILIDATE       =   2;// 表单值不为空则验证

    var $pre = '';
    var $table = '';
    var $option = array();
    var $dbType = null;
    var $data = array();
    var $fields = array();
    /**
     * object 数据库驱动调用
     * Enter description here ...
     * @var class_mysql
     */
    var $db = null;
    protected $_validate       = array();  // 自动验证定义
    protected $_auto           = array();  // 自动完成定义
    protected $_map            = array();  // 字段映射定义
    protected $_scope          = array();  // 命名范围定义


    var $lastSql = '';

    protected $comparison      = array('eq'=>'=','neq'=>'<>','gt'=>'>','egt'=>'>=','lt'=>'<','elt'=>'<=','notlike'=>'NOT LIKE','like'=>'LIKE');
    protected $selectSql  =     'SELECT%DISTINCT% %FIELD% FROM %TABLE%%JOIN%%WHERE%%GROUP%%HAVING%%ORDER%%LIMIT% %UNION%';

    /**
     * class_model constructor.
     * @param $table  表名称
     * @param class_mysql $db_drive  class_mysql 类驱动
     */
    function __construct( $table , $db_drive){
        $this->table = $db_drive->T($table);
        $this->option['table'] = $this->table;
        $this->db = $db_drive;
    }

    public function where($field , $op = '=' , $cond = '' , $like = 'AND')
    {
        $argCount = func_num_args();
        if($argCount == 1){
            $op = null;
            $cond = null;

            if(is_array($field)){
                foreach ($field as $key=>$val){
                    if(is_array($val)){
                        if(isset($val[0])){
                            $this->where($key , $val[0] , $val[1]);
                        }else{
                            $this->where($key , $val['exp'] , $val['value']);
                        }
                    }else{
                        $this->where($key , $val);
                    }
                }
                return $this;
            }

        }elseif($argCount == 2){
            $cond = $op;
            $op = '=';
        }
        return $this->setWhereItem($like , $field , $op , $cond);
    }

    public function whereOr($field , $op = '=' , $cond = '' , $like = 'OR')
    {
        $argCount = func_num_args();
        if($argCount == 1){
            $op = null;
            $cond = null;
            if(is_array($field)){
                foreach ($field as $key=>$val){
                    if(is_array($val)){
                        if(isset($val[0])){
                            $this->where($key , $val[0] , $val[1]);
                        }else{
                            $this->where($key , $val['exp'] , $val['value']);
                        }
                    }else{
                        $this->where($key , $val);
                    }
                }
                return $this;
            }
        }elseif($argCount == 2){
            $cond = $op;
            $op = '=';
        }
        return $this->setWhereItem($like , $field , $op , $cond);
    }

    public function whereIn($field , $cond)
    {
        return $this->setWhereItem('AND' , $field , 'IN' , $cond);
    }

    public function whereNotIn($field , $cond)
    {
        return $this->setWhereItem('AND' , $field , 'NOT IN' , $cond);
    }

    public function whereOrIn($field , $cond)
    {
        return $this->setWhereItem('OR' , $field , 'IN' , $cond);
    }

    public function whereOrNotIn($field , $cond)
    {
        return $this->setWhereItem('OR' , $field , 'NOT IN' , $cond);
    }

    public function whereBetween($field , $start , $end = null){
        $cond = $end === null ? $start : array($start , $end);
        return $this->setWhereItem('AND' , $field ,'BETWEEN' , $cond);
    }

    public function whereNotBetween($field , $start , $end = null){
        $cond = $end === null ? $start : array($start , $end);
        return $this->setWhereItem('AND' , $field ,'NOT BETWEEN' , $cond);
    }

    public function whereOrBetween($field , $start , $end = null){
        $cond = $end === null ? $start : array($start , $end);
        return $this->setWhereItem('OR' , $field ,'BETWEEN' , $cond);
    }

    public function whereOrNotBetween($field , $start , $end = null){
        $cond = $end === null ? $start : array($start , $end);
        return $this->setWhereItem('OR' , $field ,'NOT BETWEEN' , $cond);
    }



    function setOptions($name , $value)
    {
        if(!$this->option[$name]){
            $this->option[$name] = array();
        }
        $this->option[$name][] = $value;
        return $this;
    }

    function page( $pagesize = 15)
    {
        $option = $this->option;
        $self = new self($this->option['table'] , $this->db);
        $self->option = $option;
        $count = $self->count($this->option['alias']?$this->option['alias'].'.'.$self->getPk():'*');
        $page = new class_page($count , $pagesize);
        $list = $this->limit($page->firstRow , $page->listRows)->select();

        return array($list , $page);
    }



    /**
     * @name 写入条数
     * @access public
     * Enter description here ...
     * @param string $statr
     * @return class_model
     */
    function limit($statr , $rows = null){
        if($rows!==null){
            $statr = $statr.','.$rows;
        }
        $this->option['limit'] = $statr;
        return $this;
    }
    /**
     * @name 排序
     * @access public
     * Enter description here ...
     * @param $str string
     * @example ->order('id desc')
     * @return class_model
     */
    function order($str , $desc = ''){
        $desc AND $desc=' '.$desc;
        $this->setOptions('order' , $str.$desc);
        return $this;
    }

    /**
     * @name 设置别名
     * @access public
     * Enter description here ...
     * @param string $str 数据库别名
     * @return class_model
     */
    function alias($str){$this->option['alias'] = $str;return $this;}
    /**
     * @name MYSQL having 条件表达式  SQL标准要求HAVING必须引用GROUP BY子句中的列或用于总计函数中的列
     * @access public
     * Enter description here ...
     * @param $str
     * @return class_model
     */
    function having($str){$this->option['having'] = $str;return $this;}
    /**
     * @name group分组
     * @access public
     * Enter description here ...
     * @param $str
     * @return class_model
     */
    function group($str){$this->option['group'] = $str;return $this;}
    /**
     * @name 数据表加锁
     * @access public
     * Enter description here ...
     * @param $str
     * @return class_model
     */
    function lock($str){$this->option['lock'] = $str;return $this;}
    /**
     * @name 查询不重复的值
     * @access public
     * Enter description here ...
     * @param $str
     * @return class_model
     */
    function distinct($str){$this->option['distinct'] = $str;return $this;}
    /**
     * @name 写入字段信息,默认 为 *
     * @access public
     * Enter description here ...
     * @param unknown_type $field
     * @return class_model
     */
    function field( $field ){
        $this->setOptions('field' , $field);
        return $this;
    }

    /**
     * @name 取回表中的总数
     * @access public
     * Enter description here ...
     * @param $field
     * @return number
     */
    function count($field = ''){
        $this->option['field'] = 'count('.($field ? $field : '*').')';
        return $this->getOne();
    }

    /**
     * @name 某字段的和
     * @access public
     * Enter description here ...
     * @param $field
     * @return number
     */
    function sum($field = ''){
        $this->setOptions('field' , 'IFNULL(sum('.($field ? $field : '*').'),0)');
        return $this->getOne();
    }

    function query($sql){
        return $this->db->query($sql);
    }

    // 取回一行
    function fetch($res){
        return $this->db->fetch($res);
    }

    function fetch_num($res){
        return $this->db->fetch_num($res);
    }

    function error(){
        return $this->db->getError();
    }
    function getError(){
        return $this->db->getError();
    }
    /**
     * @name 取回字段中的最小值
     * @access public
     * Enter description here ...
     * @param field $field
     * @return number
     */
    function min($field = ''){
        $this->setOptions('field' , 'IFNULL(min('.($field ? $field : '*').'),0)');
        return $this->getOne();
    }
    /**
     * @name 取回字段中的最大值
     * @access public
     * Enter description here ...
     * @param field $field
     * @return int
     */
    function max($field = ''){
        $this->setOptions('field' , 'IFNULL(max('.($field ? $field : '*').'),0)');
        return $this->getOne();
    }
    /**
     * @name 取字段的平均值
     * @access public
     * Enter description here ...
     * @param field $field
     * @return number
     */
    function avg($field = ''){
        $this->setOptions('field' , 'IFNULL(avg('.($field ? $field : '*').'),0)');
        return $this->getOne();
    }
    /**
     * @name SQL 语句查询缓存
     * @access public
     * Enter description here ...
     * @param string $key 唯一标识符，不填则为SQL语句MD5值
     * @param int $expire 缓存时间
     * @param select $type file
     */
    public function cache($key=true,$expire='',$type=''){
        $this->option['cache']  =  array('key'=>$key,'expire'=>$expire,'type'=>$type);
        return $this;
    }
    public function union($union,$all=false) {
        if(empty($union)) return $this;
        if($all) {
            $this->option['union']['_all']  =   true;
        }
        if(is_object($union)) {
            $union   =  get_object_vars($union);
        }
        // 转换union表达式
        if(is_string($union) ) {
            $options =  $union;
        }elseif(is_array($union)){
            if(isset($union[0])) {
                $this->option['union']  =  array_merge($this->option['union'],$union);
                return $this;
            }else{
                $options =  $union;
            }
        }else{
            return;
        }
        $this->option['union'][]  =   $options;
        return $this;
    }

    /**
     * 设置表链接
     * @param string $type 类型 left 左链接、right 右链接 INNER 内链接
     * @param $table
     * @param $condition
     * @return $this
     */
    public function join($type , $table , $condition)
    {
        return $this->setOptions('join' , array($type , $table , $condition) );
    }

    /**
     * 设置左链接
     * @param $table 表名称
     * @param $condition  条件
     * @return $this
     */
    public function joinLeft($table , $condition)
    {
        return $this->join("left" , $table , $condition);
    }

    /**
     * 设置左链接
     * @param $table 表名称
     * @param $condition  条件
     * @return $this
     */
    public function joinRight($table , $condition)
    {
        return $this->join("right" , $table , $condition);
    }

    /**
     * 设置外链接
     * @param $table 表名称
     * @param $condition  条件
     * @return $this
     */
    public function joinOuter($table , $condition)
    {
        return $this->join("outer" , $table , $condition);
    }

    /**
     * 设置内链接
     * @param $table 表名称
     * @param $condition  条件
     * @return $this
     */
    public function joinInner($table , $condition)
    {
        return $this->join("inner" , $table , $condition);
    }




    public function data($data=''){
        if('' === $data && !empty($this->data)) {
            return $this->data;
        }
        if(is_object($data)){
            $data   =   get_object_vars($data);
        }elseif(is_string($data)){
            parse_str($data,$data);
        }elseif(!is_array($data)){
            system_error('设置值出错');
        }
        $this->data = $data;
        return $this;
    }
    public function setField($field,$value='') {
        if(is_array($field)) {
            $data = $field;
        }else{
            $data[$field]   =  $value;
        }
        return $this->save($data);
    }
    public function setDec($field,$step=1) {
        return $this->setField($field,array('exp',$field.'-'.$step));
    }
    public function setInc($field,$step=1) {
        return $this->setField($field,array('exp',$field.'+'.$step));
    }
    public function add($data='',$options=array(),$replace=false) {
        $this->flush(); // 取回字段信息
        if(empty($data)) {
            // 没有传递数据，获取当前数据对象的值
            if(!empty($this->data)) {
                $data    =   $this->data;
                // 重置数据
                $this->data = array();
            }else{
                return false;
            }
        }
        // 分析表达式
        $options =  $this->_parseOptions($options);
        // 数据处理
        $data = $this->_facade($data);

        // 写入数据到数据库

        $result = $this->insert($data,$options,$replace);

        return $result;
    }

    public function save($data='',$options=array()) {
        $this->flush(); // 取回字段信息
        if(empty($data)) {
            // 没有传递数据，获取当前数据对象的值
            if(!empty($this->data)) {
                $data    =   $this->data;
                // 重置数据
                $this->data = array();
            }else{
                return false;
            }
        }
        // 数据处理
        $data = $this->_facade($data);
        // 分析表达式
        $options =  $this->_parseOptions($options);
        if(!isset($options['where']) ) {
            // 如果存在主键数据 则自动作为更新条件
            if(isset($data[$this->getPk()])) {
                $pk   =  $this->getPk();
                $this->where($pk , $data[$pk]);
                unset($data[$pk]);
                $options =  $this->_parseOptions($options);
            }else{
                // 如果没有任何更新条件则不执行
                return false;
            }
        }
        // 没有任何数据，无法更新
        if(!$data){
            return false;
        }


        //print_r($options);
        $result = $this->update($data,$options);
        return $result;
    }
    public function affected_rows(){
        return $this->db->affected_rows();
    }
    public function getPk() {
        $this->flush(); // 取回字段信息
        return isset($this->fields['_pk'])?$this->fields['_pk']:$this->pk;
    }

    protected function _facade($data) {
        // 检查非数据字段
        if(!empty($this->fields)) {
            foreach ($data as $key=>$val){
                if(!in_array($key,$this->fields,true)){
                    unset($data[$key]);
                }elseif(is_scalar($val)) {
                    // 字段类型检查
                    $this->_parseType($data,$key);
                }
            }
        }
        // 安全过滤
        if(!empty($this->option['filter'])) {
            $data = array_map($this->option['filter'],$data);
            unset($this->option['filter']);
        }
        //$this->_before_write($data);
        return $data;
    }


    function getAll($field = ''){
        $options = $this->_parseOptions();
        $this->lastSql = $this->buildSelectSql($options);

        /*$cache  =  isset($options['cache'])?$options['cache']:false;
        if($cache) { // 查询缓存检测
            $key =  is_string($cache['key'])?$cache['key']:md5($this->lastSql.$field);
            $value   =  S($key,'','',$cache['type']);
            if(false !== $value) {
                return $value;
            }
        }*/
        $result   = $this->db->getAll($this->lastSql , $field);
        /*if($cache && !empty($result) ) { // 查询缓存写入
            S($key,$result,$cache['expire'],$cache['type']);
        }*/
        return $result;
    }


    function getOne($limited = false){
        $options = $this->_parseOptions();
        $this->lastSql = $this->buildSelectSql($options);

        //$cache  =  isset($options['cache'])?$options['cache']:false;
        /*if($cache) { // 查询缓存检测
            $key =  is_string($cache['key'])?$cache['key']:md5($this->lastSql);
            $value   =  S($key,'','',$cache['type']);
            if(false !== $value) {
                return $value;
            }
        }*/
        $result   = $this->db->getOne($this->lastSql , $limited);
        /*if($cache && !empty($result) ) { // 查询缓存写入
            S($key,$result,$cache['expire'],$cache['type']);
        }*/
        return $result;
    }
    function getRow(){
        $options = $this->_parseOptions();
        $this->lastSql = $this->buildSelectSql($options);

        /*$cache  =  isset($options['cache'])?$options['cache']:false;
        if($cache) { // 查询缓存检测
            $key =  is_string($cache['key'])?$cache['key']:md5($this->lastSql);
            $value   =  S($key,'','',$cache['type']);
            if(false !== $value) {
                return $value;
            }
        }*/
        $result   = $this->db->getRow($this->lastSql);
        /*if($cache && !empty($result) ) { // 查询缓存写入
            S($key,$result,$cache['expire'],$cache['type']);
        }*/
        return $result;
    }
    function getCol(){
        $options = $this->_parseOptions();
        $this->lastSql = $this->buildSelectSql($options);

        /*$cache  =  isset($options['cache'])?$options['cache']:false;
        if($cache) { // 查询缓存检测
            $key =  is_string($cache['key'])?$cache['key']:md5($this->lastSql);
            $value   =  S($key,'','',$cache['type']);
            if(false !== $value) {
                return $value;
            }
        }*/
        $result   = $this->db->getCol($this->lastSql);
        /*if($cache && !empty($result) ) { // 查询缓存写入
            S($key,$result,$cache['expire'],$cache['type']);
        }*/
        return $result;
    }



    /**
    +----------------------------------------------------------
     * 查询数据
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @param mixed $options 表达式参数
    +----------------------------------------------------------
     * @return mixed
    +----------------------------------------------------------
     */
    public function find($options=array()) {
        if(is_numeric($options) || is_string($options)) {
            $this->where($this->getPk(),$options);
            $options = array();
        }
        // 总是查找一条记录
        $options['limit'] = 1;
        // 分析表达式
        $options =  $this->_parseOptions($options);
        $resultSet = $this->select($options);
        if(false === $resultSet) {
            return false;
        }
        if(empty($resultSet)) {// 查询结果为空
            return null;
        }
        $this->data = $resultSet[0];
        //$this->_after_find($this->data,$options);
        return $this->data;
    }
    /**
    +----------------------------------------------------------
     * 获取字段信息并缓存
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @return void
    +----------------------------------------------------------
     */
    public function flush() {
        if(!empty($this->fields)){return true;}
        // 缓存不存在则查询数据表信息
        $fields =   $this->db->getFields($this->table);
        if(!$fields) { // 无法获取字段信息
            return false;
        }
        $this->fields   =   array_keys($fields);
        $this->fields['_autoinc'] = false;
        foreach ($fields as $key=>$val){
            // 记录字段类型
            $type[$key]    =   $val['type'];
            if($val['primary']) {
                $this->fields['_pk'] = $key;
                if($val['autoinc']) $this->fields['_autoinc']   =   true;
            }
        }
        // 记录字段类型信息
        $this->fields['_type'] =  $type;
        return true;
    }

    public function value( $field )
    {
        $data = $this->find();
        return $data[$field];
    }


    public function removeOption( $name )
    {
        if(isset($this->option[$name])){
            unset($this->option[$name]);
        }
        return $this;
    }

    public function column($field , $key = '')
    {
        $this->removeOption('field');
        $this->setOptions('field' , $field);
        if($key){
            $this->setOptions('field' , $key);
        }

        $list = $this->select();
        $result = array();
        $isMul = strpos($field , ',') !== false;

        foreach ($list as $r)
        {
            if($isMul){
                $value = $r;
            }else{
                $value = $r[$field];
            }
            if($key){
                $result[$r[$key]] = $value;
            }else{
                $result[] = $value;
            }
        }
        return $result;
    }

    /**
    +----------------------------------------------------------
     * 获取一条记录的某个字段值
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @param string $field  字段名
     * @param string $spea  字段数据间隔符号 NULL返回数组
    +----------------------------------------------------------
     * @return mixed
    +----------------------------------------------------------
     */
    public function getField($field,$sepa=null) {
        //$options['field']    =  $field;
        $this->removeOption('field');
        $this->setOptions('field' , $field);

        $options =  $this->_parseOptions();
        if(strpos($field,',')) { // 多字段
            $resultSet = $this->select($options);
            if(!empty($resultSet)) {
                $_field = explode(',', $field);
                $field  = array_keys($resultSet[0]);
                $move   =  $_field[0]==$_field[1]?false:true;
                $key =  array_shift($field);
                $key2 = array_shift($field);
                $cols   =   array();
                $count  =   count($_field);
                foreach ($resultSet as $result){
                    $name   =  $result[$key];
                    if($move) { // 删除键值记录
                        unset($result[$key]);
                    }
                    if(2==$count) {
                        $cols[$name]   =  $result[$key2];
                    }else{
                        $cols[$name]   =  is_null($sepa)?$result:implode($sepa,$result);
                    }
                }
                return $cols;
            }
        }else{   // 查找一条记录
            $options['limit'] = 1;
            $result = $this->select($options);
            if(!empty($result)) {
                return reset($result[0]);
            }
        }
        return null;
    }

    /**
     * 创建数据对象 但不保存到数据库
     * @access public
     * @param mixed $data 创建数据
     * @param string $type 状态
     * @return mixed
     */
    public function create($data='',$type='') {
        // 如果没有传值默认取POST数据
        if(empty($data)) {
            $data   =   $_POST;
        }elseif(is_object($data)){
            $data   =   get_object_vars($data);
        }
        // 验证数据
        if(empty($data) || !is_array($data)) {
            $this->error = '非法数据';//L('_DATA_TYPE_INVALID_');
            return false;
        }

        // 状态
        $type = $type ? $type :(!empty($data[$this->getPk()])? self::MODEL_UPDATE : self::MODEL_INSERT);

        // 检查字段映射
        if(!empty($this->_map)) {
            foreach ($this->_map as $key=>$val){
                if(isset($data[$key])) {
                    $data[$val] =   $data[$key];
                    unset($data[$key]);
                }
            }
        }

        // 检测提交字段的合法性
        if(isset($this->options['field'])) { // $this->field('field1,field2...')->create()
            $fields =   $this->options['field'];
            unset($this->options['field']);
        }elseif($type == self::MODEL_INSERT && isset($this->insertFields)) {
            $fields =   $this->insertFields;
        }elseif($type == self::MODEL_UPDATE && isset($this->updateFields)) {
            $fields =   $this->updateFields;
        }
        if(isset($fields)) {
            if(is_string($fields)) {
                $fields =   explode(',',$fields);
            }
//          // 判断令牌验证字段
//          if(C('TOKEN_ON'))   $fields[] = C('TOKEN_NAME');
            foreach ($data as $key=>$val){
                if(!in_array($key,$fields)) {
                    unset($data[$key]);
                }
            }
        }

//      // 数据自动验证
//      if(!$this->autoValidation($data,$type)) return false;

//      // 表单令牌验证
//      if(!$this->autoCheckToken($data)) {
//          $this->error = L('_TOKEN_ERROR_');
//          return false;
//      }

//      // 验证完成生成数据对象
//      if($this->autoCheckFields) { // 开启字段检测 则过滤非法字段数据
//          $fields =   $this->getDbFields();
//          foreach ($data as $key=>$val){
//              if(!in_array($key,$fields)) {
//                  unset($data[$key]);
//              }elseif(MAGIC_QUOTES_GPC && is_string($val)){
//                  $data[$key] =   stripslashes($val);
//              }
//          }
//      }

        // 创建完成对数据进行自动处理
        $this->autoOperation($data,$type);
        // 赋值当前数据对象
        $this->data =   $data;
        // 返回创建的数据以供其他调用
        return $data;
    }


    /**
     * 自动表单处理
     * @access public
     * @param array $data 创建数据
     * @param string $type 创建类型
     * @return mixed
     */
    private function autoOperation(&$data,$type) {
        if(!empty($this->options['auto'])) {
            $_auto   =   $this->options['auto'];
            unset($this->options['auto']);
        }elseif(!empty($this->_auto)){
            $_auto   =   $this->_auto;
        }
        // 自动填充
        if(isset($_auto)) {
            foreach ($_auto as $auto){
                // 填充因子定义格式
                // array('field','填充内容','填充条件','附加规则',[额外参数])
                if(empty($auto[2])) $auto[2] =  self::MODEL_INSERT; // 默认为新增的时候自动填充
                if( $type == $auto[2] || $auto[2] == self::MODEL_BOTH) {
                    if(empty($auto[3])) $auto[3] =  'string';
                    switch(trim($auto[3])) {
                        case 'function':    //  使用函数进行填充 字段的值作为参数
                        case 'callback': // 使用回调方法
                            $args = isset($auto[4])?(array)$auto[4]:array();
                            if(isset($data[$auto[0]])) {
                                array_unshift($args,$data[$auto[0]]);
                            }
                            if('function'==$auto[3]) {
                                $data[$auto[0]]  = call_user_func_array($auto[1], $args);
                            }else{
                                $data[$auto[0]]  =  call_user_func_array(array(&$this,$auto[1]), $args);
                            }
                            break;
                        case 'field':    // 用其它字段的值进行填充
                            $data[$auto[0]] = $data[$auto[1]];
                            break;
                        case 'ignore': // 为空忽略
                            if($auto[1]===$data[$auto[0]])
                                unset($data[$auto[0]]);
                            break;
                        case 'string':
                        default: // 默认作为字符串填充
                            $data[$auto[0]] = $auto[1];
                    }
                    if(isset($data[$auto[0]]) && false === $data[$auto[0]] )   unset($data[$auto[0]]);
                }
            }
        }
        return $data;
    }

    /**
    +----------------------------------------------------------
     * 分析表达式
    +----------------------------------------------------------
     * @access proteced
    +----------------------------------------------------------
     * @param array $options 表达式参数
    +----------------------------------------------------------
     * @return array
    +----------------------------------------------------------
     */
    protected function _parseOptions($options=array()) {
        if(is_array($options))
            $options =  array_merge($this->option,$options);
        // 查询过后清空sql表达式组装 避免影响下次查询
        $this->option  =   array();
        if(!isset($options['table']))
            // 自动获取表名
            $options['table'] =$this->table;
        if(!empty($options['alias'])) {
            $options['table']   .= ' '.$options['alias'];
        }
        return $options;
    }

    /**
    +----------------------------------------------------------
     * 数据类型检测
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @param mixed $data 数据
     * @param string $key 字段名
    +----------------------------------------------------------
     * @return void
    +----------------------------------------------------------
     */
    protected function _parseType(&$data,$key) {

        //if($key == 'ip')return;

        $fieldType = strtolower($this->fields['_type'][$key]);
        if(false === strpos($fieldType,'bigint') && false !== strpos($fieldType,'int')) {
            if(strpos($fieldType,'unsigned') !== false){
                if($data[$key] < 0x7fffffff)$data[$key]   =  sprintf('%u' , $data[$key]);
            }else{
                $data[$key]   =  intval($data[$key]);
            }
        }elseif(false !== strpos($fieldType,'float') || false !== strpos($fieldType,'double')){
            $data[$key]   =  floatval($data[$key]);
        }elseif(false !== strpos($fieldType,'bool')){
            $data[$key]   =  (bool)$data[$key];
        }
    }


    /**
    +----------------------------------------------------------
     * 设置锁机制
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @return string
    +----------------------------------------------------------
     */
    protected function parseLock($lock=false) {
        if(!$lock) return '';
        if('ORACLE' == $this->dbType) {
            return ' FOR UPDATE NOWAIT ';
        }
        return ' FOR UPDATE ';
    }

    /**
    +----------------------------------------------------------
     * set分析
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @param array $data
    +----------------------------------------------------------
     * @return string
    +----------------------------------------------------------
     */
    protected function parseSet($data) {
        foreach ($data as $key=>$val){
            $value   =  $this->parseValue($val);
            if(is_scalar($value)) // 过滤非标量数据
                $set[]    = $this->parseKey($key).'='.$value;
        }
        return ' SET '.implode(',',$set);
    }

    /**
    +----------------------------------------------------------
     * 字段名分析
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @param string $key
    +----------------------------------------------------------
     * @return string
    +----------------------------------------------------------
     */
    protected function parseKey(&$key) {
        return $key;
    }

    /**
    +----------------------------------------------------------
     * value分析
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @param mixed $value
    +----------------------------------------------------------
     * @return string
    +----------------------------------------------------------
     */
    protected function parseValue($value) {
        if(is_string($value)) {
            $value = '\''.$this->db->escapeString($value).'\'';
        }elseif(isset($value[0]) && is_string($value[0]) && strtolower($value[0]) == 'exp'){
            $value   =  $this->db->escapeString($value[1]);
        }elseif(is_array($value)) {
            $value   =  array_map(array($this, 'parseValue'),$value);
        }elseif(is_null($value)){
            $value   =  "''";
        }else{
            $value = "'".$value."'";
        }
        return $value;
    }

    /**
    +----------------------------------------------------------
     * field分析
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @param mixed $fields
    +----------------------------------------------------------
     * @return string
    +----------------------------------------------------------
     */
    protected function parseField($fields) {
        if(is_string($fields) && strpos($fields,',')) {
            $fields    = explode(',',$fields);
        }
        if(is_array($fields)) {
            // 完善数组方式传字段名的支持
            // 支持 'field1'=>'field2' 这样的字段别名定义
            $array   =  array();
            foreach ($fields as $key=>$field){
                if(!is_numeric($key))
                    $array[] =  $this->parseKey($key).' AS '.$this->parseKey($field);
                else
                    $array[] =  $this->parseKey($field);
            }
            $fieldsStr = implode(',', $array);
        }elseif(is_string($fields) && !empty($fields)) {
            $fieldsStr = $this->parseKey($fields);
        }else{
            $fieldsStr = '*';
        }
        //TODO 如果是查询全部字段，并且是join的方式，那么就把要查的表加个别名，以免字段被覆盖
        return $fieldsStr;
    }

    /**
    +----------------------------------------------------------
     * table分析
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @param mixed $table
    +----------------------------------------------------------
     * @return string
    +----------------------------------------------------------
     */
    protected function parseTable($tables) {
        if(is_array($tables)) {// 支持别名定义
            $array   =  array();
            foreach ($tables as $table=>$alias){
                if(!is_numeric($table))
                    $array[] =  $this->parseKey($table).' '.$this->parseKey($alias);
                else
                    $array[] =  $this->parseKey($table);
            }
            $tables  =  $array;
        }elseif(is_string($tables)){
            $tables  =  explode(',',$tables);
            array_walk($tables, array(&$this, 'parseKey'));
        }
        return implode(',',$tables);
    }



    public function setWhereItem($like , $field , $op , $cond)
    {
        if(!isset($this->option['where'])){
            $this->option['where'] = array();
        }
        $this->option['where'][] = array($like , $field , $op , $cond);
        return $this;
    }

    /**
    +----------------------------------------------------------
     * where分析
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @param mixed $where
    +----------------------------------------------------------
     * @return string
    +----------------------------------------------------------
     */
    public function parseWhere($where) {
        $whereStr = '';
        if(is_string($where)) {
            // 直接使用字符串条件
            $whereStr = $where;
        }else{ // 使用数组或者对象条件表达式

            $i = 0;
            foreach ($where as $w){
                if($i++ > 0){
                    $whereStr .= " $w[0] ";
                }
                $key = trim($w[1]);
                $op    = strtolower($w[2]);
                $val  = $w[3];
                if($w[2] == null && $val == null){
                    $whereStr .= $key;
                }elseif(strpos($key , '|') !== false){
                    $array   =  explode('|',$key);
                    $str   = array();
                    foreach ($array as $m=>$k){
                        $v =  array($op,$val);
                        if($k){
                            $str[]   = '('.$this->parseWhereItem($this->parseKey($k),$v).')';
                        }
                    }
                    $whereStr .= implode(' OR ',$str);
                }elseif(strpos($key,'&')){
                    $array   =  explode('&',$key);
                    $str   = array();
                    foreach ($array as $m=>$k){
                        $v =  array($op,$val);
                        if($k){
                            $str[]   = '('.$this->parseWhereItem($this->parseKey($k),$v).')';
                        }
                    }
                    $whereStr .= implode(' AND ',$str);
                }else{
                    $v = array($op , $val);
                    $whereStr   .= $this->parseWhereItem($this->parseKey($key),$v);
                }
            }

        }
        return empty($whereStr)?'':' WHERE '.$whereStr;
    }

    // where子单元分析
    protected function parseWhereItem($key,$val) {
        $whereStr = '';
        if(is_array($val)) {
            if(is_string($val[0])) {
                $match = strtoupper($val[0]);
                if(in_array($match , array('EQ','NEQ','GT','EGT','LT','ELT'))  ) { // 比较运算
                    $whereStr .= $key.' '.$this->comparison[strtolower($val[0])].' '.$this->parseValue($val[1]);
                }elseif(in_array($val[0] , array('>','>=','=','<','<=','<>','!='))){
                    $whereStr .= $key.' '.$val[0].' '.$this->parseValue($val[1]);
                }elseif(preg_match('/^(NOTLIKE|LIKE)$/i',$val[0])){// 模糊查找
                    if(is_array($val[1])) {
                        $likeLogic  =   isset($val[2])?strtoupper($val[2]):'OR';
                        $likeStr    =   $this->comparison[strtolower($val[0])];
                        $like   =   array();
                        foreach ($val[1] as $item){
                            $like[] = $key.' '.$likeStr.' '.$this->parseValue($item);
                        }
                        $whereStr .= '('.implode(' '.$likeLogic.' ',$like).')';
                    }else{
                        $whereStr .= $key.' '.$this->comparison[strtolower($val[0])].' '.$this->parseValue($val[1]);
                    }
                }elseif('exp'==strtolower($val[0])){ // 使用表达式
                    $whereStr .= ' ('.$key.' '.$val[1].') ';
                }elseif(preg_match('/IN/i',$val[0])){ // IN 运算
                    if(isset($val[2]) && 'exp'==$val[2]) {
                        $whereStr .= $key.' '.strtoupper($val[0]).' '.$val[1];
                    }else{
                        if(is_string($val[1])) {
                            $val[1] =  explode(',',$val[1]);
                        }
                        $zone   =   implode(',',$this->parseValue($val[1]));
                        $whereStr .= $key.' '.strtoupper($val[0]).' ('.$zone.')';
                    }
                }elseif(preg_match('/BETWEEN/i',$val[0])){ // BETWEEN运算
                    $data = is_string($val[1])? explode(',',$val[1]):$val[1];
                    $whereStr .=  ' ('.$key.' '.strtoupper($val[0]).' '.$this->parseValue($data[0]).' AND '.$this->parseValue($data[1]).' )';
                }else{
                    //Exce_error('语法错误:'.$val[0]);
                }
            }else {
                $count = count($val);
                if(in_array(strtoupper(trim($val[$count-1])),array('AND','OR','XOR'))) {
                    $rule = strtoupper(trim($val[$count-1]));
                    $count   =  $count -1;
                }else{
                    $rule = 'AND';
                }
                for($i=0;$i<$count;$i++) {
                    $data = is_array($val[$i])?$val[$i][1]:$val[$i];
                    if('exp'==strtolower($val[$i][0])) {
                        $whereStr .= '('.$key.' '.$data.') '.$rule.' ';
                    }else{
                        $op = is_array($val[$i])?$this->comparison[strtolower($val[$i][0])]:'=';
                        $whereStr .= '('.$key.' '.$op.' '.$this->parseValue($data).') '.$rule.' ';
                    }
                }
                $whereStr = substr($whereStr,0,-4);
            }
        }else {
            //对字符串类型字段采用模糊匹配

            $whereStr .= $key.' = '.$this->parseValue($val);

        }
        return $whereStr;
    }

    /**
    +----------------------------------------------------------
     * 特殊条件分析
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @param string $key
     * @param mixed $val
    +----------------------------------------------------------
     * @return string
    +----------------------------------------------------------
     */
    protected function parseThinkWhere($key,$val) {
        $whereStr   = '';
        switch($key) {
            case '_string':
                // 字符串模式查询条件
                $whereStr = $val;
                break;
            case '_complex':
                // 复合查询条件
                $whereStr   = substr($this->parseWhere($val),6);
                break;
            case '_query':
                // 字符串模式查询条件
                parse_str($val,$where);
                if(isset($where['_logic'])) {
                    $op   =  ' '.strtoupper($where['_logic']).' ';
                    unset($where['_logic']);
                }else{
                    $op   =  ' AND ';
                }
                $array   =  array();
                foreach ($where as $field=>$data)
                    $array[] = $this->parseKey($field).' = '.$this->parseValue($data);
                $whereStr   = implode($op,$array);
                break;
        }
        return $whereStr;
    }

    /**
    +----------------------------------------------------------
     * limit分析
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @param mixed $lmit
    +----------------------------------------------------------
     * @return string
    +----------------------------------------------------------
     */
    protected function parseLimit($limit) {
        return !empty($limit)?   ' LIMIT '.$limit.' ':'';
    }

    /**
    +----------------------------------------------------------
     * join分析
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @param mixed $join
    +----------------------------------------------------------
     * @return string
    +----------------------------------------------------------
     */
    protected function parseJoin($join) {
        $joinStr = '';
        if(!empty($join)) {
            foreach ($join as $key=>$_join){
                list($type , $table , $condition) = $_join;
                $joinStr .= " {$type} JOIN {$table} ON {$condition} ";
            }
        }
        return $joinStr;
    }



    /**
    +----------------------------------------------------------
     * order分析
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @param mixed $order
    +----------------------------------------------------------
     * @return string
    +----------------------------------------------------------
     */
    protected function parseOrder($order) {
        if(is_array($order)) {

            $order   =  implode(',',$order);
        }
        return !empty($order)?  ' ORDER BY '.$order:'';
    }

    /**
    +----------------------------------------------------------
     * group分析
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @param mixed $group
    +----------------------------------------------------------
     * @return string
    +----------------------------------------------------------
     */
    protected function parseGroup($group) {
        return !empty($group)? ' GROUP BY '.$group:'';
    }

    /**
    +----------------------------------------------------------
     * having分析
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @param string $having
    +----------------------------------------------------------
     * @return string
    +----------------------------------------------------------
     */
    protected function parseHaving($having) {
        return  !empty($having)?   ' HAVING '.$having:'';
    }

    /**
    +----------------------------------------------------------
     * distinct分析
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @param mixed $distinct
    +----------------------------------------------------------
     * @return string
    +----------------------------------------------------------
     */
    protected function parseDistinct($distinct) {
        return !empty($distinct)?   ' DISTINCT ' :'';
    }

    /**
    +----------------------------------------------------------
     * union分析
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @param mixed $union
    +----------------------------------------------------------
     * @return string
    +----------------------------------------------------------
     */
    protected function parseUnion($union) {
        if(empty($union)) return '';
        if(isset($union['_all'])) {
            $str  =   'UNION ALL ';
            unset($union['_all']);
        }else{
            $str  =   'UNION ';
        }
        foreach ($union as $u){
            $sql[] = $str.(is_array($u)?$this->buildSelectSql($u):$u);
        }
        return implode(' ',$sql);
    }

    /**
    +----------------------------------------------------------
     * 插入记录
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @param mixed $data 数据
     * @param array $options 参数表达式
     * @param boolean $replace 是否replace
    +----------------------------------------------------------
     * @return false | integer
    +----------------------------------------------------------
     */
    public function insert($data,$options=array(),$replace=false) {
        $values  =  $fields    = array();


        foreach ($data as $key=>$val){
            $value   =  $this->parseValue($val);
            if(is_scalar($value)) { // 过滤非标量数据
                $values[]   =  $value;
                $fields[]     =  $this->parseKey($key);
            }
        }
        $sql   =  ($replace?'REPLACE':'INSERT').' INTO '.$this->parseTable($options['table']).' ('.implode(',', $fields).') VALUES ('.implode(',', $values).')';
        $sql   .= $this->parseLock(isset($options['lock'])?$options['lock']:false);
        $this->lastSql = $sql;
        if($this->db->query($sql , 'SILENT')){
            return $this->db->insert_id();
        }
        return false;
    }

    /**
    +----------------------------------------------------------
     * 通过Select方式插入记录
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @param string $fields 要插入的数据表字段名
     * @param string $table 要插入的数据表名
     * @param array $option  查询数据参数
    +----------------------------------------------------------
     * @return false | integer
    +----------------------------------------------------------
     */
    public function selectInsert($fields,$table,$options=array()) {
        $this->model  =   !empty($options['model']) ? $options['model'] : '';
        if(is_string($fields))   $fields    = explode(',',$fields);
        array_walk($fields, array($this, 'parseKey'));
        $sql   =    'INSERT INTO '.$this->parseTable($table).' ('.implode(',', $fields).') ';
        $sql   .= $this->buildSelectSql($options);
        $this->lastSql = $sql;
        return $this->db->query($sql);
    }

    /**
    +----------------------------------------------------------
     * 更新记录
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @param mixed $data 数据
     * @param array $options 表达式
    +----------------------------------------------------------
     * @return false | integer
    +----------------------------------------------------------
     */
    public function update($data,$options) {
        $this->model  =   !empty($options['model']) ? $options['model'] : '';
        $sql   = 'UPDATE '
            .$this->parseTable($options['table'])
            .$this->parseSet($data)
            .$this->parseWhere(isset($options['where'])?$options['where']:'')
            .$this->parseOrder(isset($options['order'])?$options['order']:'')
            .$this->parseLimit(isset($options['limit'])?$options['limit']:'')
            .$this->parseLock(isset($options['lock'])?$options['lock']:false);
        $this->lastSql = $sql;
        return $this->db->query($sql);
    }

    /**
    +----------------------------------------------------------
     * 删除记录
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @param array $options 表达式
    +----------------------------------------------------------
     * @return false | integer
    +----------------------------------------------------------
     */
    public function delete($options=array()) {
        if(!empty($options)){
            if(is_numeric($options)  || is_string($options)) {
                // 根据主键删除记录
                $pk   =  $this->getPk();
                if(strpos($options,',')) {
                    $this->whereIn($pk , $options);
                }else{
                    $this->where($pk , $options);
                }
            }elseif(is_array($options)){
                $pk   =  $this->getPk();
                $this->whereIn($pk , $options);
            }
            $options =  array();
        }

        if(empty($options) && empty($this->option['where'])) {
            // 如果删除条件为空 则删除当前数据对象所对应的记录
            if(!empty($this->data) && isset($this->data[$this->getPk()]))
                return $this->delete($this->data[$this->getPk()]);
            else
                return false;
        }



        $options = $this->_parseOptions($options);

        $this->model  =   !empty($options['model']) ? $options['model'] : '';
        $sql   = 'DELETE FROM '
            .$this->parseTable($options['table'])
            .$this->parseWhere(isset($options['where'])?$options['where']:'')
            .$this->parseOrder(isset($options['order'])?$options['order']:'')
            .$this->parseLimit(isset($options['limit'])?$options['limit']:'')
            .$this->parseLock(isset($options['lock'])?$options['lock']:false);
        $this->lastSql = $sql;
        if($this->db->query($sql)){
            return $this->db->affected_rows();
        }
        return false;
    }

    /**
    +----------------------------------------------------------
     * 查找记录
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @param array $options 表达式
    +----------------------------------------------------------
     * @return mixed
    +----------------------------------------------------------
     */
    public function select($options=array()) {

        $options = array_merge($this->_parseOptions() ,  $options);

        $this->model  =   !empty($options['model']) ? $options['model'] : '';
        $sql   = $this->lastSql= $this->buildSelectSql($options);
        $cache  =  isset($options['cache'])?$options['cache']:false;
        if($cache) { // 查询缓存检测
            $key =  is_string($cache['key'])?$cache['key']:md5($sql);
            $value   =  S($key,'','',$cache['type']);
            if(false !== $value) {
                return $value;
            }
        }
        $result   = $this->db->getAll($sql);
        if($cache && !empty($result) ) { // 查询缓存写入
            S($key,$result,$cache['expire'],$cache['type']);
        }
        return $result;
    }

    /**
    +----------------------------------------------------------
     * 生成查询SQL
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @param array $options 表达式
    +----------------------------------------------------------
     * @return string
    +----------------------------------------------------------
     */
    public function buildSelectSql($options=array()) {
        if(isset($options['page'])) {
            // 根据页数计算limit
            if(strpos($options['page'],',')) {
                list($page,$listRows) =  explode(',',$options['page']);
            }else{
                $page    = $options['page'];
            }
            $page    = $page?$page:1;
            $listRows = isset($listRows)?$listRows:(is_numeric($options['limit'])?$options['limit']:20);
            $offset  =  $listRows*((int)$page-1);
            $options['limit'] =  $offset.','.$listRows;
        }
        /*        if(C('DB_SQL_BUILD_CACHE')) { // SQL创建缓存
                    $key =  md5(serialize($options));
                    $value   =  S($key);
                    if(false !== $value) {
                        return $value;
                    }
                }*/
        $sql  =   $this->parseSql($this->selectSql,$options);
        $sql   .= $this->parseLock(isset($options['lock'])?$options['lock']:false);
        /*        if(isset($key)) { // 写入SQL创建缓存
                    S($key,$sql,0,'',array('length'=>C('DB_SQL_BUILD_LENGTH'),'queue'=>C('DB_SQL_BUILD_QUEUE')));
                }*/
        return $sql;
    }

    /**
    +----------------------------------------------------------
     * 替换SQL语句中表达式
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @param array $options 表达式
    +----------------------------------------------------------
     * @return string
    +----------------------------------------------------------
     */
    public function parseSql($sql,$options=array()){
        $sql   = str_replace(
            array('%TABLE%','%DISTINCT%','%FIELD%','%JOIN%','%WHERE%','%GROUP%','%HAVING%','%ORDER%','%LIMIT%','%UNION%'),
            array(
                $this->parseTable($options['table']),
                $this->parseDistinct(isset($options['distinct'])?$options['distinct']:false),
                $this->parseField(isset($options['field'])?$options['field']:'*'),
                $this->parseJoin(isset($options['join'])?$options['join']:''),
                $this->parseWhere(isset($options['where'])?$options['where']:''),
                $this->parseGroup(isset($options['group'])?$options['group']:''),
                $this->parseHaving(isset($options['having'])?$options['having']:''),
                $this->parseOrder(isset($options['order'])?$options['order']:''),
                $this->parseLimit(isset($options['limit'])?$options['limit']:''),
                $this->parseUnion(isset($options['union'])?$options['union']:'')
            ),$sql);
        return $sql;
    }



}


