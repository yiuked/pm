<?php
/* Smarty version 3.1.32, created on 2018-08-21 11:00:57
  from 'D:\php\pmp\dist\demos\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b7b8069918e52_91787957',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dba7cb7823b79fd9584082a49907d851b0c9153f' => 
    array (
      0 => 'D:\\php\\pmp\\dist\\demos\\index.html',
      1 => 1534815469,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:commons/header.html' => 1,
    'file:commons/footer.html' => 1,
  ),
),false)) {
function content_5b7b8069918e52_91787957 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:commons/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div style="width: 980px;margin: 0 auto;border-right:1px solid #e5e5e5;border-left: 1px solid #e5e5e5; ">
    <div class="weui-cells">
        <a class="weui-cell weui-cell_access" href="/chapter/small/2">
            <div class="weui-cell__bd">
                <p>章节</p>
            </div>
            <div class="weui-cell__ft">
            </div>
        </a>
        <a class="weui-cell weui-cell_access" href="/chapter/small/3">
            <div class="weui-cell__bd">
                <p>综合</p>
            </div>
            <div class="weui-cell__ft">
            </div>
        </a>
        <a class="weui-cell weui-cell_access" href="/chapter/small/16">
            <div class="weui-cell__bd">
                <p>冲刺</p>
            </div>
            <div class="weui-cell__ft">
            </div>
        </a>
        <a class="weui-cell weui-cell_access" href="/errors/">
            <div class="weui-cell__bd">
                <p>错题排名</p>
            </div>
            <div class="weui-cell__ft">
            </div>
        </a>
    </div>
</div>
<?php $_smarty_tpl->_subTemplateRender('file:commons/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
