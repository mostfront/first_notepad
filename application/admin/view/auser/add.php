{extend name="glob/base" /}

{block name="content"}
<div class="page-header">
    <h1><span>管理员 {$typeName}</span></h1>
</div>

<div class="col-sm-4">
<form  action="{:url('admin/auser/save')}" method="post">
{:token()}
<input type='hidden' name='id' value='{$item->id|default=""}'/>

<div class="form-group">
  <label for="username">用户</label>
    <input name="username" type="text" class="form-control" id="username" placeholder="请输入用户名" value='{$item->username|default=""}' >
  </div>
  <div class="form-group">
    <label for="password">密码</label>
    <input name="password" type="password" class="form-control" id="password" placeholder="请输入密码">
  </div>
  <button type="submit" class="btn btn-default">提交</button>
</form>
</div>
{/block}

