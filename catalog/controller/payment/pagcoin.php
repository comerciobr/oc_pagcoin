<?php

   function apache_request_headers2() {
        $headers = array();
        foreach($_SERVER as $key => $value) {
            if(substr($key, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))))] = $value;
            }
        }
        return $headers;
    }

if( !function_exists('apache_request_headers') ) {
    function apache_request_headers() {
        $arh = array();
        $rx_http = '/\AHTTP_/';

        foreach($_SERVER as $key => $val) {
            if( preg_match($rx_http, $key) ) {
                $arh_key = preg_replace($rx_http, '', $key);
                $rx_matches = array();
           // do some nasty string manipulations to restore the original letter case
           // this should work in most cases
                $rx_matches = explode('_', $arh_key);

                if( count($rx_matches) > 0 and strlen($arh_key) > 2 ) {
                    foreach($rx_matches as $ak_key => $ak_val) {
                        $rx_matches[$ak_key] = ucfirst($ak_val);
                    }

                    $arh_key = implode('-', $rx_matches);
                }

                $arh[$arh_key] = $val;
            }
        }

        return( $arh );
    }
}


class ControllerPaymentPagcoin extends Controller {
	var $URL_PAGECOIN = "https://pagcoin.com";
	var $URL_CREATE_ORDER = "https://pagcoin.com/api/v1/CriarInvoice";
	var $error_request = false;
 	protected function index()
	{
		$this->language->load('payment/pagcoin');
		
	    $this->data['button_confirm'] = $this->language->get('button_confirm');
	    $this->data['text_information'] =  $this->language->get('text_information');
	    $this->data['text_wait'] = $this->language->get('text_wait');
	    $this->data['txt_payment_processed'] = $this->language->get('txt_payment_processed');
	    $this->data['link_confirm'] = $this->url->link('payment/pagcoin/confirm');
	    $this->data['link_success'] = $this->url->link('checkout/success');
	    $this->data['pagcoin_use_lightbox'] = $this->config->get("pagcoin_use_lightbox");
	
    	$this->load->model('checkout/order');
	    $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		
		$apikey = $this->config->get("pagcoin_apikey");
		$sigla_loja = $this->config->get("pagcoin_sigla");
		
		$total = $order_info['total'];
		$discount = $this->config->get('pagcoin_discount');
		if($discount)
		{
			if(stristr($discount, '%'))
			{
				$discount = preg_replace("#[%]#", "", $discount);
				$discount = ($this->cart->getSubTotal() * $discount) / 100;
			}
			
			$total -= $discount;
			$this->data['text_information'] = sprintf($this->language->get('text_discount_confirm'), $this->config->get('pagcoin_discount'), $this->currency->format($total, $order_info['currency_code'])).$this->data['text_information'];
		}
		
		$total = $this->currency->format($total, $order_info['currency_code'], false, false);
		$request = array(
			"apiKey" => $apikey, 
			"valorEmMoedaOriginal" => $total, 
			"nomeProduto" => substr($order_info['store_name'], 0, 255), 
			"idInterna" => $sigla_loja."_".$this->session->data['order_id'], 
			"email" => $order_info['email'],
			"redirectURL" => $this->url->link('checkout/success')
		);
		
		$request = json_encode($request);
		$url = $this->getPage("/", $request);
		if(!empty($url) && !$this->error_request)
		{
			$this->data["url"] = $this->URL_PAGECOIN.$url;
		}
		else
		{
			die($this->language->get('text_error'));
		}
		
	    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/pagcoin.tpl')) {
	    	$this->template = $this->config->get('config_template') . '/template/payment/pagcoin.tpl';
	    }
	    else{
	      	$this->template = 'default/template/payment/pagcoin.tpl';
	    }	

