<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait FileUpload
{

    public function FilesUpload($data, $path, $object = null)
    {

        if ($data['files']) {
            // if ($object) {
            //     if ($object['storagepath_name']) {
            //         $files = explode(',', $object['storagepath_name']);
            //         foreach ($files as $item) {
            //             if (file_exists(storage_path() . $path . $item)) {
            //                 unlink(storage_path() . $path . $item);
            //             }
            //         }
            //     }
            // }
            $FilesName = [];
            $OrginalName = [];
            foreach ($data['files'] as $key => $item) {
                $FileName = time() . '_' . $key . '.' . $item->getClientOriginalExtension();
                $item->move(storage_path() . $path, $FileName);
                $FilesName[] = $FileName;
                $OrginalName[] = $item->getClientOriginalName();
            }
            $FilesNameString = implode(',', $FilesName);
            $FileOrgNameString = implode(',', $OrginalName);

            $data['storagepath_name'] = $FilesNameString;
            $data['orginalname'] = $FileOrgNameString;
        }

        return $data; // Just return image
    }
}
