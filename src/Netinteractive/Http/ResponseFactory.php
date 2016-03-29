<?php namespace Netinteractive\Http;

use Illuminate\Routing\ResponseFactory AS BaseResponseFactory;
use Netinteractive\Http\Exception\DownloadParamsException;

/**
 * Class ResponseFactory
 * @package Netinteractive\Http
 */
class ResponseFactory extends BaseResponseFactory
{
    /**
     * @var array
     */
    protected $downloadRequiredFields = array(
        'file',
        'name'
    );

    protected $streamRequiredFields = array(
        'callback'
    );


    /**
     * Builds a response object
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     */
    public function build(array $data=array(), $status = 200, array $headers = [], $options = 0)
    {
        /**
         * header: X-Requested-With
         */
        if ( \Request::ajax() ){
            return $this->json($data, $status, $headers, $options);
        }
        /**
         * header: X-PJAX
         */
        else if ( \Request::pjax() ){
            return $this->json($data, $status, $headers, $options);
        }
        /**
         * File download response
         */
        else if (array_key_exists('download', $data)){
            $disposition = isset($data['download']['disposition']) ? $data['download']['disposition'] : 'attachment';

            foreach ($this->downloadRequiredFields AS $field) {
                if (!array_key_exists($field, $data['download'])){
                    throw new DownloadParamsException($field);
                }
            }


            return $this->download($data['download']['file'], $data['download']['name'], $headers, $disposition);
        }
        /**
         * File stream response
         */
        else if (array_key_exists('stream', $data)){
            foreach ($this->streamRequiredFields AS $field) {
                if (!array_key_exists($field, $data['stream'])){
                    throw new StreamParamsException($field);
                }
            }

            return $this->stream($data['stream']['callback'], $status, $headers);
        }
        /**
         * View response
         */
        else if (array_key_exists('view', $data)){
            $view = $this->view->make($data['view'], $data);

            return $this->make($view, $status, $headers);
        }

        return $this->make($data, $status, $headers);
    }
}