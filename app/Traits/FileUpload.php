<?php

namespace App\Traits;

use App\Models\ResultFile;
use App\Services\ResultFileService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait FileUpload
{

    
    public function FilesUpload($data, $path, $result_id = null)
    {

        if ($data['files']) {
            foreach ($data['files'] as $key => $item) {
                $FileName = time() . '_' . $key . '.' . $item->getClientOriginalExtension();
                $item->move(storage_path() . $path, $FileName);
                $data['result_id'] = $result_id;
                $data['storagepath_name'] = $FileName;
                $data['orginalname'] = $item->getClientOriginalName();
                $params = [
                    'storagepath_name' => $FileName,
                    'description' => $data['description'],
                    'result_id' => $result_id,
                    'orginalname' =>  $item->getClientOriginalName()
                ];
               ResultFile::create($params);
            }
       }

        return $data; // Just return image
    }
}
