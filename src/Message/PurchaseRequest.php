<?php

namespace Omnipay\WorldPay\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Zcredit\Src\Gateway;

/**
 * Яскувше Purchase Request
 /// <summary>
/// Create a payment transaction using Z-Credit Redirect.
/// </summary>
/// <param name="TerminalNumber">Your Z-Credit terminal number.</param>
/// <param name="UserName">Your Z-Credit user name.</param>
/// <param name="PaymentSum"><para>Payment total sum.</para><para>Caution: if left empty the customer will be able to choose the transaction sum himself !!</para></param>
/// <param name="PaymentsNumber"><para>Number of payments for this transaction.</para><para>Caution: if left empty the customer will be able to choose the number of payments himself !!</para></param>
/// <param name="Lang">Redirect page language</param>
/// <param name="Currency">Transaction currency.</param>
/// <param name="UniqueID"><para>An ID which is returned to the caller after the transaction ends.</para><para>-- Mainly used for validation</para></param>
/// <param name="ItemDescription">Describe the item which is sold in this transaction.</param>
/// <param name="ItemQtty"><para>The quantity of items sold in this transaction.</para><para>-- Only shown if ItemDescription is populated</para>para></param>
/// <param name="ItemPicture"><para>Full image URL of the item.  Caution: The URL must be HTTPS.</para><para>-- Only shown if ItemDescription is populated</para></param>
/// <param name="RedirectLink">URL which the customer is redirected to, after a successfull transaction.</param>
/// <param name="NotifyLink"><para>URL which will recieve the transaction data after successfull payment.</para><para>-- Using the POST method</para></param>
/// <param name="UsePaymentsRange">When true, the redirect page will allow the user to choose from a range of payments from 1 to the number given in the "PaymentsNumber" parameter</param>
/// <param name="ShowHolderID"><para>When true, the HolderID field will be visible</para><para>-- Otherwise it will be hidden</para></param>
/// <param name="AuthorizeOnly"><para>This will force the transaction to be a Capture Transaction (J5).</para><para>Caution: Capture transaction are not charged, and is only used to capture an amount of money for future transaction.</para></param>
/// <param name="HideCustomer"><para>When true, the Customer Data panel will be visible</para><para> -- Otherwise it will be hidden</para></param>
/// <exception cref="ZCreditException"></exception>
 */
class PurchaseRequest extends AbstractRequest
{

    // public function getTerminal()
    // {
    //     return $this->getParameter('terminal');
    // }

    // public function setTerminal($value)
    // {
    //     return $this->setParameter('terminal', $value);
    // }

    // public function getUser()
    // {
    //     return $this->getParameter('user');
    // }

    // public function setUser($value)
    // {
    //     return $this->setParameter('user', $value);
    // }

    public function getData()
    {
        $this->validate('amount');

		$data = array();
		$data['TerminalNumber'] 		= getTerminal();
		$data['Username']				= getUser();
		$data['PaymentSum']				= $PaymentSum;
		// 'PaymentsNumber'	=> $PaymentsNumber;
		$data['Lang']					= HEBREW;
		$data['Currency']				= getCurrency();
		$data['UniqueID']				= $UniqueID;
		$data['ItemDescription'] 		= $this->getDescription();
		$data['ItemQtty']				= $this->getAmount();
		$data['ItemPicture']			= $this->getPicture();
		$data['RedirectLink']			= $GW_URL;
		$data['NotifyLink']				= $GW_URL;
		$data['UsePaymentsRange'] 		= $UsePaymentsRange;
		$data['ShowHolderID']			= $ShowHolderID;
		$data['AuthorizeOnly']			= $AuthorizeOnly;
		$data['HideCustomer']			= $HideCustomer;
		$data['CustomerName']			= $CustomerName;
		$data['CustomerPhoneNumber'] 	= $CustomerPhoneNumber;
		$data['CustomerEmail']			= $CustomerEmail;
		$data['CustomerBusinessID'] 	= $CustomerBusinessID;
		$data['CssType']				= $CssType;
		$data['IsCssResponsive']		= $IsCssResponsive;


		$post = http_build_query($data);


		$post2 = "TerminalNumber=$TerminalNumber"
		."&Username=$UserName&PaymentSum=$PaymentSum&PaymentsNumber=$PaymentsNumber&Lang=$Lang"
		."&Currency=$Currency&UniqueID=$UniqueID&ItemDescription=$ItemDescription&ItemQtty=$ItemQtty"
		."&ItemPicture=$ItemPicture&RedirectLink=$RedirectLink&NotifyLink=$NotifyLink"
		."&UsePaymentsRange=$UsePaymentsRange&ShowHolderID=$ShowHolderID&AuthorizeOnly=$AuthorizeOnly"
		."&HideCustomer=$HideCustomer"
		."&CustomerName=$CustomerName&CustomerPhoneNumber=$CustomerPhoneNumber&CustomerEmail=$CustomerEmail&CustomerBusinessID=$CustomerBusinessID"
		."&CssType=$CssType&IsCssResponsive=$IsCssResponsive";

        return $post;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }

}
