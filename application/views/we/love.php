
<!DOCTYPE HTML>
<html>
<head>
    <title>Our Love Story</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <style type="text/css">
        @font-face {
            font-family: digit;
            /*src: url('digital-7_mono.ttf') format("truetype");*/
        }
    </style>
    <link href="/static/we/css/default.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="/static/we/js/jquery.js"></script>
    <script type="text/javascript" src="/static/we/js/garden_dev.js"></script>
    <script type="text/javascript" src="/static/we/js/functions_dev.js"></script>
</head>

<body>
<div id="mainDiv">
    <div id="content">
        <div id="code">
            <span class="comments">和你在一起的每一天都很耀眼，</span><br/>
            <span class="comments">因为天气好，</span><br/>
            <span class="comments">因为天气不好，</span><br/>
            <span class="comments">因为天气刚刚好，</span><br/>
            <span class="comments">每一天都很美好，</span><br/>
            <span class="comments">你是这个世界写给我的最美好的情书，</span><br/>
            <span class="comments">我想在我们老了的时候，</span><br/>
            <span class="comments">仍然能牵起你的手，</span><br/>
            <span class="comments">在夕阳的余晖下漫步海滩，</span><br/>
            <span class="comments">对全世界微笑，</span><br/>
            <span class="comments">你是我一生中最大的骄傲。</span><br/>

        </div>

        <div id="loveHeart">
            <canvas id="garden"></canvas>
            <div id="words">
                <div id="messages">
                    蔡倩青, I have fallen in love with you for
                    <div id="elapseClock"></div>
                </div>
                <div id="loveu">
                    Love you forever and ever.<br/>
                    <div class="signature">- 胡杨</div>
                </div>
            </div>
        </div>
    </div>
    <div id="copyright">

        Copyright © 2017/08/24
    </div>
</div>
<script type="text/javascript">
    var offsetX = $("#loveHeart").width() / 2;
    var offsetY = $("#loveHeart").height() / 2 - 55;
    var displayMode = 1;
    var together = new Date();
    together.setFullYear(2017, 2, 2);
    together.setHours(18);
    together.setMinutes(0);
    together.setSeconds(0);
    together.setMilliseconds(0);

    $("#loveHeart").click(function(){
        displayMode *= -1;
        timeElapse(together, displayMode);
    });

    if (!document.createElement('canvas').getContext) {
        var msg = document.createElement("div");
        msg.id = "errorMsg";
        msg.innerHTML = "Your browser doesn't support HTML5!<br/>Recommend use Chrome 14+/IE 9+/Firefox 7+/Safari 4+";
        document.body.appendChild(msg);
        $("#code").css("display", "none")
        $("#copyright").css("position", "absolute");
        $("#copyright").css("bottom", "10px");
        document.execCommand("stop");
    } else {
        setTimeout(function () {
            adjustWordsPosition();
            startHeartAnimation();
        }, 5000);

        timeElapse(together, displayMode);
        setInterval(function () {
            timeElapse(together, displayMode);
        }, 500);

        adjustCodePosition();
        $("#code").typewriter();
    }
</script>
</body>
</html>
