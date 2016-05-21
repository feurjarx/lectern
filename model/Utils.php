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
                $result[$item] = (isset($data[$item]) && $data[$item]) ? $data[$item] : null;
            }
        }

        return array_merge($prevData, $result);
    }
}