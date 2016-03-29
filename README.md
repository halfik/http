Netinteractive\Http
===================

Package delivers tools to work with Http requests and responses.

## Services
 * \Netinteractive\Http\ResponseServiceProvider - service that overrides default ResponseFactory (avaible under \Response alias).
 
 
## Response types

* json: if X-Requested-With is in request headers, reponse will be json.
* pson: if X-PJAX is in request headers, response will be pson.
* view: if view is set in $params and there are no json headers, response will be View.
* file: to download file add to $params:
    
        $params['download'] = array(
            'name' => 'my_name',
            'file' => 'robots.txt'
        );

* stream: to returns stream add to $params:
        
        $sentry = \App::make('sentry');
        $userProvider = $sentry->getUserProvider();
        $users = $userProvider->findAll();
        $callback = function() use ($users)
        {
            $FH = fopen('php://output', 'w');
            foreach ($users as $row) {
                fputcsv($FH, $row->toArray());
            }
            fclose($FH);
        };
    
        $params['stream'] = array(
            'callback' => $callback
        );

Response types priority:

1. json
2. pson
3. file
4. stream
5. view

 
## How To

Example action:
  
        public function index( array $params=array() )
        {
            $params['test'] = 'test';
    
            return \Response::build($params);
        }

Default 'view' should be set in routes.php:

        Route::any('halfik',
            array(
                'as' => 'Sandbox\HalfikController@index',
                'uses' => function (){
                    $view = 'frontend.index'; #\Input::get('view');
                    $layout = 'red'; #\Input::get('layout');
                    return \Utils::runAction('Sandbox\HalfikController@index', $view,\Input::all(), $layout);
                }
            )
        );
        


## Changelog

* 1.0.1 : changed priority of view (moved it to the end of order list)

* 1.0.0 : init