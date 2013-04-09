<?php include '../../common/view/header.html.php';?>
<form method="post">
<table align='center' class='table-1 table-bordered'>
  <caption><?php echo $lang->user->modifyPassword;?></caption>
  <tr>
  <th class='rowhead'><?echo $lang->user->password ?></th>
    <td><?php echo html::password('password1', '', "class='text-3'");?>字母和数字组合，最少六位</td>
  </tr>
  <tr>
  <th class='rowhead'><?echo $lang->user->password2?></th>
    <td><?php echo html::password('password2', '', "class='text-3'");?></td>
  </tr>
  <tr>
  <td colspan="2" align="center"><?php echo html::submitButton($lang->user->submit). html::hidden('resetKey',"$resetKey")?></td>
  </tr>
</table>
</form>
<?php include '../../common/view/footer.html.php';?>
