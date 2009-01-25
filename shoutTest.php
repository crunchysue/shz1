<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Shout Test</title>
<script type="text/javascript" src="/js/jquery/jquery-1.3.min.js"></script>
</head>

<body>

				
<br/><br />
	 
		
<!-- Form 2 -->	
	<form id="frmDoShout">
		<input type="submit" value="Shout From Red and Black" />
		<input type="text" id="shzmsg" value="here i am baby" />
	</form>		
	
	
	<script type="text/javascript">	
				
		var thekey = "RO4bWv";

		$("form#frmDoShout").submit(function(){doPost(thekey, $('#shzmsg').val());return (false);}); 

		function doPost(thekey, themsg){
			$.post(
			 	"shizzow_post.php", 
			 	{places_key:thekey, shouts_message:themsg}
			 );
		}
		
	</script>
	

</body>
</html>