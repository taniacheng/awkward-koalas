<?php 
    //define a function to find class definition files
    //according to the name of the class
    
    function loadClass($class_name) {
        $filename = strtolower($class_name) . ".php";
        $class_dir = "classes";
        $class_file = $class_dir . "/" . $filename;
        if( is_readable($class_file) ) {
            //the file exists and is readable
            include($class_file);
        }
        elseif ( is_readable("../$class_file") ) {
            include("../$class_file");
        }
        else {
            error_log("class file does not exist or is unreadable", 0);
        }
    }
    //register the function as an autoloader ie. will be called everytime a class definition is needed or called
    spl_autoload_register("loadClass");
?>