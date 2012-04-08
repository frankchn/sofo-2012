<div class="section_actions"><a href="../sets/delete?id=<?=$set->id?>">Delete Set</a></div>
<h2>View Set &mdash; <?=htmlspecialchars($set->title)?></h2>
<?php
	$photos = $set->getPhotos();
	foreach($photos as $photo) {
?>
	<a href="../photostream/view?photo=<?=$photo->id?>"><div class="thumbnail_container"><img src="<?=$photo->getImageURL('thumb')?>"></div></a>
<?php
	}
?>
