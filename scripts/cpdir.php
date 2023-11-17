<?php 
    // create php function to copy directory that take 2 parameters from stdin

    function cpdir($source, $destination) {
        // check if source is directory
        if (is_dir($source)) {
            // if source is directory, then create destination directory
            if (!is_dir($destination)) {
                mkdir($destination, recursive: true);
            }
            // get all files and directories in source directory
            $files = scandir($source);
            // loop through all files and directories
            foreach ($files as $file) {
                // check if file is not . or ..
                if ($file != '.' && $file != '..') {
                    // check if file is directory
                    if (is_dir($source . '/' . $file)) {
                        // if file is directory, then call cpdir function recursively
                        cpdir($source . '/' . $file, $destination . '/' . $file);
                    } else {
                        // if file is not directory, then copy file to destination directory
                        copy($source . '/' . $file, $destination . '/' . $file);
                    }
                }
            }
        }
    }

    cpdir($argv[1], $argv[2]);

?>