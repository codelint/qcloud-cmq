<?php namespace Com\Codelint\QCloud\CMQ;

/**
 * ResponseInternal:
 * @date 2022/6/16
 * @time 20:40
 * @author Ray.Zhang <codelint@foxmail.com>
 **/
class ResponseInternal
{
    public $header;
    public $status;
    public $data;

    public function __construct($status = 0, $header = NULL, $data = "") {
        if ($header == NULL) {
            $header = array();
        }
        $this->status = $status;
        $this->header = $header;
        $this->data = $data;
    }

    public function __toString()
    {
        $info = array("status" => $this->status,
                     "header" => json_encode($this->header),
                     "data" => $this->data);
        return json_encode($info);
    }
}
