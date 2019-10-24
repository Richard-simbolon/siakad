<?php

namespace Illuminate\Routing;

use BadMethodCallException;
use File;

abstract class Controller
{
    /**
     * The middleware registered on the controller.
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * Register middleware on the controller.
     *
     * @param  array|string|\Closure  $middleware
     * @param  array   $options
     * @return \Illuminate\Routing\ControllerMiddlewareOptions
     */

     public function generalsave($data)
    {
        print_r($data);
    }

    public function generalcreate($data){
        return view('master/Agama');
    }


    public function selectmaster($tablename){
        if(!file_exists(public_path().'/master/'.strtolower($tablename).'.php')){
          return ['msg' => "Silahkan tekan tombol refresh pada menu master"];
        }else{
            return file_get_contents(public_path().'/master/'.strtolower($tablename).'.php') ;
        }
    }

    public function success($msg= '' , $data=[]){
        return json_encode(array('status' => 'success' , 'msg'=>$msg , 'data' , $data));
    }

    public function failed($data){

    }

     public function middleware($middleware, array $options = [])
    {
        foreach ((array) $middleware as $m) {
            $this->middleware[] = [
                'middleware' => $m,
                'options' => &$options,
            ];
        }

        return new ControllerMiddlewareOptions($options);
    }



    /**
     * Get the middleware assigned to the controller.
     *
     * @return array
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }

    /**
     * Execute an action on the controller.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        return call_user_func_array([$this, $method], $parameters);
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        throw new BadMethodCallException(sprintf(
            'Method %s::%s does not exist.', static::class, $method
        ));
    }
}
