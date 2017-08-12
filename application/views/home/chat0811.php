<?php
//By Weffen 2017-06-20
//session_start();
//include("simple-php-captcha.php");
$_SESSION['captcha'] = 1234;//simple_php_captcha();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.php';  ?>
    <!--    new for signup-->
    <link href="/static/cqq/css/signup.css" rel="stylesheet">
<!--    <script src="../js/jquery.validate.min.js"></script>-->
<!--    <script src="../js/loadingoverlay.min.js"></script>-->
    <script src="/static/cqq/js/jquery.js"></script>

    <link href="/static/cqq/css/custom.css" rel="stylesheet">
    <link href="/static/cqq/css/bootstrap.css" rel="stylesheet">
<!--    <link href="/static/cqq/css/modern-business.css" rel="stylesheet">-->

<!--    <link href="/static/cqq/css/owl.carousel.css" rel="stylesheet">-->
<!--    <link href="/static/cqq/css/owl.theme.default.css" rel="stylesheet">-->

</head>
<body>
<script>

    $(document).ready(function(){
        $('#login_id').click(function(){
            $('#form_1').show();
            $('#form_2').hide();

        });

        $('#register_id').click(function(){
            $('#form_1').hide();
            $('#form_2').show();

        });
    });

    $(document).ready(function(){
        activeNav(1);
    });


    function showtips(tips, url) {
        $('#room_tips').html(tips);
        if(url != null)
            $('#room_url').attr('href', url).show();
        else
            $('#room_url').hide();
        $("#blackbg").show();
    };

    function hidetips() {
        $("#blackbg").hide();
    }

    function enterLiveRoom(id){
        $.LoadingOverlay("show");
        $.post('check_room.php' + '?random=' + Math.random(), {id: id},
            function(data) {
                $.LoadingOverlay("hide");
                showtips(data.tips, data.url);
            }, 'json'
        ).fail(function( jqXHR, textStatus, errorThrown) {
            $.LoadingOverlay("hide");
            alert( textStatus + ", " + errorThrown + ": " +  jqXHR.responseText);
        });
        return false;
    }


    function refresh_captcha(){
        $('#captcha-image').hide();
        $('#captcha_loading').show();
        $.get('refresh_captcha.php', function(url) {
            $('#captcha-image').load(function(){
                $('#captcha-image').show();
                $('#captcha_loading').hide();
            })
                .attr('src', url);;
        });
    }



    //自定义validate验证输入的数字小数点位数不能大于两位
    jQuery.validator.addMethod("minNumber",function(value, element){
        var returnVal = true;
        inputZ=value;
        var ArrMen= inputZ.split(".");    //截取字符串
        if(ArrMen.length==2){
            if(ArrMen[1].length>2){    //判断小数点后面的字符串长度
                returnVal = false;
                return false;
            }
        }
        return returnVal;
    },"小数点后最多为两位");         //验证错误信息

    $(document).ready(function(){
        activeNav(7);
        $('.btn_terms_register').fancybox({padding:5,maxWidth:800,helpers: {    overlay: {      locked: false    }}	});
        // activeNav(2,0);


        //validate
        $('#form :input').attr('data-msg-required', '此项必须输入方可提交！')
        $('#form').validate({
            //验证规则
            rules: {
                w_money: {
                    required: true,    //要求输入不能为空
                    number: true,     //输入必须是数字
                    min: 0.01,          //输入的数字最小值为0.01，不能为0或者负数
                    minNumber: $("#w_money").val()    //调用自定义验证
                }
            },

            //错误提示信息

            submitHandler: function(form) {
                // do other things for a valid form
                // form.submit();
                $.LoadingOverlay("show");
                $.post('auth.php' + '?random=' + Math.random(), $(form).serializeArray(),
                    function(data) {
                        if(data.code == '9000'){
                            self.location = 'select_chat.php'
                        }
                        else if(data.code == 'INVALID_CAPTCHA'){
                            $.LoadingOverlay("hide");
                            alert('验证码不对');
                            $('#captcha').focus();
                        }
                        else if(data.code == '2248'){
                            $.LoadingOverlay("hide");
                            alert('账号或者密码不对');
                            $('#signin_id').focus();
                        }
                        else{
                            $.LoadingOverlay("hide");
                            alert('登录发生错误：'  + data.detail);
                            $('#signin_id').focus();
                        }
                    }, 'json'
                ).fail(function( jqXHR, textStatus, errorThrown) {
                    $.LoadingOverlay("hide");
                    alert( textStatus + ", " + errorThrown + ": " +  jqXHR.responseText);
                });

                return false;
            }
        });
    });

    function submitForm(){
        $('#form').submit();
        return false;
    }

