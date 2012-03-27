<h2>Sign In</h2>
<p>Login to your Micro-Flick account by providing your user name and password below.</p>
<?php if(!empty($message)) { ?>
	<div class="error"><?=$message;?></div>
<?php } ?>
<form method="post">
	<table>
		<tr>
			<th width="150">Email Address</th>
			<td><input type="email" class="textbox" name="email"></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" class="textbox" name="password"></td>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<td><input type="submit" name="signin" value="Sign In"></td>
		</tr>		
	</table>
</form>
