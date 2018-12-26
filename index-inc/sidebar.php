 <?php 
require_once 'functions.php';
$current_user=xiu_get_index_user();


?>
  <div class="aside">
    <?php if (isset($current_user)): ?>

       <div class="profile">
        <div class="avatar"> 
          <a href="/admin/index.php"><img  src="<?php echo $current_user['avatar']; ?>"></a>
          <span></span>
        </div>
        <h3 class="name"><a href="/admin/index.php"><?php echo $current_user['nickname']; ?></a></h3>
        <a class="login" id="btn_exit" href="../index-api/clear_user.php?id=1">退出</a>
       
      </div>
     <?php else: ?>

      <div class="profile">
        <div class="avatar"> 
          <a href="#"><img  src="/static/assets/img/default.png"></a>
          <span></span>
        </div>
        <h3 class="name"><a href="#">游客</a></h3>
        <a class="login a globalLoginBtn" style="color:white;">登录</a>
        
      </div>

    <?php endif ?>
    

    <div class="widgets">
        <h4>搜索</h4>
        <div class="body search">
          <form>
            <input type="text" class="keys" placeholder="输入关键字">
            <input type="submit" class="btn" value="搜索">
          </form>
        </div>
      </div>
    <div class="widgets">
        <h4>随机推荐</h4>
        <ul class="body random">
          <li>
            <a href="javascript:;">
              <p class="title">废灯泡的14种玩法 妹子见了都会心动</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="/static/uploads/widget_1.jpg" alt="">
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <p class="title">可爱卡通造型 iPhone 6防水手机套</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="/static/uploads/widget_2.jpg" alt="">
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <p class="title">变废为宝！将手机旧电池变为充电宝的Better</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="/static/uploads/widget_3.jpg" alt="">
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <p class="title">老外偷拍桂林芦笛岩洞 美如“地下彩虹”</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="/static/uploads/widget_4.jpg" alt="">
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <p class="title">doge神烦狗打底南瓜裤 就是如此魔性</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="/static/uploads/widget_5.jpg" alt="">
              </div>
            </a>
          </li>
        </ul>
      </div>
    <div class="widgets">
      <h4>最新评论</h4>
      <ul class="body discuz">
          <li>
            <a href="javascript:;" style="text-decoration: none;">
              <div class="avatar">
                <img src="/static/uploads/avatars/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;" style="text-decoration: none;">
              <div class="avatar">
                <img src="/static/uploads/avatars/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;" style="text-decoration: none;">
              <div class="avatar">
                <img src="/static/uploads/avatars/avatar_2.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;" style="text-decoration: none;">
              <div class="avatar">
                <img src="/static/uploads/avatars/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;" style="text-decoration: none;">
              <div class="avatar">
                <img src="/static/uploads/avatars/avatar_2.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;" style="text-decoration: none;">
              <div class="avatar">
                <img src="/static/uploads/avatars/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
        </ul>
      </div> 
  </div>
  <!-- 登陆模块 -->
  <div class="modal fade" id="loginModal" style="display:none;">
  <div class="modal-dialog modal-sm" style="width:540px;">
    <div class="signin">
  <button type="button" id="login_close" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      <div class="signin-head"><img id="avatar" src="/static/assets/vendors/login-jiaoben/images/test/head_120.png" alt="" class="img-circle"></div>

      <form class="form-signin" role="form" novalidate autocomplete="off">

        <input type="text" class="form-control" id="username" name="username" placeholder="用户名" required autofocus />

        <input type="password" class="form-control" id="password" name="password" placeholder="密码" required />

        <p class="good-tips marginB10">还没有账号？<a href="javascript:;" target="_blank" id="btnRegister">立即注册</a></p>
        
        <div class="login-box marginB10">
          <button id="login_btn" type="button" class="btn btn-lg btn-warning btn-block">登录</button> 
          <div id="login-form-tips" class="tips-error bg-danger">错误提示</div>
          
        </div>
      </form>
    </div>
  </div>
</div>  
<script src="/static/assets/vendors/jquery/jquery.js"></script>
<script>
  $(function ($){
      //1.单独作用域
      //2.确保页面加载过后执行
      
      //目标：用户输入自己的邮箱过后，拿到页面上展示这个邮箱对应的头像
      //实现：
      //-时机：邮箱文本框失去焦点
      //-事情：获取文本框中填写的邮箱对应的头像地址，展示代上面的img元素上
      
      //失去焦点事件，并且能够拿到文本框中填写的邮箱时
      var usernameFormat=/^[a-z][a-zA-Z0-9]{4,7}$/;
      $('#username').on('blur',function () {
        var value=$(this).val();
        //忽略掉文本框为空或者不是一个邮箱
        if (!value || !usernameFormat.test(value)) return;

        //用户输入了一个合理的邮箱地址
        //获取这个邮箱对应的头像地址
        //因为客户端的js无法直接操作数据库，应该通过js发送ajax请求告诉服务端的某个接口
        //让这个接口帮助客户端获取头像
        
        $.get('/admin/api/avatar.php',{username:value},function (res) {
          //希望res=>这个邮箱对应的头像地址
          if (!res){
             $('#avatar').fadeOut(function () {
            $(this).on('load', function() {
              $(this).fadeIn();
            }).attr('src','/static/assets/vendors/login-jiaoben/images/test/head_120.png')
          })
            
          } else{
          //展示到img元素上
          //$('.avatar').fadeOut().attr('src',res).fadeIn();
          $('#avatar').fadeOut(function () {
            $(this).on('load', function() {
              $(this).fadeIn();
            }).attr('src',res)
          })}
        })
      });

        $('#login_btn').on('click', function() {
          var username=$('#username').val();
          var password=$('#password').val();
          //1.判断用户名和密码是否为空
          if( username && password )
          //2.发送请求，查询数据，如果错误显示提示信息，正确关闭页面，刷新页面
          $.get('/index-api/login.php',{username:username,password:password},function(res){
            if(!res){
              location.reload();
            }else{
              console.log(res);
              $('#login-form-tips').css('display','block');
              $('#login-form-tips').text(res); 
            }
            
          });
        });
    });
</script>
 
     
     