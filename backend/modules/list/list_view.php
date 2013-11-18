
<!-- LIST VIEW -->

<form action="<?=$_SERVER[PHP_SELF]?>">

<div id="toolbar">

  <h2><?=$_SCHEMA['pages'][$table]['name']?></h2>
  <h3>
<?php if($total): ?>
    <?=lang('Results');?> <strong><?=$start?> - <?=$end?></strong> <?=lang('of');?> <strong><?= $total ?></strong>
<?php else : ?>
    <?=lang('No result');?>
<?php endif; ?>
<?php if ($search): ?>
    <?=lang('for');?> <strong><?=$search?></strong>
<?php endif;?>
  </h3>
   


  <!-- Search -->
  <div class="right">
    <form action="<?=$_SERVER[PHP_SELF]?>">
    <div>
      <input type="hidden" name="order" value="<?=$_GET['order']?>">
      <input type="hidden" name="direction" value="<?=$_GET['direction']?>">
      <input type="text"   name="search" id="search" value="<?=$search;?>" size="15">
      <input type="submit" id="search_button" value="<?=lang('Search');?>">  
      <input id="adv_search" type="button" value="...">
<?php if ($search): ?>      
      <input type="submit" id="search_close" onclick="$('#search').val('');" value="<?=lang('Show all');?>"> 
<?php endif;?>      
    </div>
  </div>
</div>


<div id="main">


<?php if($message) : ?>
<!-- Actions / Messages -->
<div class="message">
<a class="close right" href="#close" onclick="$('.message').slideUp();return false;">close</a>
  <?=$message?>
</div>
<?php endif; ?>

<!-- Advanced Search -->

<?php
    if(!is_array($adv_search['id'])) {
        $adv_search['id'] = array ('0'=> '');
        
      $hide_adv_search = true;
    }
    
    if(count($adv_search['id'])<=1&&($adv_search['operator'][0]=='%like%'&&$adv_search['value'][0]=='')) {
      $hide_adv_search = true;
    } 
    
?>
<div id="searchPanel" class="message" <?php if($hide_adv_search) : ?> style="display:none;" <?php endif; ?> >
    <div class="content">  
      <a class="close right" href="<?=url_site("/list/" . $_SCHEMA['pages'][$table]['table'] . "/$url_append");?>">close</a>
    <input class="right" type="submit" value="<?=lang('Search');?>">  
<?php foreach($adv_search['id'] as $cur_id => $cur_val) : ?>
        <div style="" id="search_new">
            <select name="adv_search[id][]" id="adv_search[id][]">
            <?php foreach ($fields as $field) : ?>
                <option value="<?=$field['id'];?>" <?php if($adv_search['id'][$cur_id]==$field['id']) :?>selected="selected"<?php endif;?>><?=$field['name'];?></option>
            <?php endforeach; ?>  
            </select>
            <select name="adv_search[operator][]">
            <?php foreach ($operators as $operator=>$desc) : ?>    
                <option value="<?=$operator?>" <?php if($adv_search['operator'][$cur_id]==$operator) :?>selected="selected"<?php endif;?>><?=lang($desc);?></option>
            <?php endforeach; ?>        
            </select>
            <input name="adv_search[value][]" value="<?=$adv_search['value'][$cur_id]?>" size="15">
            <?php if($cur_id!='0') : ?>
            <input class="search_minus" type="button" value="<?=lang('Remove search field');?>">    
            <?php endif; ?>
        </div>
<?php endforeach; ?>    
    </div>
   
<!--    
    <p>
    <b>> Recherches stockées</b><br>
    <ul>
        <li><a href="">Recherche du 25 mai 2008</a></li>
        <li><a href="">Recherche du 26 mai 2008</a></li>
    </ul>
   &nbsp; &nbsp;  Nom : <input value="Recherche du 1 avril 2009"> <input type="submit" value="Enregistrer">
    
    </p>
-->    
</div>
</form>




<form method="post" action="<?=url_site("/edit/" . $page. "/");?>">


