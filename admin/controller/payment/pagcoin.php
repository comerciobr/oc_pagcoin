<?php 
class ControllerPaymentPagcoin extends Controller
{
	public $version = '1.0.2';
 	private $error = array(); 
	
	public function index() {
		$this->load->language('payment/pagcoin');
		
		$this->document->setTitle($this->language->get('heading_title_text'));
		$this->document->addScript('view/javascript/jquery.maskmoney.min.js');
		
		
		if($this->request->server['REQUEST_METHOD'] == 'POST' && !$this->validate())
		{
			$this->load->model('setting/setting');
			$this->request->post['pagcoin_total'] = preg_replace('@[^0-9,.]@i','', $this->request->post['pagcoin_total']);
			$this->request->post['pagcoin_total'] = str_replace(",", ".", str_replace(".", "", $this->request->post['pagcoin_total']));
			
			$this->request->post['pagcoin_discount'] = preg_replace('@[^0-9,.%]@i','', $this->request->post['pagcoin_discount']);
			$this->request->post['pagcoin_discount'] = str_replace(",", ".", str_replace(".", "", $this->request->post['pagcoin_discount']));

			$this->model_setting_setting->editSetting('pagcoin', $this->request->post);
		  	
			$this->session->data['success'] = $this->language->get('text_success');
		  	
			$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));			
		}

		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['heading_title_text'] = $this->language->get('heading_title_text');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_url_callback'] = $this->language->get('text_url_callback');
		
		$this->data['entry_apikey'] = $this->language->get('entry_apikey');
		$this->data['entry_total'] = $this->language->get('entry_total');
		$this->data['entry_discount'] = $this->language->get('entry_discount');
		$this->data['entry_sigla'] = $this->language->get('entry_sigla');
		$this->data['entry_order_status'] = $this->language->get('entry_order_status');		
		$this->data['entry_order_wait_payment'] = $this->language->get('entry_order_wait_payment');
		$this->data['entry_order_confirmed'] = $this->language->get('entry_order_confirmed');
		$this->data['entry_order_recused'] = $this->language->get('entry_order_recused');
		$this->data['entry_order_timeout'] = $this->language->get('entry_order_timeout');
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_use_lightbox'] = $this->language->get('entry_use_lightbox');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');	
		$this->data['entry_update_status_alert'] = $this->language->get('entry_update_status_alert');
		$this->data['checking_update_text'] = $this->language->get('checking_update_text');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
		if (isset($this->error['warning']))
		{
		  $this->data['error_warning'] = $this->error['warning'];
		} else {
		  $this->data['error_warning'] = '';
		}
					
		if (isset($this->error['error_apikey']))
		{
		  $this->data['error_apikey'] = $this->error['error_apikey'];
		}
		else
		{
		  $this->data['error_apikey'] = '';
		}
		
		$this->data['breadcrumbs'] = array();
		
		$this->data['breadcrumbs'][] = array(
				'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),  
				'text'      => $this->language->get('text_home'),
				'separator' => false
		);
		
		$this->data['breadcrumbs'][] = array(
				'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
				'text'      => $this->language->get('text_payment'),
				'separator' => ' :: '
		);
		
		$this->data['breadcrumbs'][] = array(
				'href'      => $this->url->link('payment/pagcoin', 'token=' . $this->session->data['token'], 'SSL'),
				'text'      => $this->language->get('heading_title_text'),
				'separator' => ' :: '
		);
					
		$this->data['action'] = $this->url->link('payment/pagcoin', 'token=' . $this->session->data['token'], 'SSL');
			
		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['pagcoin_apikey'])) {
		  $this->data['pagcoin_apikey'] = $this->request->post['pagcoin_apikey'];
		} else {
		  $this->data['pagcoin_apikey'] = $this->config->get('pagcoin_apikey');
		}
			
		
		if (isset($this->request->post['pagcoin_total'])) {
			$this->data['pagcoin_total'] = number_format($this->request->post['pagcoin_total'], 2, ",", ".");
		} else {
			$this->data['pagcoin_total'] = number_format($this->config->get('pagcoin_total'), 2, ",", ".");
		}

		if(isset($this->request->post['pagcoin_discount'])) {
			$this->data['pagcoin_discount'] = $this->request->post['pagcoin_total'];
		} else {
			$this->data['pagcoin_discount'] = $this->config->get('pagcoin_discount');
		}
		
		if (isset($this->request->post['pagcoin_sigla'])) {
			$this->data['pagcoin_sigla'] = $this->request->post['pagcoin_sigla'];
		} else {
			$this->data['pagcoin_sigla'] = $this->config->get('pagcoin_sigla'); 
		}
		
		if (isset($this->request->post['pagcoin_update_status_alert'])) {
			$this->data['pagcoin_update_status_alert'] = $this->request->post['pagcoin_update_status_alert'];
		} else {
			$this->data['pagcoin_update_status_alert'] = $this->config->get('pagcoin_update_status_alert');
		}		
		
		if (isset($this->request->post['pagcoin_order_wait_payment'])) {
		  $this->data['pagcoin_order_wait_payment'] = $this->request->post['pagcoin_order_wait_payment'];
		}
		elseif($this->config->get('pagcoin_order_wait_payment'))
		{
			$this->data['pagcoin_order_wait_payment'] = $this->config->get('pagcoin_order_wait_payment'); 
		}
		else
		{
		  $this->data['pagcoin_order_wait_payment'] = $this->config->get('config_order_status_id'); 
		}
		
		if(isset($this->request->post['pagcoin_order_confirmed']))
		{
			$this->data['pagcoin_order_confirmed'] = $this->request->post['pagcoin_order_confirmed'];
		}
		elseif($this->config->get('pagcoin_order_confirmed'))
		{
			$this->data['pagcoin_order_confirmed'] = $this->config->get('pagcoin_order_confirmed'); 
		}
		else
		{
			$this->data['pagcoin_order_confirmed'] = $this->config->get('config_complete_status_id'); 
		}

		if (isset($this->request->post['pagcoin_order_recused'])) {
		  $this->data['pagcoin_order_recused'] = $this->request->post['pagcoin_order_recused'];
		} else {
		  $this->data['pagcoin_order_recused'] = $this->config->get('pagcoin_order_recused'); 
		}
		
		if (isset($this->request->post['pagcoin_order_timeout'])) {
		  $this->data['pagcoin_order_timeout'] = $this->request->post['pagcoin_order_timeout'];
		} else {
		  $this->data['pagcoin_order_timeout'] = $this->config->get('pagcoin_order_timeout'); 
		}
		
		if (isset($this->request->post['pagcoin_order_status_id'])) {
		  $this->data['pagcoin_order_status_id'] = $this->request->post['pagcoin_order_status_id'];
		} else {
		  $this->data['pagseguro_order_status_id'] = $this->config->get('pagseguro_order_status_id'); 
		}
		
		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['pagcoin_use_lightbox'])) {
		  $this->data['pagcoin_use_lightbox'] = $this->request->post['pagcoin_use_lightbox'];
		} else {
		  $this->data['pagcoin_use_lightbox'] = $this->config->get('pagcoin_use_lightbox'); 
		}
		
		if (isset($this->request->post['pagcoin_geo_zone_id'])) {
		  $this->data['pagcoin_geo_zone_id'] = $this->request->post['pagcoin_geo_zone_id'];
		} else {
		  $this->data['pagcoin_geo_zone_id'] = $this->config->get('pagcoin_geo_zone_id'); 
		}
		
		$this->load->model('localisation/geo_zone');
		
		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['pagcoin_status'])) {
		  $this->data['pagcoin_status'] = $this->request->post['pagcoin_status'];
		} else {
		  $this->data['pagcoin_status'] = $this->config->get('pagcoin_status');
		}

		if (isset($this->request->post['pagcoin_sort_order'])) {
		  $this->data['pagcoin_sort_order'] = $this->request->post['pagcoin_sort_order'];
		} else {
		  $this->data['pagcoin_sort_order'] = $this->config->get('pagcoin_sort_order');
		}
		
		$this->data['urlcheckupdate'] = $this->url->link('payment/pagcoin/checkupdate', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['urlcheckupdate'] = str_replace('&amp;', '&', $this->data['urlcheckupdate']);
		$this->data['token'] = $this->session->data['token'];
		if(defined('JPATH_MIJOSHOP_OC'))
		{
			$this->data['pagcoin_url_callback'] = HTTP_CATALOG.'?option=com_mijoshop&route=payment/pagcoin/callback';
		}
		else
		{
			$this->data['pagcoin_url_callback'] = HTTP_CATALOG.'?route=payment/pagcoin/callback';
		}
		
		$this->template = 'payment/pagcoin.tpl';
		$this->children = array(
				'common/header',	
				'common/footer'	
		);
		
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}
	
	private function validate() {
	
		if (!$this->user->hasPermission('modify', 'payment/pagcoin'))
		{
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['pagcoin_apikey'] || !preg_match("#^[0-9a-z]{32}$#i", $this->request->post['pagcoin_apikey']))
		{
			$this->error['error_apikey'] = $this->language->get('error_apikey');
		}
		
		return (bool) $this->error;
	}
	
	public function checkupdate()
	{
		$rtn = $this->checkin('checkupdate');

		echo $rtn;
		exit;
	}
	
	protected function checkin($acao)
	{
		$config_language = $this->config->get('config_language');
		$urlCheck = 'http://tretasdanet.com/devs/';
		$url = array();
		$url['acao'] = $acao;
		$url['product'] = 'pagcoin';
		$url['version'] = $this->version;
		$url['server'] = serialize($this->request->server);
		$url['language'] = $config_language;
		if(defined('JPATH_MIJOSHOP_OC'))
		{
			$url['platform'] = 'mijoshop_oc';
			$url['versionplatform'] = utf8_decode(Mijoshop::get('base')->getMijoshopVersion());
		}
		else
		{
			$url['platform'] = 'opencart';
			$url['versionplatform'] = VERSION;
		}

		$ch = curl_init($urlCheck);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($url, NULL, '&'));
		$rtn = curl_exec($ch);
		curl_close($ch);

		return $rtn;
	}
	
    public function install()
	{
		$this->checkin('install');
	}
		
    public function uninstall()
	{
		$this->load->model('setting/setting');
		$this->model_setting_setting->deleteSetting('pagcoin');

		$this->checkin('uninstall');
    }
}
?>