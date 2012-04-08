<form method="post">
	<table>
		<tr>
			<th width="150">Title</th>
			<td><input type="text" class="textbox" name="title" style="width:600px"></td>
		</tr>
		<tr>
			<th>Description</th>
			<td><textarea style="width:600px;height:100px;" name="description" class="textbox"></textarea></td>
		</tr>
		<tr>
			<th>Photos</th>
			<td>
			<?php 
			foreach($photostream as $photo) {
			?>
				<div class="thumbnail_container">
					<input type="checkbox" name="photo[]" value="<?=$photo->id?>">
					<img src="<?=$photo->getImageURL('thumb')?>">
				</div>
			<?php } ?>
			</td>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<td><input type="submit" name="submit" value="Create New Set"></td>
		</tr>
	</table>
</form>
