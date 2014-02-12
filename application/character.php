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

	// Get the full character list and put it into an array
	$data = json_decode($API->getCharacter($id));
	?>
	<pre>
	<?php
	foreach($data->data->results as $character)
	{
		print_r($character);
	}
}
?>