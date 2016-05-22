<?php

/**
 * Created by PhpStorm.
 * Date: 21.05.2016
 * Time: 13:10
 */
class Utils
{
    /**
     * @param array $list
     * @param array $data
     * @param array $prevData
     * @return array
     */
    public static function arraySerialization(array $list, array $data, array $prevData = []) {

        $result = [];
        
        if ($data && is_array($data) && $list && is_array($list)) {
            foreach ($list as $item) {
                $result[$item] = isset($data[$item]) ? (($data[$item] === '0' || $data[$item] === 0 || $data[$item]) ? $data[$item] : null) : null;
            }
        }

        return array_merge($prevData, $result);
    }

    /**
     * @return string
     */
    public static function getHttpHost(){
        return 'http://' . $_SERVER['HTTP_HOST'];
    }

    /**
     * @return bool
     */
    public static function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}