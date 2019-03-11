<?php

# Complete the function below.

# DO NOT MODIFY anything outside the below function
function rearrange($elements, $length) {

    $store = array_reduce($elements, function(array $out, $in) {
        $key = array_unique(str_split($in));
        natcasesort($key);
        $key = implode('', $key);
        if(!array_key_exists($key, $out)) {
            $out[$key] = [];
        }
        $out[$key][] = $in;

        return $out;
     }, []);

     echo implode(',', array_map(function($word) {
         return implode(',', $word);
     }, $store));

}
# DO NOT MODIFY anything outside the above function

# DO NOT MODIFY THE CODE BELOW THIS LINE!
$handle = fopen("php://stdin", "r");
fscanf($handle, "%d", $elements_cnt);

$elements = array();
for ($elements_i = 0; $elements_i < $elements_cnt; $elements_i++) {
  fscanf($handle, "%s", $elements[]);
}

rearrange($elements, $elements_cnt);
