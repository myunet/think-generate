<?php
declare (strict_types = 1);

namespace myunet\generate\controller;

use think\facade\View;
use think\App;

/**
 * 控制器基础类
 */
abstract class BaseController
{
    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 模型实例
     * @var
     */
    protected $model;

    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app){
        $this->app     = $app;
        $this->request = $this->app->request;
        View::config([
            'view_path' => GetRootPath()."\\generate\\view\\",
        ]);
        // 控制器初始化
        $this->initialize();
    }

    // 初始化
    protected function initialize(){
        //检测是否安装sql文件
        app_is_installed();
    }

    protected function renderJson($code = 1, $msg = '', $data = []){
        return compact('code', 'msg', 'data');
    }

    protected function success($msg = 'success', $data = [], $code = 1){
        return json($this->renderJson($code, $msg, $data));
    }

    protected function error($msg = 'error', $data = [], $code = 0){
        return json($this->renderJson($code, $msg, $data));
    }
}
