<?php

if (! function_exists('fitrans')) {
    function fitrans($key, $params = [], $lang = null, $default = '')
    {

        if(config('famousContentApi.useApi')) {
            return \Famousinteractive\ContentApi\Library\Trans::get($key, $params, $lang, $default, config('famousContentApi.useCache', true));
        } else {
            return trans($key, $params);
        }
    }
}


if (! function_exists('fitds')) {
    function fitds($datasetName, $prefixLang = false, $param='all', $useCache=true) {
        if(config('famousContentApi.useApi')) {
            return \Famousinteractive\ContentApi\Library\Dataset::get($datasetName, $prefixLang, $param, $useCache);
        } else {
            return ['dataset'   => $datasetName];
        }
    }
}

if (! function_exists('fitpushds')) {
    function fitpushds($datasetName, $data=[], $prefixLang = false) {
        if(config('famousContentApi.useApi')) {
            return \Famousinteractive\ContentApi\Library\Dataset::put($datasetName, $data, $prefixLang);
        } else {
            return true;
        }
    }
}