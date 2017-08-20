<html>
<head>
	<title></title>
</head>
<body>
<form action="/your-server-side-code" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_Xq50ANCpXwAVDOgmHJTeMnM7"
    data-amount="999"
    data-name="Demo Site"
    data-description="Widget"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto">
  </script>
</form>
</body>
</html>
<?php 
echo "welcome";
echo htmlentities($type);
?>