<?php include '../../common/view/header.admin.html.php';?>
<form method="post" target="hiddenwin">
<table align="center" class="table-6 table-bordered">
    <caption><?php echo $lang->user->resetcaption;?></cation>
    <tr><th><?php echo $lang->user->resetaccount;?></th><td><?php echo html::input("account")?></td></tr>
    <tr><th><?php echo $lang->user->resetemail;?></th><td><?php echo html::input("email")?></td></tr>
    <tr align="center"><td colspan="2"><?php echo html::submitButton($lang->user->resetsubmit);?></td></tr>
</table>  
</form>
<?php include '../../common/view/footer.admin.html.php';?>
