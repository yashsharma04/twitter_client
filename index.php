<?php
	session_start();
	require "vendor/autoload.php";
	use Abraham\TwitterOAuth\TwitterOAuth;

	define('CONSUMER_KEY', 'Hkv6RTJu4UjM1kdik6rkC1g1w'); // add your app consumer key between single quotes
	define('CONSUMER_SECRET', 'f14cQcYnlJ9U2i1iowLjVGd5KEonaHTjOONMzJMNENVVvcXy3s'); // add your app consumer secret key between single quotes
	define('OAUTH_CALLBACK', 'https://127.0.0.1/twitter_new/callback.php'); // your app callback URL

	if (!isset($_SESSION['access_token'])) {
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
		$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
		$_SESSION['oauth_token'] = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
		header("Location:".$url);		
	} 
	else 
	{
		$access_token = $_SESSION['access_token'];
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

		// echo $user->name ;
		// echo "<pre>";
		// print_r($user);
		// echo "</pre>";
		$get = $connection->get('statuses/home_timeline',array('count' => '5'));
		// echo "<pre>";
		// print_r($get);
		// echo "</pre>";
		$count =0 ;
		// echo $get[0]->text;
		// echo "<img src=".$img." alt='image'>";
		// 	<?php
				 						// $user = $connection->get("followers/ids");
				 						// echo "<pre>";
 				  				// 		print_r($user);
 				  				// 		echo "</pre>";
										?>
		
		?>


		<!doctype html>
		<html lang="en">
		<head>

			<meta charset="UTF-8">
    		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    		<meta name="viewport" content="width=device-width, initial-scale=1">

    		<!-- Bootstrap -->
    		<link href="css/bootstrap.min.css" rel="stylesheet">
			<title>Twitter Client</title>
			<link href='http://fonts.googleapis.com/css?family=Quicksand:300,400' rel='stylesheet' type='text/css'>
			<link href='http://fonts.googleapis.com/css?family=Lato:400,300' rel='stylesheet' type='text/css'>
			<link href="http://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
			<link href='css/style.css' rel='stylesheet' type='text/css'>

		</head>
		<body>
			 <!-- Fixed navbar -->
			    <nav class="navbar navbar-default navbar-fixed-top">
			      <div class="container">
			        <div class="navbar-header">
			          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			            <span class="sr-only">Toggle navigation</span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			          </button>
			          <a class="navbar-brand" href="#">Twitter</a>
			        </div>
			        <div id="navbar" class="navbar-collapse collapse">
			          <ul class="nav navbar-nav">
			            <li class="active"><a href="#">Home</a></li>
			            <li><a href="#about">Notifications</a></li>
			            <li><a href="#contact">Messages</a></li>
			          </ul>
			        </div><!--/.nav-collapse -->
			      </div>
			    </nav>

			<div class='container wid'>
			<!-- code start -->
			<div class="twPc-div">
			    <a class="twPc-bg twPc-block"></a>

				<div>
					<div class="twPc-button">
			            <!-- Twitter Button | you can get from: https://about.twitter.com/tr/resources/buttons#follow -->
			            <a href="https://twitter.com/mertskaplan" class="twitter-follow-button" data-show-count="false" data-size="large" data-show-screen-name="false" data-dnt="true">Follow @mertskaplan</a>
			            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			            <!-- Twitter Button -->   
					</div>

					<a title="Mert Salih Kaplan" href="https://twitter.com/mertskaplan" class="twPc-avatarLink">
						<img alt="YASH SHARMA" src="" class="twPc-avatarImg">
					</a>

					<div class="twPc-divUser">
						<div class="twPc-divName">
							<?php
				 				$user = $connection->get("account/verify_credentials");
 				  				echo $user->name;
							?>
						</div>
						<span>
							<a href="https://twitter.com/mertskaplan">@<span><?php
				 				$user = $connection->get("account/verify_credentials");
 				  				echo $user->screen_name;
							?></span></a>
						</span>
					</div>

					<div class="twPc-divStats">
						<ul class="twPc-Arrange">
							<li class="twPc-ArrangeSizeFit">
								<a href="https://twitter.com/mertskaplan" title="9.840 Tweet">
									<span class="twPc-StatLabel twPc-block">Tweets</span>
									<span class="twPc-StatValue">1</span>
								</a>
							</li>
							<li class="twPc-ArrangeSizeFit">
								<a href="https://twitter.com/mertskaplan/following" title="885 Following">
									<span class="twPc-StatLabel twPc-block">Following</span>
									<span class="twPc-StatValue">196</span>
								</a>
							</li>
							<li class="twPc-ArrangeSizeFit">
								<a href="https://twitter.com/mertskaplan/followers" title="1.810 Followers">
									<span class="twPc-StatLabel twPc-block">Followers</span>
									<span class="twPc-StatValue">25</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- code end -->


			<div class='cont'>
				<span class="first"> 
				<?php
				 $user = $connection->get("account/verify_credentials");
 				  echo $user->screen_name;
				?>
				<span class="icon-edit new"></span>
			</span>
			<ul class="timeline">
				<li>
					<div class="avatar">
						
						<?php
							$img =  $get[$count]->user->profile_image_url ;
							echo "<img src=".$img." alt='image'>";
						?>
						<div class="hover">
							<div class="icon-twitter"></div>
						</div>
					</div>
					<div class="bubble-container">
						<div class="bubble">
						<div class="retweet">
							<div class="icon-retweet"></div>
						</div>
							
							<?php
								echo $get[$count]->text;
								$count = $count +1 ;
							?>
							<div class="over-bubble">
								<div class="icon-mail-reply action"></div>
								<div class="icon-retweet action"></div>
								<div class="icon-star"></div>
							</div>
						</div>
						
						<div class="arrow"></div>
					</div>
				</li>
				<li>
					<div class="avatar">
						<?php
							$img =  $get[$count]->user->profile_image_url ;
							echo "<img src=".$img." alt='image'>";
						?>
						<div class="hover">
							<div class="icon-twitter"></div>
						</div>
					</div>
					<div class="bubble-container">
						<div class="bubble">
							
													<?php
								echo $get[$count]->text;
								$count = $count +1 ;
							?>
							<div class="over-bubble">
								<div class="icon-mail-reply action"></div>
								<div class="icon-retweet action"></div>
								<div class="icon-star"></div>
							</div>
						</div>
						<div class="arrow"></div>
					</div>
				</li>
				<li>
					<div class="avatar">
						<?php
							$img =  $get[$count]->user->profile_image_url ;
							echo "<img src=".$img." alt='image'>";
						?>
						<div class="hover">
							<div class="icon-twitter"></div>
						</div>
					</div>
					<div class="bubble-container">
						<div class="bubble">
												<?php
								echo $get[$count]->text;
								$count = $count +1 ;
							?>
							<div class="over-bubble">
								<div class="icon-mail-reply action"></div>
								<div class="icon-retweet action"></div>
								<div class="icon-star"></div>
							</div>
						</div>
						<div class="arrow"></div>
					</div>
				</li>
				<li>
					<div class="avatar">
						<?php
							$img =  $get[$count]->user->profile_image_url ;
							echo "<img src=".$img." alt='image'>";
						?>
						<div class="hover">
							<div class="icon-twitter"></div>
						</div>
					</div>
					<div class="bubble-container">
						<div class="bubble">
													<?php
								echo $get[$count]->text;
								$count = $count +1 ;
							?>
							<div class="over-bubble">
								<div class="icon-mail-reply action"></div>
								<div class="icon-retweet action"></div>
								<div class="icon-star"></div>
							</div>
						</div>
						<div class="arrow"></div>
					</div>
				</li>
			</ul>
			</div>
			</div>
			 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		    <!-- Include all compiled plugins (below), or include individual files as needed -->
		    <script src="js/bootstrap.min.js"></script>
		</body>
		</html>


		<?php

	}
?>