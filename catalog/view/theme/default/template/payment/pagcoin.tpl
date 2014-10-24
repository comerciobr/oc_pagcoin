<center>
<a href="javascript:;" class="button-confirm"><img src="https://pagcoin.com/Content/img/Resources/bt%20pagcompagcoin.png" width="250" /></a>
</center>
<br>
<?php if ($text_information) { ?>
<div class="information"><?php echo $text_information; ?></div>
<?php } ?>
<div class="buttons">
  <div class="right"><a id="button-confirm" class="button button-confirm"><span><?php echo $button_confirm; ?></span></a></div>   
</div>
<script type="text/javascript"><!--
$('.button-confirm').bind('click', function() {
	$.ajax({
		type: 'GET',
		url: '<?php echo $link_confirm; ?>',
		beforeSend: function() {
			$('#button-confirm').attr('disabled', true);
			
			$('#payment').before('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		success: function()
		{
			<?php if($pagcoin_use_lightbox){ ?>
				jQuery.colorbox({href: "<?php echo $url; ?>", iframe: true, overlayClose: false, escKey: false, fixed: true, width: "80%", height: "100%", title: '<?php echo $txt_payment_processed; ?>'});
			<?php }else{ ?>
				$.get( "<?php echo $link_success; ?>");
				setTimeout(function()
				{
					location = "<?php echo $url; ?>";
				}, 1000);
			<?php } ?>
		}
	});
});

<?php if($pagcoin_use_lightbox){ ?>
	$(document).bind("cbox_cleanup", function()
	{
		location = '<?php echo $link_success; ?>';
	});
<?php } ?>
//--></script>