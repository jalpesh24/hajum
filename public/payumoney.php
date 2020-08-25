<?php
	// Merchant key here as provided by Payu
	$MERCHANT_KEY = "gtKFFx";
	
	// Merchant Salt as provided by Payu
	$SALT = "eCwWELxi";
	
	// End point - change to https://secure.payu.in for LIVE mode
	$PAYU_BASE_URL = "https://test.payu.in";
	$action = $PAYU_BASE_URL . '/_payment';
	
	$posted = array();
	if(!empty($_POST))
	{
		foreach($_POST as $key => $value) {
			$posted[$key] = $value;
		}
		
		$formError = 0;
		if(empty($posted['txnid'])) 
		{
			// Generate random transaction id
			$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
			$posted['txnid'] = $txnid;
		}
		else {
			$txnid = $posted['txnid'];
		}
		
		$hash = '';
		$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";	
		
		if(!isset($posted['hash']) || empty($posted['hash']))
		{
			if(empty($posted['key'])
			|| empty($posted['txnid'])
			|| empty($_REQUEST['amount'])
			|| empty($_REQUEST['firstname'])
			|| empty($_REQUEST['email'])
			|| empty($_REQUEST['phone'])
			|| empty($_REQUEST['productinfo'])
			|| empty($posted['surl'])
			|| empty($posted['furl'])
			) {
				$formError = 1;
			}
			else 
			{
				$hashVarsSeq = explode('|', $hashSequence);
				$hash_string = '';
				foreach($hashVarsSeq as $hash_var) 
				{
					$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
					$hash_string .= '|';
				}
				$hash_string .= $SALT;
				$hash = strtolower(hash('sha512', $hash_string));
				$action = $PAYU_BASE_URL . '/_payment';
				
			}
		}
		elseif(isset($posted['hash']) && !empty($posted['hash'])) 
		{
			$hash = $posted['hash'];
			$action = $PAYU_BASE_URL . '/_payment';
		}
	}
	//echo '<pre>'; echo $hash_string; print_r($_REQUEST); exit();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Pay U Money</title>
      <script type="text/javascript">
	var hash = '<?php echo $hash ?>';
	function submitPayuForm() {
      	document.payuForm.submit();
	}
	</script>
</head>
<body onload="submitPayuForm()">
	<form action="<?php echo $action; ?>" method="post" name="payuForm" id="payuForm">
      	<input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
            <input type="hidden" name="tour_id" value="<?php echo $_REQUEST['tour_id'] ?>" />
            <input type="hidden" name="activities_id" value="<?php echo $_REQUEST['activities_id'] ?>" />
            <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
            <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
            <input type="hidden" name="firstname" value="<?php echo $_REQUEST['firstname'] ?>" />
            <input type="hidden" name="lastname" value="<?php echo $_REQUEST['lastname'] ?>" />
            <input type="hidden" name="email" value="<?php echo $_REQUEST['email'] ?>" />
            <input type="hidden" name="phone" value="<?php echo $_REQUEST['phone'] ?>" />
            <input type="hidden" name="amount" value="<?php echo $_REQUEST['amount'];?>" />
            <input type="hidden" name="productinfo" value="<?php echo $_REQUEST['productinfo'];?>" />
           <!--  <input type="hidden" name="address" value="<?php echo $_REQUEST['address'];?>" /> -->
            <input type="hidden" name="city" value="<?php echo $_REQUEST['city'];?>" />
            <!-- <input type="hidden" name="country" value="<?php echo $_REQUEST['country'];?>" />
            <input type="hidden" name="state" value="<?php echo $_REQUEST['state'];?>" />
            -->
            <input type="hidden" name="surl" value="<?php echo $_REQUEST['surl'];?>"/> <!-- Success notification -->
            <input type="hidden" name="furl" value="<?php echo $_REQUEST['furl'];?>"/> <!-- Failure notification -->
            <table>
            <tr>
			<?php if(!$hash) { ?>
			<td colspan="4"><input type="submit" value="Submit" /></td>
			<?php } ?>
		</tr>
		</table>
	</form>
</body>
</html>