	    $this->render();
	  }
		
	public function confirm() {
	    
		$this->load->model('checkout/order');
    	$this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('pagcoin_order_wait_payment'));
    	$this->cart->clear();
    		
    	unset($this->session->data['shipping_method']);
    	unset($this->session->data['shipping_methods']);
    	unset($this->session->data['payment_method']);
    	unset($this->session->data['payment_methods']);
    	unset($this->session->data['guest']);
    	unset($this->session->data['comment']);
    	unset($this->session->data['order_id']);
    	unset($this->session->data['coupon']);
    	unset($this->session->data['voucher']);
    	unset($this->session->data['vouchers']);
    	/*
		*/    	
	}
			
	public function callback()
	{
		$headers = apache_request_headers();
		$headers2 = apache_request_headers2();
		
		//*
		$f = fopen(DIR_LOGS."pagcoin.txt", "a+");
		//ob_start();
		$text = "";
		foreach($headers as $key => $header)
		{
			$text .="{$key} = {$header}\r\n";
		}
		//$text = ob_get_clean();
		//@ob_end_clean();
		//$text = implode("\r\n", $headers);
		fwrite($f, $text);
		//fclose($f);
		//*/
		
		//if(!isset($headers["EnderecoPagCoin"]) || !isset($headers["AssinaturaPagCoin"]))
		if(!isset($headers["ENDERECOPAGCOIN"]) || !isset($headers["ASSINATURAPAGCOIN"]))
		{
			die("Cabeçalhos não encontrados.");
		}
		
		$postdata = file_get_contents("php://input");
		$fields = json_decode($postdata, true);
		
		$text = "\r\n{$postdata}\r\n\r\n";
		fwrite($f, $text);
		fclose($f);
		
		// função para calculo do hmac   concatenação de cabeçalho + conteudo   sua ApiKey       
		//$signature = hash_hmac('sha256', $headers["EnderecoPagCoin"].$postdata, $this->config->get("pagcoin_apikey"));
		$signature = hash_hmac('sha256', $headers["ENDERECOPAGCOIN"].$postdata, $this->config->get("pagcoin_apikey"));

		//if($signature != $headers["AssinaturaPagCoin"]){
		if($signature != $headers["ASSINATURAPAGCOIN"]){
			die("Assinatura não confere");
		}
		
		// Sua implementação própria para identificar o pagamento e liberar os produtos. 
		// Para acessar os campos do objeto informado, use a seguinte sintaxe como exemplo:
		$idPagCoin = $fields["idPagCoin"];
		$valorEmMoedaOriginal = $fields["valorEmMoedaOriginal"];
		$nomeProduto = $fields["nomeProduto"];
		$order_id = str_replace($this->config->get("pagcoin_sigla")."_", "", $fields["idInterna"]);
		$email = $fields["email"];
		$hora = $fields["hora"];
		$moedaOriginal = $fields["moedaOriginal"];
		$statusPagamento = $fields["statusPagamento"];
		$horaResposta = $fields["horaResposta"];

		$this->load->model('checkout/order');
		$order = $this->model_checkout_order->getOrder($order_id);

		if($order)
		{
			$comment = "Tipo de pagamento: Bitcoin\n\n";
			switch($statusPagamento)
			{
				case "aguardando":
				{
					if ($order['order_status_id'] == '0')
					{
						$this->model_checkout_order->confirm($order_id, $this->config->get('pagcoin_order_wait_payment'), $comment);
					}
					elseif($order['order_status_id'] != $this->config->get('pagcoin_order_wait_payment'))
					{
						$this->model_checkout_order->update($order_id, $this->config->get('pagcoin_order_wait_payment'), $comment, $this->config->get('pagcoin_update_status_alert'));
					}
					break;
				}
				case "confirmado":
				{
					if($order['order_status_id'] != $this->config->get('pagcoin_order_confirmed'))
					{
						$this->model_checkout_order->update($order_id, $this->config->get('pagcoin_order_confirmed'), '', $this->config->get('pagcoin_update_status_alert'));
					}
					break;
				}
				case "recusado":
				case "rejeitado":
				{
					if($order['order_status_id'] != $this->config->get('pagcoin_order_recused'))
					{
						$this->model_checkout_order->update($order_id, $this->config->get('pagcoin_order_recused'), '', $this->config->get('pagcoin_update_status_alert'));
					}
					break;				
				}
				case "timeout":
				{
					if($order['order_status_id'] != $this->config->get('pagcoin_order_timeout'))
					{
						$this->model_checkout_order->update($order_id, $this->config->get('pagcoin_order_timeout'), '', $this->config->get('pagcoin_update_status_alert'));
					}
					break;
				}
			}
		}
	}
	
	protected function getPage($url, $post = array())
	{
		$url = $this->URL_CREATE_ORDER.$url;
		$ch = curl_init($url);

		if(!empty($post) || count($post))
		{
			if(is_array($post))
			{
				$post = http_build_query($post, NULL, '&');
			}

			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}
		else
		{
			curl_setopt($ch, CURLOPT_POST, false);
			curl_setopt($ch, CURLOPT_HTTPGET, true);
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$html = curl_exec($ch);
		$info = curl_getinfo($ch);
		if($info["http_code"] != 200)
		{
			$this->error_request = true;
		}

		curl_close($ch);	
		
		return $html;
	}
}
?>
