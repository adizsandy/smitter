<div>
Hello there this is contact page  
<br> 
</div>
<form method="post">
	<input type="hidden" name="_token" value="<?php echo csrf_token('contact'); ?>">
	Email: <input type="text" name="email">
	Password: <input type="text" name="password">
	<input type="submit" name="contactForm" value="Submit">
</form>