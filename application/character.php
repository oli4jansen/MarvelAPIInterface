<?php
$page = 'character';
include 'header.php';

// Get the current page number
$id = 0;
if(isset($_GET['id']) && is_numeric($_GET['id'])) $id = $_GET['id'];

if($id==0)
{
	?>
	Dit is geen geldig ID.
	<?php
}
else
{

	// Get the character information and put it into an array
	$data = json_decode($API->getCharacter($id));
	?>

	<?php
	foreach($data->data->results as $character)
	{
		?>
		<img src="<?php echo $character->thumbnail->path.'.'.$character->thumbnail->extension; ?>" height="250">
		<h2><?php echo $character->name; ?></h2>
		<p><?php echo $character->description; ?></p>

		Totaal aantal comics met <?php echo $character->name; ?>: <?php echo $character->comics->available; ?>.<br>
		<?php
		foreach($character->comics->items as $comic)
		{
			?><a href="comic.php?id=<?php echo end(explode('/', $comic->resourceURI)); ?>" class="comic"><?php echo $comic->name; ?></a><br><?php
		}
	}
}
?>