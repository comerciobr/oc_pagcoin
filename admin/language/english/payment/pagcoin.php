<?php
// Heading
$_['heading_title']					= '<a href="http://comerciobr.com" target="_blank"><img src="view/image/comerciobr_pagcoin.png" alt="Comércio BR - PagCoin" title="Comércio BR - PagCoin" /></a>';
$_['heading_title_text']			= 'Comércio BR - PagCoin';


// Text
$_['text_pagcoin'] 		 			= '<a href="http://comerciobr.com" target="_blank"><img src="view/image/payment/pagcoin.png" alt="Comércio BR - PagCoin" title="Comércio BR - PagCoin" style="border: 1px solid #EEEEEE;" /></a>';
$_['text_payment']        			= 'Payment';
$_['text_success']        			= 'Module successfully upgraded PagCoin!';
$_['text_url_callback']    			= 'Return URL to register at PagCoin<span class="help">Save this URL for <a href="https://pagcoin.com/Painel/Api" target="_blank">https://pagcoin.com/Painel/Api</a></span>, it is through her that the PagCoin communicate with the module in order to allow integration.';

// Entry
$_['entry_apikey']         			= 'ApiKey:<span class="help">His apiKey in PagCoin</span>';
$_['entry_total']         			= 'Enable module from:<span class="help">Total minimum the application should reach to the module is enabled</span>';
$_['entry_discount']         		= 'Discount:<span class="help">Discount will be given when choosing PagCoin as payment, put direct value or % sign next to the value for percentage</span>';
$_['entry_sigla']   	      		= 'Abbreviation to be concatenated to the order number:<span class="help">Useful for identifying the PagCoin of which store the application belongs. Ex. Ordering No. 01 and acronym "lojaA", the reference will be requested in PagCoin "01_lojaA" </span>';

$_['entry_order_wait_payment'] 		= 'Status Awaiting Payment:<span class="help">the buyer initiated the transaction, but so far the PagCoin not received any payment information. The request should NOT be released yet.</span>';
$_['entry_order_confirmed'] 		= 'Payment Status Confirmed:<span class="help">The buyer has already made ​​the payment along to PagCoin and the application can now be released</span>';
$_['entry_order_recused'] 			= 'Payment status Declined:<span class="help">PagCoin refused the transaction the buyer for some unknown procedure and the request SHOULD NOT be released.</span>';
$_['entry_order_timeout'] 			= 'Payment Status Expired:<span class="help">the transaction expired because the buyer did not pay on time and the request should NOT be released.</span>';

$_['entry_use_lightbox']   			= 'Use lightbox:<span class="help">use lightbox for payments</span>';
$_['entry_geo_zone']      			= 'geographic region:';
$_['entry_status']        			= 'Situation:';
$_['entry_sort_order']    			= 'Ordination:';
$_['entry_update_status_alert'] 	= 'Warn of change in the status of the transaction:<span class="help">Send e-mail to the customer notifying you about changes in the status of the request.</span>';
$_['checking_update_text']			= 'Checking for new updates';

// Error
$_['error_permission']    			= 'Warning: You do not have permission to modify the PagCoin!';
$_['error_apikey']         			= 'Enter your <b>ApiKey</b> security with 32 characters';
?>