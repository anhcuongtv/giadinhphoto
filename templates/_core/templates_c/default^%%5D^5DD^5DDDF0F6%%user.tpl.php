<?php /* Smarty version 2.6.26, created on 2014-08-28 20:04:20
         compiled from _mail/site/register/user.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['smartyMailGroupContainer'])."header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if ($this->_tpl_vars['myUser']->fullname != ''): ?><p>Chao ban <?php echo $this->_tpl_vars['myUser']->fullname; ?>
,</p><?php endif; ?>
<p>Ban da dang ky thanh vien thanh cong tai website www.GiaDinhPhotoContest.com vao luc <?php echo $this->_tpl_vars['datecreated']; ?>
</p>
<p>Thong tin tai khoan:</p>
<p>&nbsp;&nbsp;Username: <b><?php echo $this->_tpl_vars['myUser']->username; ?>
 &lt;<?php echo $this->_tpl_vars['myUser']->email; ?>
&gt;</b></p>
<p>&nbsp;&nbsp;Password: <b><?php echo $this->_tpl_vars['formData']['fpassword']; ?>
</b></p>

<?php if ($this->_tpl_vars['activatedCode'] != ''): ?>
	<p>Nhan vao day de kich hoat tai khoan: <a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
activate.html?username/<?php echo $this->_tpl_vars['myUser']->username; ?>
/code/<?php echo $this->_tpl_vars['activatedCode']; ?>
">		<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
activate.html?username=<?php echo $this->_tpl_vars['myUser']->username; ?>
&amp;code=<?php echo $this->_tpl_vars['activatedCode']; ?>
</a></p>
    <p>Neu lien ket o tren khong chay duoc, hay truy cap dia chi <a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
activate.html"><?php echo $this->_tpl_vars['conf']['rooturl']; ?>
activate.html</a> va nhap cac thong tin sau: <br />
    	&nbsp;&nbsp;&nbsp;Username: <b><?php echo $this->_tpl_vars['myUser']->username; ?>
</b><br />
        &nbsp;&nbsp;&nbsp;Activated Code: <b><?php echo $this->_tpl_vars['activatedCode']; ?>
</b></p>
<?php endif; ?>
<p>Cam on da tham gia website. Chuc ban mot ngay tot lanh!</p>

--------------------------------------------------------------------------------------

<?php if ($this->_tpl_vars['myUser']->fullname != ''): ?><p>Hi <?php echo $this->_tpl_vars['myUser']->fullname; ?>
,</p><?php endif; ?>
<p>You have already registered members at the site www.GiaDinhPhotoContest.com at time <?php echo $this->_tpl_vars['datecreated']; ?>
</p>
<p>Account information:</p>
<p>&nbsp;&nbsp;Username: <b><?php echo $this->_tpl_vars['myUser']->username; ?>
 &lt;<?php echo $this->_tpl_vars['myUser']->email; ?>
&gt;</b></p>
<p>&nbsp;&nbsp;Password: <b><?php echo $this->_tpl_vars['formData']['fpassword']; ?>
</b></p>

<?php if ($this->_tpl_vars['activatedCode'] != ''): ?>
	<p>Nhan vao day de kich hoat tai khoan: <a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
activate.html?username/<?php echo $this->_tpl_vars['myUser']->username; ?>
/code/<?php echo $this->_tpl_vars['activatedCode']; ?>
">		<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
activate.html?username=<?php echo $this->_tpl_vars['myUser']->username; ?>
&amp;code=<?php echo $this->_tpl_vars['activatedCode']; ?>
</a></p>
    <p>Neu lien ket o tren khong chay duoc, hay truy cap dia chi <a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
activate.html"><?php echo $this->_tpl_vars['conf']['rooturl']; ?>
activate.html</a> va nhap cac thong tin sau: <br />
    	&nbsp;&nbsp;&nbsp;Username: <b><?php echo $this->_tpl_vars['myUser']->username; ?>
</b><br />
        &nbsp;&nbsp;&nbsp;Activated Code: <b><?php echo $this->_tpl_vars['activatedCode']; ?>
</b></p>
<?php endif; ?>
<p>Thanks for participating website. Have a nice day!</p>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['smartyMailGroupContainer'])."footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>