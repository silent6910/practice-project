<?php

class ArticleType
{
    CONST BULLETIN = 0;
    CONST DISCUSS = 1;
    CONST PROBLEM = 2;
    CONST EXPERIENCE = 3;

    //get class all const
    static function getConstants()
    {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }

    //todo Here permission design is defective.
    static function getPermission()
    {
        return [self::BULLETIN => 'article_createBulletin'];
    }
}