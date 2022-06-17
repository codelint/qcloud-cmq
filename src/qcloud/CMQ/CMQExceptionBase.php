<?php namespace Com\Codelint\QCloud\CMQ;

/**
 * CMQExceptionBase:
 * @date 2022/6/16
 * @time 20:34
 * @author Ray.Zhang <codelint@foxmail.com>
 **/
class CMQExceptionBase extends \RuntimeException {
    /*
    @type code: int
    @param code: 错误类型
    @type message: string
    @param message: 错误描述
    @type data: array
    @param data: 错误数据
    */

    public $code;
    public $message;
    public $data;

    public function __construct($message, $code = -1, $data = array())
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }

    public function __toString()
    {
        return "CMQExceptionBase  " . $this->get_info();
    }

    public function get_info()
    {
        $info = array("code" => $this->code,
            "data" => json_encode($this->data),
            "message" => $this->message);
        return json_encode($info);
    }
}










