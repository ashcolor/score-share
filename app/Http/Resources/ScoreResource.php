<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScoreResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'title' => $this->title,
            'artist' => $this->artist,
            'score_created_at' => $this->score_created_at,
            'score_updated_at' => $this->score_updated_at,
            'genre' => $this->genre,
            'remarks' => $this->remarks,
            'url' => $this->url,
            'score_created_user' => $this->score_created_user,
            //ログインユーザのIDを付与する
            'is_own' => sizeof($this->ownerships->where('id', 1)) !== 0,
            'is_want' => sizeof($this->wants->where('id', 1)) !== 0,
        ];
    }
}
