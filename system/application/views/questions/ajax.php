<?php header ("Content-Type:text/xml"); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>
<message>
	<title><?php echo $result['title']; ?></title>
	<content><?php echo $result['message']; ?></content>
	<type><?php echo $result['type']; ?></type>
</message>