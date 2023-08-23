<?php
function is_empty($var, $text, $location, $ms, $data)
{
    if (empty($var)) {
        #Error Message
        $em = "The " . $text . " is Required";
        header("Location: $location?$ms=$em&$data");
        exit;
    }
    return 0;
}
?>