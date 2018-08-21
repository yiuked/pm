<?php
/* Smarty version 3.1.32, created on 2018-08-21 10:59:46
  from 'D:\php\pmp\dist\demos\chapter\subject.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b7b80224b7809_62401876',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6abed6edc24576a1ecb2a50ceb35123fa3d64fc8' => 
    array (
      0 => 'D:\\php\\pmp\\dist\\demos\\chapter\\subject.html',
      1 => 1534820383,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:commons/header.html' => 1,
    'file:commons/footer.html' => 1,
  ),
),false)) {
function content_5b7b80224b7809_62401876 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\php\\pmp\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
$_smarty_tpl->_subTemplateRender('file:commons/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<link href="/dist/demos/css/agreement.css" rel="stylesheet" type="text/css" charset="utf-8">
<div class="body-content">
  <div class="content">
    <div class="tkCont">
      <div class="tkCMain">
        <form action="/chapter/subject/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" method="post">
          <div class="title" style="margin-bottom:20px;">PMP在线考题</div>
          <p class="sign small">生成时间: <span style="text-decoration: underline;"><?php echo smarty_modifier_date_format(time(),'%Y-%m-%d');?>
 </span>
          </p>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['subjects']->value, 'subject');
$_smarty_tpl->tpl_vars['subject']->iteration = 0;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['subject']->value) {
$_smarty_tpl->tpl_vars['subject']->iteration++;
$__foreach_subject_0_saved = $_smarty_tpl->tpl_vars['subject'];
?>
          <br>
          <div><strong><?php echo $_smarty_tpl->tpl_vars['subject']->iteration;?>
.<?php echo $_smarty_tpl->tpl_vars['subject']->value['name'];?>
</strong></div>
          <div>
            <input type="radio" name="checked[<?php echo $_smarty_tpl->tpl_vars['subject']->value['id'];?>
]" value="A" <?php if ((($tmp = @$_smarty_tpl->tpl_vars['subject']->value['checked'])===null||$tmp==='' ? false : $tmp) && $_smarty_tpl->tpl_vars['subject']->value['checked'] == 'A') {?>checked<?php }?> <?php if ($_smarty_tpl->tpl_vars['show']->value) {?>disabled<?php }?>> A.<?php echo $_smarty_tpl->tpl_vars['subject']->value['itemA'];?>

            <?php if ($_smarty_tpl->tpl_vars['show']->value && $_smarty_tpl->tpl_vars['subject']->value['result'] == 'A') {?><i class="weui-icon-success"></i><?php }?>
          </div>
          <div>
            <input type="radio" name="checked[<?php echo $_smarty_tpl->tpl_vars['subject']->value['id'];?>
]" value="B" <?php if ((($tmp = @$_smarty_tpl->tpl_vars['subject']->value['checked'])===null||$tmp==='' ? false : $tmp) && $_smarty_tpl->tpl_vars['subject']->value['checked'] == 'B') {?>checked<?php }?> <?php if ($_smarty_tpl->tpl_vars['show']->value) {?>disabled<?php }?>> A.<?php echo $_smarty_tpl->tpl_vars['subject']->value['itemB'];?>

            <?php if ($_smarty_tpl->tpl_vars['show']->value && $_smarty_tpl->tpl_vars['subject']->value['result'] == 'B') {?><i class="weui-icon-success"></i><?php }?>
          </div>
          <div>
            <input type="radio" name="checked[<?php echo $_smarty_tpl->tpl_vars['subject']->value['id'];?>
]" value="C" <?php if ((($tmp = @$_smarty_tpl->tpl_vars['subject']->value['checked'])===null||$tmp==='' ? false : $tmp) && $_smarty_tpl->tpl_vars['subject']->value['checked'] == 'C') {?>checked<?php }?> <?php if ($_smarty_tpl->tpl_vars['show']->value) {?>disabled<?php }?>> A.<?php echo $_smarty_tpl->tpl_vars['subject']->value['itemC'];?>

            <?php if ($_smarty_tpl->tpl_vars['show']->value && $_smarty_tpl->tpl_vars['subject']->value['result'] == 'C') {?><i class="weui-icon-success"></i><?php }?>
          </div>
          <div>
            <input type="radio" name="checked[<?php echo $_smarty_tpl->tpl_vars['subject']->value['id'];?>
]" value="D" <?php if ((($tmp = @$_smarty_tpl->tpl_vars['subject']->value['checked'])===null||$tmp==='' ? false : $tmp) && $_smarty_tpl->tpl_vars['subject']->value['checked'] == 'D') {?>checked<?php }?> <?php if ($_smarty_tpl->tpl_vars['show']->value) {?>disabled<?php }?>> A.<?php echo $_smarty_tpl->tpl_vars['subject']->value['itemD'];?>

            <?php if ($_smarty_tpl->tpl_vars['show']->value && $_smarty_tpl->tpl_vars['subject']->value['result'] == 'D') {?><i class="weui-icon-success"></i><?php }?>
          </div>
          <?php if ($_smarty_tpl->tpl_vars['show']->value == true) {?>
          <br>
          <div><strong>解析</strong></div>
          <div>答案:<?php echo $_smarty_tpl->tpl_vars['subject']->value['result'];?>
</div>
          <div><?php echo $_smarty_tpl->tpl_vars['subject']->value['jiexi'];?>
</div>
          <?php }?>
          <?php
$_smarty_tpl->tpl_vars['subject'] = $__foreach_subject_0_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          <?php if ($_smarty_tpl->tpl_vars['show']->value == true) {?>
          <a href="/chapter/subject/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="weui-btn weui-btn_primary">再做一次</a>
          <?php } else { ?>
          <button type="submit" class="weui-btn weui-btn_primary">提交</button>
          <?php }?>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $_smarty_tpl->_subTemplateRender('file:commons/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
if ($_smarty_tpl->tpl_vars['show']->value == true) {
echo '<script'; ?>
>
    $.alert("<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
", "结果");
<?php echo '</script'; ?>
>
<?php }
}
}
