<?php
/* Smarty version 3.1.29, created on 2017-12-17 18:00:28
  from "D:\WAMP\Apache24\htdocs\MVCFrame\application\admin\view\goodsList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a36403cefc559_21582366',
  'file_dependency' => 
  array (
    '92ebf732df2de0e2e019cf2d542c2c547ae630b1' => 
    array (
      0 => 'D:\\WAMP\\Apache24\\htdocs\\MVCFrame\\application\\admin\\view\\goodsList.html',
      1 => 1513504149,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a36403cefc559_21582366 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>商品列表</title>
<meta name="description" content="">
<meta name="商品" content="">
<link href="" rel="stylesheet">
</head>
<body>
	<table>
			<?php
$_from = $_smarty_tpl->tpl_vars['goods']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_v_0_saved_item = isset($_smarty_tpl->tpl_vars['v']) ? $_smarty_tpl->tpl_vars['v'] : false;
$_smarty_tpl->tpl_vars['v'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['v']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
$__foreach_v_0_saved_local_item = $_smarty_tpl->tpl_vars['v'];
?>
		<tr>
				<td>
				<?php echo $_smarty_tpl->tpl_vars['v']->value['goods_name'];?>

				</td>
		</tr>
    		<?php
$_smarty_tpl->tpl_vars['v'] = $__foreach_v_0_saved_local_item;
}
if ($__foreach_v_0_saved_item) {
$_smarty_tpl->tpl_vars['v'] = $__foreach_v_0_saved_item;
}
?>
	</table>
    
</body>
</html><?php }
}
