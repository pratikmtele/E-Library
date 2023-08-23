<?php
function upload_file($file, $allowed_exs, $path)
{
    $file_name = $file['name'];
    $tmp_name = $file['tmp_name'];
    $error = $file['error'];

    if ($error === 0) {
        $file_exs = pathinfo($file_name, PATHINFO_EXTENSION);
        # convert the file extension into lower case and store it in the var
        $file_exs_lc = strtolower($file_exs);

        # check if the file extension is exist in the allowed extension
        if (in_array($file_exs_lc, $allowed_exs)) {
            # renaming the file with random strings
            $new_file_name = uniqid("", true).'.'.$file_exs_lc;

            #assigning upload path 
            $file_upload_path = "../uploads/".$path.'/'.$new_file_name;

            # moving uploaded file to root directory uploads/$path folder
            move_uploaded_file($tmp_name, $file_upload_path);

            # creating success message 
            $sm['status'] = "success";
            $sm['data'] = $new_file_name;
            return $sm;
        } else {
            # creating error message for extension type
            $em['status'] = "error";
            $em['data'] = "You can't upload files of this type.";
            return $em;
        }
    } else {
        # creating error message associating with keys and values array
        $em['status'] = "error";
        $em['data'] = "Error ocurred while uploading file.";
        return $em;
    }
}
?>