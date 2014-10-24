<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title_text; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
		<br />
		<div id="checkupdate" class="attention"></div>

	  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
	    <table class="form">
	      <tr>
	        <td><span class="required">*</span> <?php echo $entry_apikey; ?></td>
	        <td><input type="text" name="pagcoin_apikey" value="<?php echo $pagcoin_apikey; ?>" size="50%" maxlength="32" />
	          <?php if ($error_apikey) { ?>
	          <span class="error"><?php echo $error_apikey; ?></span>
	          <?php } ?></td>
	      </tr>
          <tr>
            <td><?php echo $text_url_callback; ?></td>
            <td><?php echo $pagcoin_url_callback; ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_total; ?></td>
            <td><input type="text" name="pagcoin_total" value="<?php echo $pagcoin_total; ?>" id="pagcoin_total" size="8" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_discount; ?></td>
            <td><input type="text" name="pagcoin_discount" value="<?php echo $pagcoin_discount; ?>" size="5" /></td>
          </tr>
	      <tr>
	        <td><?php echo $entry_sigla; ?></td>
	        <td><input type="text" name="pagcoin_sigla" value="<?php echo $pagcoin_sigla; ?>" /></td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_order_wait_payment; ?></td>
	        <td><select name="pagcoin_order_wait_payment" id="pagcoin_order_wait_payment">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagcoin_order_wait_payment) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	        </td>
	      </tr>
	        <td><?php echo $entry_order_confirmed; ?></td>
	        <td><select name="pagcoin_order_confirmed" id="pagcoin_order_confirmed">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagcoin_order_confirmed) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_order_recused; ?></td>
	        <td><select name="pagcoin_order_recused" id="pagcoin_order_recused">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagcoin_order_recused) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_order_timeout; ?></td>
	        <td><select name="pagcoin_order_timeout" id="pagcoin_order_timeout">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagcoin_order_timeout) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_update_status_alert; ?></td>
	        <td>
			  <select name="pagcoin_update_status_alert">
	            <?php if ($pagcoin_update_status_alert) { ?>
	            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
	            <option value="0"><?php echo $text_no; ?></option>
	            <?php } else { ?>
	            <option value="1"><?php echo $text_yes; ?></option>
	            <option value="0" selected="selected"><?php echo $text_no; ?></option>
	            <?php } ?>
	          </select>
			</td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_use_lightbox; ?></td>
	        <td>
			  <select name="pagcoin_use_lightbox">
	            <?php if ($pagcoin_use_lightbox) { ?>
	            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
	            <option value="0"><?php echo $text_no; ?></option>
	            <?php } else { ?>
	            <option value="1"><?php echo $text_yes; ?></option>
	            <option value="0" selected="selected"><?php echo $text_no; ?></option>
	            <?php } ?>
	          </select>
			</td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_geo_zone; ?></td>
	        <td>
			  <select name="pagcoin_geo_zone_id">
	            <option value="0"><?php echo $text_all_zones; ?></option>
	            <?php foreach ($geo_zones as $geo_zone) { ?>
	            <?php if ($geo_zone['geo_zone_id'] == $pagcoin_geo_zone_id) { ?>
	            <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
	            <?php } else { ?>
	            <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
	           <?php } ?>
	            <?php } ?>
	          </select>
			</td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_status; ?></td>
	        <td>
			  <select name="pagcoin_status">
	            <?php if ($pagcoin_status) { ?>
	            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
	            <option value="0"><?php echo $text_disabled; ?></option>
	            <?php } else { ?>
	            <option value="1"><?php echo $text_enabled; ?></option>
	            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
	            <?php } ?>
	          </select>
			</td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_sort_order; ?></td>
	        <td><input type="text" name="pagcoin_sort_order" value="<?php echo $pagcoin_sort_order; ?>" size="1" /></td>
	      </tr>
	    </table>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript"><!--
checking_update_text = "<?php echo $checking_update_text; ?>";
$(function()
{
	$.ajax(
	{
		url: '<?php echo $urlcheckupdate; ?>',
		dataType: 'json',
		beforeSend: function()
		{
			$("#checkupdate").text(checking_update_text);
		},
		success: function(data)
		{
			if(data.update)
			{
				$("#checkupdate").html(data.html);
			}
			else
			{
				$("#checkupdate").html(data.html);
				setTimeout(function()
				{
					$("#checkupdate").hide();
				}, 5000);
			}
		},
		error: function(xhr, ajaxOptions, thrownError)
		{
			setTimeout(function()
			{
				$("#checkupdate").hide();
			}, 5000);
		}
	});
	
	$("#pagcoin_total").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
});

//--></script>
<?php echo $footer; ?> 