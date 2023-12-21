<?php ?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo App::get("root_uri") . "/public/favicon_io/favicon.ico" ?>" sizes="32x32">
    <link rel="apple-touch-icon" href="<?php echo App::get("root_uri") . "/public/favicon_io/apple-touch-icon.png" ?>"><!-- 180×180 -->
    <link rel="manifest" href="<?php echo App::get("root_uri") . "/public/favicon_io/site.webmanifest" ?>">
    <title><?= isset($pageTitle) ? $pageTitle : "Tertib App" ?></title>
    <!-- Custom Bootstrap  -->
    <link rel="stylesheet" href="<?php echo App::get("root_uri") . "/public/css/index.css" ?>">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="<?php echo App::get("root_uri") . "/public/vendor/bootstrap-icons/font/bootstrap-icons.min.css" ?>">
    <!-- Jquery -->
    <script src=" <?php echo App::get("root_uri") . "/public/vendor/jquery/jquery.min.js" ?>">
    </script>
    <!-- Fonts -->
    <?php Helper::importView('fonts.view.php'); ?>
    <style>
        /* start local var css */
        :root {
            /* Gradient */
            --bg-gradient: linear-gradient(0deg, rgba(252, 178, 22, 0.02) 0%, rgba(252, 178, 22, 0.02) 100%), #FFF !important;
            --btn-gradient: linear-gradient(270deg, #FCB216 -15.46%, #FCB216 5.16%, #F3542C 37.46%);

            /* Drop Shadow Filter */
            --drop-shadow: drop-shadow(0px 0px 4px rgba(12, 28, 68, 0.29));
        }

        /* end local var css */

        body::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        body {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>
</head>

<body class="position-relative" style="font-family: Poppins-Regular; ">
    <div class="position-fixed z-1" style="right: -85px; bottom:9vh;">
        <?php Helper::importView('partials/utils/dark_mode_button.view.php');
        ?>
    </div>
    <?php require $subview; ?>
    <script src=" <?= App::get("root_uri") . "/public/vendor/bootstrap/js/bootstrap.bundle.min.js" ?>">
    </script>
    <script src=" <?= App::get("root_uri") . "/public/js/color-modes.js" ?>">
    </script>
    <!-- script for navbar -->
    <script src="<?= App::get("root_uri") . "/public/js/nav.js" ?>"></script>
</body>

</html>