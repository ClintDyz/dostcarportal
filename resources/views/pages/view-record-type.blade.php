<form class="wow animated fadeIn pl-3 pr-3 pt-0 m-0">
    <div class="md-form form-sm mt-0 mb-2 float-right">
        @if (Auth::user())
        <button type="button" class="btn btn-link btn-lg p-2 orange-text"
                onclick="$(this).showEdit('{{ $id }}', 'record-type', '{{ $type }}')">
            <i class="far fa-edit"></i> Edit
        </button>
        @endif
    </div><br>
    <div class="md-form form-sm">
        <i class="fas fa-keyboard prefix"></i>
        <input type="text" id="record-type" name="record_type" 
               class="form-control form-control-sm" value="{{ $type }}" readonly>
        <label for="record-type" class="active">
            Type
        </label>
    </div>

    <div>
        <label>
            Icon:&nbsp;&nbsp;<i class="{{ $icon }} fa-lg"></i>
        </label>
    </div>
</form>