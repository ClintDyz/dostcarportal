<form id="form-edit" class="wow animated fadeIn p-3 m-0" 
      method="POST" enctype="multipart/form-data"
      action="{{ url('infosys/update/'. $id) }}">
    {{ csrf_field() }}
    <div class="md-form form-sm mt-0">
        <div class="input-group">
            <div class="custom-file">
                <input class="custom-file-input" id="infosys-icon" name="infosys_icon" 
                       aria-describedby="infosys-icon" type="file"
                       accept="image/*">
                <label class="custom-file-label" for="infosys-icon">
                    <i class="fas fa-image"></i> {{ $icon }}
                </label>
            </div>
        </div>
    </div>

    <div class="md-form form-sm">
        <select class="browser-default custom-select black-text"
                id="infosys-type" name="infosys_type"  
                style="font-size: 10.5pt;" required>
            <option value="">------ Select system type ------</option>
            <option value="main" {{ $type == 'main' ? 'selected': '' }}>
                Main
            </option>
            <option value="special-project" {{ $type == 'special-project' ? 'selected': '' }}>
                Special Project
            </option>
            <option value="back-end" {{ $type == 'back-end' ? 'selected': '' }}>
                Back-end
            </option>
            <option value="others" {{ $type == 'others' ? 'selected': '' }}>
                Others
            </option>
        </select>
    </div>

    <div class="md-form form-sm">
        <i class="fas fa-window-maximize prefix"></i>
        <input type="text" id="infosys-name" name="infosys_name" 
               class="form-control form-control-sm"
               value="{{ $name }}" required>
        <label for="infosys-name" {{ !empty($name) ? 'class=active': '' }}>
            System Name
        </label>
    </div>

    <div class="md-form form-sm">
        <i class="fas fa-font prefix"></i>
        <input type="text" id="infosys-abrv" name="infosys_abrv" 
               class="form-control form-control-sm" value="{{ $abrv }}">
        <label for="infosys-abrv" {{ !empty($abrv) ? 'class=active': '' }}>
            Name Abbreviation (Optional)
        </label>
    </div>

    <div class="md-form form-sm">
        <i class="fa fa-pencil-alt prefix"></i>
        <textarea type="text" id="infosys-desc" name="infosys_desc" 
                  class="md-textarea form-control">{{ $description }}</textarea>
        <label for="infosys-desc" {{ !empty($description) ? 'class=active': '' }}>
            Description
        </label>
    </div>

    <div class="md-form form-sm">
        <i class="fas fa-external-link-alt prefix"></i>
        <input type="text" id="infosys-local-url" name="infosys_local_url" 
               class="form-control form-control-sm" value="{{ $localURL }}">
        <label for="infosys-local-url" {{ !empty($localURL) ? 'class=active': '' }}>
            Local URL
        </label>
    </div>

    <div class="md-form form-sm">
        <i class="fas fa-external-link-alt prefix"></i>
        <input type="text" id="infosys-public-url" name="infosys_public_url" 
               class="form-control form-control-sm" value="{{ $publicURL }}">
        <label for="infosys-public-url" {{ !empty($publicURL) ? 'class=active': '' }}>
            Public URL
        </label>
    </div>

    <input type="hidden" id="form-action" value="{{ url('infosys/update/'. $id) }}">
    <input type="hidden" id="delete-url" value="{{ url('infosys/delete/' . $id) }}">
</form>