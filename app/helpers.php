<?php

/**
 * Query builder helper for text LIKE SQL
 *
 * @param mixed $query
 * @param string $field
 * @param string $value
 * @return mixed
 */
function queryText($query, $field, $value)
{
    if (str_contains($value, '*')) {
        $query->where($field, 'like', str_replace('*', '%', $value));
    } else {
        $query->where($field, $value);
    }

    return $query;
}

/**
 * Matching sort query params
 * $matches = [$sortKey, 'desc|asc']
 *
 * @param string $sort
 * @param array $matches
 * @return bool
 */
function regexpSort($sort, &$matches)
{
    return preg_match('/^(\w+)_(desc|asc)$/', $sort, $matches) === 1 ? true : false;
}

/**
 * Validate domain name
 *
 * @param string $domainName
 * @return bool
 */
function isValidDomainName($domainName)
{
    return preg_match('/^(?:[-A-Za-z0-9]+\.)+[A-Za-z]{2,6}$/', $domainName) === 1 ? true : false;
}

/**
 * Validate domain name with http or https
 *
 * @param string $domainName
 * @return bool
 */
function isValidDomainNameWithHttp($domainName)
{
    return preg_match('/^https?:\/\/(?:[-A-Za-z0-9]+\.)+[A-Za-z]{2,6}$/', $domainName) === 1 ? true : false;
}

/**
 * Matching default folder name
 *
 * @param $defaultFolderName
 * @return bool
 */
function regexpDefaultFolderName($defaultFolderName)
{
    return preg_match('/^('.config('image.default_folder_name').')/', $defaultFolderName) === 1 ? true : false;
}

/**
 * Generate trade number.
 *
 * @return string
 */
function generateTradeNo()
{
    $timezone = config('view.timezone');
    $datetime = \Carbon\Carbon::now($timezone)->format('YmdHis');
    $rand = sprintf('%04d', rand(0, 9999));

    return $datetime.$rand;
}

/**
 * Parse datetime to Carbon UTC timezone.
 *
 * @param $datetime
 * @return \Carbon\Carbon
 */
function toUtc($datetime)
{
    return \Carbon\Carbon::parse($datetime, config('view.timezone'))->timezone('UTC');
}

/**
 * Calculate the date range
 *
 * @param $dateFrom
 * @param $dateTo
 * @return array
 */
function dateRange($dateFrom,$dateTo) {
    $dates = [];

    $start_date = \Carbon\Carbon::parse($dateFrom);
    $end_date = \Carbon\Carbon::parse($dateTo);

    for($date = $start_date; $date->lte($end_date); $date->addDay()) {
        $dates[] = $date->format('Y-m-d');
    }

    return $dates;
}

/**
 * Get time difference.
 * ex. +08:00
 *
 * @return string
 */
function timezoneDiff()
{
    return \Carbon\Carbon::today(config('view.timezone'))->format('P');
}