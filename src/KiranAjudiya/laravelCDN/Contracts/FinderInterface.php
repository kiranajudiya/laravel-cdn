<?php

namespace KiranAjudiya\laravelCDN\Contracts;

/**
 * Interface FinderInterface.
 *
 * @author   Kiran Ajudiya <ajudiyabalam@gmail.com>
 */
interface FinderInterface
{
    public function read(AssetInterface $paths);
}
