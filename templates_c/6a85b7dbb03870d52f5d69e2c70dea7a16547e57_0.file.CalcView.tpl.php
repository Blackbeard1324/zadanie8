<?php
/* Smarty version 3.1.30, created on 2021-03-05 21:49:49
  from "E:\Programy\xampp\htdocs\zadanie8\app\views\CalcView.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6042996dbfe842_51121587',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6a85b7dbb03870d52f5d69e2c70dea7a16547e57' => 
    array (
      0 => 'E:\\Programy\\xampp\\htdocs\\zadanie8\\app\\views\\CalcView.tpl',
      1 => 1614977254,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
    'file:messages.tpl' => 1,
  ),
),false)) {
function content_6042996dbfe842_51121587 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11514043376042996dbfe4c5_00275351', 'content');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'content'} */
class Block_11514043376042996dbfe4c5_00275351 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="pure-menu pure-menu-horizontal bottom-margin">
	<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
logout"  class="pure-menu-heading pure-menu-link">wyloguj</a>
	<span style="float:right;">użytkownik: <?php echo $_smarty_tpl->tpl_vars['user']->value->login;?>
, rola: <?php echo $_smarty_tpl->tpl_vars['user']->value->role;?>
</span>
</div>

<form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
calcCompute" method="post">
	<fieldset>
		<div class="pure-control-group">
			<label for="id_kwota">Kwota pożyczki: </label>
			<input id="id_kwota" type="text" name="kwota" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->kwota;?>
" />
		</div>
	<div class="pure-control-group">
		<label for="id_lata">Na ile lat: </label>
		<input id="id_lata" type="text" name="lata" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->lata;?>
" />
	</div>
	<div class="pure-control-group">
		<label for="id_procent">Oprocentowanie pożyczki: </label>
		<input id="id_procent" type="text" name="procent" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->procent;?>
" />
	</div>
		<div class="pure-controls">
			<input type="submit" value="Oblicz" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>

	<?php $_smarty_tpl->_subTemplateRender("file:messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<?php if (isset($_smarty_tpl->tpl_vars['res']->value->result)) {?>
		<div class="messages info">
			Twoja miesięczna rata to: <?php echo $_smarty_tpl->tpl_vars['res']->value->result;?>

		</div>
	<?php }?>

<?php
}
}
/* {/block 'content'} */
}
