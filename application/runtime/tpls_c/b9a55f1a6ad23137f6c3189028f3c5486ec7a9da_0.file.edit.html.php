<?php
/* Smarty version 3.1.29, created on 2018-03-01 23:09:02
  from "D:\WAMP\Apache24\htdocs\Questions-Answers\application\admin\view\category\edit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a98178ed379e8_38193419',
  'file_dependency' => 
  array (
    'b9a55f1a6ad23137f6c3189028f3c5486ec7a9da' => 
    array (
      0 => 'D:\\WAMP\\Apache24\\htdocs\\Questions-Answers\\application\\admin\\view\\category\\edit.html',
      1 => 1519916939,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a98178ed379e8_38193419 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="webkit" name="renderer">
    <meta content="IE=edge,Chrome=1" http-equiv="X-UA-Compatible">
    <meta content="width=device-width,initial-scale=1,maximum-scale=1" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="blank" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <title>分类管理-有问必答</title>
    <link href="<?php echo PUBLIC_PATH;?>
home/css/bootstrap.css?v=20151125" rel="stylesheet" type="text/css">
    <link href="<?php echo PUBLIC_PATH;?>
home/css/icon.css?v=20151125" rel="stylesheet" type="text/css">
    <link href="<?php echo PUBLIC_PATH;?>
admin/css/common.css?v=20151125" rel="stylesheet" type="text/css">
    <?php echo '<script'; ?>
 src="<?php echo PUBLIC_PATH;?>
home/js/jquery.2.js?v=20151125" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo PUBLIC_PATH;?>
home/jquery.form.js?v=20151125" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo PUBLIC_PATH;?>
admin/js/framework.js?v=20151125" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo PUBLIC_PATH;?>
admin/js/global.js?v=20151125" type="text/javascript"><?php echo '</script'; ?>
>
    <!--[if lte IE 8]>
    <?php echo '<script'; ?>
 type="text/javascript" src="../static/js/respond.js"><?php echo '</script'; ?>
>
    <![endif]-->
</head>

<body>
    <div class="aw-header">
        <button class="btn btn-sm mod-head-btn pull-left">
         <i class="icon icon-bar"></i>
        </button>

        <div class="mod-header-user">
            <ul class="pull-right">

                <li class="dropdown username">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="">
                        <img width="30" class="img-circle" src="<?php echo PUBLIC_PATH;?>
common/avatar-mid-img.png">
                        itbull
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu pull-right mod-user">
                        <li>
                            <a target="_blank" href="">
                                <i class="icon icon-user"></i>
                                账户
                            </a>
                        </li>

                        <li>
                            <a href="login.html">
                                <i class="icon icon-logout"></i>
                                退出
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div id="aw-side" class="aw-side ps-container">
        <div class="mod">
            <div class="mod-logo">
                <img alt="" src="<?php echo PUBLIC_PATH;?>
admin/img/logo.png" class="pull-left">
                <h1>有问必答</h1>
            </div>

            <div class="mod-message">
                <div class="message">
                    <a title="首页" target="_blank" href="../index.html" class="btn btn-sm">
                        <i class="icon icon-home"></i>
                    </a>

                    <a title="退出" href="login.html" class="btn btn-sm">
                        <i class="icon icon-logout"></i>
                    </a>
                </div>
            </div>

            <ul class="mod-bar">
                <input type="hidden" val="0" id="hide_values">
                <li>
                    <a class=" icon icon-ul" href="index.html">
                        <span>摘要信息</span>
                    </a>
                </li>

                <li>
                    <a data="icon" class=" icon icon-reply active" href="javascript:;">
                        <span>内容管理</span>
                    </a>

                    <ul class="hide" style="display: block;">
                        <li>
                            <a class="active" href="category.html">
                                <span>分类管理</span>
                            </a>
                        </li>
                        <li>
                            <a href="question.html">
                                <span>问题管理</span>
                            </a>
                        </li>
                        <li>
                            <a href="topic.html">
                                <span>话题管理</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a data="icon" class=" icon icon-user" href="javascript:;">
                        <span>用户管理</span>
                    </a>

                    <ul class="hide">
                        <li>
                            <a href="user.html">
                                <span>用户列表</span>
                            </a>
                        </li>
                        <li>
                            <a href="role.html">
                                <span>用户角色</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a data="icon" class="icon icon-setting" href="javascript:;">
                        <span>全局设置</span>
                    </a>

                    <ul class="hide">
                        <li>
                            <a href="site.html">
                                <span>站点信息</span>
                            </a>
                        </li>
                        <li>
                            <a href="regedit.html">
                                <span>注册访问</span>
                            </a>
                        </li>
                        <li>
                            <a href="mail.html">
                                <span>邮件设置</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a data="icon" class=" icon icon-job" href="javascript:;">
                        <span>工具</span>
                    </a>

                    <ul class="hide">
                        <li>
                            <a href="tool.html">
                                <span>系统维护</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="ps-scrollbar-x-rail" style="width: 235px; display: none; left: 0px; bottom: 3px;">
            <div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps-scrollbar-y-rail" style="top: 0px; height: 607px; display: inherit; right: 0px;">
            <div class="ps-scrollbar-y" style="top: 0px; height: 560px;"></div>
        </div>
    </div>

    <div class="aw-content-wrap">
        <form method="post" id="category_form" action="?m=admin&c=category&a=update">
        <div class="mod">
            <div class="mod-head">
                <h3>
                    <span class="pull-left">分类编辑</span>
                </h3>
            </div>
            <div class="tab-content mod-content">
                <table class="table table-striped">
                    <tbody><tr>
                        <td>
                            <div class="form-group">
                                <span class="col-sm-4 col-xs-3 control-label">分类标题:</span>
                                <div class="col-sm-5 col-xs-8">
                                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['catInfo']->value['catId'];?>
" name="catId">
                                    <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['catInfo']->value['catName'];?>
" name="catName" class="form-control">
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-group">
                                <span class="col-sm-4 col-xs-3 control-label">父级分类:</span>
                                <div class="col-sm-5 col-xs-8">
                                    <select class="form-control" name="parentId">
                                        <option value="0">无</option>
                                        <?php
$_from = $_smarty_tpl->tpl_vars['category']->value;
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
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['catId'];?>
" 
                                                <?php if ($_smarty_tpl->tpl_vars['catInfo']->value['parentId'] == $_smarty_tpl->tpl_vars['v']->value['catId']) {?> selected<?php }?>>
                                                <?php echo $_smarty_tpl->tpl_vars['v']->value['catName'];?>
 
                                            </option>
                                        <?php
$_smarty_tpl->tpl_vars['v'] = $__foreach_v_0_saved_local_item;
}
if ($__foreach_v_0_saved_item) {
$_smarty_tpl->tpl_vars['v'] = $__foreach_v_0_saved_item;
}
?>
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody><tfoot>
                    <tr>
                        <td>
                            <input type="submit"  value="保存设置">
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            </div>
        </form>
    </div>


    <div class="aw-footer">
        <p>
            Copyright &copy; 2016-2099 - Powered By
            <a target="blank" href="http://www.questions-answers.com/">有问必答 1.0</a>
        </p>
    </div>

</body>
</html><?php }
}
