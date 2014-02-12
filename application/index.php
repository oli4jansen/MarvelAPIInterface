<style>
* {
	-webkit-box-sizing: border-box;
	box-sizing: border-box;

	font-family: Helvetica, Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
body {
	background-color: #222;
}
h1, h2, h3 {
	padding: 0;
	margin: 0 0 10px;
	font-weight: 300;
}

.character {
	display: block;
	padding: 0;
	margin: 20px auto;
	max-width: 700px;

	background-color: #333;
	color: #eee;
}
	.character img {
		display: inline-block;
		vertical-align: top;
		width: 20%;
		padding: 0;
		margin: 0;
	}
	.character .content {
		display: inline-block;
		vertical-align: top;
		width: 80%;
		margin: 0;
		padding: 15px;
	}
		.character .content h2 {
			text-transform: uppercase;
		}
</style>

<?php
include 'config.php';

// Get the full character list and put it into an array
$data = json_decode($API->getCharacterList());

foreach($data->data->results as $character)
{
	?>

	<div class="character">

		<img src="<?php echo $character->thumbnail->path.'.'.$character->thumbnail->extension; ?>"><div class="content">
			<h2><?php echo $character->name; ?></h2>
			<p><?php echo $character->description; ?></p>
		</div>

	</div>
	<?php
//	print_r($character);
}