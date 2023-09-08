<button type="button"
        class="btn btn-sm btn-primary"
        data-kt-menu-trigger="click"
        data-kt-menu-placement="bottom-end"
        data-kt-menu-flip="top-end">
    <i class="fas fa-filter"></i>
    Filter
    <span class="svg-icon svg-icon-5 ms-2 me-0"></span>
</button>

<div
    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-250px py-4"
    data-kt-menu="true">
    <div class="menu-item px-3">

        <div class="px-7 py-5">
            <form method="GET" id="{{$filter['id'] ?? 'filter_form'}}">
                <!--begin::Input group-->
                <div class="mb-10">
                    <!--begin::Label-->
                    <label class="form-label fs-5 fw-bold mb-3">Status Type:</label>
                    <!--end::Label-->

                    <!--begin::Options-->
                    <div class="d-flex flex-column flex-wrap fw-bold"
                        data-kt-docs-table-filter="payment_type">
                        @foreach($filter['values'] as $label => $value)
                            <label
                                class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                <input class="form-check-input" type="radio" name="status_type" value="{{ $value }}"
                                    @if($loop->first) checked="checked" @endif/>
                                <span class="form-check-label text-gray-600">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    <!--end::Options-->

                </div>
            </form>
            <!--end::Input group-->
        </div>

    </div>

</div>
