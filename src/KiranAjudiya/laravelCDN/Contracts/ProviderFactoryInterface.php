<?php

namespace KiranAjudiya\laravelCDN\Contracts;

/**
 * Interface ProviderFactoryInterface.
 *
 * @author   Kiran Ajudiya <ajudiyabalam@gmail.com>
 */
interface ProviderFactoryInterface
{
    public function create($configurations);
}
