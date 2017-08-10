<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="<?php echo $base_url;?>static/css/login_pc.css">
</head>

<body>

<header class="hd">


    <div class="warp">
        <a href="#1">
            <img src="<?php echo $base_url?>static/dist/images/logo.png" alt="" class="logo-img">
            <span class="span_txt">商城首页</span>
        </a>
    </div>
</header>
<div class="login-box">
    <div class="bg" style="background-image:url(<?php echo $base_url?>static/dist/images/login_bg.jpg)">
        <div class="warp">
            <div class="form-box">
                <div class="tit">
                    <a href="#"  class="active">账号登录</a>
                    <a href="#">新用户注册</a>
                    <div class="line"></div>
                </div>
                <div class="cont-box">
                    <!--登录-->
                    <div class="cont-item active">
                        <div class="input-txt">
                            <i class="iconfont icon-shouji"></i>
                            <input type="text"  placeholder="请输入手机号码" id="mobile" name="mobile">
                        </div>
                        <div class="input-txt">
                            <i class="iconfont icon-suo"></i>
                            <input type="password" placeholder="请输入6-12位密码" id="password" name="password">
                        </div>
                        <div class="form-ft">
                            <a href="#11" class="login-btn" id="submit">登录</a>
                            <a href="<?php echo $base_url;?>home/account/resetPassword" class="wjmm">忘记密码</a>
                        </div>
                    </div>
                    <!--注册-->
                    <div class="cont-item ">
                        <div class="input-txt">
                            <i class="iconfont icon-shouji"></i>
                            <input type="text" placeholder="请输入手机号码" id="re_mobile" name="mobile">
                        </div>
                        <div class="yzm-box2">
                            <div class="input-txt yzm">
                                <!--<i class="iconfont icon-anquan"></i>-->
                                <input type="text" placeholder="请输入数字验证码" id="captchanum" name="captchanum">
                            </div>
                            <div class="input-txt yzm-btn send-standby sendmsg" id="send-captcha-num">
                                <!--发送验证码-->
                                <div id="img" class="am-fr" style=""></div>
                            </div>
                        </div>
                        <div class="yzm-box">
                            <div class="input-txt yzm">
                                <i class="iconfont icon-anquan"></i>
                                <input type="text" placeholder="请输入手机验证码" id="captcha" name="captcha">
                            </div>
                            <div class="input-txt yzm-btn send-standby sendmsg" id="send-captcha">
                                <!--发送验证码-->
                                发送验证码
                            </div>
                        </div>
                        <div class="input-txt">
                            <i class="iconfont icon-suo"></i>
                            <input type="password" placeholder="请输入6-12位密码" id="password1" name="password1">
                        </div>

                        <div class="form-ft">
                            <a href="#11" class="login-btn" id="submit1">注册并登录</a>
                            <a href="#111" class="xy">《使用条款和用户协议》</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<script src="<?php echo $base_url?>static/js/lib/jquery.min.js"></script>

<script>

    $(".form-box").on('click', '.tit a', function () {
        var $this = $(this), $contItem = $('.cont-box').find('.cont-item');
        $this.parents('.tit').find('a').removeClass('active');
        $this.addClass('active');
        $contItem.removeClass('active');
        $contItem.eq($this.index()).addClass('active');

        checkLine($this.index())
    })
    function checkLine(index) {
        index = index || 0;
        $(".tit").find('.line').css("left", index * 50 + '%');
    }

    checkLine($(".tit").find('.active').index())


    // 验证码
    function getCaptcha() {
        $.get("/admin/account/captcha", function (htmlStr) {
//                console.log(htmlStr);
            img = '<img id="Imageid" src="/static/captcha/' + htmlStr + '">';
            $("#img").html($(img));
        })
    }
    getCaptcha();

    //刷新验证码
    $('#img').click(function () {
        getCaptcha();
    });

    // 登录
    $('#submit').on("click", function () {
        var mobile = $('#mobile').val();
        var password = $('#password').val();

        var pattern = /^1[34578]\d{9}$/;
        if (!pattern.test(mobile)) {
            alert("请填写11位数字的正确号码");
            return;
        }
        if (password == "") {
            alert("请填写密码");
            return;
        }

        //登录验证
        $.post("<?php echo $base_url; ?>home/account/checkLogin", {
            'mobile': mobile,
            'password': password
        }, function (json) {
            if (json.result == 0) {
                window.location.href = "<?php echo $base_url; ?>home";
            } else {
                alert("账号或密码错误！");
            }
            return;
        }, 'json');
    });

    var iTimer = 0;
    //发送验证码
    $('#send-captcha').on("click", function () {
        var re_mobile = $('#re_mobile').val();
        var captchanum = $('#captchanum').val();


        var pattern = /^1[34578]\d{9}$/;
        if (!pattern.test(re_mobile)) {
            alert("请填写11位数字的正确号码");
            return;
        }

        if (!navigator.onLine) {
            alert("网络连接异常，请检查网络");
            return;
        }
        if (captchanum == "") {
            alert("请填写验证码");
            return;
        }

        var self = this;
        if ($(this).hasClass("send-standby")) {
            $.post("/home/account/sms_port_pc",{
                captcha:captchanum,
                phone:re_mobile,
                type:0
            }, function (json) {
                var json = eval(json);
                console.log(json);
                if (json.errcode != 0) { // 检验失败  手机号已存在等
                    alert(json.errmsg);
                    getCaptcha();
                    if (json.errcode > 10030) {
                        return;
                    }
                    clearInterval(iTimer);
                    $('#send-captcha').text('发送验证码');
                } else { //  发送成功 去掉class
                    $(self).removeClass("send-standby");
                    timeCount();
                }
            }, 'json');
        }

    });



    //定时器
    function timeCount() {
        var i = 60;
        iTimer = setInterval(function () {
            i <= 0 ? clearInterval(iTimer) : i--;
            $('#send-captcha').text(i + '秒');
            if (i == 0) {
                clearInterval(iTimer)
                $('#send-captcha').text('发送验证码');
                $('#send-captcha').addClass("send-standby");
            }
        }, 1000);
    }


    //注册
    $('#submit1').on("click", function () {

        var mobile = $('#re_mobile').val();
        var password1 = $('#password1').val();
        var captcha = $('#captcha').val();
        var pattern = /^1[34578]\d{9}$/;
        if (!pattern.test(mobile)) {
            alert("请填写11位数字的正确号码");
            return;
        }
        if (password1 == "" || captcha == "") {
            alert("请填写密码和验证码");
            return;
        }

        if (password1.length < 6 || password1.length > 12) {
            alert("请输入6-12位密码");
            return;
        }

        $.post("<?php echo $base_url; ?>/home/account/add", {
            'mobile': mobile,
            'password': password1,
            'captcha': captcha
        }, function (json) {
            var json = eval(json);

            if (json.result == 0) {
                //帮助登录
                $.post("<?php echo $base_url; ?>home/account/checkLogin", {
                    'mobile': mobile,
                    'password': password1
                }, function (json) {
                    if (json.result == 0) {
                        window.location.href = "<?php echo $base_url; ?>/home";
                        return;
                    }
                    return;
                }, 'json');

            } else {
                alert(json.message);
                return;
            }

        }, 'json');
    });
</script>

</body>

</html>