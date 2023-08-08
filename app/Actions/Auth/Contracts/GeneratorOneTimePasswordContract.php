<?php

namespace App\Actions\Auth\Contracts;

interface GeneratorOneTimePasswordContract
{
    public function generate(): string;
}
