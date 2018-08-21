<?php
/* Smarty version 3.1.32, created on 2018-08-21 11:00:59
  from 'D:\php\pmp\dist\demos\chapter.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b7b806bdb5199_10842794',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0db2dbbd23251064f175331af767909662aa22ef' => 
    array (
      0 => 'D:\\php\\pmp\\dist\\demos\\chapter.html',
      1 => 1534815112,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:commons/header.html' => 1,
    'file:commons/footer.html' => 1,
  ),
),false)) {
function content_5b7b806bdb5199_10842794 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:commons/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div style="width: 980px;margin: 0 auto;border-right:1px solid #e5e5e5;border-left: 1px solid #e5e5e5; ">
    <div class="bd">
      <div class="page__bd">
        <div class="weui-cells">
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['chapters']->value, 'chapter');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['chapter']->value) {
?>
          <div class="weui-cell">
            <div class="weui-cell__bd">
              <p class="weui-media-box__desc"><?php echo $_smarty_tpl->tpl_vars['chapter']->value['name'];?>
(<?php echo $_smarty_tpl->tpl_vars['chapter']->value['count'];?>
题)</p>
            </div>
            <div class="weui-cell__ft">
              <a href="/chapter/subject/<?php echo $_smarty_tpl->tpl_vars['chapter']->value['id'];?>
" class="weui-btn weui-btn_mini weui-btn_default">答题</a>
            </div>
          </div>
          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
      </div>
    </div>
</div>
<?php $_smarty_tpl->_subTemplateRender('file:commons/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
