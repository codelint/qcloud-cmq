<?php namespace Com\Codelint\QCloud\Laravel\Queue;

use Com\Codelint\QCloud\CMQ\Account;
use Com\Codelint\QCloud\CMQ\Message;
use Com\Codelint\QCloud\CMQ\QueueMeta;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\Job as JobContract;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Support\Facades\Log;

/**
 * QueueJob:
 * @date 2022/6/16
 * @time 19:53
 * @author Ray.Zhang <codelint@foxmail.com>
 **/
class CMQJob extends Job implements JobContract {

    protected Message $job;
    protected Account $client;

    public function __construct(Container $container, Account $client, Message $job, $connectionName, $queue)
    {
        // $this->sqs = $sqs;
        $this->job = $job;
        $this->queue = $queue;
        $this->client = $client;
        $this->container = $container;
        $this->connectionName = $connectionName;
    }

    /**
     * Release the job back into the queue after (n) seconds.
     *
     * @param int $delay
     * @return void
     */
    public function release($delay = 0)
    {
        parent::release($delay);
//        $queue = $this->client->get_queue($this->queue);
//
//        $queue_meta = new QueueMeta();
//        $queue_meta->queueName = $queue;
//        $queue_meta->pollingWaitSeconds = 10;
//        $queue_meta->visibilityTimeout = $delay;
//        $queue_meta->maxMsgSize = 1024;
//        $queue_meta->msgRetentionSeconds = 3600;
//        $queue->set_attributes($queue_meta);
        //$queue->
//        $my_queue->rewindQueue($delay);
        // $my_queue->set_attributes();
//        $this->sqs->changeMessageVisibility([
//            'QueueUrl' => $this->queue,
//            'ReceiptHandle' => $this->job['ReceiptHandle'],
//            'VisibilityTimeout' => $delay,
//        ]);

        Log::info("Release Job[{$this->getJobId()}]");
        $this->delete();;
        Log::info("Delete Job[{$this->getJobId()}] success");
    }

    /**
     * Delete the job from the queue.
     *
     * @return void
     */
    public function delete()
    {
        parent::delete();
        Log::info("Delete Job[{$this->getJobId()}]");
        $my_queue = $this->client->get_queue($this->queue);
        $my_queue->delete_message($this->job->receiptHandle);
        Log::info("Delete Job[{$this->getJobId()}] success");
    }

    public function getJobId()
    {
        return $this->job->msgId;
    }

    public function getRawBody()
    {
        // Log::info('msgBody: ' . $this->job->msgBody);
        return $this->job->msgBody;
    }

    public function attempts()
    {
        Log:info("Job[{$this->job->msgId}].attempts: {$this->job->dequeueCount}");
        return 1;
        //  return $this->job->dequeueCount;
    }
}
