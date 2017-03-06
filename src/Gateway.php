<?php

namespace Omnipay\Zcredit;

use Omnipay\Common\AbstractGateway;
use Omnipay\Zcredit\Message\CompletePurchaseRequest;
use Omnipay\Zcredit\Message\PurchaseRequest;

/**
 * Z-credit Gateway
 *
 * @link http://www.z-credit.co.il/
 */

    const Hebrew = "he-IL";
    const English = "en-US";
    const NIS = 1;
    const USD = 2;
    const testUser = 'testws3';
    const testTerminal = '0962333014';

class Gateway extends AbstractGateway
{

    public function getName()
    {
        return 'Zcredit';
    }

    public function getDefaultParameters()
    {
        return array(
            'terminal'  => '',
            'user'      => '',
            'testMode'  => true,
        );
    }

    public function getTerminal()
    {
        return getTestMode() ? testTerminal : $this->getParameter('terminal');
    }

    public function setTerminal($value)
    {
        return $this->setParameter('terminal', $value);
    }

    public function getUser()
    {
        return getTestMode() ? testUser : $this->getParameter('user');
    }

    public function setUser($value)
    {
        return $this->setParameter('user', $value);
    }

    public function getPicture()
    {
        return 'http://picture.com';
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Zcredit\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Zcredit\Message\CompletePurchaseRequest', $parameters);
    }

}
