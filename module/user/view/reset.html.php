<?php include '../../common/view/header.html.php';?>
<form method="post" target="hiddenwin">
  <table align="center" class="table-3">
    <caption><?php echo $lang->user->resetcaption;?></cation>
    <tr>
      <td class='w-120px a-right'><?php echo $lang->user->resetaccount;?></td>
      <td><?php echo html::input("account", '', "class='text-1'")?></td>
    </tr>
    <tr>
      <td class='a-right'><?php echo $lang->user->resetemail;?></td>
      <td><?php echo html::input("email", '', "class='text-1'")?></td>
    </tr>
    <tr align="center"><td colspan="2"><?php echo html::submitButton($lang->user->resetsubmit);?></td></tr>
  </table>  
</form>
<?php include '../../common/view/footer.html.php';?>
