<?php

namespace KiranAjudiya\laravelCDN\Contracts;

/**
 * Interface CdnHelperInterface.
 *
 * @author   Kiran Ajudiya <ajudiyabalam@gmail.com>
 */
interface CdnHelperInterface
{
    public function getConfigurations();

    public function validate($configuration, $required);

    public function parseUrl($url);

    public function startsWith($haystack, $needle);

    public function cleanPath($path);
}
