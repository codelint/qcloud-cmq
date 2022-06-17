<?php namespace Com\Codelint\QCloud\CMQ;

/**
 * CMQClientException:
 * @date 2022/6/16
 * @time 20:35
 * @author Ray.Zhang <codelint@foxmail.com>
 **/
class CMQClientException extends CMQExceptionBase {
    public function __construct($message, $code = -1, $data = array())
    {
        parent::__construct($message, $code, $data);
    }

    public function __toString()
    {
        return "CMQClientException  " . $this->get_info();
    }
}
