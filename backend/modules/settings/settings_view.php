
<form  method="POST" action="<?=$_SERVER[PHP_SELF]?>">


<div id="toolbar">
  <h2 class="left"><?= lang('Preferences');?></h2>



</div>



<div id="main">



 <dl class="edit">
  <dt><label for="results"><?= lang('Number of Results');?> </label></dt>
  <dd>
    <?= html_select('results',$results,$_CONFIG['results']);?>
    <?= lang('results per page.');?> 
  </dd>

  <dt class="alt"><label for="lang"><?= lang('Language');?>  </label></dt>
  <dd class="alt">
    <?= html_select('lang',$languages,$_CONFIG['lang']);?>
  </dd>
  <dt><label for="theme"><?= lang('Theme');?>  </label></label></dt>
  <dd>
    <?= html_select('theme',$themes,$_CONFIG['theme']);?>

      <!--[if lt IE 7]>
        <br><?php echo lang('IE6_warning'); ?>
      <![endif]-->
  </dd>
  <dt class="alt"><label for="size"><?= lang('Text size');?>  </label></dt>
  <dd class="alt">
    <?= html_select('size',$size,$_CONFIG['size']);?>
     
  </dd>
 </dl> 
 
 <!--
 // FIXME : login_cookie doesn't work
 <tr>
  <th scope="row"><label for="login_cookie"><?= lang('Sign in');?> : </label></th>
  <td>
    <input type="checkbox" id="login_cookie" name="login_cookie" <?php if($_CONFIG['login_cookie']) : ?>CHECKED="CHECKED"<?php endif; ?>><label for="login_cookie"> <?= lang('Remember me on this computer');?></label>
  </td>
 </tr>
 -->



<input type="hidden" name="change_settings" value="1">
<input type="hidden" name="redirect_uri" value="<?php echo $_SESSION['last_uri'];?>">




 </div>
 <div id="actionbar">
 
<input type="submit" value="<?php echo lang('Save preferences');?>">
 </div>
 
 
 </form>
 
