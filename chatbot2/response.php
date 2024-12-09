<?php 

require "../vendor/autoload.php";

use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;

$data = json_decode(file_get_contents("php://input"));

$text = $data->text;

$client = new Client("AIzaSyAqY6QljWdNbq0NErIvYo7t1J8t5zoriO4");

$response = $client->geminipro()->generateContent(
    new TextPart($text),
);

echo $response->text();

?>