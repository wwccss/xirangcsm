<?php
$webRoot      = $this->app->getWebRoot();
$jsRoot       = $webRoot . "js/";
$defaultTheme = $webRoot . 'theme/default/';
?>
<link rel='stylesheet' href='<?php echo $defaultTheme;?>datepicker.css' type='text/css' />
<style type='text/css'>
button.ui-datepicker-trigger{border:0px; margin-bottom:10px;}
</style>
<script src='<?php echo $jsRoot;?>jquery/datepicker/datepicker.min.js'  type='text/javascript'></script>
<script language='javascript'>
formatDate = 'yy-mm-dd';
$.dpText = <?php echo json_encode($lang->datepicker->dpText)?>

var dayNames     = <?php echo json_encode($lang->datepicker->dayNames)?>;
var abbrDayNames = <?php echo json_encode($lang->datepicker->abbrDayNames)?>;
var monthNames   = <?php echo json_encode($lang->datepicker->monthNames)?>;
 
$(function() {
    $(".date").datepicker({
        showOn: "button",
        buttonImage: "/theme/default/images/datepicker/calendar.gif",
        dayNames : dayNames,
        dayNamesShort : abbrDayNames,
        dayNamesMin : abbrDayNames,
        monthNames : monthNames,
        dateFormat:formatDate
    })
});
</script>
