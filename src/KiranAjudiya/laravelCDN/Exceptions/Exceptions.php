<?php

namespace KiranAjudiya\laravelCDN\Exceptions;

/**
 * @author Kiran Ajudiya <ajudiyabalam@gmail.com>
 */
class CdnException extends \RuntimeException
{
}

class MissingConfigurationFileException extends CdnException
{
}

class MissingConfigurationException extends CdnException
{
}

class UnsupportedProviderException extends CdnException
{
}

class EmptyPathException extends CdnException
{
}
