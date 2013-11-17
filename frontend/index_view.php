<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $config['site_title'];?></title>
    <base href="<?php echo $_CONFIG['site']['base_url'];?>"></base>
    <meta name="keywords" content="<?php echo $config['site_keywords'];?>" />
    <meta name="description" content="<?php echo $config['site_description'];?>" />
    <link href="bower_components/bootstrap-css/css/bootstrap.min.css" rel="stylesheet" />
    <link href="styles/style.css" rel="stylesheet" />
</head>

<body>

<div class="container">

    <div class="header">
        <ul class="nav nav-pills pull-right">
          <?php foreach($pages as $p) : ?>
            <?php if($p['status']) : ?>
              <li  <?php if($p['url']==$page['url']): ?>class="active"<?php endif;?> ><a href="<?=$_CONFIG['site']['url']?>/<?=$p['url']?>"><?echo $p['name'];?></a></li>
          <?php endif ; ?>
        <?php endforeach; ?>  
        </ul>
        <h3 class="text-muted"><?=$config['site_title'];?></h3>
    </div>

    <?php include($page['view']);?>

    <div class="footer">
          <?=nl2br($config['footer'])?>
    </div>

</div> <!-- /container -->

<?php if(isset($config['google_ga'])) : ?>
    <!-- Google analytics -->
    <script type="text/javascript">
      var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
      document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
      try {
        var pageTracker = _gat._getTracker("<?php echo $config['google_ga']; ?>)";
        pageTracker._trackPageview();
    } catch(err) {
    }
</script>
<?php endif; ?>

</body>
</html>
