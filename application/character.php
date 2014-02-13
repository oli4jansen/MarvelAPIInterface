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
	try
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
							<a href="comic.php?id=<?php echo end($idComic); ?>"><?php echo $comic->name; ?></a>
						</td>
					</tr>
					<?php
				}
				?>

				<tr>
					<td><b># series</b></td>
					<td><?php echo $character->series->available; ?></td>
				</tr>
				<?php
				foreach($character->series->items as $serie)
				{
					$idSerie = explode('/', $serie->resourceURI);
					?>
					<tr>
						<td></td>
						<td>
							<a href="serie.php?id=<?php echo end($idSerie); ?>"><?php echo $serie->name; ?></a>
						</td>
					</tr>
					<?php
				}
				?>

				<tr>
					<td><b># stories</b></td>
					<td><?php echo $character->stories->available; ?></td>
				</tr>
				<?php
				foreach($character->stories->items as $story)
				{
					$idStory = explode('/', $story->resourceURI);
					?>
					<tr>
						<td></td>
						<td>
							<a href="story.php?id=<?php echo end($idStory); ?>"><?php echo $story->name; ?></a>
						</td>
					</tr>
					<?php
				}
				?>

				<tr>
					<td><b># events</b></td>
					<td><?php echo $character->events->available; ?></td>
				</tr>
				<?php
				foreach($character->events->items as $event)
				{
					$idEvent = explode('/', $event->resourceURI);
					?>
					<tr>
						<td></td>
						<td>
							<a href="event.php?id=<?php echo end($idEvent); ?>"><?php echo $event->name; ?></a>
						</td>
					</tr>
					<?php
				}

				foreach($character->urls as $url)
				{
					?>
					<tr>
						<td><b>External link: <?php echo $url->type; ?></b></td>
						<td>
							<a href="<?php echo $url->url; ?>"><?php echo $url->url; ?></a>
						</td>
					</tr>
					<?php
				}
			}
			?>
		</table>
		<?php
	}
	catch (Exception $exc)
	{
		echo $exc->getMessage();
	}
}
?>