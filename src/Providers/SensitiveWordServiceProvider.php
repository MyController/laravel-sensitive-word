<?php

namespace MyController\SensitiveWord\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use MyController\SensitiveWord\Facades\SensitiveWordFacade;
use MyController\SensitiveWord\SensitiveWord\SensitiveWordFilter;

class SensitiveWordServiceProvider extends ServiceProvider
{
    /**
     * 指定提供者加载是否延缓。
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * 运行注册后的启动服务。
     *
     * @return void
     */
    public function boot()
    {
        //敏感词验证规则
        Validator::extend('has_sensitive_word', function ($attribute, $value, $parameters, $validator) {
            $sensitiveWord = SensitiveWordFacade::getFirstSensitiveWordInContent($value);
            if ($sensitiveWord) {
                \Log::info('"' . $value . '" contains SensitiveWord "' . $sensitiveWord . '"');
            }
            return $sensitiveWord === '';
        });
    }

    /**
     * 注册服务提供者。
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('MyController.SensitiveWord', function ($app) {
            return new SensitiveWordFilter();
        });
    }

    /**
     * 获取提供者所提供的服务。
     * PS: defer 属性设置为 true 时会使用本方法
     *
     * @return array
     */
    public function provides()
    {
        return array('MyController.SensitiveWord');
    }
}
