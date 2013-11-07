<!DOCTYPE html>
<html>
<head>
	<title><?=$_SCHEMA['title']?></title>	
	<meta http-equiv="Content-Type"	content="text/html; charset=UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?=url_base();?>themes/<?=$_CONFIG['theme']?>/css/style_screen.css" type="text/css" media="screen" >	
	<link rel="stylesheet" href="<?=url_base();?>themes/<?=$_CONFIG['theme']?>/css/style_print.css" type="text/css" media="print" >
	    <link rel="shortcut icon" href="<?=url_base();?>themes/<?=$_CONFIG['theme']?>/images/favicon.ico" type="image/x-icon" />
<!--[if lt IE 7]>
	<link rel="stylesheet" href="<?=url_base();?>themes/<?=$_CONFIG['theme']?>/css/style_ie.css" type="text/css">
<![endif]-->
<style>

.edit {
  margin : auto;
  margin-top : 100px;
  background : #eee;
  border : solid #AAA 1px;
  padding : 10px;

}

body {
  background : #D1D8E2;
}
li {
  display:inline;
  float:left;

}

</style>

</head>
<body>

<div id="wrap" class="">

	<div id="header">
		<h1 class="left" ><a href="<?=url_base();?>"><?=$_SCHEMA['title']?></a></h1>

	</div>

	<div id="login" style="text-align:center;">

<form method="post" action="<?=$_SERVER['PHP_SELF']?>" autocomplete="off">

<dl class="edit" style="display:inline-block;text-align:left;">
<?php if($error) : ?>
    <dt><div class="error"><?=lang('Bad username / password')?></div></dt>
<?php endif; ?>


  <dt><label for="username"><?=lang('Username')?></label></dt>
  <dd><input type="text" name="username" id="username" value="<?=$_POST['username']?>"></dd>
  
  <dt><label for="password"><?=lang('Password')?></label></dt>
  <dd><input type="password" name="password" id="password" value=""></dd>
  
  <dt style="text-align:right;"><input type="submit" value="<?=lang('Sign in')?>"></dt>

</dl>
  

</form>

  </div>
  

<!--[if lte IE 6]>
<script src="<?=url_base();?>modules/login/ie6-warning/warning.js"></script><script>window.onload=function(){e("<?=url_base();?>modules/login/ie6-warning/")}</script>
<![endif]-->

<script type="text/javascript">
  document.getElementById('username').focus();
</script>

</body>
</html>
