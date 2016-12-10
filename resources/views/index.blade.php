<!DOCTYPE html>
<html lang="en">
<head>
	<title>
		Green Desk
	</title>
	
	<!-- Token used to verify ajax requests -->
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="{{ URL::to('utils/bootstrap-3.3.6-dist/css/bootstrap.min.css') }}">
	<!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->

	<!-- jQuery library -->
	<script type="text/javascript" src="{{ URL::to('utils/jquery.min.js') }}"></script>
	<script src="{{ URL::to('utils/jquery-ui.js') }}"></script>
	<script src="{{ URL::to('utils/jquery.searchabledropdown-1.0.8.min.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::to('utils/jquery-ui.css') }}">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->

	<!-- Latest compiled JavaScript -->
	<script type="text/javascript" src="{{ URL::to('utils/bootstrap-3.3.6-dist/js/bootstrap.min.js') }}"></script>
	
	<!-- Styles -->
	<link rel="stylesheet" href="{{ URL::to('css/newView_GC_Style.css') }}">
	<style type="text/css">
		body{
			background-attachment:fixed;
			background-image:url('images/dlsustc.jpg');
			background-size:1600px 1063px;
			background-repeat: no-repeat;
			background-size:cover;
			overflow-x:hidden;
		}
		h1{
			color: #fff;
			text-transform: uppercase;
			font-family: Tahoma;
			font-size: 350%;
		}
		.indexbtn{
			background: #72a114;
			border: 0;
			color: #fff;
			display: block;
			margin: 2rem 2vw 0;
			padding: .75rem 0;
			text-align: center;
			padding: 6px 40px;
			padding: .4rem 2.5rem;
		}
		#background{
			background: linear-gradient(137deg, rgb(8, 255, 6) 35%, rgba(8,230,6,1) 75%, rgba(8,225,6,1) 57%);
			position: absolute;
			top: 0;
			right: 0;
			bottom: 0;
			left: 0;
			opacity: 0.4;
		}
		#top, #bottom, #left, #right {
			background: #fff;
			position: fixed;
		}
		#left, #right {
			top: 0; bottom: 0;
			width: 15px;
		}
		#left { left: 0; }
		#right { right: 0; }
		
		#top, #bottom {
			left: 0; right: 0;
			height: 15px;
		}
		#top { top: 0; }
		#bottom { bottom: 0; }

	</style>
</head>
<body>
	<div id="background"></div>
	<div id="left"></div>
	<div id="right"></div>
	<div id="top"></div>
	<div id="bottom"></div>

	
	<div class="col-lg-6 col-lg-offset-3" style="padding-top:9%;">
		<div class="row">
			<center>
				<img src="https://media.taiga.io/project/f/2/2/d/f0f5cdadddd9c6736d45ced10463aed669da5760b4dd4e7e02b81a44da4f/greendesk.png.300x300_q85_crop.png" style="width:25%">
			</center>
		</div>
		<div class="row">
			&nbsp;
		</div>
		<div class="row">
			<center>
				<h1>A Tool for room assignments</h1>
			</center>
		</div>
		<div class="row">
			&nbsp;
		</div>

		<div class="row">
			<div class="col-lg-6 col-lg-offset-3">
				<center>
					<a class="btn-lg btn-block btn-primary" href="/gradeconsultation">GET STARTED</a>
				</center>
			</div>
		</div>
	</div>
</body>
</html>


