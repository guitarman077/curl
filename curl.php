<?php

/**
 * Class Curl
 */
class Curl {

    private $curl;

    /**
     * 
     */
    public function __construct()
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * @param $url
     * @return bool
     */
    public function setOptUrl($url)
    {
        return curl_setopt($this->curl, CURLOPT_URL, $url);
    }

    /**
     * @param $cookie_jar
     * @return bool
     */
    public function setOptCookieJar($cookie_jar)
    {
        return curl_setopt($this->curl, CURLOPT_COOKIEJAR, $cookie_jar);
    }

    /**
     * @param $cookie_file
     * @return bool
     */
    public function setOptCookieFile($cookie_file)
    {
        return curl_setopt($this->curl, CURLOPT_COOKIEJAR, $cookie_file);
    }

    /**
     * @return bool
     */
    public function setOptPostTrue() {
        return $this->setOptPost(true);        
    }

    /**
     * @return bool
     */
    public function setOptPostFalse() {
        return $this->setOptPost(false);
    }

    /**
     * @param bool $value
     * @return bool
     */
    public function setOptPost($value) {
        return curl_setopt($this->curl, CURLOPT_POST, (bool) $value);
    }
    
    /**
     * @param $option
     * @param $value
     * @return bool
     */
    public function setOpt($option, $value)
    {
        return curl_setopt($this->curl, $option, $value);
    }

    /**
     * @return mixed
     */
    public function exec()
    {
        return curl_exec($this->curl);
    }

    /**
     * 
     */
    public function close()
    {
        curl_close($this->curl);
    }

    /**
     * @param array $params
     * @return bool
     */
    public function setOptPostFields(Array $params)
    {
        return curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->prepareForPost($params));
    }

    /**
     * @param $array
     * @return string
     */
    protected function prepareForPost($array)
    {
        $return = '';

        foreach ($array as $key => $value) {
            $return .= $key . '=' . $value . '&';
        }

        return $return;
    }

    /**
     * 
     */
    public function __destruct() {
        $this->close();
    }
}