@extends('layout.app')

@section('title', 'Category')

@push('css')
@endpush

@section('content')
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div class="card">
            <div class="card-header text-center">Category Table</div>
            <div class="card-body">

                <div class="text-right">
                    <a href="{{ route('category.create') }}" class="btn btn-success mb-2"><i class="fa-solid fa-pen"></i> Add Category </a>
                </div>
                
                {{ $dataTable->table() }}
            </div>
        </div>
        
            <!-- Modal Edit -->
            <div class="modal fade actionModal" id="actionModal" tabindex="-1" aria-labelledby="largeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                </div>
            </div>


@endsection

@push('scripts')
    <!-- Add this script tag before your custom JavaScript -->
    <script>
        $(document).ready(function() {
            $('#category-table').on('click','.action', function() {
            let data = $(this).data()
            let id = data.id
            let jenis = data.jenis
            
            console.log(data);

            if(jenis == 'delete'){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                    $.ajax({
                        method: 'DELETE',
                        url: `{{ url('/category/delete') }}/${id}`,
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]'). attr('content')
                        },
                        success: function(res){
                            window.LaravelDataTables["category-table"].ajax.reload()
                        Swal.fire(
                        'Deleted!',
                        res.message,
                        res.status
                    )
                        }

                    })
                    }
                })
            };

            if(jenis == 'edit'){
            // const modal = new bootstrap.Modal($('#actionModal'));
            const modal = new bootstrap.Modal(document.getElementById('actionModal'))
            $.ajax({
                method: 'get',
                url: `{{ url('/category/edit') }}/${id}`,
                success: function(res){
                    $('#actionModal').find('.modal-dialog').html(res)
                    modal.show()
                    update()
                }
            })
        }

            function update(){
                $('#formAction').submit(function(e){
                    e.preventDefault()
                    const _form = this
                    const formData = new FormData(_form)

                $.ajax({
                    method: 'PUT',
                    url: `{{ url('/category/update') }}/${id}`,
                    headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]'). attr('content')
                        },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res){
                        window.LaravelDataTables["category-table"].ajax.reload()
                        modal.hide()
                        Swal.fire(
                        'Updated!',
                        res.message,
                        res.status
                        )
                },
                    error: function(res){
                        let errors = res.responseJSON?.errors
                        $(_form).find('.text-danger.text-small').remove()
                        if(errors){
                            for(const [key, value] of Object.entries(errors)){
                                $(`[name='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                            }
                        }
                        console.log(errors);
                    }
                })
            })
        }
    });
});
    </script>


    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endpush
