<div class="wow animated fadeIn">
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
                            @if (Auth::user())
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
                            @if (Auth::user())
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
                            @if (Auth::user())
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
        @endif
    @endif
</div>