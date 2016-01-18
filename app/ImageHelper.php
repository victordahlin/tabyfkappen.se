<?php

namespace App;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Add number to the file if file exist already
     *
     * @param $fileName
     * @return string
     */
    static function changeNameFile($fileName) {
        if ($pos = strrpos($fileName, '.')) {
            $name = substr($fileName, 0, $pos);
            $ext = substr($fileName, $pos);
        } else {
            $name = $fileName;
        }

        $path = storage_path() . '/app/';
        $newpath = $path . $fileName;
        $newname = $fileName;
        $counter = 0;

        while (file_exists($newpath)) {
            $newname = $name . $counter . $ext;
            $newpath = $path.$newname;
            $counter++;
        }

        return $newname;
    }


    /**
     * Try add image to storage otherwise return image name
     *
     * @param Request $request
     * @return array|mixed|null|string
     */
    public static function saveImageAndGetName(Request $request)
    {
        $fileName = $request->file('image_file_path')->getClientOriginalName();

        // Replace swedish special chars
        $search = array('å','ä','ö', '');
        $search = array('å','ä','ö');
        $replace = array('a','a','o');
        $fileName = str_replace($search, $replace, $fileName);
        $fileName = preg_replace('/\s+/', '', $fileName);

        if ($request->hasFile('image_file_path')) {
            if(Storage::exists($fileName)) {
                $fileName = ImageHelper::changeNameFile($fileName);
            }

            // Replace swedish special chars
            $search = array('å','ä','ö', ' ');
            $search = array('å','ä','ö');
            $replace = array('a','a','o');
            $fileName = str_replace($search, $replace, $fileName);

            // Store file in folder storage
            Storage::put(
                $fileName,
                file_get_contents($request->file('image_file_path')->getRealPath())
            );
        }
        return $fileName;
    }

}