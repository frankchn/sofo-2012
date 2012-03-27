<h2>New Account</h2>
<p>Sign up for a new account by providing your email address, password and full name.</p>
<?php if(!empty($message)) { ?>
	<div class="error"><?=$message;?></div>
<?php } ?>
<form method="post">
	<table>
		<tr>
			<th width="150">Email Address</th>
			<td><input type="email" class="textbox" name="email" value="<?=isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" class="textbox" name="password"></td>
		</tr>
		<tr>
			<th>Full Name</th>
			<td><input type="text" class="textbox" name="full_name" value="<?=isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : ''; ?>"></td>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<td><input type="submit" name="signup" value="Register Account"></td>
		</tr>		
	</table>
</form>
