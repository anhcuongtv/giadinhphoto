<?php /* Smarty version 2.6.26, created on 2012-11-15 13:07:21
         compiled from _controller/admin/maincontent.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'sslashes', '_controller/admin/maincontent.tpl', 2, false),array('modifier', 'default', '_controller/admin/maincontent.tpl', 2, false),)), $this); ?>

<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['contents'])) ? $this->_run_mod_handler('sslashes', true, $_tmp) : smarty_modifier_sslashes($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 'No contents') : smarty_modifier_default($_tmp, 'No contents')); ?>
