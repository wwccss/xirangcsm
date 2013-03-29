<?php
$webRoot      = $this->app->getWebRoot();
$jsRoot       = $webRoot . "js/";
$defaultTheme = $webRoot . 'theme/default/';
?>
<link rel='stylesheet' href='<?php echo $defaultTheme;?>datepicker.css' type='text/css' />
<script src='<?php echo $jsRoot;?>jquery/datepicker/min.js'  type='text/javascript'></script>
<script src='<?php echo $jsRoot;?>jquery/datepicker/date.js' type='text/javascript'></script>
<script language='javascript'>
Date.firstDayOfWeek = 1;
Date.format = 'yyyy-mm-dd';
$.dpText = <?php echo json_encode($lang->datepicker->dpText)?>

Date.dayNames     = <?php echo json_encode($lang->datepicker->dayNames)?>;
Date.abbrDayNames = <?php echo json_encode($lang->datepicker->abbrDayNames)?>;
Date.monthNames   = <?php echo json_encode($lang->datepicker->monthNames)?>;
 
$(function() {
    startDate = '1970-1-1';
    $(".date").datePicker({createButton:true, startDate:startDate})
        .bind('click', function() {
            $(this).dpDisplay();
            this.blur();
            return false;
        });
});
</script>
