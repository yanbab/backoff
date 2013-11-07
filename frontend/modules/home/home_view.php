<?=$page['content']?>
<p class="clear">&nbsp;</p>

    <?php foreach($expos as $expo):?>

        <? if ($expo['id_type']=='3'&&!$first) : ?>
            <h2 class="clear">Évènements</h2>
            <? $first =  TRUE; ?>
        <? endif; ?>

        <? if ($expo['id_type']=='1'&&!$first2) : ?>
            <h2 class="clear">Expositions</h2>
            <? $first2 =  TRUE; ?>
        <? endif; ?>
<? if ($expo['id_type']=='2') : ?>


<?php else : ?>
    <div class="expo_intro">
        <?php if($expo['image']): ?>
        <a  href="agenda/<?=urlencode($expo['artist'])?>"><img width="120"  align="left" alt="" src="documents/images/agenda_flyers/<?=$expo[image]?>" style="" /></a>
        <?php endif; ?>
        <? if(	1) : ?>
        <div class="right invert"><?=$expo['date']?></div>
        <? endif;?>
        <div  style="<?php if($expo['image']): ?>margin-left : 145px;<?php endif; ?>text-align : justify;">
        <h3 style="text-align : left;"><?=$expo['artist']?> </h3>
        
        <?php if($expo['intro']): ?>
        <div><?=$expo['intro']?></div>
        <?php endif;?>
        
        <a class="more" href="agenda/<?=urlencode($expo['artist'])?>">En savoir plus&hellip;</a>
        </div>
    </div>
    <div class="clear margin-bottom"></div>
<?php endif; ?>






    <?php endforeach;?>
    
 
    
