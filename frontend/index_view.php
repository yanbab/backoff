<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?=$config['site_title']?></title>
    <base href="/Public/backoff/frontend/"></base>
    <meta name="keywords" content="<?=$config['site_keywords']?>" />
    <meta name="description" content="<?=$config['site_description']?>" />
    <link href="bower_components/bootstrap-css/css/bootstrap.min.css" rel="stylesheet" />
    <style>

        /* Space out content a bit */
        body {
            padding-top: 20px;
            padding-bottom: 20px;
            color:#444;
        }   
        
        h1 {
            font-size: 20px;
            border-bottom: 1px solid #e5e5e5;
            padding-bottom: 20px;
            margin-bottom: 15px;
            margin-top:0;
        }
        /* Everything but the jumbotron gets side spacing for mobile first views */
        .header,
        .marketing,
        .footer {
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Custom page header */
        .header {
            border-bottom: 1px solid #e5e5e5;
            margin-bottom: 15px
        }
        /* Make the masthead heading the same height as the navigation */
        .header h3 {
            margin-top: 0;
            margin-bottom: 0;
            line-height: 40px;
            padding-bottom: 19px;
        }

        /* Custom page footer */
        .footer {
            padding-top: 19px;
            color: #777;
            border-top: 1px solid #e5e5e5;
        }

        /* Customize container */
        @media (min-width: 768px) {
            .container {
                max-width: 730px;
            }
        }
        .container-narrow > hr {
            margin: 30px 0;
        }

        /* Main marketing message and sign up button */
        .jumbotron {
            text-align: center;
            border-bottom: 1px solid #e5e5e5;
        }

        .jumbotron .btn {
            font-size: 21px;
            padding: 14px 24px;
        }

        /* Supporting marketing content */
        .marketing {
            margin: 40px 0;
        }
        .marketing p + h4 {
            margin-top: 28px;
        }
    /* Backoff styles */
        /* Responsive: Portrait tablets and up */
        @media screen and (min-width: 768px) {
            /* Remove the padding we set earlier */
            .header,
            .marketing,
            .footer {
                padding-left: 0;
                padding-right: 0;
            }
            /* Space out the masthead */
            .header {
                margin-bottom: 15px;
            }
            /* Remove the bottom border on the jumbotron for visual effect */
            .jumbotron {
                border-bottom: 0;
            }
        }
        
    
    </style>

</head>

<body>

<div class="container">

    <div class="header">
        <ul class="nav nav-pills pull-right">
          <?php foreach($pages as $p) : ?>
            <?php if($p['status']) : ?>
              <li  <?php if($p['url']==$page['url']): ?>class="active"<?php endif;?> ><a href="./<?=$p['url']?>"><?=$p['name']?></a></li>
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
