
<div id="toolbar">
  <div class="right">

  </div>
  <h2 class=left><?=$title?></h2>
  
  
  
  <?=lang('Delete');?>
   <div class="left">
   <small>
   </small></div>

</div>


<form>
<div class="message">
<pre><?php print_r($_POST);?></pre>
<p>
Delete <?=count($_POST[checked_id])?> elements ?
<input name="ids" type="hidden" value="<?=addslashes(serialize($_POST[checked_id]));?>">
</p>
</div>
</form>


<div id="actionbar">
  		<input type="button" value="<?=lang('Delete');?>" onclick="javascript:document.location='<?=url_site("/list/$page/");?>';" >
  		<input type="button" value="<?=lang('Cancel');?>" onclick="javascript:document.location='<?=url_site("/list/$page/");?>';" >
</div>

