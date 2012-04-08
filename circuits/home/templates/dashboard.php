<div class="section_container">
	<div class="section_actions"><a href="<?=create_link('photostream/upload');?>">Upload New Photos</a></div>
	<h2>My Photostream</h2>
	<div class="section_content">
		<?php if(count($photostream) > 0) { $max = 0; ?>
			<?php 
			foreach($photostream as $photo) {
				if($max++ >= 10) break;
			?>
				<a href="../photostream/view?photo=<?=$photo->id?>"><div class="thumbnail_container"><img src="<?=$photo->getImageURL('thumb')?>"></div></a>
			<?php } ?>
		<?php } else { ?>
		<div style="text-align:center">
			You don't have any photos uploaded at the moment. Why don't you upload some?
		</div>
		<?php } ?>
	</div>
</div>

<div class="section_container">
	<div class="section_actions"><a href="../sets/add">Add New Set</a></div>
	<h2>My Sets</h2>
	<div class="section_content">
		<?php
		foreach($sets as $set) {
		?>
		<div>
			<?php 
				$thumbnail = $set->getRandomPhoto();
				if(is_object($thumbnail)) {
			?>
			<div class="thumbnail_container">
				<a href="../sets/view?set=<?=$set->id?>"><img src="<?=$set->getRandomPhoto()->getImageURL('thumb')?>"></a>
			</div>
			<?php
				} else {
			?>
			<div class="thumbnail_container"></div>
			<?php
				}
			?>
			<div class="set_description">
				<h3><a href="../sets/view?set=<?=$set->id?>"><?=htmlspecialchars($set->title)?></a></h3>
				<div><?=htmlspecialchars($set->description)?></div>
			</div>
		</div>
		<?php
		}
		?>
	</div>
</div>


<div class="section_container">
	<div class="section_actions">Add Friends</div>
	<h2>My Friends</h2>
	<div class="section_content">
	
	</div>
</div>
