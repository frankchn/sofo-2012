<div class="section_container">
	<div class="section_actions"><a href="<?=create_link('photostream/upload');?>">Upload New Photos</a></div>
	<h2>My Photostream</h2>
	<div class="section_content">
		<?php if(count($photostream) > 0) { ?>
			<?php foreach($photostream as $photo) { ?>
				<div class="thumbnail_container">
					<img src="<?=$photo->getImageURL('thumb')?>">
				</div>
			<?php } ?>
		<?php } else { ?>
		<div style="text-align:center">
			You don't have any photos uploaded at the moment. Why don't you upload some?
		</div>
		<?php } ?>
	</div>
</div>

<div class="section_container">
	<div class="section_actions">Manage Sets</div>
	<h2>My Sets</h2>
	<div class="section_content">
	
	</div>
</div>


<div class="section_container">
	<div class="section_actions">Add Friends</div>
	<h2>My Friends</h2>
	<div class="section_content">
	
	</div>
</div>
