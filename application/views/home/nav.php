<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                
                <a class="navbar-brand" href="index.php"><img src="../images/logo_04.png"></a>
                <a class="btn_nav"><i class="fa fa-bars"></i></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            
            
            <div class="slide_menu">
                <div class="top_menu"><ul>
                    <li><a class="btn_register" href="register.php">模拟帐户</a></li>
                    <li><a class="btn_signup" href="signup.php">开立帐户</a></li>
            </ul></div>
                <ul class="main_menu">
                    <li><a  >关于公司</a>
                    <ul class="menu_lv2">
                    	<li><a  href="about_us.php">公司简介</a></li>
                        <li><a  href="certificate.php">公司资质</a></li>
                        <li><a  href="press_release.php">公司公告</a></li>
                    </ul>
                    </li>
                    <li><a href="select_chat.php">智讯在线</a>
                        
                    </li>
                    <li><a   >财经消息</a>
                    <ul class="menu_lv2">
                    	<li><a href="news.php">即时新闻</a></li>
                    <li><a href="finance_calendar.php">财经日历</a></li>
                    <li><a href="market_review.php">金市评论</a></li>
                    </ul>
                    </li>
                    
                    <li><a >交易细则</a>
                    <ul class="menu_lv2">
                    	<li><a href="procedures.php">开户程序</a></li>
                    <li><a href="buy_sell_detail.php">买卖细则</a></li>
					<li><a href="deposit_withdrawal.php">资金存取</a></li>
                    </ul>
                    </li>
                    
					
                    <li><a >下载中心</a>
                        <ul class="menu_lv2">
                    <li><a href="download.php">平台下载</a></li>
                    <li><a href="download_form.php">表格下载</a></li>
                    
                    </ul>
                    </li>
                        <li><a href="contact_us.php">联络我们</a></li>
                    
            
                      
                    
                    
                </ul>
                <?php if(empty($_SESSION['account_id'])){?>
                <div class="signin"><a  href="signin.php" class="btn_signin" >客户登入</a></div>
                <?php } else { ?>
                <div class="username"><a class="btn_username" ><?php echo $_SESSION['account_data']->name;?></a>
                <div class="userbox">
                <a class="btn_userbox" href="logout.php">登出</a></div>
                </div>
                <?php } ?>

                
               <div class="lang"><a class=" btn_lang" href="javascript:getPath('/sc/','/tc/');">繁体 </a> | <a class="active btn_lang" >简体</a></div><!--end of lang--> 
            </div>
            <!-- end of slide_menu -->
           
            
        </div>
        <!-- end of container -->
    </nav>
    <div class="block"></div>
    <div class="block2"></div>