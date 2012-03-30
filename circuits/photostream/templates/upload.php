<h2>Upload a New Photo</h2>
<?php if(!empty($error_message)) { ?>
	<div class="error"><?=$error_message;?></div>
<?php } ?>
<?php if(!empty($success_message)) { ?>
	<div class="success"><?=$success_message;?></div>
<?php } ?>
<form method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<th width="150">Image File</th>
			<td><input type="file" class="textbox" name="image" style="width:400px;"></td>
		</tr>
		<tr>
			<th width="150">Title</th>
			<td><input type="text" class="textbox" name="title" style="width:400px;"></td>
		</tr>
		<tr>
			<th width="150">Description</th>
			<td><textarea name="description" class="textbox" style="width:400px;height:150px"></textarea></td>
		</tr>
		<tr>
			<th width="150"> </th>
			<td><input type="submit" name="upload" value="Upload Photo"></td>
		</tr>							
	</table>
</form>
