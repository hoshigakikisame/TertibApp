<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : "Default Title"?></title>
    <link rel="stylesheet" href="<?php echo App::get("root_uri") . "/public/vendor/bootstrap/css/bootstrap.min.css" ?>">
</head>
<body>
    <script src="<?php echo App::get("root_uri") . "/public/vendor/bootstrap/js/bootstrap.bundle.min.js" ?>"></script>
    <?php require $subview; ?>
</body>
</html>