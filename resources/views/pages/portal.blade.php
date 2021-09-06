@extends('layouts.app')

@section('custom-css')

<link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">

@endsection

@section('content')

<div class="card transparent mt-2">
  	<div id="top-nav" class="card-body p-0">
    	<!--Navbar -->
		<nav class="navbar navbar-expand-lg navbar-dark trans-blue-bg">
		  	<span class="navbar-brand" style="font-size: 10pt;">
		  		<strong>
                    <i class="far fa-calendar-alt"></i> 
                    <span id="datetime-display">TODAY IS {{ strtoupper(date('l : F j, Y')) }} [ {{ date('h:i:sa') }} ]</span>
                </strong>
		  	</span>
		  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content"
		    	    aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
		    	<span class="navbar-toggler-icon"></span>
		  	</button>
		  	<div class="collapse navbar-collapse" id="navbar-content">
		    	<ul class="navbar-nav ml-auto nav-flex-icons">
                    @if (!Auth::user())
                    <li class="nav-item">
                        <a class="nav-link" id="btn-show-register" aria-haspopup="true"
                           aria-expanded="false">
                            <strong><i class="fas fa-marker"></i> Sign-up</strong>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-haspopup="true" aria-expanded="false"
                           data-toggle="modal" data-target="#modal-login">
                            <strong><i class="fas fa-user"></i> Log-in</strong>
                        </a>
                    </li>
                    @else
                    <li class="nav-item avatar dropdown">
                        <a class="nav-link waves-effect waves-light" id="userdropdown" data-toggle="dropdown" 
                           aria-haspopup="true" aria-expanded="false">
                            <img src="{{ url(Auth::user()->avatar) }}" 
                                 class="rounded-circle z-depth-0" alt="avatar image" width="25px">
                            <strong> {{ Auth::user()->firstname }}</strong>
                        </a>
                        <div class="dropdown-menu dropdown-mdb-color" 
                             aria-labelledby="userdropdown">
                            <a class="dropdown-item waves-effect waves-light" href="#">
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item waves-effect waves-light" href="{{ url('logout') }}">
                                Logout
                            </a>
                        </div>
                    </li>
                    @endif
		    	</ul>
		  	</div>
		</nav>
		<!--/.Navbar -->
  	</div>
</div>

