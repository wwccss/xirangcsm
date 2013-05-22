<?php include '../../common/view/header.html.php';?>
<form method="post" target="hiddenwin">
<table align="center" class="table-6">
    <caption><?php echo $lang->user->resetcaption;?></cation>
    <tr><th class='w-120px'><?php echo $lang->user->resetaccount;?></th><td><?php echo html::input("account")?></td></tr>
    <tr><th><?php echo $lang->user->resetemail;?></th><td><?php echo html::input("email")?></td></tr>
    <tr align="center"><td colspan="2"><?php echo html::submitButton($lang->user->resetsubmit);?></td></tr>
</table>  
</form>
<?php include '../../common/view/footer.html.php';?>
