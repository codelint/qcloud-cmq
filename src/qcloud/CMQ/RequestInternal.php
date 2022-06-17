<?php namespace Com\Codelint\QCloud\CMQ;

/**
 * RequestInternal:
 * @date 2022/6/16
 * @time 20:40
 * @author Ray.Zhang <codelint@foxmail.com>
 **/
class RequestInternal
{
    public $header;
    public $method;
    public $uri;
    public $data;

    public function __construct($method = "", $uri = "", $header = NULL, $data = "") {
        if ($header == NULL) {
            $header = array();
        }
        $this->method = $method;
        $this->uri = $uri;
        $this->header = $header;
        $this->data = $data;
    }

    public function __toString()
    {
        $info = array("method" => $this->method,
                     "uri" => $this->uri,
                     "header" => json_encode($this->header),
                     "data" => $this->data);
        return json_encode($info);
    }
}
