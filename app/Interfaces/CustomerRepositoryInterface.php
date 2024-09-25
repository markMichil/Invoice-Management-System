<?php

namespace App\Interfaces;

interface CustomerRepositoryInterface
{
    public function all($request);

    public function find($id);
}
