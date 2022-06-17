<?php namespace Com\Codelint\QCloud\Laravel\Queue;

use Com\Codelint\QCloud\CMQ\Account;
use Illuminate\Queue\Connectors\ConnectorInterface;

/**
 * Connector:
 * @date 2022/6/16
 * @time 19:45
 * @author Ray.Zhang <codelint@foxmail.com>
 **/
class CMQConnector  implements ConnectorInterface{

    public function connect(array $config)
    {
//        $cred = new Credential($config['key'], $config['secret']);
//        $httpProfile = new HttpProfile();
//        $httpProfile->setEndpoint($config['endpoint']);
//
//        $clientProfile = new ClientProfile();
//        $clientProfile->setHttpProfile($httpProfile);
//        $client = new TdmqClient($cred, "ap-guangzhou", $clientProfile);

        $my_account = new Account($config['endpoint'], $config['key'], $config['secret']);

//        $queue_meta = new QueueMeta();
//        $queue_meta->queueName = $config['queue'];
//        $queue_meta->pollingWaitSeconds = 10;
//        $queue_meta->visibilityTimeout = 60;
//        $queue_meta->maxMsgSize = 1024;
//        $queue_meta->msgRetentionSeconds = 3600;
//
//        $my_account->get_queue($config['queue'])->set_attributes($queue_meta);

        return new CMQueue($my_account, $config['queue'], $config['endpoint'], $config['after_commit'] ?? null);
    }
}
