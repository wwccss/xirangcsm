<?php RUN_MODE == 'admin' ? include '../../common/view/header.admin.html.php' : include '../../common/view/header.html.php';?>
<div class='row'>
  <?php if(RUN_MODE == 'front'):?>
  <div class='span2'>
    <div class='cont-left'><?php include 'blockusermenu.html.php';?></div>
  </div>
  <?php endif;?>
  <div <?php if(RUN_MODE == 'front') echo "class='span10'"?>>
    <form method='post' target='hiddenwin' class='cont bd-none'>
    <table class='<?php echo RUN_MODE == 'front' ? 'table-1' : 'table-5'?>' align='center'>
      <caption><?php echo $lang->user->profile;?></caption>
        <tr>
          <td align='right' class='w-60px'><?php echo $lang->user->account;?></td>
          <td><?php echo $user->account;?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->realname;?></td>
          <td><?php echo $user->realname;?></td>
        </tr>
        <?php if(RUN_MODE == 'admin'):?>
        <tr>
          <td align='right'><?php echo $lang->user->role;?></td>
          <td><?php echo $lang->user->roleList[$user->role];?></td>
        </tr>
        <tr>
          <td align='right'><?php echo $lang->user->gender;?></td>
          <td><?php echo $lang->user->genderList[$user->gender];?></td>
        </tr>
        <?php endif;?>
        <tr>
          <td align='right'><?php echo $lang->user->email;?></td>
          <td><?php echo $user->email;?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->birthday;?></td>
          <td><?php echo $user->birthday;?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->company;?></td>
          <td><?php echo $user->company;?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->address;?></td>
          <td><?php echo $user->address;?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->zipcode;?></td>
          <td><?php echo $user->zipcode;?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->mobile;?></td>
          <td><?php echo $user->mobile;?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->phone;?></td>
          <td><?php echo $user->phone;?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->qq;?></td>
          <td><?php echo $user->qq;?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->msn;?></td>
          <td><?php echo $user->msn;?></td>
        </tr>  
        <tr>
          <td align='right'><?php echo $lang->user->gtalk;?></td>
          <td><?php echo $user->gtalk;?></td>
        </tr>  
 
        <tr><td colspan='2' align='center'><?php echo html::a(inlink('edit', "userID=$user->id&type=$type"), $lang->user->editProfile);?></td></tr>
      </table>
    </form>
  </div>
</div>
<?php RUN_MODE == 'admin' ? include '../../common/view/footer.admin.html.php' : include '../../common/view/footer.html.php';?>
