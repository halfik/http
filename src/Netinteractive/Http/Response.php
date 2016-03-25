<?php namespace Netinteractive\Http;

use Illuminate\Http\Request AS Request;
use  Illuminate\Http\Response AS BaseResponse;

/**
 * Class Response
 * @package Netinteractive\Http
 */
class Response extends BaseResponse
{
    /**
     * @var Illuminate\Http\Request
     */
    private $request;

    /**
     * @var array
     */
    private $params;

    /**
     * makes a response
     */
    public static function make(Request $request, array $params=array())
    {

    }
}