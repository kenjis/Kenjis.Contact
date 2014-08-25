<?php
$app = require __DIR__ . '/../../bootstrap/instance.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contact_form = $app->resource->post
        ->uri('app://self/contact/form')
        ->withQuery([
            'name'    => $_POST['name'],
            'email'   => $_POST['email'],
            'comment' => $_POST['comment'],
        ])
        ->eager->request();
} else {
    $contact_form = $app->resource->get
        ->uri('app://self/contact/form')
        ->eager->request();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sample Contact Form</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<?php echo $contact_form; ?>
</body>
</div>
</html>
