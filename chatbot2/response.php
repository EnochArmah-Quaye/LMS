<?php 

require "../vendor/autoload.php";

use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;

$data = json_decode(file_get_contents("php://input"));

$text = $data->text;

$client = new Client("AIzaSyD96KIhTHeQLN64wK_gArL7jB00dWlfIVI");

$response = $client->geminipro()->generateContent(
    new TextPart($text),
);

echo $response->text();

?>