<div class="row mt-3">
	<div class="col-xs-12 col-md-8">
		<div class="card trans-blue-bg z-depth-1">
			<div class="card-body">
				<ul class="nav nav-tabs blue-grey" id="myTab" role="tablist">
                    @if (count($recordTypes) > 0)
                        @foreach ($recordTypes as $rType)
					<li class="nav-item tab-text-size">
					    <a class="{{ $rType->id == $firstRecordType ? ' active': '' }}
                                  nav-link tab-text"
                           id="tab-{{ $rType->elem_id }}" data-toggle="tab" 
                           href="#{{ $rType->elem_id }}" role="tab" 
					       aria-controls="{{ $rType->elem_id }}"
					       aria-selected="true">
					   		<i class="{{ $rType->fa_icon }}"></i> {{ $rType->type }}
					   	</a>
					</li>
                        @endforeach
                    @endif

                    <li class="nav-item">
                        <a class="nav-link tab-text" id="tab-search-record" 
                           data-toggle="tab" href="#search-record" role="tab" 
                           aria-controls="other-records"
                           aria-selected="false">
                            <strong><i class="fas fa-search"></i> Search All</strong>
                        </a>
                    </li>

                    @if (Auth::user() && Auth::user()->role != 3)
                    <li class="nav-item ml-5">
                        <a class="nav-link tab-text primary-color" id="tab-add-edit-record-types" 
                           data-toggle="tab" href="#add-edit-record-types" role="tab" 
                           aria-controls="add-edit-record-types"
                           aria-selected="false">
                            <strong><i class="fas fa-keyboard"></i> Add/Edit Types</strong>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tab-text green" id="tab-add-record" 
                           data-toggle="tab" href="#add-record" role="tab" 
                           aria-controls="add-records"
                           aria-selected="false">
                            <strong><i class="fas fa-folder-plus"></i> Add Record</strong>
                        </a>
                    </li>
                    @endif
				</ul>

				<div class="tab-content white">
                    @if (count($recordTypes) > 0)
                        @foreach ($recordTypes as $rType)
                    <div class="{{ $rType->id == $firstRecordType ? ' show active': '' }} 
                                tab-pane fade p-2" id="{{ $rType->elem_id }}" 
                         role="tabpanel" aria-labelledby="tab-{{ $rType->elem_id }}">
                        <div class="table-responsive table-custom-height">
                            <div id="{{ $rType->elem_id }}-content">
                                <table class="table table-hover table-bordered table-sm m-0">
                                    <thead>
                                        <tr>
                                            <th class="table-txt text-center" width="2%">
                                                <strong>#</strong>
                                            </th>
                                            <th class="table-txt text-center" width="38%">
                                                <strong>
                                                    {{ $rType->type == 'Announcement' ? $rType->type: 'Title' }}
                                                </strong>
                                            </th>
                                            <th class="table-txt text-center" width="15%">
                                                <strong>Subject</strong>
                                            </th>
                                            <th class="table-txt text-center" width="15%">
                                                <strong>Due Date</strong>
                                            </th>
                                            <th class="table-txt text-center" width="15%">
                                                <strong>Remarks</strong>
                                            </th>
                                            <th class="table-txt text-center" width="15%">
                                                <strong>Posted By</strong>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($records) > 0)
                                            @foreach ($records as $itmCtr => $record)
                                        <tr onclick="$(this).showView('{{ $record->id }}', 'record', '{{ $record->record_type }}');"
                                            class="cursor-pointer">
                                            <td class="table-txt text-center">{{ $itmCtr + 1 }}</td>
                                            <td class="table-txt">{{ $record->title }}</td>
                                            <td class="table-txt">{{ $record->subject }}</td>
                                            <td class="table-txt text-center">
                                                {{ ($record->date_due == '0000-00-00' || !$record->date_due) ? 'N/a' : $record->date_due }}
                                            </td>
                                            <td class="table-txt">{{ $record->remarks }}</td>
                                            <td class="table-txt">{{ $record->user }}</td>
                                        </tr>  
                                            @endforeach
                                        @else
                                        <tr>
                                            <td colspan="6" class="text-danger">
                                                <center>
                                                    <strong>There is no record/s.</strong>
                                                </center>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        @endforeach
                    @endif

                    <!-- Search Records -->
                    <div class="tab-pane fade" id="search-record" 
                         role="tabpanel" aria-labelledby="tab-search-record">
                        <div class="md-form m-0 p-3">
                            <input id="inp-search-record" class="form-control m-0" type="text" 
                                   placeholder="Search" aria-label="Search" autocomplete="false" 
                                   onkeyup="$(this).searchRecord();">
                        </div>
                        <hr class="m-0">
                        <div class="table-responsive table-custom-height pl-5 pr-5 pt-3">
                            <div id="search-display" class="well">
                                <p class="grey-text"> Please fill-up the search field.</p>
                            </div>
                        </div>
                    </div>

                    @if (Auth::user())

                    <!-- Add Record Types -->
                    <div class="tab-pane fade" id="add-edit-record-types" 
                         role="tabpanel" aria-labelledby="tab-add-edit-record-types">
                        <form id="form-create-record-type" action="{{ route('store-record-type') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="md-form m-0 p-3">
                                <div class="md-form">
                                    <i class="fas fa-keyboard prefix"></i>
                                    <input type="text" id="r-type" name="r_type" class="form-control" required>
                                    <label for="r-type" class="">
                                        &nbsp;Record Type
                                    </label>
                                </div> 

                                <div class="md-form">
                                    <i class="fas fa-grip-horizontal prefix"></i>
                                    <input type="text" id="r-icon" name="r_icon" class="form-control" value="far fa-file" required>
                                    <label for="r-icon">
                                        &nbsp;Record Type Icon
                                    </label>
                                </div>
                            </div>

                            <input type="hidden" id="form-action-record-type" value="{{ route('store-record-type') }}">
                        </form>
                        <hr class="m-0">
                        <div class="table-responsive table-custom-height pl-5 pr-5 pt-3">
                            <div id="add-edit-types-display" class="well">
                                <p>Existing Record Types:</p>
                                <form id="form-update-record-type-order" action="{{ route('update-record-type-order') }}" method="POST">
                                    {{ csrf_field() }}

                                    <table class="table table-hover table-bordered table-fixed table-sm m-0 mb-4">
                                        <tbody class="sortable">
                                            @if (count($recordTypes) > 0)
                                            @foreach ($recordTypes as $rType)
                                                    @if ($rType->id != 1)
                                            <tr onclick="$(this).showView('{{ $rType->id }}', 'record-type', '3');" class="cursor-pointer">
                                                <td width="2%">
                                                    <i class="fas fa-arrows-alt"></i>
                                                    <input type="hidden" name="rec_id[]" value="{{ $rType->id }}">
                                                </td>
                                                <td>&nbsp;&nbsp;{{ $rType->type }}</td>
                                            </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <div class="btn-group btn-block" role="group">
                            <button onclick="$(this).store('#form-create-record-type', '#form-action-record-type');" 
                                    class="btn btn-green btn-md">
                                <i class="fas fa-folder-plus"></i> Add
                            </button>
                            <button onclick="$(this).updateRecordTypeOrder();" class="btn btn-orange btn-md">
                                <i class="fas fa-align-right"></i> Update Order
                            </button>
                        </div>
                    </div>

                    <!-- Add Records -->
                    <div class="tab-pane fade" id="add-record" 
                         role="tabpanel" aria-labelledby="tab-add-record">
                        <div class="m-0 p-3">
                            <select id="sel-record-type" class="w-100">
                                <option value="0">---- Select a record type ----</option>

                                @if (count($recordTypes) > 0)
                                    @foreach ($recordTypes as $rType)
                                        @if ($rType->id != 1)
                                <option value="{{ $rType->id }}">{{ $rType->type }}</option>
                                        @endif
                                    @endforeach
                                @endif

                                <!--<option value="new-tab">New Tab</option>-->
                            </select>
                        </div>
                        <hr class="m-0">
                        <div class="table-responsive table-custom-height pl-5 pr-5 pt-3">
                            <div id="add-record-display" class="well">
                                <p class="grey-text"> Please select a record type.</p>
                            </div>
                        </div>
                        <button id="btn-add-record" class="btn btn-green btn-md btn-block">
                            <i class="fas fa-folder-plus"></i> Add
                        </button>
                    </div>
                    @endif
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-4">
		<div class="card trans-blue-bg z-depth-1 h-100">
			<div class="card-body text-blue">
				<div class="card-title text-white">
					<strong><i class="fas fa-calendar-day"></i>  Events</strong>
				</div>
				<div class="table-responsive table-custom-height-2 white">
					<table class="table table-hover table-bordered table-sm m-0">
						<thead>
							<tr>
								<th class="table-txt text-center">
									<strong>#</strong>
								</th>
								<th class="table-txt text-center">
									<strong>Event Name</strong>
								</th>
								<th class="table-txt text-center">
									<strong>Type</strong>
								</th>
								<th class="table-txt text-center">
									<strong>Date Start</strong>
								</th>
								<th class="table-txt text-center">
									<strong>Time Start</strong>
								</th>
								<th class="table-txt text-center">
									<strong>Date End</strong>
								</th>
							</tr>
						</thead>
                        <tbody>
                            @if (count($memos) > 0)
                                @foreach ($memos as $itmCtr => $memo)
                            <tr>
                                <td class="table-txt text-center">{{ $itmCtr + 1 }}</td>
                                <td class="table-txt">{{ $memo->event }}</td>
                                <td class="table-txt">{{ $memo->type }}</td>
                                <td class="table-txt">{{ $memo->startDate }}</td>
                                <td class="table-txt">{{ $memo->startTime }}</td>
                                <td class="table-txt">{{ $memo->endDate }}</td>
                            </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="6" class="text-danger">
                                    <center>
                                        <strong>There is no memo.</strong>
                                    </center>
                                </td>
                            </tr>
                            @endif
                        </tbody>
					</table>
				</div>
                <hr>
				<p class="text-left text-white m-0" style="font-size: 9pt;">
					To view more memo, click 
                    <a target="_blank" href="https://trace.dostcar.ph/" 
                       class="text-default"> here</a> to login to TRACE.
				</p>
			</div>
		</div>
	</div>
