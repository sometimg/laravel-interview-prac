<?php

namespace App\Services;

interface ProductContract
{
    public function create($with);

    public function delete($id);
}
