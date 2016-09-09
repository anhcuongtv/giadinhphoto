<?php /* Smarty version 2.6.26, created on 2016-09-09 13:25:19
         compiled from _controller/site/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', '_controller/site/header.tpl', 7, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php if ($this->_tpl_vars['pageTitle'] != ''): ?><?php echo $this->_tpl_vars['pageTitle']; ?>
<?php else: ?><?php echo $this->_tpl_vars['setting']['site']['defaultPageTitle']; ?>
<?php endif; ?></title>
<meta name="author" content="iMS Vietnam, support@imsvietnam.com" />
<meta name="keywords" content="<?php echo ((is_array($_tmp=@$this->_tpl_vars['pageKeyword'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['setting']['site']['defaultPageKeyword']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['setting']['site']['defaultPageKeyword'])); ?>
" />
<meta name="description" content="<?php echo ((is_array($_tmp=@$this->_tpl_vars['pageDescription'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['setting']['site']['defaultPageDescription']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['setting']['site']['defaultPageDescription'])); ?>
" />
<meta name="robots" content="index,follow" />
<link href="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/css/style.css" rel="stylesheet" type="text/css" media="screen,print" />
<link rel="shortcut icon" href="favicon.ico" />
<link href="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/css/shadowbox.css" rel="stylesheet" type="text/css" media="screen,print" />
<script type="text/javascript">
	var rooturl = "<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
";
	var currentTemplate = "<?php echo $this->_tpl_vars['currentTemplate']; ?>
";
	var delConfirm = "<?php echo $this->_tpl_vars['lang']['controllergroup']['jsDelConfirm']; ?>
";
</script>
</head>
<body>

	<div id="wrapper" class="<?php if ($this->_tpl_vars['controller'] != 'memberarea'): ?>wrapperborder<?php endif; ?>">
	<?php if ($this->_tpl_vars['controller'] == 'index'): ?>
		<div id="home">
            <div id="positionlogo">
                <div id="homelogo">
                    <img src="<?php echo $this->_tpl_vars['setting']['extra']['staticserver']['vn']; ?>
default/images/gdpc-contest-2012.png" />
                </div>
                
                            </div>
            <div id="header">
            <div class="topbar">
                <div class="left">
                    <div>
                        <ul>
                <li><a <?php if ($this->_tpl_vars['controller'] == 'index'): ?>class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['mHome']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['mHome']; ?>
</a></li>
                <li><a <?php if ($this->_tpl_vars['controller'] == 'page' && $this->_tpl_vars['pagename'] == 'rules'): ?>class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
article-rules.html" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['mRule']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['mRule']; ?>
</a></li>
                <li><a <?php if ($this->_tpl_vars['controller'] == 'page' && $this->_tpl_vars['pagename'] == 'awards'): ?>class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
article-awards.html" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['mAward']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['mAward']; ?>
</a></li>
                <li><a <?php if ($this->_tpl_vars['controller'] == 'page' && $this->_tpl_vars['pagename'] == 'judge'): ?>class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
article-judge.html" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['mJudge']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['mJudge']; ?>
</a></li>
                <li><a <?php if ($this->_tpl_vars['controller'] == 'statuslist'): ?>class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/statuslist/index" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['mStatuslist']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['mStatuslist']; ?>
</a></li>
                <li><a <?php if ($this->_tpl_vars['controller'] == 'page' && $this->_tpl_vars['pagename'] == 'instruction'): ?>class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
article-instruction.html" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['mInstruction']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['mInstruction']; ?>
</a></li>
                <li><a <?php if ($this->_tpl_vars['controller'] == 'memberarea' || $this->_tpl_vars['controller'] == 'login' || $this->_tpl_vars['controller'] == 'register'): ?>class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
memberarea.html" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['mMemberarea']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['mMemberarea']; ?>
</a></li>
                                                <li><a <?php if ($this->_tpl_vars['controller'] == 'page' && $this->_tpl_vars['pagename'] == 'photo'): ?>class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/photo/index" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['mPhotos']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['mPhotos']; ?>
</a></li>

            </ul>
                    </div>
                </div>
                <div class="right">
                    <a href="?language=vn"><img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/img_vietnam.gif" alt="VN" /></a>
                    <a href="?language=en"><img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/img_english.gif" alt="EN" /></a>
                </div>
            </div>
        </div>
		</div><!-- end #home -->
	<?php else: ?>
        <div id="positionlogo">
                <div id="homelogo">
                    <img src="<?php echo $this->_tpl_vars['setting']['extra']['staticserver']['vn']; ?>
default/images/gdpc-contest-2012.png" />
                </div>
                            </div>
		<div id="header">
			<div class="topbar">
				<div class="left">
                    <div>
                        <ul>
                <li><a <?php if ($this->_tpl_vars['controller'] == 'page' && $this->_tpl_vars['pagename'] == 'home'): ?>class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['mHome']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['mHome']; ?>
</a></li>
                <li><a <?php if ($this->_tpl_vars['controller'] == 'page' && $this->_tpl_vars['pagename'] == 'rules'): ?>class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
article-rules.html" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['mRule']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['mRule']; ?>
</a></li>
                <li><a <?php if ($this->_tpl_vars['controller'] == 'page' && $this->_tpl_vars['pagename'] == 'awards'): ?>class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
article-awards.html" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['mAward']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['mAward']; ?>
</a></li>
                <li><a <?php if ($this->_tpl_vars['controller'] == 'page' && $this->_tpl_vars['pagename'] == 'judge'): ?>class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
article-judge.html" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['mJudge']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['mJudge']; ?>
</a></li>

                <li><a <?php if ($this->_tpl_vars['controller'] == 'statuslist'): ?>class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/statuslist/index" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['mStatuslist']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['mStatuslist']; ?>
</a></li>
                <li><a <?php if ($this->_tpl_vars['controller'] == 'page' && $this->_tpl_vars['pagename'] == 'instruction'): ?>class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
article-instruction.html" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['mInstruction']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['mInstruction']; ?>
</a></li>
                <li><a <?php if ($this->_tpl_vars['controller'] == 'memberarea' || $this->_tpl_vars['controller'] == 'login' || $this->_tpl_vars['controller'] == 'register'): ?>class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
memberarea.html" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['mMemberarea']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['mMemberarea']; ?>
</a></li>
                                                <li><a <?php if ($this->_tpl_vars['controller'] == 'page' && $this->_tpl_vars['pagename'] == 'photo'): ?>class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/photo/index" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['mPhotos']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['mPhotos']; ?>
</a></li>

            </ul>
                    </div>
                </div>
				<div class="right">
					<a href="?language=vn"><img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/img_vietnam.gif" alt="VN" /></a>
					<a href="?language=en"><img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/img_english.gif" alt="EN" /></a>
				</div>
			</div>
			
					</div><!-- end #header -->
	<?php endif; ?>




