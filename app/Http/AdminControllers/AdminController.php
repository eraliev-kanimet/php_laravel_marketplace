<?php

namespace App\Http\AdminControllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Intervention\Image\Facades\Image;

class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $file
     * @return string
     */
    public function saveImage($file): string
    {
        $dir = 'storage/app/public/pictures/' . date('Y') . '/' . date('m') . '/' . date('d');
        if (!file_exists($dir)) {
            mkdir($dir, 0775, true);
        }
        $image_name = md5(time()) . $file->getClientOriginalName();
        Image::make($file)->resize(600, 500)->save($dir . $image_name);

        return 'storage/pictures/' . date('Y') . '/' . date('m') . '/' . date('d') . $image_name;
    }
}