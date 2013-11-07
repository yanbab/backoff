<script type="text/javascript" >
function form_cancel() {
  window.document.location = '<?= url_site("/list/$page/");?>';
}
function form_delete() {
  if(confirm('<?=lang('Delete this record ?');?>')) {
    window.document.form.action.value = 'delete';
    window.document.form.submit();
  }
}
</script>

<div id="toolbar">
  <div class="right">

  </div>
  <h2><?=$title?></h2>
   <h3>
   <?php if ($line['id']) : ?><?=lang('Edit record #');?><strong><?=$line['id']?></strong><?php else : ?><?=lang('New Record');?><?php endif;?>
   </h3>

</div>



<form  method="POST" enctype="multipart/form-data" name="form" action="<?=$_SERVER[REQUEST_URI]?>" autocomplete="off">

<div id="main">

<?php if($message) : ?>
<div class="message error"><?=$message?></div>
<?php endif; ?>


<dl class="edit">
 
<?php foreach($fields as $fieldname => $field):?>
<?php if (!$field['no_edit']) : ?>
 <?php ($alt=="alt") ? $alt="":$alt="alt" ?>
  <dt class="<?=$alt?>">
    <label for="<?=$fieldname?>"><?=$field['name']?></label>
  </dt>
  <dd class="<?=$alt?>">
      <?php if ($errors[$fieldname]) : ?>
        <div class="error">
        <?php echo $errors[$fieldname]; ?>
        </div>
      <?php endif; ?>
    
      <?php if ($field['read_only']||$schema['read_only']) : ?>
      		<?= call_user_func(array("" . $field['type'] . "Plugin", prepForDisplay),$field,$line[$fieldname]);?>
      		<input type="hidden" name="<?=Plugin::prefix?><?=$fieldname?>" value="<?=$line[$fieldname]?>">
      <?php else : ?>
      		<?= call_user_func(array( $field['type']. "Plugin", getHtml),$field,$line[$fieldname]);?>
      <?php endif;?>
      		<?= call_user_func(array( $field['type']. "Plugin", getHtmlDescription),$field,$line[$fieldname]);?>
      
    </dd>
<?php endif;?>
<?php endforeach; ?>
</dl>
<div>
    <input type="hidden" name="id" value="<?=$line['id']?>">
    <input type="hidden" name="action" id="action" value="update">
</div>

</div>
<div id="actionbar">
<input id="action_save" type="submit"  value="<?=lang('Save');?>"><input id="action_cancel" type="button" value="<?=lang('Cancel');?>" onclick="javascript:form_cancel();" >
<?php if($line['id']&&!$schema['no_delete']) : ?>
<input id="action_delete" type="button"  value="<?=lang('Delete');?>" onclick="javascript:form_delete();">
<?php endif; ?>

</div>

</form>

  
</script>

