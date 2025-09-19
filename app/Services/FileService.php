<?php

namespace App\Services;

use App\Models\File;
use App\Models\Ticket;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function uploadFiles(Ticket $ticket, array $files): void
    {
        foreach ($files as $file) {
            /** @var UploadedFile $file */
            $path = $file->store('tickets/' . $ticket->id, 'public');

            $ticket->files()->create([
                'original_name' => $file->getClientOriginalName(),
                'path'          => $path,
                'mime_type'     => $file->getMimeType(),
                'size'          => $file->getSize(),
            ]);
        }
    }
}
