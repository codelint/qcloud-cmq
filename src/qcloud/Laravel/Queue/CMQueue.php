<?php namespace Com\Codelint\QCloud\Laravel\Queue;

use Com\Codelint\QCloud\CMQ\Account;
use Com\Codelint\QCloud\CMQ\CMQExceptionBase;
use Com\Codelint\QCloud\CMQ\Message;
use Illuminate\Contracts\Queue\ClearableQueue;
use Illuminate\Contracts\Queue\Queue as QueueContract;

/**
 * Queue:
 * @date 2022/6/16
 * @time 19:46
 * @author Ray.Zhang <codelint@foxmail.com>
 **/
class CMQueue extends \Illuminate\Queue\Queue implements QueueContract, ClearableQueue {

    protected Account $q_client;
    protected string $endpoint;
    protected string $default;

    public function __construct(Account $q_client,
                                $default,
                                $endpoint = '',
                                $dispatchAfterCommit = false)
    {
        $this->q_client = $q_client;
        $this->endpoint = $endpoint;
        $this->default = $default;
        $this->dispatchAfterCommit = $dispatchAfterCommit;
    }

    public function clear($queue)
    {
        return 0;
    }

    public function size($queue = null)
    {
        return 0;
    }

    public function push($job, $data = '', $queue = null)
    {
        return $this->enqueueUsing(
            $job,
            $this->createPayload($job, $this->default, $data),
            $this->default,
            null,
            function ($payload, $queue) {
                return $this->pushRaw($payload, $queue);
            }
        );
    }

    public function pushRaw($payload, $queue = null, array $options = [])
    {
        // Log::info('queue: ' . $queue);
        $my_queue = $this->q_client->get_queue($queue);

//        $queue_meta = new QueueMeta();
//        $queue_meta->queueName = $queue;
//        $queue_meta->pollingWaitSeconds = 10;
//        $queue_meta->visibilityTimeout = 60;
//        $queue_meta->maxMsgSize = 1024;
//        $queue_meta->msgRetentionSeconds = 3600;

        try
        {
            // 消息内容
            // $msg_body = "I am test message.";
            // Log::info($payload);
            $msg = new Message($payload);
            // 发送消息
            return $my_queue->send_message($msg)->msgId;

            // echo "Send Message Succeed! MessageBody:" . $msg_body . " MessageID:" . $re_msg->msgId . "\n";
        } catch (CMQExceptionBase $e)
        {
            // Log::info('Create Queue Fail! Exception:' . $e->getMessage());
        }
    }

    public function later($delay, $job, $data = '', $queue = null)
    {
        return $this->push($job, $data, $queue);
    }

    public function pop($queue = null)
    {
//        $response = $this->sqs->receiveMessage([
//            'QueueUrl' => $queue = $this->getQueue($queue),
//            'AttributeNames' => ['ApproximateReceiveCount'],
//        ]);
//
//        if (!is_null($response['Messages']) && count($response['Messages']) > 0)
//        {
//            return new SqsJob(
//                $this->container, $this->sqs, $response['Messages'][0],
//                $this->connectionName, $queue
//            );
//        }


        $my_queue = $this->q_client->get_queue($queue);

//        $queue_meta = new QueueMeta();
//        $queue_meta->queueName = $queue;
//        $queue_meta->pollingWaitSeconds = 10;
//        $queue_meta->visibilityTimeout = 60;
//        $queue_meta->maxMsgSize = 1024;
//        $queue_meta->msgRetentionSeconds = 3600;

        try {
            $msg = $my_queue->receive_message(3);
            return new CMQJob($this->container, $this->q_client, $msg, $this->connectionName, $queue);
        } catch (CMQExceptionBase $e) {
//            if(!Str::contains($e->getMessage(), 'no message'))
//            {
//
//            }
            // Log::info('Error: ' . $e->getMessage());
            return null;
        }
    }
}
