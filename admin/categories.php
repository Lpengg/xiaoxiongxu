<?php 
require_once '../functions.php';

//判断用户是否登录一定是最先去做


//添加函数
function add_categories(){
  //1.
  //2.
  //3.
  if (empty($_POST['name'])||empty($_POST['slug'])) {
    $GLOBALS['success']=false;
    $GLOBALS['message']='请完整填写表单';
    return;
    }
    $name=$_POST['name'];
    $slug=$_POST['slug'];

    //接收并保存数据
    $rows=xiu_execute("insert into categories values(null,'{$slug}','{$name}');");
    $rows <= 0 ? $GLOBALS['success']=false:'';
    $GLOBALS['message']= $rows <= 0 ? '添加失败':'添加成功';
}

//修改操作
function edit_category(){
  global $current_edit_category;
  /* if (empty($_POST['name'])||empty($_POST['slug'])) {
    $GLOBALS['success']=false;
    $GLOBALS['message']='请完整填写表单';
    return;
  }*/
  $name=empty($_POST['name']) ? $current_edit_category['name']:$_POST['name'];
  $slug=empty($_POST['slug']) ? $current_edit_category['slug']:$_POST['slug'];
  $id=$current_edit_category['id'];
  //接收并保存数据
  $rows=xiu_execute("update categories set slug='{$slug}',name='{$name}' where id='{$id}'");
  $rows <= 0 ? $GLOBALS['success']=false:'';
  $GLOBALS['message']= $rows <= 0 ? '更新失败':'更新成功';
}

//--------判断是否是编辑数据
if(empty($_GET['id'])){
  if ($_SERVER['REQUEST_METHOD']==='POST') {
    add_categories();
  }
 }else{ 
  //编辑
   //客户端通过url传递过来一个id
  //需要拿到用户想要的数据
  $current_edit_category=xiu_fetch_one('select * from categories where id=' . $_GET['id']);
  if ($_SERVER['REQUEST_METHOD']==='POST') {
    edit_category();
  }
}

//查询分类数据
 $categories = xiu_fetch('SELECT * FROM categories;');


 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/static/assets/css/admin.css">
  <script src="/static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
  <?php include 'inc/navbar.php'; ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>

     <!-- 有错误信息时展示 -->
      <?php if (isset($message)): ?>
         <div class="alert <?php echo isset($success) ? 'alert-danger':'alert-success'; ?> ">
        <?php echo $message; ?>
      </div>
      <?php endif ?>


      <div class="row">
        <div class="col-md-4">
         <?php if (isset($current_edit_category)): ?>
           <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $current_edit_category['id']; ?>" method="post" autocomplete="off">
            <h2>编辑《<?php echo $current_edit_category['name']; ?>》</h2>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" name="name" class="form-control" name="name" type="text" placeholder="<?php echo $current_edit_category['name']; ?>">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" name="slug" class="form-control" name="slug" type="text" placeholder="<?php echo $current_edit_category['slug']; ?>">
              <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">保存</button>
            </div>
          </form>
          <?php else: ?>
             <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
            <h2>添加新分类目录</h2>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" name="name" class="form-control" name="name" type="text" placeholder="分类名称">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" name="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <!-- <p class="help-block">https://zce.me/category/<strong>slug</strong></p> -->
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">添加</button>
            </div>
          </form>
         <?php endif ?>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a id="btn_delete" class="btn btn-danger btn-sm" href="/admin/categories-del.php" style="display: none">批量删除</a>
          </div>

          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th>名称</th>
                <th>Slug</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($categories as $item): ?>
                 <tr>
                <td class="text-center"><input type="checkbox" data-id="<?php echo $item['id']; ?>"></td>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['slug']; ?></td>
                <td class="text-center">
                  <a href="/admin/categories.php?id=<?php echo $item['id']; ?>" class="btn btn-info btn-xs">编辑</a>
                  <a href="/admin/categories-del.php?id=<?php echo $item['id']; ?>" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <?php endforeach ?>
               
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
 <?php $current_page = 'categories'; ?>
 <?php include 'inc/sidebar.php' ?>

  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script>
    //1.不要重复使用无意义的选择操作 应该采用变量去本地化
    $(function ($) {
      //在表格中的任意一个check选中状态变化时
      var $tbdoyCheckboxs = $('tbody input');
      var $btnDelete=$('#btn_delete');
      //定义一个数组记录被选中的id
      var allChecked=[];
      $tbdoyCheckboxs.on('change', function() {
        
       
        var id=$(this).data('id');

        if ($(this).prop('checked')) {
          //.data()获取自定义属性的值
          allChecked.push(id);
        }else{
          allChecked.splice(allChecked.indexOf(id),1);
        }
        //根据数组中有没有值判断有没有被选中
        allChecked.length ? $btnDelete.fadeIn():$btnDelete.fadeOut();
        $btnDelete.prop('search','?id='+allChecked);
      });


    /*  $tbdoyCheckboxs.on('change', function() {
        //有任意一个checkbox被选中就显示，反之隐藏
        
        var flag=false;
        $tbdoyCheckboxs.each(function (i,item) {
          //attr()获取的是html上写的属性
          //prop()获取的是dom上的属性
          if($(item).prop('checked')){
            flag=true;
          }
        });

        flag ? $btnDelete.fadeIn():$btnDelete.fadeOut();
      });*/
    })
  </script>

  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
