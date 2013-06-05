<html>
	<head>
		<script type="text/javascript" src="/library/js/jquery-1.8.0.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('button.ga_trackable').click(function(){
                    _gaq.push(['_trackEvent','click',$(this).prop('id')]);
                });
			});
		</script>
		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-12087022-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>
	</head>
	<body>
		<?foreach(range(1,11) as $uniqId):?>
			<button class="ga_trackable" id="button_<?=$uniqId;?>">Button <?=$uniqId;?></button>
		<?endforeach;?>		
		

	</body>
</html>
