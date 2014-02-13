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
	<table>
		<?php
		foreach($data->data->results as $character)
		{
			?>
			<tr>
				<td><b>Name</b></td>
				<td><?php echo $character->name; ?></td>
			</tr>
			<tr>
				<td><b>Description</b></td>
				<td><?php echo $character->description; ?></td>
			</tr>
			<tr>
				<td><b>Thumbnail</b></td>
				<td><img src="<?php echo $character->thumbnail->path.'.'.$character->thumbnail->extension; ?>" width="300"></td>
			</tr>
			<tr>
				<td><b># comics</b></td>
				<td><?php echo $character->comics->available; ?></td>
			</tr>

			<?php
			foreach($character->comics->items as $comic)
			{
				$idComic = explode('/', $comic->resourceURI);
				?>
				<tr>
					<td></td>
					<td>
						<a href="comic.php?id=<?php echo end($idComic); ?>" class="comic"><?php echo $comic->name; ?></a>
					</td>
				</tr>
				<?php
			}
		}
		?>
	</table>
	<?php
}
?>