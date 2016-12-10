<html>

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
	<link rel="stylesheet" href="{{ URL::to('utils/jquery-ui.css') }}">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->

	<!-- Latest compiled JavaScript -->
	<script type="text/javascript" src="{{ URL::to('utils/bootstrap-3.3.6-dist/js/bootstrap.min.js') }}"></script>
	
	<!-- Styles -->
	<link rel="stylesheet" href="{{ URL::to('css/newView_GC_Style.css') }}">
	
</head>

<body>

	<!-- Import Prof Modal -->
	<div id="importProfModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- View Prof Modal content-->
			<div class="modal-content">
				<div id="reservation">
					{!! Form::open(array('url'=>route('professor.import'),'method'=>'POST', 'files'=>true))!!}
					{{ csrf_field() }}
					<div class="modal-header modalHeadStyle">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title modalTitle">Import Professors</h4>
					</div>
					<div class="modal-body">
						<input type="file" name="importfile"/>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-block button">Import</button>
						<button type="button" class="btn btn-block button" data-dismiss="modal">Close</button>
					</div>
					{!! Form::close() !!}
				</div>
			</div>

		</div>
	</div>

	<!-- Add Prof Modal -->
	<div id="addProfModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Add Prof Modal content-->
			<div class="modal-content">
				<div id="reservation">
					<div class="modal-header modalHeadStyle">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title modalTitle">Add Professor</h4>
					</div>
					<div class="modal-body">
						<ul>
							<li><textarea id = "firstName" class="profText" placeholder="First Name" required=""></textarea></li>
							<li><textarea id = "lastName" class="profText" placeholder="Last Name" required=""></textarea></li>
							<li>
								<label for = "typeOp">Type:</label>
								<div id = "typeOp">
									<form id = "typeForm">
										<label class="radio-inline"><input type="radio" name="optradio" value = "Full Time">Full Time</label>
										<label class="radio-inline"><input type="radio" name="optradio" value = "Part Time">Part Time</label>
									</form>
								</div>
							</li>
							<li><label for="collegeSelect">College:
								<select class = "form-control" id = "collegeSelect">
									<option>CCS</option>
									<option>GCOE</option>
									<option>COS</option>
									<option>RVCOB</option>
									<option>CLA</option>
									<option>COED</option>
									<option>SOE</option>
								</select>
							</li>
							<li>
								<label for = "typeOp">Base:</label>
								<div id = "typeOp">
									<form id = "baseForm">
										<label class="radio-inline"><input type="radio" name="optradio" value = "Manila">Manila</label>
										<label class="radio-inline"><input type="radio" name="optradio" value = "STC">STC</label>
									</form>
								</div>
							</li>
						</ul>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default button" id="doneBtn">Done</button>
						<button type="button" class="btn btn-default button" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>

		</div>
	</div>

	<!-- ----------TOOLBAR---------- -->
	<!-- ----------MAIN CONTAINER----------- -->
	<div class="container-fluid">
		<div class="row">
			<!-- ----------TOOLBAR---------- -->
			<nav class="navbar navbar-default" id = "toolbar">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="/" id="toolTitle">
							Green Desk
						</a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a href="/gradeconsultation">Grade Consultation</a></li>
							<li><a href="/finalexams" >Finals</a></li>
							<li class="active"><a href="/proflist" >Professor List</a></li>
						</ul> 
					</div><!--/.nav-collapse -->
				</div><!--/.container-fluid -->
			</nav>
		</div>
	</div>

	<div class="row" id="firstRow">
		<div class = "col-xs-4">
		</div>
		<div class = "col-xs-8">
			<p style = "margin-left: -40px;">
				<input id = "searchRes" type="search" placeholder="Search..." class = "searchBar" />
				Filter by: 
				<select id = "filterSearch">
					<option value = "0">first name</option>
					<option value = "1">middle name</option>
					<option value = "2">last name</option>
					<option value = "3">type</option>
					<option value = "4">college</option>
					<option value = "5">base</option>
				</select>
			</p>
		</div>
	</div>
	<br/>
	<div id="viewProfModal" class="panel panel-default">
		
		<div id="reservation">
			<div class="panel-heading">
				<h2 class="modal-title modalTitle">Professor List</h2>
			</div>
			<div class="panel-body" id = "profTable">
				<table id = "profTbl" class="table table-condensed searchableTable">
					<thead>
						<tr>
							<th>Firstname</th>
							<th>Middle Initial</th>
							<th>Lastname</th>
							<th>Type</th>
							<th>College</th>
							<th>Base</th>
							<th>Active</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody id = "profList">
						
					</tbody>
				</table>
			</div>
			<div class="panel-footer">
				<button type="button" class="btn button" data-toggle="modal" data-target="#addProfModal">Add New Professor</button>
				<button type="button" class="btn button" data-toggle="modal" data-target="#importProfModal">Import Professors</button>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	var urlGetProfessors = '{{ route("get.professors") }}';
	var urlAddProfessor = '{{ route("add.professor") }}';
	var urlSetActive = '{{ route("set.active") }}';
	var urlEditProf = '{{ route("edit.professor") }}';
	var urlDeleteProf = '{{ route("delete.professor") }}';


	$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#inputWarning').hide();
	retrieveProfessors(null);
});
</script>
<script src="{{ URL::to('js/professors.js') }}"></script>
<script src="{{ URL::to('js/searching.js') }}"></script>
