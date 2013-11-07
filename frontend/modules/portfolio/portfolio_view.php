
<?php if(!$module_standalone) : ?>
<div class="thumbs">
<?php foreach ($portfolio as $ref): ?>
    <div class="thumb"><a title="<?=$ref[title]?>" rel="<?=$ref[url]?>" href="references/<?=$ref[url]?>/"><img src="documents/images/portfolio/thumbnails/<?=$ref['thumbnail']?>" width="80" height="80"></div>
<?php endforeach; ?>

<?php for ($i=1;$i<=(16-sizeof($portfolio));++$i) :?>
    <div class="thumb"></div>
<?php endfor; ?>



</div>
<div class="reference">
<?php endif?>



    <div class="info">        
        <p class="right">
            <?=nl2br($current_ref['info']);?>
        </p>
        <p>
            <strong><?=$current_ref['title']?></strong><br>
            http://<?=$current_ref['url']?>/
        </p>

    </div>
    <div class="image">
    <a href="http://<?=$current_ref['url']?>" target="_blank"><img width="540" height="325" id="img_ref" src="documents/images/portfolio/<?=$current_ref['image']?>" ></a>
    </div>
    
    
<?php if(!$module_standalone) : ?>
</div>
<?php endif?>
