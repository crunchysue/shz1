<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="/js/jquery/jquery-1.3.min.js"></script>
</head>

<body>

				
<br/><br />

	<form id="frmDoShout">
		<input type="submit" id="submitShout" value="Shout From Here" />
	</form>			
				
	<script type="text/javascript">	
		
		$("form#frmDoShout").submit(function(){
			 /* Code */ 
			 $.post(
			 	"shizzow_post.php", 
			 	{places_key:"RO4bWv"}
			 );
		}); 
		
	</script>


</body>
</html>