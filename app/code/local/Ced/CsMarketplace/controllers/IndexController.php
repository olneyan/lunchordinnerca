<?php
/**
 * CedCommerce
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category    Ced;
 * @package     Ced_CsMarketplace
 * @author 		CedCommerce Core Team <coreteam@cedcommerce.com>
 * @copyright   Copyright CedCommerce (http://cedcommerce.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Ced_CsMarketplace_IndexController extends Ced_CsMarketplace_Controller_AbstractController
{
	public function indexAction() {
		if (!Mage::getStoreConfig('ced_csmarketplace/general/shopurl_active'))	{
			$this->_redirect('/');
			return;
		}
		else {
			$this->_redirect('*/vshops');
			return;
		}
	}
<<<<<<< HEAD
	public function sendapplinkAction(){
		$email = $this->getRequest()->getParam('email');
		print_r($email);
		echo "hi there";
		die();
	}
=======
>>>>>>> aa209c7ea91034ffae67f205b17068791e2bbe6b
}