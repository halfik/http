<?php namespace Netinteractive\Http\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class CombinerFacade
 * @package Netinteractive\Http\Facades
 */
class CombinerFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'ni.http.response'; }
}