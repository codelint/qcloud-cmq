<?php namespace Com\Codelint\QCloud\Laravel\Provider;

use Com\Codelint\QCloud\Laravel\Queue\CMQConnector;
use Illuminate\Support\ServiceProvider;

/**
 * QCloudCMQProvider:
 * @date 2022/6/17
 * @time 15:49
 * @author Ray.Zhang <codelint@foxmail.com>
 **/
class QCloudCMQProvider extends ServiceProvider{

    public function register()
    {
//        $this->app->singleton('codelint.ringo.logger', function () {
//            return new RingoLogger();
//        });
    }

    public function boot()
    {
        app('queue') && app('queue')->addConnector('cmq', function () {
            return new CMQConnector();
        });
    }
}