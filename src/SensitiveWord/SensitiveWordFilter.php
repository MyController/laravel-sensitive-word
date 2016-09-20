<?php

namespace MyController\SensitiveWord\SensitiveWord;

class SensitiveWordFilter
{
    public static function getFirstSensitiveWordInContent($content)
    {
        try {
            $matches = array();
            if(self::getFirstSensitiveWordInContentByKiki($content, $matches)){
                return $matches[0];
            } else {
                return "";
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    //todo 优化方向 , 敏感词库过大会导致程序崩溃, 应该实现分批取词分批比较
    public static function getFirstSensitiveWordInContentByKiki($content, & $matches)
    {
        static $keywords;

        if (! $keywords) {
            $path = dirname(__FILE__) . '/keywords';
            if (file_exists($path)) {
                $delimiter = '/';
                $fileContent = file($path, FILE_IGNORE_NEW_LINES + FILE_SKIP_EMPTY_LINES);
                $filterFunc = function (& $item) use ($delimiter) {
                    // 对于正则表达式涉及到的特殊字符都要转义
                    $item = preg_quote($item, $delimiter);
                };
                array_walk_recursive($fileContent, $filterFunc);
                $keywords = $delimiter . implode('|', $fileContent) . $delimiter . "i";
            }
        }

        if ($keywords) {
            return preg_match($keywords, $content, $matches);
        } else {
            return 0;
        }
    }

    public static function showSensitiveWordLibrary()
    {
        //TODO show the keywords library

        return "敏感词1\n敏感词2\n敏感词3";
    }

    public static function addSensitiveWord($word)
    {
        //TODO add a sensitive word to the keywords library

        return true;
    }

    public static function removeSensitiveWord($word)
    {
        //TODO remove a sensitive word from the keywords library

        return true;
    }

}