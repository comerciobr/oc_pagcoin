<?php
// Heading
$_['heading_title']					= '<a href="http://comerciobr.com" target="_blank"><img src="view/image/comerciobr_pagcoin.png" alt="Comércio BR - PagCoin" title="Comércio BR - PagCoin" /><span style="display: none">PagCoin</span></a>';
$_['heading_title_text']			= 'Comércio BR - PagCoin';


// Text
$_['text_pagcoin'] 		 			= '<a href="http://comerciobr.com" target="_blank"><img src="view/image/payment/pagcoin.png" alt="Comércio BR - PagCoin" title="Comércio BR - PagCoin" style="border: 1px solid #EEEEEE;" /></a>';
$_['text_payment']        			= 'Pagamento';
$_['text_success']        			= 'Módulo PagCoin atualizado com sucesso!';
$_['text_url_callback']    			= 'URL de retorno para cadastrar no PagCoin<span class="help">Salve essa URL em <a href="https://pagcoin.com/Painel/Api" target="_blank">https://pagcoin.com/Painel/Api</a></span>, pois é através dela que o PagCoin se comunicará com o módulo afim de permitir a integração.';

// Entry
$_['entry_apikey']         			= 'ApiKey:<span class="help">Sua ApiKey no PagCoin</span>';
$_['entry_total']         			= 'Habilitar módulo a partir de:<span class="help">Total mínimo que o pedido deve atingir para que o módulo seja habilitado</span>';
$_['entry_discount']         		= 'Desconto:<span class="help">Desconto que será concedido ao escolher PagCoin como forma de pagamento, coloque valor direto ou sinal de % ao lado do valor para percentual</span>';
$_['entry_sigla']   	      		= 'Sigla para ser concatenada ao número do pedido:<span class="help">Útil para identificar no PagCoin de qual loja pertence o pedido. Ex. para pedido de N° 01 e sigla "lojaA", a referência do pedido no PagCoin será "01_lojaA" </span>';

$_['entry_order_wait_payment'] 		= 'Status Aguardando Pagamento:<span class="help">o comprador iniciou a transação. Mas, até o momento o PagCoin não recebeu nenhuma informação sobre o pagamento. O pedido NÂO deve ser liberado ainda.</span>';
$_['entry_order_confirmed'] 		= 'Status Pagamento Confirmado:<span class="help">O comprador já efetuou o pagamento junto ao PagCoin e o pedido já pode ser liberado</span>';
$_['entry_order_recused'] 			= 'Status Pagamento Recusado:<span class="help">o PagCoin recusou a transação do comprador por algum procedimento desconhecido e o pedido NÂO deve ser liberado.</span>';
$_['entry_order_timeout'] 			= 'Status Pagamento Expirado:<span class="help">a transação expirou porque o comprador não efetuou o pagamento dentro do prazo e o pedido NÂO deve ser liberado.</span>';

$_['entry_use_lightbox']   			= 'Usar lightbox:<span class="help">utilizar lightbox para efetuar pagamentos</span>';
$_['entry_geo_zone']      			= 'Região geográfica:';
$_['entry_status']        			= 'Situação:';
$_['entry_sort_order']    			= 'Ordenação:';
$_['entry_update_status_alert'] 	= 'Alertar sobre mudança no status da transação:<span class="help">Envia e-mail para o cliente avisando-o sobre mudança no status do pedido.</span>';
$_['checking_update_text']			= 'Verificando se existem novas atualizações';

// Error
$_['error_permission']    			= 'Atenção: Você não possui permissão para modificar o PagCoin!';
$_['error_apikey']         			= 'Digite sua <b>ApiKey</b> de segurança com 32 caracteres';
?>