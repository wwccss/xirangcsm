<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php
$moduleName = $this->moduleName;
$methodName = $this->methodName;
if(!isset($config->$moduleName->editor->$methodName)) return;
$editors = $config->$moduleName->editor->$methodName;
$editors['id'] = explode(',', $editors['id']);
?>

<script src='<?php echo $jsRoot;?>jquery/kindeditor/kindeditor-min.js' type='text/javascript'></script>
<script language='javascript' type='text/javascript'>
var editor = <?php echo json_encode($editors);?>;

var simpleTools = 
[ 'title', 'fontname', 'fontsize', 'textcolor', 'bgcolor', 'bold', 'italic','underline', 
'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist', 'insertunorderedlist', '|',
'emoticons', 'image', 'link', '|', 'removeformat','undo', 'redo', 'fullscreen', 'about'];

var forumTools = 
['textcolor', 'bgcolor', 'bold', 'italic','underline', 'justifyleft', 'justifycenter', 'justifyright', '|',
'insertorderedlist', 'insertunorderedlist', '|',
'emoticons', 'image', 'flash', '|', 
'link', 'unlink', '|',
'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', 'removeformat', 'undo', 'redo', '|',
'fullscreen', 'about'];

var fullTools = 
[ 'title', 'fontname', 'fontsize','textcolor', '|',
'bgcolor', 'bold', 'italic','underline', '|',
'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', '|',
'insertorderedlist', 'insertunorderedlist', '|',
'emoticons', 'image','link', 'unlink', '|',
'removeformat','undo', 'redo',  'fullscreen', 'source', 'about', '-',
'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|',
'indent', 'outdent', 'subscript', 'superscript', '|',
'selectall', 'strikethrough', 'removeformat', '|',
'flash', 'media', 'advtable', 'hr', 'print'];

$(document).ready(function() 
{
    $.each(editor.id, function(key, editorID)
    {
        $('form').submit(function() 
        {
            KE.util.setData(editorID);
        })
    })
})  

<?php
$editorTool=$editors['tools'];
foreach($editors['id'] as $editorID)
{
   echo "KE.show({id:'" . $editorID . "', items:" . $editorTool.", filterMode:true, urlType:'relative', imageUploadJson: createLink('file', 'ajaxUpload')});\n";
}
?>
</script>
