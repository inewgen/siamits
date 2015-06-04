<html>
	<head></head>
  <body>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-63483372-1', 'auto');
      ga('send', 'pageview');
    </script>
    <center>
    	<div style="margin-top:100px;">
   	<?php if (ENV_MODE == 'dev'): ?>
        	<img src="http://www.siamits.dev/public/themes/default/assets/img/comingsoon.png" width="454" height="456" />
    <?php else: ?>
    		<img src="http://www.siamits.com/public/themes/default/assets/img/comingsoon.png" width="454" height="456" />
    <?php endif;?>
    	</div>
      <div><font color="#666">Your IP : <?php echo $_SERVER['REMOTE_ADDR'];?></font></div>
    </center>
  </body>
</html>