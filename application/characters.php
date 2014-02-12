<?php
$page = 'characters';
include 'header.php';

// Get the current page number
$page = 0;
if(isset($_GET['page']) && is_numeric($_GET['page'])) $page = $_GET['page'];

// Get the full character list and put it into an array
$data = json_decode($API->getCharacterList($page, 5));

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
?>
<div class="pagination">
<?php
if($page>0)
{
	?>
	<a href="?page=<?php echo $page-1; ?>" class="button">Previous page</a>
	<?php
}
if($data->data->count > 0)
{
	?>
	<a href="?page=<?php echo $page+1; ?>" class="button">Next page</a>
	<?php
}
?>
</div>