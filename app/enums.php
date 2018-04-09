<?php

class ArticleType
{
    CONST BULLETIN = 1;
    CONST DISCUSS = 2;
    CONST PROBLEM = 3;
    CONST EXPERIENCE = 4;

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