<?php

namespace App\Presenters\v1;

use App\Presenters\BasePresenter;

class TaskPresenter extends BasePresenter
{
    public function list()
    {
        return [
            'id' => $this->id,
            'user' => (new UserPresenter($this->user))->detail(),
            'title' => $this->title,
            'description' => $this->description,
            'is_approved' => (boolean) $this->is_approved,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}