<?php namespace Com\Codelint\QCloud\Laravel\Provider;

use Com\Codelint\QCloud\Laravel\Queue\CMQConnector;

/**
 * QueueServiceProvider:
 * @date 2022/6/17
 * @time 16:18
 * @author Ray.Zhang <codelint@foxmail.com>
 **/
class QueueServiceProvider extends \Illuminate\Queue\QueueServiceProvider {
    public function registerConnectors($manager)
    {
        parent::registerConnectors($manager);

        $manager->addConnector('cmq', function () {
            return new CMQConnector();
        });
    }
}