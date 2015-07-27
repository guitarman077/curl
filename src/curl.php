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
        return curl_setopt($this->curl, CURLOPT_COOKIEFILE, $cookie_file);
    }

    /**
     * @param array $headers
     * @return bool
     */
    public function setOptHTTPHeader(Array $headers)
    {
        return curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
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
     * @return bool
     */
    public function setOptHeaderTrue()
    {
        return curl_setopt($this->curl, CURLOPT_HEADER, true);
    }

    /**
     * @return bool
     */
    public function setOptHeaderFalse()
    {
        return curl_setopt($this->curl, CURLOPT_HEADER, false);
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
     * @return bool
     */
    public function setOptNobodyTrue()
    {
        return $this->setOpt(CURLOPT_NOBODY, true);
    }

    /**
     * @return bool
     */
    public function setOptNobodyFalse()
    {
        return $this->setOpt(CURLOPT_NOBODY, false);
    }
    
    /**
     * @return mixed
     */
    public function getInfo()
    {
        return curl_getinfo($this->curl);
    }

    /**
     *
     */
    public function __destruct()
    {

        if (get_resource_type($this->curl) == 'Unknown') {
            return;
        }

        $this->close();
    }
}