</script>
<?php //include 'nav.php';  ?>

<!-- Page Content -->
<div class="page_ttl"><div class="container"><h1>智讯在线</h1></div></div>

<div class="content select_chat"><div class="container">

        <div class="group_btn_chat"><a class="btn_select_chat" href="#" onclick="return enterLiveRoom(1)"><span class="roomName">赢在起点新手区</span>
                <span class="smaller_txt">所有客户均可进入</span><img src="../images/chat_room_01.jpg"/></a>
            <a class="btn_select_chat" href="#" onclick="return enterLiveRoom(2)"><span class="roomName">运筹致胜专区</span>
                <span class="smaller_txt">客户帐户资金须达二万美元</span><img src="../images/chat_room_02.jpg"/></a>
            <a class="btn_select_chat" href="#" onclick="return enterLiveRoom(3)"><span class="roomName">卓越理财专区</span>
                <span class="smaller_txt">客户帐户资金须达八万美元</span><img src="../images/chat_room_03.jpg"/></a>
        </div><!--end of group_btn_chat-->
    </div><!--end of container-->
</div><!--end of select_chat -->



<div class="" id="blackbg">
    <div class=" " id="tipsbox">

        <div class="col-sm-6">
            <h3 type="button" class="sub_ttl" id="login_id">登入</h3>
            <div>
                <form class="form-horizontal" enctype="multipart/form-data" action="file:///Macintosh HD/Users/CG/Library/Caches/com.binarynights.ForkLift2/%234/withdraw_suc.php" method="post" name="form" id="form_1">

                    <div class="form-group" style="margin-top: 30px">
                        <div class="col-xs-4 inputtitle form-fd"><span class="red_star">*</span>账户：</div>
                        <div class="col-xs-8 inputfield">
                            <input type="text" class="form-control" name="signin_id" id="signin_id" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-4 inputtitle form-fd"><span class="red_star">*</span>密码：</div>
                        <div class="col-xs-8 inputfield">
                            <input type="password" class="form-control" name="signin_pw" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-4 inputtitle form-fd"><span class="red_star">*</span>验证码：</div>
                        <div class="col-xs-8 inputfield" style="text-align: left">
                            <input type = "text" class="form-control" style="width:50%;display: inline-block" id="captcha" required name="captcha"/>
                            <span id="captcha_loading" style="display: none">加载中...</span><img id="captcha-image" src="" style="max-width: 90px; max-height: 34px; cursor: pointer" onclick="refresh_captcha()" title="点击刷新">
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-xs-6" style="margin-left:25%; margin-top:40px;"><a id="submitbtn" href="#" class="btn btn_submit" onclick="submitForm()">登入</a></div>

                        <div class="form-group">
                            <div class="col-xs-12" style="color: #666;line-height: 30px;font-size: 16px; margin-top: 30px;">请使用在本公司开立之真实账户号码及密码登入<br>如还不是本公司客户，可注册一个模拟账户予以登陆。</div>
                        </div>


                    </div>
                    <input type="hidden" name="form_dictionary" id="form_dictionary">
                </form>
            </div>

        </div>
        <div class="col-sm-6">

            <h3 type="button" class="sub_ttl" id="register_id">注册 </h3><span class="remind"><span class="red_star">*</span>必须填写</span>
            <form class="form-horizontal" action="http://ckbudwebt.tradingengine.net:21240/demo/regdemo_action_website.asp" method="post" name="form" id='form_2' hidden="true">

                <input type="hidden" name="m_lang" value="SC" />


                <div class="form-group" style="margin-top: 30px">
                    <div class="col-xs-3 inputtitle form-fd"><span class="red_star">*</span>称谓：</div><div class="col-xs-9 inputfield"><select class="form-control"  name="m_gender" required>
                            <option selected disabled>请选择</option>
                            <option value="MR">先生</option>
                            <option value="MRS">太太</option>
                            <option value="MISS">小姐</option>
                            <option value="MS">女士</option>
                        </select></div>
                </div>
                <div class="form-group">
                    <div class="col-xs-3 inputtitle form-fd"><span class="red_star">*</span>姓名：</div><div class="col-xs-9 inputfield"><input type="text" class="form-control" name="m_username" required /></div>
                </div>



                <div class="form-group">
                    <div class="col-xs-3 inputtitle form-fd"><span class="red_star">*</span>电邮：</div><div class="col-xs-9 inputfield"><input type="mail" class="form-control" name="m_emailaddress" required /></div>
                </div>
                <div class="form-group">
                    <div class="col-xs-3 inputtitle form-fd"><span class="red_star">*</span>电话：</div><div class="col-xs-9 inputfield"><input type="tel" class="form-control" name="m_phone" required /></div>
                </div>

                <div class="form-group">
                    <div class="col-xs-3 inputtitle form-fd"><span class="red_star">*</span>国家：</div><div class="col-xs-9 inputfield">
                        <select class="form-control"  name="m_country" required>
                            <option value="" selected disabled>请选择</option>
                            <option value="China">中国</option>
                            <option value="Hong Kong">香港特别行政区</option>
                            <option value="Macau">澳门特别行政区</option>
                            <option value="Taiwan">中国台湾</option>
                            <option value="Afghanistan">阿富汗</option>
                            <option value="Albania">阿尔巴尼亚</option>
                            <option value="Algeria">阿尔及利亚</option>
                            <option value="Andorra">安道尔</option>
                            <option value="Angola">安哥拉</option>
                            <option value="Anguilla">安圭拉</option>
                            <option value="Antarctica">南极洲</option>
                            <option value="Antigua and Barbuda">安提瓜和巴布达</option>
                            <option value="Argentina">阿根廷</option>
                            <option value="Armenia">亚美尼亚</option>
                            <option value="Aruba">阿鲁巴</option>
                            <option value="Australia">澳大利亚</option>
                            <option value="Austria">奥地利</option>
                            <option value="Azerbaijan">阿塞拜疆</option>
                            <option value="Bahamas">巴哈马</option>
                            <option value="Bahrain">巴林</option>
                            <option value="Bangladesh">孟加拉国</option>
                            <option value="Barbados">巴巴多斯</option>
                            <option value="Belarus">白俄罗斯</option>
                            <option value="Belgium">比利时</option>
                            <option value="Belize">伯利兹</option>
                            <option value="Benin">贝宁</option>
                            <option value="Bermuda">百慕大</option>
                            <option value="Bhutan">不丹</option>
                            <option value="Bolivia">玻利维亚</option>
                            <option value="Bosnia and Herzegovina">波斯尼亚和黑塞哥维那</option>
                            <option value="Botswana">博茨瓦纳</option>
                            <option value="Bouvet Island">布维岛</option>
                            <option value="Brazil">巴西</option>
                            <option value="British indian Ocean Territory">英属印度洋领土</option>
                            <option value="British Virgin Islands">英属维尔京群岛</option>
                            <option value="Brunei Darussalam">文莱</option>
                            <option value="Bulgaria">保加利亚</option>
                            <option value="Burkina Faso">布基纳法索</option>
                            <option value="Burundi">布隆迪</option>
                            <option value="Cambodia">柬埔寨</option>
                            <option value="Cameroon">喀麦隆</option>
                            <option value="Canada">加拿大</option>
                            <option value="Cape Verde">佛得角</option>
                            <option value="Cayman Islands">开曼群岛</option>
                            <option value="Central Africa">中非</option>
                            <option value="Chad">乍得</option>
                            <option value="Chile">智利</option>
                            <option value="Christmas Island">圣诞岛</option>
                            <option value="Cocos(Keeling) Islands">科科斯(基林)群岛</option>
                            <option value="Colombia">哥伦比亚</option>
                            <option value="Comoros">科摩罗</option>
                            <option value="Congo">刚果</option>
                            <option value="Cook Islands">库克群岛</option>
                            <option value="Costa Rica">哥斯达黎加</option>
                            <option value="Cote d Ivoire">科特迪瓦</option>
                            <option value="Croatia">克罗地亚</option>
                            <option value="Cuba">古巴</option>
                            <option value="Cyprus">塞浦路斯</option>
                            <option value="Czech Repoublic">捷克</option>
                            <option value="Denmark">丹麦</option>
                            <option value="Djibouti">吉布提</option>
                            <option value="Dominica">多米尼克</option>
                            <option value="Dominican Republic">多米尼加共和国</option>
                            <option value="East Timor">东帝汶</option>
                            <option value="Ecuador">厄瓜多尔</option>
                            <option value="Egypt">埃及</option>
                            <option value="El Salvador">萨尔瓦多</option>
                            <option value="Equatorial Guinea">赤道几内亚</option>
                            <option value="Eritrea">厄立特里亚</option>
                            <option value="Estonia">爱沙尼亚</option>
                            <option value="Ethiopia">埃塞俄比亚</option>
                            <option value="Faroe Islands">法罗群岛</option>
                            <option value="Fiji">斐济</option>
                            <option value="Finland">芬兰</option>
                            <option value="France">法国</option>
                            <option value="French Guiana">法属圭亚那</option>
                            <option value="French Polynesia">法属波利尼西亚</option>
                            <option value="French Southern Territories">法属南部领土</option>
                            <option value="Gabon">加蓬</option>
                            <option value="Gambia">冈比亚</option>
                            <option value="Georgia">格鲁吉亚</option>
                            <option value="Germany">德国</option>
                            <option value="Ghana">加纳</option>
                            <option value="Gibraltar">直布罗陀</option>
                            <option value="Greece">希腊</option>
                            <option value="Greenland">格陵兰</option>
                            <option value="Grenada">格林纳达</option>
                            <option value="Guadeloupe">瓜德罗普</option>
                            <option value="Guam">关岛</option>
                            <option value="Guatemala">危地马拉</option>
                            <option value="Guinea">几内亚</option>
                            <option value="Guine-bissau">几内亚比绍</option>
                            <option value="Guyana">圭亚那</option>
                            <option value="Haiti">海地</option>
                            <option value="Heard islands and Mc Donald Islands">赫德岛和麦克唐纳岛</option>
                            <option value="Honduras">洪都拉斯</option>
                            <option value="Hungary">匈牙利</option>
                            <option value="Iceland">冰岛</option>
                            <option value="India">印度</option>
                            <option value="Indonesia">印度尼西亚</option>
                            <option value="Iran">伊朗</option>
                            <option value="Iraq">伊拉克</option>
                            <option value="Ireland">爱尔兰</option>
                            <option value="Israel">以色列</option>
                            <option value="Italy">意大利</option>
                            <option value="Jamaica">牙买加</option>
                            <option value="Japan">日本</option>
                            <option value="Jordan">约旦</option>
                            <option value="Kazakhstan">哈萨克斯坦</option>
                            <option value="Kenya">肯尼亚</option>
                            <option value="Kiribati">基里巴斯</option>
                            <option value="Korea,Democratic Peoples Republic of">朝鲜</option>
                            <option value="Korea,Republic of">韩国</option>
                            <option value="Kuwait">科威特</option>
                            <option value="Kyrgyzstan">吉尔吉斯斯坦</option>
                            <option value="Lao">老挝</option>
                            <option value="Latvia">拉脱维亚</option>
                            <option value="Lebanon">黎巴嫩</option>
                            <option value="Lesotho">莱索托</option>
                            <option value="Liberia">利比里亚</option>
                            <option value="Libya">利比亚</option>
                            <option value="Liechtenstein">列支敦士登</option>
                            <option value="Lithuania">立陶宛</option>
                            <option value="Luxembourg">卢森堡</option>
                            <option value="Macedonia">马斯顿</option>
                            <option value="Madagascar">马达加斯加</option>
                            <option value="Malawi">马拉维</option>
                            <option value="Malaysia">马来西亚</option>
                            <option value="Maldives">马尔代夫</option>
                            <option value="Mali">马里</option>
                            <option value="Malta">马耳他</option>
                            <option value="Malvinas Islands (Falkland Islands)">马尔维纳斯群岛(福克兰群岛)</option>
                            <option value="Marshall Islands">马绍尔群岛</option>
                            <option value="Martinique">马提尼克</option>
                            <option value="Mauritania">毛里塔尼亚</option>
                            <option value="Mauritius">毛里求斯</option>
                            <option value="Mayotte">马约特</option>
                            <option value="Mexico">墨西哥</option>
                            <option value="Micronesia">密克罗尼西亚</option>
                            <option value="Moldova">摩尔多瓦</option>
                            <option value="Monaco">摩纳哥</option>
                            <option value="Mongolia">蒙古</option>
                            <option value="Montserrat">蒙特塞拉特</option>
                            <option value="Morocco">摩洛哥</option>
                            <option value="Mozambique">莫桑比克</option>
                            <option value="Myanmar">缅甸</option>
                            <option value="Namibia">纳米比亚</option>
                            <option value="Nauru">瑙鲁</option>
                            <option value="Nepal">尼泊尔</option>
                            <option value="Netherlands">荷兰</option>
                            <option value="Netherlands Antilles">荷属安的列斯</option>
                            <option value="New Caledonia">新喀里多尼亚</option>
                            <option value="New Zealand">新西兰</option>
                            <option value="Nicaragua">尼加拉瓜</option>
                            <option value="Niger">尼日尔</option>
                            <option value="Nigeria">尼日利亚</option>
                            <option value="Niue">纽埃</option>
                            <option value="Norfolk Island">诺福克岛</option>
                            <option value="Northern Marianas">北马里亚纳</option>
                            <option value="Norway">挪威</option>
                            <option value="Oman">阿曼</option>
                            <option value="Pakistan">巴基斯坦</option>
                            <option value="Palau">贝劳</option>
                            <option value="Palestine">巴勒斯坦</option>
                            <option value="Panama">巴拿马</option>
                            <option value="Papua New Guinea">巴布亚新几内亚</option>
                            <option value="Paraguay">巴拉圭</option>
                            <option value="Peru">秘鲁</option>
                            <option value="Philippines">菲律宾</option>
                            <option value="Pitcairn Islands Group">皮特凯恩群岛</option>
                            <option value="Poland">波兰</option>
                            <option value="Portugal">葡萄牙</option>
                            <option value="Puerto Rico">波多黎各</option>
                            <option value="Qatar">卡塔尔</option>
                            <option value="Reunion">留尼汪</option>
                            <option value="Romania">罗马尼亚</option>
                            <option value="Russia">俄罗斯</option>
                            <option value="Rwanda">卢旺达</option>
                            <option value="Saint helena">圣赫勒拿</option>
                            <option value="Saint Kitts and nevis">圣基茨和尼维斯</option>
                            <option value="Saint lucia">圣卢西亚</option>
                            <option value="Saint Pierre and Miquelon">圣皮埃尔和密克隆</option>
                            <option value="Saint Vincent and the Grenadines">圣文森特和格林纳丁斯</option>
                            <option value="San Marion">圣马力诺</option>
                            <option value="Sao Tome and Principe">圣多美和普林西比</option>
                            <option value="Saudi Arabia">沙竺阿拉伯</option>
                            <option value="Senegal">塞内加尔</option>
                            <option value="Seychells">塞舌尔</option>
                            <option value="Sierra leone">塞拉利昂</option>
                            <option value="Singapore">新加坡</option>
                            <option value="Slovakia">斯洛伐克</option>
                            <option value="Slovenia">斯洛文尼亚</option>
                            <option value="Solomon Islands">所罗门群岛</option>
                            <option value="Somalia">索马里</option>
                            <option value="South Africa">南非</option>
                            <option value="South Georgia and South Sandwich Islands">南乔治亚岛和南桑德韦奇岛</option>
                            <option value="Spain">西班牙</option>
                            <option value="Sri Lanka">斯里兰卡</option>
                            <option value="Sudan">苏丹</option>
                            <option value="Suriname">苏里南</option>
                            <option value="Svalbard and jan Mayen Islands">斯瓦尔巴群岛</option>
                            <option value="Swaziland">斯威士兰</option>
                            <option value="Sweden">瑞典</option>
                            <option value="Switzerland">瑞士</option>
                            <option value="Syria">叙利亚</option>
                            <option value="Tajikistan">塔吉克斯坦</option>
                            <option value="Tanzania">坦桑尼亚</option>
                            <option value="Thailand">泰国</option>
                            <option value="Togo">多哥</option>
                            <option value="Tokelau">托克劳</option>
                            <option value="Tonga">汤加</option>
                            <option value="Trinidad and Tobago">特立尼达和多巴哥</option>
                            <option value="Tunisia">突尼斯</option>
                            <option value="Turkey">土耳其</option>
                            <option value="Turkmenistan">土库曼斯坦</option>
                            <option value="Turks and Caicos Islands">特克斯科斯群岛</option>
                            <option value="Tuvalu">图瓦卢</option>
                            <option value="Uganda">乌干达</option>
                            <option value="Ukraine">乌克兰</option>
                            <option value="United Arab Emirates">阿联酋</option>
                            <option value="United Kingdom">英国</option>
                            <option value="United States">美国</option>
                            <option value="Uruguay">乌拉圭</option>
                            <option value="Uzbekistan">乌兹别克斯坦</option>
                            <option value="Vanuatu">瓦努阿图</option>
                            <option value="Vatican">梵蒂冈</option>
                            <option value="Venezuela">委内瑞拉</option>
                            <option value="Viet Nam">越南</option>
                            <option value="Wallis and Futuna Is-lands">瓦利斯和富图纳群岛</option>
                            <option value="Western Sahara">西撒哈拉</option>
                            <option value="Western Samoa">西萨摩亚</option>
                            <option value="Yemen">也门</option>
                            <option value="Yugoslavia">南斯拉夫</option>
                            <option value="Zaire">扎伊尔</option>
                            <option value="Zambia">赞比亚</option>
                            <option value="Zimbabwe">津巴布韦</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-3 inputtitle form-fd"><span class="red_star"></span>地址：</div><div class="col-xs-9 inputfield"><input type="text" class="form-control" name="addr1" /></div>
                </div>
                <div class="form-group">
                    <div class="col-xs-3 inputtitle"></div><div class="col-xs-9 inputfield"><input type="text" class="form-control" name="addr2" /></div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12"><input type="checkbox" id="checkbox_agree" required />&nbsp;我已阅读并同意以下<a href="terms_register.php" target="_blank" class="btn_terms_register"  data-fancybox-type="iframe" href="disclaimer.php">条款及细则</a>。</div>
                </div>
                <div class="form-group">
                    <div class="col-xs-6"><a class="btn btn_submit"><i class="fa fa-pencil" aria-hidden="true"></i> 提交</a></div><div class="col-xs-6"><a class="btn btn_cancel" ><i class="fa fa-refresh" aria-hidden="true"></i> 重置</a></div></div>
            </form>
        </div>
    </div>


    <div class="blackbg" onclick="hidetips()"></div>
</div>

<!-- Footer -->
<?php //include 'footer.php';  ?>
<!-- /.Footer -->

</body>

</html>
