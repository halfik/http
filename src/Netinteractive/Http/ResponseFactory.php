<?php namespace Netinteractive\Http;

use Illuminate\Http\Request AS Request;
use Illuminate\Routing\ResponseFactory AS BaseResponseFactory;
use  Illuminate\Http\Response AS BaseResponse;
use Netinteractive\Http\Exception\DownloadParamsException;

/**
 * Class ResponseFactory
 * @package Netinteractive\Http
 */
class ResponseFactory extends BaseResponseFactory
{
    protected $downloadRequiredFields = array(
        'file',
        'name'
    )


    /**
     * Builds a response object
     * @param \Illuminate\Http\Request $request
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     */
    public function build(Request $request, array $data=array(), $status = 200, array $headers = [], $options = 0)
    {

        /**
         * header: X-Requested-With
         */
        if ($request->ajax()){
            return $this->json($data, $status, $headers, $options);
        }
        /**
         * header: X-PJAX
         */
        else if ($request->pjax()){
            return $this->json($data, $status, $headers, $options);
        }
        else if (array_key_exists('view', $data)){
            return $this->view($data['view'], $data, $status, $headers);
        }
        else if (array_key_exists('download', $data)){
            $disposition = isset($data['download']['disposition']) ? $data['download']['disposition'] : 'attachment';

            foreach ($downloadRequiredFields AS $field) {
                if (!array_key_exists($field, $data['download'])){
                    throw new DownloadParamsException($field);
                }
            }


            return $this->download($data['download']['file'], $data['download']['name'], $headers, $disposition);
        }

        return $data;
    }
}