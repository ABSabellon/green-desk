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
		}
	</style>
</head>
<body>
	<div class="row visible-lg">
		<div class="col-lg-12">
			&nbsp;
			<div class="row">
				<div class="col-lg-4">
					&nbsp;
				</div>
				<div class="col-lg-4" style="padding-top:5%;">
					<center><img src="https://media.taiga.io/project/f/2/2/d/f0f5cdadddd9c6736d45ced10463aed669da5760b4dd4e7e02b81a44da4f/greendesk.png.300x300_q85_crop.png" style="width:40%"></center>
					<br>
					<div class="col-lg-1">
						&nbsp;
					</div>
					<div class="col-lg-12 indexdiv" style="padding-left:10%; padding-right:10%; padding-top:5%;">
						<div class="col-lg-6">
							<a class="btn btn-default btn-block btn-round" href="/gradeconsultation">Grade Consulation </a>
						</div>
						<div class="col-lg-6">
							<a class="btn btn-default btn-block btn-round" href="/finalexams">Final Exam</a>
						</div>
					</div>
					<div class="col-lg-1">
						&nbsp;
					</div>
				</div>
				<div class="col-lg-4">
					&nbsp;
				</div>
			</div>
		</div>
	</div>
</body>
</html>


