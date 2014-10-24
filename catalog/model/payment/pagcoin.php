<?php 
/*
* @package		Comércio BR
* @copyright	2014
* @site			http://comerciobr.com
* @license		http://www.gnu.org/licenses/gpl-2.0.html
*
* @Donate		1G3xTNh512PRDbfoEoeWWacigVVR9tYHAp Bitcoin
* @Donate		LXjsKahtNEmtZCQPXyRnw7c7mU4iKJbYWJ Litcoin
* @Donate		DFLaTxkhVeA84juzLBmxL8uRA1A7KJGnbL DogeCoin
*/

class ModelPaymentPagcoin extends Model {
  	public function getMethod($address, $total)
	{
		$this->language->load('payment/pagcoin');
		
		if($total >= $this->config->get('pagcoin_total'))
		{
			$status = true;
		}
		else
		{
			$status = false;
		}
		
		$method_data = array();

		if ($status)
		{
			$discount = $this->config->get('pagcoin_discount');
			if($discount)
			{
				if(stristr($discount, '%'))
				{
					$discount = sprintf($this->language->get('text_discount'), $discount);
				}
				else
				{
					$discount = sprintf($this->language->get('text_discount'), $this->currency->format($discount));
				}
			}
			else
			{
				$discount = "";
			}
			
			$method_data = array( 
				'code'       => 'pagcoin',
				'title'      => $this->language->get('text_title').$discount,
				'sort_order' => $this->config->get('pagcoin_sort_order')
			);
		}
		
    	return $method_data;
  	}
}
?>