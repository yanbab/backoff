<!DOCTYPE html>
<html>
<head>
    <title><?=$_SCHEMA['title']?><?=$sub_title?></title>
    <meta http-equiv="Content-Type"  content="text/html; charset=UTF-8" />
    <base href="http://<?=$_SERVER[HTTP_HOST]?><?=url_base();?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?=url_base();?>themes/<?=$_CONFIG['theme']?>/images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="<?=url_base();?>themes/<?=$_CONFIG['theme']?>/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="<?=url_base();?>themes/<?=$_CONFIG['theme']?>/css/style_screen.css" type="text/css" media="screen" />  
    <link rel="stylesheet" href="<?=url_base();?>themes/<?=$_CONFIG['theme']?>/css/style_print.css" type="text/css" media="print" />
    <!--[if lt IE 7]>
    <link rel="stylesheet" href="<?=url_base();?>themes/<?=$_CONFIG['theme']?>/css/style_ie.css" type="text/css">
    <![endif]-->
    <style type="text/css" >
        #wrap { font-size :<?=$_CONFIG['size']?>%; }
    </style>
    <script src="<?=url_base();?>modules/index/jquery-1.3.min.js" type="text/javascript"></script>  
    <script src="<?=url_base();?>modules/index/jquery.cookie.min.js" type="text/javascript"></script>  
    <script src="<?=url_base();?>modules/index/index.js" type="text/javascript"></script>  
<?php if(file_exists("themes/$_CONFIG[theme]/theme.js")) : ?>
    <script src="<?=url_base();?>themes/<?=$_CONFIG['theme']?>/theme.js" type="text/javascript"></script> 
<?php endif; ?>     
</head>

<body >
<div id="wrap">

  <div id="header">
    <h1><a  href="<?=url_base();?>"><?=$_SCHEMA['title']?></a></h1>
    <ul id="top_menu">
      <li><a class="_blank" href="<?=url_base();?><?=SITE_PATH?>"><?=lang('View web site');?></a></li>
      <!-- <li><a href="<?=url_site("/help/");?>" <?php if($module=='help') : ?>class="selected"<?php endif;?>><?=lang('Help');?></a></li>  -->
      <li><a href="<?=url_site("/settings/");?>" <?php if($module=='settings') : ?>class="selected"<?php endif;?>><?=lang('Preferences');?></a></li>
      <li><a href="<?=url_site("/logout/");?>"><?=lang('Sign out');?></a></li>
      <!--
      <li><a  class="_blank" href="<?=url_base();?>image_browser?folder=../documents"><?=lang('Documents');?></a></li>
      -->
    </ul>
  </div>  <!-- END #header -->
  
  <div id="sidebar">

     <ul id="menu">
<?php 
  $has_group = 0;
  $close = '<span id="close_sidebar">x</span>';
    foreach ($_SCHEMA['pages'] as $_id => $_val) :
    
     if(!$_val['module']) :
       $_val['module'] = 'list';
    endif;
    
    if($_id==url_segment(2)) :
      $class="class=\"selected\"";
    else:
      $class="";
    endif;
    if($_val[type]=='separator') {
      if($has_group) {
      
      
        ?></ul></li><?
      }
      ?><li class="group"><a href="#" title="<?= $_val[description]; ?>"><?=$close?><?= $_val[name]; ?></a></li
      ><li><ul id="group<?=$has_group?>"><?
      $has_group++;
      
    } else {
?><li class="item"><a <?=$class?> href="<?= url_site("/$_val[module]/$_id/");?>"  title="<?= $_val[description]; ?>"><?= $_val['name']; ?></a></li>
  <? }?>
<?php 
$close ='';
endforeach; ?>
<?php if($has_group) : ?>
  </ul>
</li>
<?php endif; ?>

    </ul>



  
  
  </div>  <!-- END #sidebar -->
  

  <div id="content">

  <!-- BEGIN MODULE -->

  <?php include $module_view; ?>

  <!-- END MODULE -->

  </div> <!-- END #content -->
  
  <div id="footer">
    <div class="right">
      <?= $footer_content ?>
    </div>
    copyright &copy; 2007 yanbab.net
  </div>  <!-- END #footer -->
  

</div>   <!-- END #wrap -->

</body>

</html>
