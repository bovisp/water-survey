<?php

namespace App\Http\Resources\Logbooks;

use Illuminate\Http\Resources\Json\JsonResource;

class LogbookPackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'formatNumber' => $this->lesson->topic_id ? $this->lesson->topic->number . '.' . str_pad($this->lesson->number, 2, '0', STR_PAD_LEFT) : 'No topic.' . $this->lesson->number,
            'lessonName' => $this->lesson->name,
            'versionNumber' => $this->lesson->lessonVersion->version,
            'complete' => $this->complete
        ];
    }
}
