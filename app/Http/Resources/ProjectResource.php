<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'name' => $this->name,
            'user_name' => $this->user->profile->name,
            'description' => $this->description,
            'user_link' => route('profile.show', $this->user->getRouteKey()),
            'link' => route('projects.show', $this->getRouteKey()),
            // 'user_avatar' => "http://2.bp.blogspot.com/_pQN7jbxZTok/SdNJwScrrAI/AAAAAAAAAAM/QkIwtpwKZjc/s280/imagenes-dibujos-animados-bob-esponja-p.jpg",
            'ago' => $this->created_at->diffForHumans(),
            'editing' => false
        ];
    }
}
