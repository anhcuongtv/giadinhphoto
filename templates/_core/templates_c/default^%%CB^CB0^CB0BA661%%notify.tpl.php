<?php /* Smarty version 2.6.26, created on 2012-11-15 13:05:30
         compiled from notify.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'is_array', 'notify.tpl', 6, false),)), $this); ?>
<?php if (count ( $this->_tpl_vars['notifySuccess'] ) > 0): ?>
<div class="notify-bar notify-bar-success">
	<div class="notify-bar-icon"><img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/notify/success.png" align="success" /></div>
	<div class="notify-bar-button"><a href="javascript:void(0);" onclick="javascript:$(this).parent().parent().fadeOut();" title="close"><img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/notify/close-btn.png" border="0" alt="close" /></a></div>
	<div class="notify-bar-text">
		<?php if (is_array($this->_tpl_vars['notifySuccess'])): ?>
			<?php $_from = $this->_tpl_vars['notifySuccess']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['notifysuccess'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['notifysuccess']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['notifySuccessItem']):
        $this->_foreach['notifysuccess']['iteration']++;
?>
				<p><?php echo $this->_tpl_vars['notifySuccessItem']; ?>
</p>
				<?php if (! ($this->_foreach['notifysuccess']['iteration'] == $this->_foreach['notifysuccess']['total'])): ?><div class="notify-bar-text-sep"></div><?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
			<p><?php echo $this->_tpl_vars['notifySuccess']; ?>
</p>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>

<?php if (count ( $this->_tpl_vars['notifyError'] ) > 0): ?>
<div class="notify-bar notify-bar-error">
	<div class="notify-bar-icon"><img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/notify/error.png" align="error" /></div>
	<div class="notify-bar-button"><a href="javascript:void(0);" onclick="javascript:$(this).parent().parent().fadeOut();" title="close"><img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/notify/close-btn.png" border="0" alt="close" /></a></div>
	<div class="notify-bar-text">
		<?php if (is_array($this->_tpl_vars['notifyError'])): ?>
			<?php $_from = $this->_tpl_vars['notifyError']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['notifyerror'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['notifyerror']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['notifyErrorItem']):
        $this->_foreach['notifyerror']['iteration']++;
?>
				<p><?php echo $this->_tpl_vars['notifyErrorItem']; ?>
</p>
				<?php if (! ($this->_foreach['notifyerror']['iteration'] == $this->_foreach['notifyerror']['total'])): ?><div class="notify-bar-text-sep"></div><?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
			<p><?php echo $this->_tpl_vars['notifyError']; ?>
</p>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>

<?php if (count ( $this->_tpl_vars['notifyWarning'] ) > 0): ?>
<div class="notify-bar notify-bar-warning">
	<div class="notify-bar-icon"><img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/notify/warning.png" alt="warning" /></div>
	<div class="notify-bar-button"><a href="javascript:void(0);" onclick="javascript:$(this).parent().parent().fadeOut();" title="close"><img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/notify/close-btn.png" border="0" alt="close" /></a></div>
	<div class="notify-bar-text">
		<?php if (is_array($this->_tpl_vars['notifyWarning'])): ?>
			<?php $_from = $this->_tpl_vars['notifyWarning']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['notifywarning'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['notifywarning']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['notifyWarningItem']):
        $this->_foreach['notifywarning']['iteration']++;
?>
				<p><?php echo $this->_tpl_vars['notifyWarningItem']; ?>
</p>
				<?php if (! ($this->_foreach['notifywarning']['iteration'] == $this->_foreach['notifywarning']['total'])): ?><div class="notify-bar-text-sep"></div><?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
			<p><?php echo $this->_tpl_vars['notifyWarning']; ?>
</p>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>

<?php if (count ( $this->_tpl_vars['notifyInformation'] ) > 0): ?>
<div class="notify-bar notify-bar-info">
	<div class="notify-bar-icon"><img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/notify/info.png" alt="info" /></div>
	<div class="notify-bar-button"><a href="javascript:void(0);" onclick="javascript:$(this).parent().parent().fadeOut();" title="close"><img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/notify/close-btn.png" border="0" alt="close" /></a></div>
	<div class="notify-bar-text">
		<?php if (is_array($this->_tpl_vars['notifyInformation'])): ?>
			<?php $_from = $this->_tpl_vars['notifyInformation']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['notifyinformation'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['notifyinformation']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['notifyInformationItem']):
        $this->_foreach['notifyinformation']['iteration']++;
?>
				<p><?php echo $this->_tpl_vars['notifyInformationItem']; ?>
</p>
				<?php if (! ($this->_foreach['notifyinformation']['iteration'] == $this->_foreach['notifyinformation']['total'])): ?><div class="notify-bar-text-sep"></div><?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
			<p><?php echo $this->_tpl_vars['notifyInformation']; ?>
</p>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>