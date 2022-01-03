<?php
class Redirection
{
    private $_id;
    private $_key;
    private $_url;

    public function getId()
    {
        return $this->_id;
    }
    public function setId($_id)
    {
        return $this->_id = $_id;
    }
    public function getKey()
    {
        return $this->_key;
    }
    public function setKey($_key)
    {
        return $this->_key = $_key;
    }
    public function getUrl()
    {
        return $this->_url;
    }
    public function setUrl($_url)
    {
        return $this->_url = $_url;
    }

    public function __construct(array $options = [])
    {
        if (!empty($options)) {
            $this->hydrate($options);
        }
    }
    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $method = "set" . ucfirst($key);
            if (is_callable(([$this, $method]))) {
                $this->$method($value);
            }
        }
    }
}
