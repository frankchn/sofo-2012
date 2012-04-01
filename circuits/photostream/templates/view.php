<div>
	<div style="float:right; text-align:right">
		<div>
			<a href="<?=$photo->getImageURL('medium')?>" target="_new">Medium</a> | 
			<a href="<?=$photo->getImageURL('large')?>" target="_new">Large</a> | 
			<a href="<?=$photo->getImageURL('original')?>" target="_new">Original</a>
		</div>
		<?php
		if($photo->user_id == $user->id) {
		?>
		<div><a href="delete?photo=<?=$photo->id?>">Delete</a></div>
		<?php	
		}
		?>
	</div>
	<h2>Photo &mdash; <?=_s($photo->title);?></h2>
</div>
<div style="text-align:center">
	<img src="<?=$photo->getImageURL('small')?>" border="0">
</div>
<div style="width:600px;margin:10px auto;padding:20px;border:1px solid #eeeeee;background-color:#f9f9f9">
	<?=_s($photo->description)?>
</div>
<div style="text-align:center;padding-top:25px;">
	<h3>More in <?php $u = new User($photo->user_id); echo _s($u->full_name); ?>'s Photostream</h3>
	<?php
		$prevPhoto = $photostream->getPrev();
		if(is_object($prevPhoto)) {
	?>
		<div class="thumbnail_container"><a href="view?photo=<?=$prevPhoto->id?>"><img src="<?=$prevPhoto->getImageURL('thumb')?>"></a></div>
	<?php
		}
	?>
	
	<?php
		if(is_object($photo)) {
	?>
		<div class="thumbnail_container"><img src="<?=$photo->getImageURL('thumb')?>"></div>
	<?php
		}
	?>
	
	<?php
		$nextPhoto = $photostream->getNext();
		if(is_object($nextPhoto)) {
	?>
		<div class="thumbnail_container"><a href="view?photo=<?=$nextPhoto->id?>"><img src="<?=$nextPhoto->getImageURL('thumb')?>"></a></div>
	<?php
		}
	?>		
</div>
