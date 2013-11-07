
<div id="toolbar">
  <div class="right">

  </div>
  <h2 class=left><?=$_SCHEMA['pages'][$table]['name']?></h2>
  
  
  
  <?=lang('Export data');?>
   <div class="left">
   <small>
   </small></div>

</div>
<div id="main">
  <table class="edit" >
  <tr>
    <td><?=lang('Copy the data below and paste it in your document.');?></td>
  </tr>
  <tr>
    <td><textarea id="export_field" style="width:400px; height : 200px;" wrap="off"><?=$data?></textarea></td>
  </tr>  
  
<!--  
  <tr><td>
  
  <?=lang('Alternatively, you can download the data as file :');?><br>
    <ul>
      <li><a href="<?=url_site("/export/$page/csv/")?>">export_<?=$page?>_<?=date("Ymd")?>.csv</a> (CSV)</li>
      <li><a href="<?=url_site("/export/$page/xls/")?>">export_<?=$page?>_<?=date("Ymd")?>.xls</a> (Excel)</li>
    </ul>      
  </td></tr>
  
-->  
  
  </table>

</div>

<div id="actionbar">
  		<input type="button" value="<?=lang('Continue');?>" onclick="javascript:document.location='<?=url_site("/list/$page/");?>';" >
</div>

<script type="text/javascript">
  document.getElementById('export_field').select();
</script>
