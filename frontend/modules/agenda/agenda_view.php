
<?php if($artiste) : ?>
    <!-- Fiche Exposition -->
    
    <h1 style="text-transform : none;"><strong><?php if($artiste[id_type]==3):?>Évènement<?php else : ?>Expo<?php endif; ?></strong> <?=$artiste['artist']?></h1>
    <?php if($artiste['image']): ?>
    <img width="120"  align="left" alt="" src="documents/images/agenda_flyers/<?=$artiste[image]?>" style="margin-right: 25px;margin-bottom:10px;" />
    <?php endif; ?>    
    <div class="margin-bottom" style="text-align : justify;">     
    <h3><?=$artiste['date']?></h3>
    <?=$artiste['intro']?> 
    </div>
    <div class="margin-bottom clear" >
    <?=$artiste['content']?> 
    </div>
    
    <?php if(sizeof($galery)>0) : ?>
    <h2><strong>Galerie</strong> d'images</h2>
    <ul class="galery ">
    <?php foreach($galery as $photo) : ?>
        <li><a rel="box" title="<?=$photo[title]?>" href="documents/images/agenda/<?=$photo['image']?>" class="box"><img src="documents/images/agenda/thumbnails/<?=$photo['thumbnail']?>" width="90"></a></li>
    <?php endforeach;?>
    </ul>
    <div class="clear margin-bottom"></div>
    <?php endif; ?>
    
    <?php if($artiste['url']):?> 
    
    <h2><strong>Site</strong> Web</h2>
        <p>
        <a target="_blank" class="more" href="<?=$artiste['url']?>"><?=$artiste['url']?></a> 
        </p>
    <?php endif;?>

<?php else : ?>
    <!-- Liste expos -->
    
    <h1>Évenements</h1>

    <?php foreach($expos as $expo):?>

        <? if ($expo['id_type']=='2'&&!$first) : ?>
<!--            <h2>Artistes</h2>
            <? $first =  TRUE; ?>
-->        <? endif; ?>
        <? if ($expo['id_type']=='1'&&!$first2) : ?>
            <h2>Expositions</h2>
            <? $first2 =  TRUE; ?>
        <? endif; ?>

<?php if($expo['id_type']!='2' ) : ?>
    <div class="expo_intro">
        <?php if($expo['image']): ?>
        <a  href="agenda/<?=urlencode($expo['artist'])?>"><img width="120"  align="left" alt="" src="documents/images/agenda_flyers/<?=$expo[image]?>" style="" /></a>
        <?php endif; ?>
        <? if(	1) : ?>
        <div class="right invert"><?=$expo['date']?></div>
        <? endif;?>
        <div  style="margin-left : 145px;text-align : justify;">
        <h3 style="text-align : left;"><?=$expo['artist']?> </h3>
        
        <?php if($expo['intro']): ?>
        <div><?=$expo['intro']?></div>
        <?php endif;?>
        
        <a class="more" href="agenda/<?=urlencode($expo['artist'])?>">En savoir plus&hellip;</a>
        
        </div>
    </div>
    <div class="clear margin-bottom"></div>
<?php endif ;?>
    <?php endforeach;?>


<?php endif;?>
