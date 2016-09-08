<?php /* Smarty version 2.6.26, created on 2012-07-31 07:00:17
         compiled from redirect.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="5;url=<?php echo $this->_tpl_vars['redirect']; ?>
"/>
<title>Page Redirecting</title>
</head>

<body bgcolor="#57585c" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;">
<div style="line-height:2;text-align:center; margin:auto;width: 500px; height:270px; background: url(<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/redirect/redirect_bg.png) no-repeat;margin-top:150px;">
	<div style="padding:160px 30px 0 30px;">
	<?php echo $this->_tpl_vars['redirectMsg']; ?>
<br />
	<a href="<?php echo $this->_tpl_vars['redirect']; ?>
"><?php echo $this->_tpl_vars['lang']['global']['redirectClickHere']; ?>
</a> <?php echo $this->_tpl_vars['lang']['global']['redirectDontWantWait']; ?>

	</div>
</div>
</body>
</html>