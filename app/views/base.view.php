<?php ?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : "Default Title" ?></title>
    <!-- Custom Bootstrap  -->
    <link rel="stylesheet" href="<?php echo App::get("root_uri") . "/public/css/index.css" ?>">
    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="<?php echo App::get("root_uri") . "/public/vendor/bootstrap/css/bootstrap.min.css" ?>"> -->
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="<?php echo App::get("root_uri") . "/public/vendor/bootstrap-icons/font/bootstrap-icons.min.css" ?>">
    <!-- Jquery -->
    <script src=" <?php echo App::get("root_uri") . "/public/vendor/jquery/jquery.min.js" ?>">
    </script>

    <style>
        /* start font initialize */
        @font-face {
            font-family: "Poppins";
            src: url("<?php echo App::get("root_uri") . "/public/font/Poppins/Poppins-Regular.ttf" ?>") format('truetype');
        }

        @font-face {
            font-family: "Poppins Medium";
            src: url("<?php echo App::get("root_uri") . "/public/font/Poppins/Poppins-Medium.ttf" ?>") format('truetype');
        }

        @font-face {
            font-family: "Poppins Semi Bold";
            src: url("<?php echo App::get("root_uri") . "/public/font/Poppins/Poppins-SemiBold.ttf" ?>") format('truetype');
        }

        @font-face {
            font-family: "Poppins Bold";
            src: url("<?php echo App::get("root_uri") . "/public/font/Poppins/Poppins-Bold.ttf" ?>") format('truetype');
        }

        @font-face {
            font-family: "Poppins Extra Bold";
            src: url("<?php echo App::get("root_uri") . "/public/font/Poppins/Poppins-ExtraBold.ttf" ?>") format('truetype');
        }

        /* end font initialize */

        /* start local var css */
        :root {
            /* Color */
            --dark-blue: #0C1C44;
            --red: #9C3B34;
            --grey: #B5B5B5;
            --orange-opa: #F3542C;
            --yellow: #FCB216;
            --orange: #FCB216;
            --white: #FFF;
            --white-gray: #FDFDFD;

            /* Gradient */
            --bg-gradient: linear-gradient(0deg, rgba(252, 178, 22, 0.02) 0%, rgba(252, 178, 22, 0.02) 100%), #FFF !important;
            --btn-gradient: linear-gradient(270deg, #FCB216 -15.46%, #FCB216 5.16%, #F3542C 37.46%);

            /* Drop Shadow Filter */
            --drop-shadow: drop-shadow(0px 0px 4px rgba(12, 28, 68, 0.29));

        }

        /* end local var css */

        /* custom css for all page*/
    </style>
    <link rel="stylesheet" href="<?php echo App::get("root_uri") . "/public/css/style.css" ?>">
</head>

<body class="position-relative">
    <div class="position-fixed z-2" style="right: -85px; bottom:9vh;">
        <?php Helper::importView('partials/utils/dark_mode_button.view.php');
        ?>
    </div>
    <?php require $subview; ?>
    <script src=" <?php echo App::get("root_uri") . "/public/vendor/bootstrap/js/bootstrap.bundle.min.js" ?>">
    </script>
    <script src=" <?php echo App::get("root_uri") . "/public/js/color-modes.js" ?>">
    </script>
    <!-- script for navbar -->
    <script src="<?php echo App::get("root_uri") . "/public/js/nav.js" ?>"></script>
</body>

</html>