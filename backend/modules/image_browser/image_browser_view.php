<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <title><?=$_SCHEMA['title']?></title>	
  <meta http-equiv="Content-Type"	content="text/html; charset=UTF-8" >
  <base href="<?=url_base();?>">

  <script src="<?=url_base();?>modules/index/jquery-1.3.min.js" type="text/javascript"></script>  


</head>
<body>
<style>
  * {
    font-family : arial, sans-serif;
    font-size : 12px;
  }
  a img {
    border : solid black 1px;
    margin-right : 10px;
    margin-bottom : 10px;
    float : left;
    padding : 1px;
    background : #fff url(<?=url_base();?>/themes/default/images/loading.gif) no-repeat center;
  }
  
  a:hover img {
    
    border : solid #ddd 1px;
    background : #fff;
  }
  
  #upload{
    background : #ddd;
    border-bottom : solid black 1px;
    padding: 3px 10px;
    height : 2em;
  }
  form,body {
    margin : 0;
  }
  #galery{
    margin : 10px;
  }
  html,body {
      background : #555;
      height : 100%;
  }
  img.delete {
    cursor : crosshair;
  }
  img.todelete {
    border : solid red 1px;
    background : red;
    opacity : .5;
  }
  .relative {
    position : absolute;
    top : 0;
    left : 0;
  }
  .transparent {
    opacity : 0;
  }
input {
  cursor : pointer;
}

</style>

<div id="upload">
  <div id="delete" style="float:right" >
      <form method="post" name="delete_form">
        <span id="delete_message">Click an image to delete it or</span>
        <input type="button" value="Delete..." onclick="delete_start();" id="bt_delete">
        <input type="button" value="Cancel" onclick="delete_stop();" id="bt_cancel">
        
        <input type="hidden" name="file_to_delete" id="file_to_delete">
        
      </form>
  </div>  
  
  <form enctype="multipart/form-data" method="post" style="position:relative">
    <input type="submit" value="Add..." class="relative"> 
    <input type="file" style="cursor : pointer;" name="userfile" class="relative transparent" onchange="this.form.submit()" > 
    
  </form>

</div>

<div id="galery">
<?php foreach ($images as $image) : ?>
<?php 
  $info = getimagesize("$folder/$image"); 
  if($info[0]) :
    ($info[0]>120) ?  $w = " width=\"120\"" : $w="";
?>
  <a href="<?=$folder?><?=$image?>" title="<?=$image?>"><img alt="<?=$image?>" src="<?=$folder?><?=$image?>" <?=$w?> ></a>
<?php endif;?>
<?php endforeach; ?>
</div>




<script type="text/javascript">

var mode = "insert";

function delete_init() {
  $("#delete_message").hide();
  $("#bt_cancel").hide();
}

function delete_start() {
  $("#delete_message").show();
  $("#bt_cancel").show();
  $("#bt_delete").hide();

  $("img").addClass("delete");
  mode = "delete";
}
function delete_stop() {
  $("#delete_message").hide();
  $("#bt_cancel").hide();
  $("#bt_delete").show();

  $("img").removeClass("delete");
  $("img").removeClass("todelete");
}

$(function() {
 
 delete_init();
 
  $("img").click(
    function () {
      if(mode=="delete") {
        $(this).addClass("todelete");
        if(confirm("Delete this file ?")) {
          file = $(this).attr("alt");
          $(this).hide('slow');
          document.delete_form.file_to_delete.value = file;
          document.delete_form.submit();
          return false;
        } else {
          delete_stop();
          return false;
        }
      } else {
        return false;
      }
    }
  )

});

</script>
