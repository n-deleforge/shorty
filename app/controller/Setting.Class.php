<?php
class Setting
{
    private $_id;
    private $_key;
    private $_value;

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
    public function getValue()
    {
        return $this->_value;
    }
    public function setValue($_value)
    {
        return $this->_value = $_value;
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
