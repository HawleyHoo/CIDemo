<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

<!--    --><?php //include 'header.php'; ?>
    <script src="../js/loadingoverlay.min.js"></script>

    <style>
        .login-modal {
            position: fixed;
            top: 30%;
            left: 50%;
            margin-left: -233px;
            width: 466px;
            background: #fff;
            box-shadow: 0 -2px 34px 1px rgba(4, 4, 4, 0.2);
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 0 36px;
            display: none;
        }
        .login-modal.active {
            display: block;
        }
        .login-modal.czmm {
            padding-top: 20px;
        }
        .login-modal .col-btn {
            position: absolute;
            right: 15px;
            top: 18px;
        }
        .login-modal .col-btn i {
            font-size: 20px;
            color: #000;
        }
        .login-modal .tit {
            line-height: 48px;
            overflow: auto;
            position: relative;
            margin-top: 38px;
        }
        .login-modal .tit a {
            display: block;
            float: left;
            width: 50%;
            text-align: center;
            font-size: 24px;
            border-bottom: 1px solid #ddd;
            color: #999;
            -webkit-transition: all .3s;
            -moz-transition: all .3s;
            transition: all .3s;
        }
        .login-modal .tit a.active {
            color: #222;
        }
        .login-modal .tit .line {
            height: 1px;
            background: #d90303;
            width: 50%;
            position: absolute;
            bottom: 0;
            left: 0;
            -webkit-transition: all .3s;
            -moz-transition: all .3s;
            transition: all .3s;
        }
        .login-modal .cont-box {
            padding-top: 40px;
        }
        .login-modal .cont-box .cont-item {
            display: none;
        }
        .login-modal .cont-box .cont-item.active {
            display: block;
        }
        .login-modal .cont-box .cont-item .input-txt {
            border: 1px solid #ddd;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            width: 396px;
            height: 46px;
            line-height: 46px;
            padding-left: 48px;
            padding-right: 20px;
            margin-bottom: 20px;
            position: relative;
        }
        .login-modal .cont-box .cont-item .input-txt i {
            color: #13227a;
            position: absolute;
            left: 10px;
        }
        .login-modal .cont-box .cont-item .input-txt input {
            border: 0;
            outline: none;
            width: 100%;
        }
        .login-modal .cont-box .cont-item .input-txt .icon-shouji {
            font-size: 24px;
        }
        .login-modal .cont-box .cont-item .input-txt .icon-suo {
            font-size: 24px;
        }
        .login-modal .cont-box .cont-item .input-txt .icon-anquan {
            font-size: 24px;
        }
        .login-modal .cont-box .cont-item .yzm-box {
            overflow: auto;
        }
        .login-modal .cont-box .cont-item .yzm-box2 {
            overflow: auto;
        }
        .login-modal .cont-box .cont-item .yzm-box2 .yzm {
            padding: 0 20px;
        }
        .login-modal .cont-box .cont-item .yzm-box2 .yzm-btn img {
            width: 100%;
        }
        .login-modal .cont-box .cont-item .yzm {
            width: 233px;
            float: left;
        }
        .login-modal .cont-box .cont-item .yzm-btn {
            width: 144px;
            float: left;
            margin-left: 17px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
            padding: 0;
            color: #333;
        }
        .login-modal .cont-box .cont-item .form-ft {
            width: 394px;
            bottom: 30px;
            margin: 20px 0;
            overflow: auto;
            border: 1px solid transparent;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .login-modal .cont-box .cont-item .form-ft .login-btn {
            width: 100%;
            height: 56px;
            line-height: 56px;
            font-size: 22px;
            color: #fff;
            background-color: #d90303;
            display: block;
            text-align: center;
        }
        .login-modal .cont-box .cont-item .form-ft .xy {
            color: #13227a;
            float: right;
            line-height: 36px;
        }
        .login-modal .cont-box .cont-item .form-ft .wjmm {
            color: #333;
            float: right;
            line-height: 36px;
        }

    </style>
</head>

<body>

<!--登录注册-->
<div class="login-modal active">
    <a href="#13" class="col-btn">
        <i class="icon iconfont icon-icon1"></i>
    </a>
    <div class="tit">
        <a href="#" class="active">登录</a>
        <a href="#">注册</a>
        <div class="line"></div>
    </div>
    <div class="cont-box">
        <!--登录-->
        <div class="cont-item active">
            <div class="input-txt">
                <i class="iconfont icon-shouji"></i>
                <input type="text" placeholder="请输入手机号码" id="mobile" name="mobile">
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
                    <input type="text" placeholder="请输入数字验证码" id="captchanum" name="captchanum">
                </div>
                <div class="input-txt yzm-btn send-standby sendmsg" id="send-captcha-num">
                    <div id="img" class="am-fr" style=""></div>
                </div>
            </div>

            <div class="yzm-box">
                <div class="input-txt yzm">
                    <i class="iconfont icon-anquan"></i>
                    <input type="text" placeholder="请输入验证码"  id="captcha" name="captcha">
                </div>
                <div class="input-txt yzm-btn send-standby sendmsg" id="send-captcha">
                    <!--发送验证码-->
                    发送验证码
                </div>
            </div>
            <div class="input-txt">
                <i class="iconfont icon-suo"></i>
                <input type="password" placeholder="请输入6-12位密码"  id="password1" name="password">
            </div>
            <div class="form-ft">
                <a href="#11" class="login-btn" id="submit1">注册并登录</a>
                <a href="#111" class="xy">《使用条款和用户协议》</a>
            </div>
        </div>

    </div>
</div>

<script>
    $('.login').on('click', function () {
        $('.login-modal').addClass('active');
    })
    $('.col-btn').on('click',function(){
        $('.login-modal').removeClass('active');
    })

    $(".login-modal").on('click', '.tit a', function () {
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
</script>

<script>
    $(document).ready(function () {
        activeNav(1);
    });

    function showtips(tips, url) {
        $('#room_tips').html(tips);
        if (url != null)
            $('#room_url').attr('href', url).show();
        else
            $('#room_url').hide();
        $("#blackbg").show();
    }
    ;

    function hidetips() {
        $("#blackbg").hide();
    }

    function enterLiveRoom(id) {
        $.LoadingOverlay("show");
        $.post('check_room.php' + '?random=' + Math.random(), {id: id},
            function (data) {
                $.LoadingOverlay("hide");
                showtips(data.tips, data.url);
            }, 'json'
        ).fail(function (jqXHR, textStatus, errorThrown) {
            $.LoadingOverlay("hide");
            alert(textStatus + ", " + errorThrown + ": " + jqXHR.responseText);
        });
        return false;
    }

</script>
<?php //include 'nav.php'; ?>

<!-- Page Content -->
<div class="page_ttl">
    <div class="container"><h1>智讯在线</h1></div>
</div>

<div class="content select_chat">
    <div class="container">

        <div class="group_btn_chat"><a class="btn_select_chat" href="#" onclick="return enterLiveRoom(1)"><span
                        class="roomName">赢在起点新手区</span>
                <span class="smaller_txt">所有客户均可进入</span><img src="../images/chat_room_01.jpg"/></a>
            <a class="btn_select_chat" href="#" onclick="return enterLiveRoom(2)"><span class="roomName">运筹致胜专区</span>
                <span class="smaller_txt">客户帐户资金须达二万美元</span><img src="../images/chat_room_02.jpg"/></a>
            <a class="btn_select_chat" href="#" onclick="return enterLiveRoom(3)"><span class="roomName">卓越理财专区</span>
                <span class="smaller_txt">客户帐户资金须达八万美元</span><img src="../images/chat_room_03.jpg"/></a>
        </div><!--end of group_btn_chat-->
    </div><!--end of container-->
</div><!--end of select_chat -->


<div class="chatselectbox" id="blackbg">
    <div class="tipsbox" id="tipsbox">
        <!--<p>直播间密码为</p> -->
        <p class="password" id="room_tips"></p><!-- 后台定义的文字 -->
        <a href="vip01.php" id="room_url">前往</a><!-- 跳转链接 -->
    </div>
    <div class="blackbg" onclick="hidetips()"></div>
</div>


<!-- Footer -->
<?php //include 'footer.php'; ?>
<!-- /.Footer -->

</body>

</html>
