<?php
namespace Vinelab\UrlShortener\Validators;

use Vinelab\UrlShortener\Contracts\ValidatorInterface;
use Vinelab\UrlShortener\Exceptions\MissingConfigurationException;
use Vinelab\UrlShortener\Exceptions\ResponseErrorException;

/**
 * Class ValidatorTrait holds the basic shared validators across all drivers
 *
 * @category Validator Trait
 * @package Vinelab\UrlShortener\Validators
 * @author  Mahmoud Zalt <mahmoud@vinelab.com>
 */
trait ValidatorTrait
{

    /**
     * validate the input parameter in the config file is not missed
     *
     * @param $parameter
     *
     * @return mixed
     * @throws \Vinelab\UrlShortener\Validators\MissingConfigurationException
     */
    public function validateConfiguration($parameter)
    {
        if (!$parameter) {
            throw new MissingConfigurationException("Missing the configuration ($parameter).");
        }

        return $parameter;
    }

    /**
     * validate response is OK (200)
     *
     * @param $code
     *
     * @throws \Vinelab\UrlShortener\Validators\ResponseErrorException
     */
    public function validateResponseCode($code)
    {
        if (!$code || $code != '200') {
            throw new ResponseErrorException("Response is not OK! Response code = $code");
        }
    }

}
