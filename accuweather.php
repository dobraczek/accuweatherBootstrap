<?php

/**
 * accuweatherBootstrap
 * @author Martin Dobry
 * @link http://webscript.cz
 * @version 1.0
 */

namespace Accuweather;

class Weather
{
    public $link;
    public $locationKey;
    public $apikey;
    public $daily;
    public $lang;
    public $metric;
    public $details;
    public $formatDate;
    public $day;
    public $text;
    
    public function __construct() {
        $this->link = "http://dataservice.accuweather.com/forecasts/v1/daily/";
        $this->locationKey = "";
        $this->apikey = "";
        $this->daily = "5day";
        $this->lang = "cs-cz"; // https://developer.accuweather.com/localizations-by-language
        $this->formatDate = "d.m.Y";
        $this->metric = 'true';
        $this->details = 'true';
        $this->text = json_decode($this->openJsonLang(), 1);
        $this->day = $this->langDay();
    }
	
	private function file_get_contents_curl($url) {
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    $data = curl_exec($ch);
	    curl_close($ch);
	    return $data;
	}
	
	private function openJsonLang() {
	    return file_get_contents("./lang/".$this->lang.".json", true);
	}
	
	private function langDay() {
	    $data = json_decode($this->openJsonLang(), 1);
	    return array($data['sunday'], $data['monday'], $data['tuesday'], $data['wednesday'], $data['thursday'], $data['friday'], $data['saturday']);
	}
    
    public function accuweather()
    {
        $json = $this->file_get_contents_curl($this->link.$this->daily."/".$this->locationKey."?apikey=".$this->apikey."&language=".$this->lang."&details=".$this->details."&metric=".$this->metric);
        $array = json_decode($json, 1);
        return $array;
    }
}
?>
