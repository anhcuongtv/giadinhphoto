<?php /* Smarty version 2.6.26, created on 2012-07-31 07:00:04
         compiled from _controller/site/sidebar.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sidebar_news', '_controller/site/sidebar.tpl', 29, false),)), $this); ?>
<div id="panelleft">
	<?php if ($this->_tpl_vars['controller'] != 'index'): ?>
	<div id="sidebar-userstatus">
		<?php if ($this->_tpl_vars['me']->id > 0): ?>
			<?php echo $this->_tpl_vars['lang']['controllergroup']['hi']; ?>
, <a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
memberarea.html" title="Memberarea"><?php echo $this->_tpl_vars['me']->username; ?>
</a> | <a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
logout.html" title="<?php echo $this->_tpl_vars['lang']['global']['mLogout']; ?>
" style="color:#999;"><?php echo $this->_tpl_vars['lang']['global']['mLogout']; ?>
</a>
			
			
		<?php else: ?>
			<?php echo $this->_tpl_vars['lang']['controllergroup']['hi']; ?>
, <?php echo $this->_tpl_vars['lang']['controllergroup']['guest']; ?>
<?php if ($this->_tpl_vars['setting']['extra']['enableRegister']): ?> | <a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
register.html" title="<?php echo $this->_tpl_vars['lang']['global']['mRegister']; ?>
" style="color:#999;"><?php echo $this->_tpl_vars['lang']['global']['mRegister']; ?>
</a><?php endif; ?>
			
			
		<?php endif; ?>
	</div>
	<?php endif; ?>
	

	<div class="logo">
		<a href="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/fiapbanner.jpg" title="FIAP" rel="shadowbox"><img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/logofiap.png" alt="fiap" /></a>
		<a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
article-paymentmethod.html" title="Paypal support" class="banner"><img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/paypallogo.png" alt="Secure Payments by Paypal" /></a>
		<a href="#" title="Logo 1" class="banner"><img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/bannerimage1.jpg" alt="logo1" /></a>
		<a href="#" title="Logo 2" class="banner"><img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/bannerimage2.jpg" alt="logo2" /></a>
	</div><!-- end .logo -->
	
	<?php if ($this->_tpl_vars['setting']['extra']['enablePhotogallery'] || ( $this->_tpl_vars['controller'] != 'index' && $this->_tpl_vars['controller'] != 'news' ) || $this->_tpl_vars['me']->canViewPhoto()): ?>
	<div id="sidebar-news">
		<div class="head"><img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/greybox-logo.png" alt="" /> <?php echo $this->_tpl_vars['lang']['controllergroup']['aboutThisContest']; ?>
</div>
		<div class="body">
			
			<div class="detail"><?php echo smarty_function_sidebar_news(array(), $this);?>
</div>
		</div>
	</div>
	<?php endif; ?>
</div><!-- end #panelleft -->
		
		