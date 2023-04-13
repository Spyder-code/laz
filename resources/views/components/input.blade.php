<div class="col-{{ $col ?? 12 }}">
    <div class="fv-row mb-7">
        <!--begin::Label-->
        <label class="fs-6 fw-semibold form-label mt-3">
            <span class="{{ !empty($required)?$required?'required':'':'' }}">{{ $label ?? '' }}</span>
            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ $info ?? 'Enter the '.$label.' input' }}"></i>
        </label>
        <!--end::Label-->
        <!--begin::Input-->
        @if ($type=='textarea')
            <textarea class="form-control form-control-solid" {{  !empty($required)?$required?'required':'':''  }} id="{{ $id??$name }}" name="{{ $name }}" {{ !empty($attr)?implode(' ', $attr) : '' }}>{{ $value ?? '' }}</textarea>
        @elseif($type=='color')
            <input type="{{ $type }}" id="{{ $id??$name }}" {{  !empty($required)?$required?'required':'':''  }} class="form-control form-control-solid" name="{{ $name }}" value="{{ $value ?? old($name) }}" {{ !empty($attr)?implode(' ', $attr) : '' }} style="height: 70px;" />
        @else
            <input type="{{ $type }}" id="{{ $id??$name }}" {{  !empty($required)?$required?'required':'':''  }} class="form-control form-control-solid" name="{{ $name }}" value="{{ $value ?? old($name) }}" {{ !empty($attr)?implode(' ', $attr) : '' }} />
        @endif
        <!--end::Input-->
    </div>
</div>
<!--end::Input group-->
