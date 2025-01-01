<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function storeImage($file, $folder, $isUpdate = false) {
        if (!Storage::exists('public/' . $folder)) {
            Storage::makeDirectory('public/' . $folder);
        }
        $tempPath = $file->store('temp');
        $fileName = explode('.', last(explode('/', $tempPath)))[0] . '.jpg';
        $this->compressAndStoreImage(storage_path('app/' . $tempPath), storage_path('app/public/' . $folder . '/' . $fileName), 75, $isUpdate);
        Storage::delete($tempPath);
        return env('APP_URL') . Storage::url('public/' . $folder . '/' . $fileName);
    }

    protected function storeLogo($file, $folder) {
        if (!Storage::exists('public/' . $folder)) {
            Storage::makeDirectory('public/' . $folder);
        }
        
        $file->store('public/' . $folder);
        $fileName = $file->hashName();

        return env('APP_URL') . Storage::url('public/' . $folder . '/' . $fileName);
    }

    protected function storeFile($file, $folder) {
        if (!Storage::exists('public/' . $folder)) {
            Storage::makeDirectory('public/' . $folder);
        }
        
        $fileName = explode('.', $file->getClientOriginalName())[0] . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/' . $folder, $fileName);

        return env('APP_URL') . Storage::url('public/' . $folder . '/' . $fileName);
    }

    protected function deleteFile($fileUrl) {
        $path = $this->getStoragePathFromUrl($fileUrl);
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }

    private function getStoragePathFromUrl($url) {
        $path = parse_url($url, PHP_URL_PATH);
        $path = str_replace('/storage/', '', $path);
        return 'public/' . $path;
    }

    protected function str_random($length)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
        }
        return $result;
    }

    protected function validateAndGetLimit($limit, $default = 10) {
        if (is_numeric($limit) && $limit > 0) {
            return $limit;
        }
        return $default;
    }

    protected function compressAndStoreImage($filePath, $destination, $quality = 75, $isUpdate = false) {
        $image = Image::make($filePath);
        $image->orientate();

        if ($image->mime() == 'image/png' || $isUpdate) {
            $quality = 100;
        }

        $image->resize(1024, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save($destination, $quality);
        $image->destroy();
    }
}
