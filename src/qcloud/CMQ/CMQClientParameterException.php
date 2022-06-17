<?php namespace Com\Codelint\QCloud\CMQ;

/**
 * CMQClientParameterException:
 * @date 2022/6/16
 * @time 20:36
 * @author Ray.Zhang <codelint@foxmail.com>
 **/
class CMQClientParameterException extends CMQClientException {
    /* 参数格式错误
        @note: 请根据提示修改对应参数;
    */
    public function __construct($message, $code = -1, $data = array())
    {
        parent::__construct($message, $code, $data);
    }

    public function __toString()
    {
        return "CMQClientParameterException  " . $this->get_info();
    }
}
