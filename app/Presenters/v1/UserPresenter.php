<?php

namespace App\Presenters\v1;

use App\Presenters\BasePresenter;

class UserPresenter extends BasePresenter
{
    public function detail()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'role' => $this->role,
        ];
    }
}