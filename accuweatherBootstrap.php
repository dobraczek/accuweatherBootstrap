<?php

/**
 * accuweatherBootstrap
 * @author Martin Dobry
 * @link http://webscript.cz
 * @version 1.0
 */

namespace Accuweather;
include "accuweather.php";

class Bootstrap {
    
    private $html;
    
    public function __construct() {
        $this->html = null;
    }
    
    public function getArray(): Weather {
        return new Weather();
    }
    
    public function DesignA() {
        
        $weatherClass = new Weather();
        
        # array DAY
        $dayArray = 0;
        
        # class variable
        $this->text = $weatherClass->text;
        $this->lang = $weatherClass->lang;
        $this->day = $weatherClass->day;
        $this->details = $weatherClass->details;
        $this->formatDate = $weatherClass->formatDate;
        
        # array
        $weather = $weatherClass->accuweather();
        
        # internal variable
        $day = date("w", strtotime($weather['Headline']['EffectiveDate']));
        $unit = ($weather['DailyForecasts'][$dayArray]['Temperature']['Minimum']['Unit'] == "C" ? '°C' : $weather['DailyForecasts'][$dayArray]['Temperature']['Minimum']['Unit']);
        $daily = $weather['DailyForecasts'][$dayArray]['Day'];
        $night = $weather['DailyForecasts'][$dayArray]['Night'];
        
        # output
        $this->html = '<div class="row">
            <div class="col-md-12">
                <h3>'.$this->text['nextday'].' '.strtolower($this->day[$day]).' '.date($this->formatDate, strtotime($weather['Headline']['EffectiveDate'])).'</h3>
            </div>
            <div class="col-md-2 text-center">
                <img src="https://developer.accuweather.com/sites/default/files/'.($weather['DailyForecasts'][$dayArray]['Day']['Icon'] < 10 ? '0'.$daily['Icon'] : $daily['Icon']).'-s.png" alt="'.$daily['IconPhrase'].'" /><br />
                <small>'.$weather['DailyForecasts'][$dayArray]['Day']['IconPhrase'].'</small>
            </div>
            <div class="col-md-110">
                <p>'.$weather['Headline']['Text'].'<br />
                   '.$this->text['temp'].' '.$this->text['from'].'
                   '.$weather['DailyForecasts'][$dayArray]['Temperature']['Minimum']['Value'].'
                   '.$this->text['to'].'
                   '.$weather['DailyForecasts'][$dayArray]['Temperature']['Maximum']['Value'].'
                   '.$unit;
    
        if($this->details == "true")
    
            $this->html .= '<br />
            '.$this->text['wind'].' '.$daily['Wind']['Speed']['Value'].'
            '.$daily['Wind']['Speed']['Unit'].' ('.$daily['Wind']['Direction']['Localized'].')<br />
            '.$this->text['snow'].' '.$daily['Snow']['Value'].' '.$daily['Snow']['Unit'].'<br />
            ';
    
    
            $this->html .= '</p>
            </div>
         </div>';
        return $this->html;
        
    }
}

?>
