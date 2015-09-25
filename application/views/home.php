<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="/assets/style.css">
</head>
<body>
	<p><a href="/logout">Logout</a></p>
	<h1>Welcome, <?=$profile['alias']?></h1>
	<h3>Quotable Quotes</h3>
	<div class = 'quoteblock'>
	<?php foreach($all_quotes as $quote){
	  ?>
		<p><?=$quote['quoted_by']?>: "<?=$quote['message']?>"</p>
		<p>Posted by 
			<?php
				foreach ($users as $user) {
					if($user['id'] == $quote['posted_by'])
					{ 
						echo $user['name'];
					}
				}
			 ?>
		</p>
		<form action="/add" method="post">
			<input type="hidden" name="quote_id" value="<?=$quote['id']?>">
			<button>Add To My List</button>
		</form>
	<?php 
	} ?>	
	</div>
	<h3>Favorite Quotes</h3>
	<div class="quoteblock">
	<?php foreach($favorite as $favorites){ ?>
		<p><?=$favorites['quoted_by']?>: "<?=$favorites['message']?>"</p>
		<p>Posted by 
			<?php
				foreach ($users as $user) {
					if($user['id'] == $favorites['posted_by'])
					{ 
						echo $user['name'];
					}
				}
			 ?>
		</p>
		<form action="/remove" method="post">
			<input type="hidden" name="quote_id" value="<?=$favorites['quotes_id']?>">
			<button>Remove from My List</button>
		</form>
	<?php } ?>
	</div>
	<h1>Contribute a Quote</h1>
	<form action="/contribute" method="post">
		<p>Quoted By: <input type="text" name="quoted_by"></p>
		<p>Message: <textarea name="quote"></textarea></p>
		<button>Submit</button>
	</form>
</body>
</html>