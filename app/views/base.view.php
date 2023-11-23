<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : "Default Title" ?></title>
    <link rel="stylesheet" href="<?php echo App::get("root_uri") . "/public/vendor/bootstrap/css/bootstrap.min.css" ?>">
    <style>
        @font-face {
            font-family: "Poppins";
            src: url("<?php echo App::get("root_uri") . "/public/font/Poppins/Poppins-Regular.ttf" ?>") format('truetype');
        }

        @font-face {
            font-family: "Poppins Bold";
            src: url("<?php echo App::get("root_uri") . "/public/font/Poppins/Poppins-Bold.ttf" ?>") format('truetype');
        }

        :root {
            --red: #9C3B34;
        }
    </style>
</head>

<body style="background: linear-gradient(0deg, rgba(252, 178, 22, 0.02) 0%, rgba(252, 178, 22, 0.02) 100%), #FFF;">
    <script src=" <?php echo App::get("root_uri") . "/public/vendor/bootstrap/js/bootstrap.bundle.min.js" ?>">
    </script>
    <?php require $subview; ?>
</body>

</html>