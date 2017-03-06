<?php

namespace Omnipay\WorldPay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * WorldPay Purchase Response
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $GW_URL = 'https://pci.zcredit.co.il/WebControl/RequestToken.aspx';

    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        $url = urlencode($GW_URL) . '?' . http_build_query($this->data);
        return str_replace('&amp;', '&', $url);
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return null;
    }
}
