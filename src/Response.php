<?php

namespace App;

class Response
{
    
    private
        /**
         * @var int
         */
        $statusCode,
        /**
         * @var string
         */
        $statusText,
        /**
         * @var array
         */
        $header,
        /**
         * @var string
         */
        $body;
    
    /**
     * constructor
     */
    public function __construct()
    {
        $this->statusCode = 200;
        $this->statusText = "OK";
        $this->header = [];
        $this->body = "";
    }
    
    /**
     * @param string $body
     */
    public function setBody(string $body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }
    
    /**
     * @param int $code
     * @param string $text
     */
    public function setStatus(int $code, string $text)
    {
        $this->statusCode = $code;
        $this->statusText = $text;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return "HTTP/1.1 "
              . $this->statusCode
              . " "
              . $this->statusText;
    }

    public function addHeader(string $name, string $value)
    {
        $this->header[$name] = $value;
    }
    
    /**
     * Renvoie header
     * @return array
     */
    public function getHeader(): array
    {
        return $this->header;
    }
    
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getBody();
    }

    /**
     * @param string $name
     */
    public function __get($name)
    {
        return property_exists($this, $name)
        ? $this->{$name}
        : null;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @throws \RuntimeException
     */
    public function __set($name, $value)
    {
        throw new \RuntimeException();
    }

}
