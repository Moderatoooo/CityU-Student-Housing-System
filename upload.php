<?php


/**
 * 上传文件处理
 */

require_once 'initialize.php';

// 获取上传文件对象
$upload = class_upload::getUpload(false);

// 开始上传
if(!$upload->upload()){
    die($upload->getErrorMsg());
}
// 获取上传的文件
$uploadList = $upload->getUploadFileInfo();

// 获取上传文件的路径
$saveto = str_replace(DT_PATH,'',$upload->savePath . $uploadList[0]['savename']);

?>

<script language="javascript">
    function Get(name){
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)","i");
        var r = window.location.search.substr(1).match(reg);
        if (r!=null) return unescape(r[2]);
        return null;
    }
    var str=location.toString();
    var file = "<?php echo $saveto ?>";
    var Result = Get("Result");
    var callback = Get("callback");
    if(Result!= null){
        window.parent.document.getElementById(Result).value=file;   // 写入表单中
    }else{
        window.parent.window[callback](file);  // 调用回调函数
    }
    document.write("上传成功");
</script>