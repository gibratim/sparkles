<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>date picker</title>
<link href="styles/glDatePicker.default.css" rel="stylesheet" type="text/css">
<link href="styles/glDatePicker.darkneon.css" rel="stylesheet" type="text/css">
<link href="styles/glDatePicker.flatwhite.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery-1.9.1.min.js" ></script>
<script src="glDatePicker.min.js"></script>
<script type="text/javascript">
        $(window).load(function()
        { $('input').glDatePicker({	
		 showAlways: true , cssName: 'darkneon',dateFormat: 'yy-mm-dd'
		
		});    });
</script>
</head>

<body>
<input type="text" id="mydate" gldp-id="datepick" value="This is how we do it" size="100px" />
    <div gldp-el="datepickx" style="width:350px; height:200px; position:absolute; top:70px; left:100px;">
    </div>
</body>
</html>
