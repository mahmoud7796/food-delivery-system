<?php
define('PAGINATION_COUMT', 20);

 function getFolder()
{
    return app()->getLocale()==='ar'?'css-rtl':'css';
}

 function saveImage($photo,$folderPath)
{
    $ext = $photo->getClientOriginalName();
    $new_name = rand() . '.' .$ext;
    $photo->move(public_path() . '/assets/admin/images/'.$folderPath.'/', $new_name);
    $imagePath= '/assets/admin/images/'.$folderPath.'/'.$new_name;
    return $imagePath;
}
