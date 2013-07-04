<?php
session_start();

if($_COOKIE['page_access']){
	define('INCLUDE_CHECK', TRUE);
}
if(!defined('INCLUDE_CHECK')){
	header("Location: ../index.php");
	exit();
}
include '../connect.php';

 $_SESSION['userID'] = $_COOKIE['userID'];
// echo $_COOKIE['userID'];
$imp = $_COOKIE['userID'];
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="../favicon.ico" />
	<title>User Dashboard</title>
	
	<style type="text/css">
     * { margin:0; padding:0;}
    body {
        /* background: url('earth.jpg') center; */
        text-align: center;
    }
    </style>
    
    <link rel="stylesheet" type="text/css" href="dashboard.css" media="all" />
    <link rel="stylesheet" type="text/css" href="theme.default/default.css" media="all" />

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <!--
        -->		
	<script type="text/javascript" src="lightbox/lib/jquery-1.8.2.min.js"></script>
  	<!-- Add fancyBox main JS and CSS files -->
  	<script type="text/javascript" src="lightbox/source/jquery.fancybox.js?v=2.1.3"></script>
  	<link rel="stylesheet" type="text/css" href="lightbox/source/jquery.fancybox.css?v=2.1.2" media="screen" />
  
  	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>
	<script type="text/javascript">
        jQuery.fn.center = function () {
            this.css("left", ( $(window).width() - this.width() ) / 2 + $(window).scrollLeft() + "px");
            return this;
        }

        //document ready
        $(function(){
            $('#dashboard').center();
        });
        
        //window resize
        $(window).resize(function() {
            $('#dashboard').center();
        });        
    </script>

</head>

<body background="./swirls.jpg" style="background-repeat: no-repeat;">
	<div id="other_content">
		<h1 style="font-size: 60px; color: #123456;">User Dashboard</h1><br />
		<h3>
			<?php 
				$query = "SELECT * FROM members WHERE uid=\"".$imp."\"";
				$result = mysql_query($query, $link);
				$row = mysql_fetch_array($result);
				echo "Welcome ".$row['usr'];				
		  	?>
		</h3>
	</div>
	<div id="dashboard">
        <div id="left_shelf"></div>
        <div id="shelf">
            <ul id="menu_dashboard">
                <li><a class="fancybox fancybox.iframe" href="product_template.php?userID=<?php echo $imp; ?>"><img id="button1" src="my_images/messenger.png" alt="Apple" onclick="my_func(this.id)" /></a></li>
                <li><a class="fancybox fancybox.iframe" href="image_gallery/web/index.php?userID=<?php echo $imp; ?>"><img src="my_images/image.png" alt="Home" /></a></li>
                <li><a class="fancybox fancybox.iframe" href="addressbook/index.php?userID=<?php echo $imp; ?>"><img src="my_images/blue contacts.png" alt="Safari" /></a></li>
                <li><a class="fancybox fancybox.iframe" href="media_player/media.php?userID=<?php echo $imp; ?>"><img src="my_images/music.png" alt="Tools" /></a></li>
                <li><a class="fancybox fancybox.iframe" href="bookmarks.php?userID=<?php echo $imp; ?>"><img src="my_images/bookmark.png" alt="Tools" /></a></li>
                
                <li class="separator">&nbsp;</li> 
                
                <li><a class="fancybox fancybox.iframe" href="file_manager.php?userID=<?php echo $imp; ?>"><img src="my_images/Files.png" alt="harddrive" /></a></li>
                <li><a class="fancybox fancybox.iframe" href="upload.php?userID=<?php echo $imp; ?>"><img src="my_images/upload.png" alt="harddrive" /></a></li>
                <li><a href="../index.php?logoff"><img src="my_images/logout.png" alt="harddrive" /></a></li>
            </ul>
        </div>
        <div id="right_shelf"></div>
    </div>
    <!--
    <form name="form2" id="form2" method="post" action="google.com" onsubmit="openWindow(300, 300, 'google.com');">
		<input type="submit" value="click here"/>
	</form>
	-->
</body>
</html>