{{-- @php
    $items = [
        '<a href="/" data-theme="light" class="btn btn-bg-white btn-active-color-primary">Create</a>',
        '<a href="/" data-theme="light" class="btn btn-bg-white btn-active-color-primary">Update</a>',
    ]
@endphp --}}
<!--begin::Toolbar-->
<div class="toolbar py-5 py-lg-15" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-white fw-bold my-1 fs-3">{{ $title ?? '' }}</h1>
            <!--end::Title-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        @if (!empty($items))
        <div class="d-flex align-items-center py-3 py-md-1 gap-4">
            @foreach ($items as $item)
                {!! $item !!}
            @endforeach
        </div>
        @endif
        <!--end::Actions-->
    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->
