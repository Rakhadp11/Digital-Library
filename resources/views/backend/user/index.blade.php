@extends('backend.layout.app')

@section('title', 'User')

@section('content')
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div class="card">
            <div class="card-header text-center">User Table</div>
            <div class="card-body">
                <div class="text-left mb-2">
                    <a href="{{ route('user.export') }}" class="btn btn-success"><i class="fa-solid fa-file-export"></i> Export</a>
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
    <script>
        $(document).ready(function() {
            $('#user-table').on('click','.action', function() {
            let data = $(this).data()
            let id = data.id
            let jenis = data.jenis

            const modal = new bootstrap.Modal(document.getElementById('actionModal'))
            
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
                        url: `{{ url('/admin/user/delete') }}/${id}`,
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]'). attr('content')
                        },
                        success: function(res){
                        window.LaravelDataTables["user-table"].ajax.reload()
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
            $.ajax({
                method: 'get',
                url: `{{ url('/admin/user/edit') }}/${id}`,
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
                method: 'POST',
                url: `{{ url('/admin/user/update') }}/${id}`,
                headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]'). attr('content')
                    },
                data: formData,
                processData: false,
                contentType: false,
                success: function(res){
                    window.LaravelDataTables["user-table"].ajax.reload()
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
