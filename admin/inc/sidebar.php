<!-- 也可以使用 $_SERVER['PHP_PAGE']取代$current_page -->
<?php 

require_once '../functions.php';

$current_page = isset($current_page) ? $current_page:'';

$old_current_user=xiu_get_current_user();
$current_user=xiu_fetch_one('select * from users where id='.$old_current_user['id']);

 ?>

<div class="aside">
    <div class="profile">
      <img class="avatar" src="<?php echo $current_user['avatar']; ?>">
      <h3 class="name"><?php echo $current_user['nickname']; ?></h3>
      <div style="color:#ccc;"><?php echo $current_user['bio']; ?></div>

<!-- 仪表盘 -->
    </div>
    <ul class="nav">
      <li <?php echo $current_page === 'index' ? 'class="active"':''; ?> >
        <a href="/admin/index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>

<!-- 文章 -->
      <?php $menu_posts=array('posts','post-add','categories'); ?>
      <li <?php echo in_array($current_page,$menu_posts) ? 'class="active"':''; ?>>
        <a href="#menu-posts"<?php echo in_array($current_page,$menu_posts) ? '':'class="collapsed"'; ?>  data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse <?php echo in_array($current_page,$menu_posts) ? ' in':''; ?>">
          <li<?php echo $current_page === 'posts' ? ' class="active"' : '' ?>><a href="/admin/posts.php">所有文章</a></li>
          <li <?php echo $current_page === 'post-add' ? 'class="active"':''; ?>><a href="/admin/post-add.php">写文章</a></li>

          <?php if ($current_user['role'] === 'admin'): ?>
             <!-- 管理员才能看 -->
            <li <?php echo $current_page === 'categories' ? 'class="active"':''; ?>><a href="/admin/categories.php">分类目录</a></li>
          <?php endif ?>
          
        </ul>
      </li>

<!-- 评论 -->
      <li <?php echo $current_page === 'comments' ? 'class="active"':''; ?> >
        <a href="/admin/comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>


<!-- 用户 -->
      <?php if ($current_user['role'] === 'admin'): ?>
         <li <?php echo $current_page === 'users' ? 'class="active"':''; ?> >
          <a href="/admin/users.php"><i class="fa fa-users"></i>用户</a>
         </li>
      <?php endif ?>
     

<!-- 设置 -->
    <?php if ($current_user['role'] === 'admin'): ?>
       <?php $menu_settings=array('nav-menus','slides','settings'); ?>
        <li <?php echo in_array($current_page,$menu_settings) ? 'class="active"':''; ?>>
          <a href="#menu-settings"<?php echo in_array($current_page,$menu_settings) ? '':'class="collapsed"'; ?>  data-toggle="collapse">
            <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
          </a>

          <ul id="menu-settings" class="collapse <?php echo in_array($current_page,$menu_settings) ? ' in':''; ?>" >
            <li <?php echo $current_page === 'nav-menus' ? 'class="active"':''; ?>><a href="/admin/nav-menus.php">导航菜单</a></li>
            <li <?php echo $current_page === 'slides' ? 'class="active"':''; ?>><a href="/admin/slides.php">图片轮播</a></li>
            <li <?php echo $current_page === 'settings' ? 'class="active"':''; ?>><a href="/admin/settings.php">网站设置</a></li>
          </ul>
    <?php endif ?>
     

<!-- 个人中心 -->
        <li><a href="/admin/profile.php"><i class="fa fa-user"></i>个人中心</a></li>

      </li>
    </ul>
  </div>