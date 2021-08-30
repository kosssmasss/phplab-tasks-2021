<?php
namespace strings;

class Strings implements StringsInterface{
    public function snakeCaseToCamelCase(string $input): string{
        return lcfirst(str_replace('_', '', ucwords($input, '_')));
    }
    public function mirrorMultibyteString(string $input): string{
        $arr = explode(' ',$input);
        foreach($arr as $key => $item){
            $strcyr = "";
            for($i = mb_strlen($item, "UTF-8"); $i >= 0; $i--) {
                $strcyr .= mb_substr($item, $i, 1, "UTF-8");
            }
            $arr[$key] = $strcyr;
        }
        return implode(" ",$arr);
    }
    public function getBrandName(string $noun): string{
        $first = mb_substr($noun, 0, 1, "UTF-8");
        $last  = mb_substr($noun, -1, 1, "UTF-8");

        if ($first != $last){
            $noun = ucfirst($noun);
            return "The $noun";
        }

        else {
            return ucfirst($noun.ltrim($noun, $noun[0]));
        }
    }
}