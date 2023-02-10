<?php
// $client_uri = $_SERVER['REQUEST_URI'];
// if ($client_uri === "/") {
//     header("Location: /dashboard");
// }

$client_id = "1228d6726fc51523afe5ad1725309709affdc8eea7401a7189f178a46469a10f";
$client_secret = "fa4ca9e469054ac51cc223f3e648fc33acc8dc1bc720e448f3bb21c27fb2d095";
$url = 'https://api.mokapos.com/oauth/token';
$data = array(
    'grant_type'=>"client_credentials",
    'client_id' => $client_id ,
    'client_secret' => $client_secret,
    'scope' => "report"
);
$options = array(
    'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\nAuthorization: 'Bearer 94ddd50375b855ccd619a15c0f6bc346d7deb5411f49b6e9e5611ef73b76e90f'",
        'method' => 'POST',
        'content' => http_build_query($data)
    )
);
var_dump($options);

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$result = json_decode($result);
$result = (array) $result;
if ($result === FALSE) { /* Handle error */
}
echo "<br/>";
var_dump($result);

echo "<br/>";
echo "<br/>";
echo $result["access_token"];
?>