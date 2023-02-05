<?php
require("vendor/autoload.php");
// Zamzar File Converter
if (isset($_POST['download_xlsx'])) {
    $filename = "example.csv";
    // Connect to the Production API using an API Key
    $zamzar = new \Zamzar\ZamzarClient("511f1fe7beb7908b22acdc222185cf8dbe03fb49");
    // Submit a conversion job
    $job = $zamzar->jobs->submit([
        'source_file' => 'storage/trash/'.$filename,
        'target_format' => 'xlsx'
    ]);
    // Wait for the job to complete (the default timeout is 60 seconds)
    $job->waitForCompletion([
        'timeout' => 60
    ]);
    // Download the converted files 
    $job->downloadTargetFiles([
        'download_path' => 'storage/excel/'
    ]);
    // Delete the source and target files on Zamzar's servers
    $job->deleteAllFiles();
    $file = 'example.xlsx';

    header('Content-Description: File Transfer');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="example.xlsx"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <h1>Hello, world!</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>