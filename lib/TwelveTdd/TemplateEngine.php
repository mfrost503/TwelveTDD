<?php
namespace TwelveTdd;

class TemplateEngine
{
    public function evaluate($string, $variables)
    {
        preg_match_all('/\${[A-Za-z_-]+}/',$string,$keys);
        $keyArray = $keys[0];
        foreach($keyArray as $key) {
            $strippedKey = str_replace(array("}","{","$"),"",$key);
            $variableKeys = array_keys($variables);
            if(!in_array($strippedKey,$variableKeys)) {
                throw new MissingValueException("Key is missing from provided variables");
            }
            $string = str_replace($key,$variables[$strippedKey],$string);
        }
        return $string;
    }
}