<?php
$page = 'characters';
include 'header.php';

// Get the current page number
$page = 0;
if(isset($_GET['page']) && is_numeric($_GET['page'])) $page = $_GET['page'];

// Get the full character list and put it into an array
$data = json_decode($API->getCharacterList($page, 50));

?>
<table>
	<tr>
		<td><b>Thumbnail</b></td>
		<td><b>Name</b></td>
		<td><b>Description</b></td>
	</tr>
<?php
foreach($data->data->results as $character)
{
	?>
	<tr>
		<td><img src="<?php echo $character->thumbnail->path.'.'.$character->thumbnail->extension; ?>" height="150" valign="top"></td>
		<td>
			<a href="character.php?id=<?php echo $character->id; ?>"><?php echo $character->name; ?></a>
		</td>
		<td><?php echo $character->description; ?></td>
	</tr>
	<?php
}
?>
</table>
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