<table class="list">
<?php ($_GET['direction']=='desc') ? $direction = 'asc' : $direction = 'desc';?>
  <!-- Header -->
  <thead>
  <tr>
    <th width="16"><input type="checkbox" id="check_all" ></th>
    <th width="16"><a href="<?=url_site("/list/$page/");?>?search=<?=$_GET['search']?>&amp;order=id&amp;direction=<?=$direction;?>&amp;query=<?=$_GET['$query']?>&amp;page=<?=$_GET['page']?>"> #</a></th>
<?php foreach($fields as $fieldname => $field): ?>
<?php
  // Order stuff 
  $order = $fieldname;
  $direction='asc';
  $th_class='';
  if($_GET['order']==$order) {
    $th_class='order';
    if($_GET['direction'] == 'asc') {
      $direction = 'desc';
      $th_class .= ' asc';
    }
    if($_GET['direction'] == 'desc') {
      $order = '';
      $direction = '';
      $th_class .= ' desc';
    }
    
  }
  
?>
<?php if (!$field['edit_only']) : ?>
    <th  class="<?php echo $th_class; ?>"><a href="<?=url_site("/list/$page/" );?>?search=<?=$_GET['search']?>&amp;order=<?=$order;?>&amp;direction=<?=$direction;?>&amp;page=<?=$_GET['page']?>"><?=$field['name'];?></a></th>
<?php endif; ?>
<?php endforeach; ?>
  </tr>
  </thead>
  
  <!-- Results -->
<?php foreach($lines as $line):?>
  <tr class="row<?=$alt?>">
    <td class="action check" width="16"><input type="checkbox"  name="checked_id[]" value="<?=$line['id']?>"></td>
    <td class="action"><strong><a class="edit_link" title="<?=lang('Edit this item')?>" href="<?=url_site("/edit/$page"  . "/$line[id]/");?><?php //echo $url_append;?>">#<?=$line[id]?></a></strong></td>
<?php foreach($fields as $fieldname => $field): ?>
<?php 
if($field['id']) {
    $fieldname = $field['id'];
}
// pass table name & id
$field['record']['table'] = $_SCHEMA['pages'][$table]['table'];
$field['record']['id'] = $line['id']; // FIX ME : if key is not 'id'
?>
<?php if (!$field['edit_only']) : ?>
    <td><?= call_user_func(array( $field['type'] . 'Plugin', prepForDisplay),$field,$line[$fieldname]);?></td>
<?php endif; ?>
<?php endforeach; ?>
  </tr>
<?php ($alt) ? $alt = '' : $alt = ' alt';?>
<?php endforeach; ?> 

</table>




</div>

<!-- Actions -->
<div id="actionbar">	    
	
	<div class="right">
	      <?= $htmlPager ?>
	</div>
	
	<div class="left">
<?php 
// FIXME : no_delete should be verified in edit.php too 
if (!$schema['no_create']) : ?>
	  <div>
<!--	  <input type="hidden" name="action" value="create">
-->		<input type="submit" value="<?=lang('Add');?>" style="margin-right : 1em;">
    </div>
<?php endif; ?>	
	</div>



	<div class="left" id="adv_actions" style="display:none;">
		<select onchange="this.form.action = '<?=url_site("/");?>list/' +   '<?=$page?>' + '/' + this.value + '/' + '<?=$url_append?>';this.form.submit();" >
			<option>Actions...</option>
			<option value="delete">&nbsp; Effacer</option>
			<option value="duplicate">&nbsp; Dupliquer</option>
			<option value="export">&nbsp; <?=lang('Export');?></option>
		</select>
		&nbsp;
		<input name="select_all_search" id="select_all_search" type="checkbox" value="1"><label for="select_all_search">&nbsp;Appliquer aux <?= $total ?> résultats<sup></sup></label>
		
		</select>
	</div>


</div>

<script src="assets/scripts/jquery.highlight.js" type="text/javascript"></script>  
<script src="assets/scripts/jquery.duplicate-remove.js" type="text/javascript"></script>  
<script src="modules/list/list.js" type="text/javascript"></script>  
