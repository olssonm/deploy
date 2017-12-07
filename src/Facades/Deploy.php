<?php namespace Olssonm\Deploy\Facades;

use Illuminate\Support\Facades\Facade;

class Deploy extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'deploy';
    }
}