</div>

<div class="row mt-3">
	<div class="col-xs-12 col-md-12">
		<div class="card trans-blue-bg z-depth-1">
			<div class="card-body">
				<div class="card-title text-white">
					<strong><i class="fas fa-server"></i> Web-based System</strong>

                    @if (Auth::user())
                        @if (Auth::user()->role == 1)
                    <button onclick="$(this).showCreate();" class="btn btn-success btn-sm">
                        <i class="fas fa-folder-plus"></i> Add
                    </button>
                        @endif
                    @endif
				</div>
				<div id="infosys-display" class="card-body rounded white p-0">
                    @if (count($infosysMain) > 0)
					<div class="col-md-12 col-sm-12 col-xs-12 dashboard-label p-2">
	                    <strong>Main</strong>
	                </div>
					<div class="row pl-5 pr-5">
						@foreach ($infosysMain as $infoCtr => $info)
						<div class="col-sm-4 col-md-3 col-lg-2 mt-3">
                            <div class="card">
                                <div class="card-body text-center p-0">
                                    <div class="card-body p-0">
                                        <a class="btn btn-white p-0" target="_blank" href="{{ asset($info->url) }}"
                                           data-toggle="tooltip" data-placement="bottom" title="{{ $info->name }}">
                                            <div class="view overlay zoom cursor-pointer">
                                                <img class="card-img-top img-fluid" src="{{ url($info->icon) }}" alt="Icon">
                                            </div>
                                            
                                        </a>
                                        <a class="btn btn-white btn-block waves-effect waves-light p-1"
                                            target="_blank" href="{{ $info->url }}">
                                             <strong><i class="fas fa-external-link-alt"></i> {{ $info->abrv }}</strong>
                                         </a>
                                        <div class="btn-group btn-toolbar w-100" role="group" aria-label="Basic example">
                                            @if (Auth::user() && Auth::user()->role != 3)
                                            <a class="btn btn-white waves-effect waves-light black-text p-1 w-50"
                                               onclick="$(this).showEdit('{{ $info->id }}', 'infosys');">
                                                <i class="fas fa-edit orange-text"></i>
                                            </a>
                                            @endif
                                            <a class="btn btn-light waves-effect waves-light black-text p-1  w-50"
                                               data-toggle="tooltip" data-placement="top" title="{{ $info->description }}">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						@endforeach
					</div>
                    @endif

                    @if (count($infosysSpecProj) > 0)
					<div class="col-md-12 col-sm-12 col-xs-12 dashboard-label mt-5 p-2">
	                    <strong>Special Projects</strong>
	                </div>
	                <div class="row pl-5 pr-5 pb-3">
						@foreach ($infosysSpecProj as $info)
						<div class="col-sm-4 col-md-3 col-lg-2 mt-3">
                            <div class="card">
                                <div class="card-body text-center p-0">
                                    <div class="card-body p-0">
                                        <a class="btn btn-white p-0" target="_blank" href="{{ asset($info->url) }}"
                                           data-toggle="tooltip" data-placement="bottom" title="{{ $info->name }}">
                                            <div class="view overlay zoom cursor-pointer">
                                                <img class="card-img-top img-fluid" src="{{ url($info->icon) }}" alt="Icon">
                                            </div>
                                            
                                        </a>
                                        <a class="btn btn-white btn-block waves-effect waves-light p-1"
                                            target="_blank" href="{{ $info->url }}">
                                             <strong><i class="fas fa-external-link-alt"></i> {{ $info->abrv }}</strong>
                                         </a>
                                        <div class="btn-group btn-toolbar w-100" role="group" aria-label="Basic example">
                                            @if (Auth::user() && Auth::user()->role != 3)
                                            <a class="btn btn-white waves-effect waves-light black-text p-1 w-50"
                                               onclick="$(this).showEdit('{{ $info->id }}', 'infosys');">
                                                <i class="fas fa-edit orange-text"></i>
                                            </a>
                                            @endif
                                            <a class="btn btn-light waves-effect waves-light black-text p-1  w-50"
                                               data-toggle="tooltip" data-placement="top" title="{{ $info->description }}">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						@endforeach
					</div>
                    @endif

                    @if (count($infosysOthers) > 0)
                    <div class="col-md-12 col-sm-12 col-xs-12 dashboard-label mt-5 p-2">
                        <strong>Others</strong>
                    </div>
                    <div class="row pl-5 pr-5 pb-3">
                        @foreach ($infosysOthers as $info)
                        <div class="col-sm-4 col-md-3 col-lg-2 mt-3">
                            <div class="card">
                                <div class="card-body text-center p-0">
                                    <div class="card-body p-0">
                                        <a class="btn btn-white p-0" target="_blank" href="{{ asset($info->url) }}"
                                           data-toggle="tooltip" data-placement="bottom" title="{{ $info->name }}">
                                            <div class="view overlay zoom cursor-pointer">
                                                <img class="card-img-top img-fluid" src="{{ url($info->icon) }}" alt="Icon">
                                            </div>
                                            
                                        </a>
                                        <a class="btn btn-white btn-block waves-effect waves-light p-1"
                                            target="_blank" href="{{ $info->url }}">
                                             <strong><i class="fas fa-external-link-alt"></i> {{ $info->abrv }}</strong>
                                         </a>
                                        <div class="btn-group btn-toolbar w-100" role="group" aria-label="Basic example">
                                            @if (Auth::user() && Auth::user()->role != 3)
                                            <a class="btn btn-white waves-effect waves-light black-text p-1 w-50"
                                               onclick="$(this).showEdit('{{ $info->id }}', 'infosys');">
                                                <i class="fas fa-edit orange-text"></i>
                                            </a>
                                            @endif
                                            <a class="btn btn-light waves-effect waves-light black-text p-1  w-50"
                                               data-toggle="tooltip" data-placement="top" title="{{ $info->description }}">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    @if (Auth::user())
                        @if (Auth::user()->role == 1)
                            @if (count($infosysBackEnd) > 0)
                    <div class="col-md-12 col-sm-12 col-xs-12 dashboard-label mt-5 p-2">
                        <strong>Back-end System</strong>
                    </div>
                    <div class="row pl-5 pr-5 pb-3">
                        @foreach ($infosysBackEnd as $info)
                        <div class="col-sm-4 col-md-3 col-lg-2 mt-3">
                            <div class="card">
                                <div class="card-body text-center p-0">
                                    <div class="card-body p-0">
                                        <a class="btn btn-white p-0" target="_blank" href="{{ asset($info->url) }}"
                                           data-toggle="tooltip" data-placement="bottom" title="{{ $info->name }}">
                                            <div class="view overlay zoom cursor-pointer">
                                                <img class="card-img-top img-fluid" src="{{ url($info->icon) }}" alt="Icon">
                                            </div>
                                        </a>
                                        <a class="btn btn-white btn-block waves-effect waves-light p-1"
                                            target="_blank" href="{{ $info->url }}">
                                             <strong><i class="fas fa-external-link-alt"></i> {{ $info->abrv }}</strong>
                                         </a>
                                        <div class="btn-group btn-toolbar w-100" role="group" aria-label="Basic example">
                                            @if (Auth::user())
                                            <a class="btn btn-white waves-effect waves-light black-text p-1 w-50"
                                               onclick="$(this).showEdit('{{ $info->id }}', 'infosys');">
                                                <i class="fas fa-edit orange-text"></i>
                                            </a>
                                            @endif
                                            <a class="btn btn-light waves-effect waves-light black-text p-1 w-50"
                                               data-toggle="tooltip" data-placement="top" title="{{ $info->description }}">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                            @endif
                        @endif
                    @endif
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('modals')
    @include('modals.view')
    @include('modals.create')
    @include('modals.edit')
    @include('modals.delete')
    @include('modals.notification')

    @if (!Auth::user())
        @include('modals.login')
        @include('modals.signup')
    @endif
@endsection

@section('custom-js')
    <script>
        let recordTypes = {!! json_encode($recordTypes) !!};
    </script>
    <script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/portal.js') }}"></script>

    @if (!empty(Session::get('success')))
        <script type="text/javascript">
            $(function() {
                $('#modal-success').modal();
            });
        </script>
    @endif

    @if (!empty(Session::get('danger')))
        <script type="text/javascript">
            $(function() {
                $('#modal-danger').modal();
            });
        </script>
    @endif
@endsection