@if (!$sub)
<div class="menu-item menu-lg-down-accordion me-0 me-lg-2">
    <a href="{{ $link }}" class="menu-link py-3">
        <span class="menu-title">{{ $title }}</span>
    </a>
</div>
@else
<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
    <span class="menu-link py-3">
        <span class="menu-title">{{ $title }}</span>
        <span class="menu-arrow d-lg-none"></span>
    </span>
    <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
        @foreach ($sub as $item)
        <div class="menu-item">
            <a class="menu-link py-3" href="{{ $item['link'] }}" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                <span class="menu-icon">
                    <span class="svg-icon svg-icon-3">
                        <i class="{{ $item['icon'] ?? 'fas fa-list' }}"></i>
                    </span>
                </span>
                <span class="menu-title">{{ $item['title'] }}</span>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endif

