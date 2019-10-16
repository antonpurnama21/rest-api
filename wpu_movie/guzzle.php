<?php 
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$response = $client->request('GET', 'http://omdbapi.com', [
	'query' => [
		'apikey' => '6fe2633d',
		's'		=> 'transformers'
	]
]);

$result = json_decode($response->getBody()->getContents(), true);
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>WPU MOVIE</title>
 </head>
 <body>

<?php foreach ($result['Search'] as $key): ?>

 	<ul>
 		<li>Title : <?= $key['Title']?></li>
 		<li>Year : <?= $key['Year']?></li>
 		<li>
 			<img src="<?= $key['Poster']?>" width="80">
 		</li>
 	</ul>
<?php endforeach ?> 
 </body>
 </html>