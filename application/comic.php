<?php
$page = 'comic';
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

	// Get the comic information
	$data = json_decode($API->getComic($id));
	?>

	<?php
	foreach($data->data->results as $comic)
	{
		?>
		<div class="content-holder">
			<h2><?php echo $comic->title; ?></h2>
			<table>
				<tr><td>ID</td><td><?php echo $comic->id; ?></td></tr>
				<tr><td>Pages</td><td><?php echo $comic->pageCount; ?></td></tr>
				<tr><td>View at Marvel</td><td><?php echo $comic->urls[0]->url; ?></td></tr>
				<tr><td>Series</td><td><?php echo $comic->series->name; ?></td></tr>
				<?php
				foreach($comic->prices as $price)
				{
					?>
					<tr><td><?php echo $price->type; ?></td><td>&dollar;<?php echo $price->price; ?></td></tr>
					<?php
				}
				?>
				<tr><td>Thumbnail</td><td><img src="<?php echo $comic->thumbnail->path.'.'.$comic->thumbnail->extension; ?>" height="100"></td></tr>
				<?php
				foreach($comic->images as $image)
				{
					?>
					<tr><td>Image</td><td><img src="<?php echo $image->path.'.'.$image->extension; ?>" height="100"></td></tr>
					<?php
				}
				?>
				<tr><td><b>Number of creators</b></td><td><?php echo $comic->creators->available; ?></td></tr>
				<?php
				foreach($comic->creators->items as $creator)
				{
					?>
					<tr><td><?php echo $creator->role; ?></td><td><?php echo $creator->name; ?></td></tr>
					<?php
				}
				?>
				<tr><td><b>Number of characters</b></td><td><?php echo $comic->characters->available; ?></td></tr>
				<?php
				foreach($comic->characters->items as $characters)
				{
					?>
					<tr><td>-</td><td><?php echo $characters->name; ?></td></tr>
					<?php
				}
				?>

		</div>
		<?php
	}
}
?>