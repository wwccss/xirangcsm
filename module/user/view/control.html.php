<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<div class='row'>
  <div class='span2'>
    <div class='cont-left'><?php include 'blockusermenu.html.php';?></div>
  </div>
  <div class='span10'>
    <div class='cont'>
      <table class='table-1'>
        <caption>
          <?php printf($lang->user->control->welcome, $this->app->user->account);?>
        </caption>
        <tr><td><?php printf($lang->user->control->welcome, $this->app->user->account);?></td></tr>
      </table>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
