<?=$page['content']?>

<div>
<?php foreach ($galery as $image) : ?>
	<a class="thumbnail" style="display:inline-table;margin:0 10px 10px 0;" title="<?=$image[title]?>" href="files/images/<?=$image['image']?>">
		<img src="files/images/thumbnails/<?=$image['thumbnail']?>" alt="" >
	</a>
<?php endforeach; ?>
</div>
<?php if(!count($galery)): ?>
	<div class="alert alert-info">
	No pictures yet
	</div>
<?php endif; ?>