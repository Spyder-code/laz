<div class="col-{{ $col ?? 12 }}">
    <!--begin::Input group-->
    <div class="fv-row mb-7">
        <!--begin::Label-->
        <label class="fs-6 fw-semibold form-label mt-3">
            <span class="required">{{ $label ?? '' }}</span>
        </label>
        <!--end::Label-->
        <div class="w-100">
            <div class="form-floating border rounded">
                <!--begin::Select2-->
                <select id="{{ $id??false }}" class="form-select form-select-solid lh-1 py-3" name="{{ $name }}" {{ !empty($attr)?implode(' ', $attr) : '' }}>
                    <option>Choose {{ $label }}</option>
                    @foreach ($options as $idx => $option)
                        <option value="{{ $idx }}" {{ !empty($value)?$value==$idx ? 'selected' : '':'' }}>{{ $option }}</option>
                    @endforeach
                </select>
                <!--end::Select2-->
            </div>
        </div>
    </div>
    <!--end::Input group-->
</div>
