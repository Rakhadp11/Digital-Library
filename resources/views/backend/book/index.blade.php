@extends('backend.layout.app')

@section('title', 'Book')

@push('css')
@endpush

@section('content')
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div class="card">
            <div class="card-header text-center">Book Table</div>
            <div class="card-body">
                <div class="text-left mb-2">
                    <a href="{{ route('book.export') }}" class="btn btn-success"><i class="fa-solid fa-file-export"></i> Export</a>
                </div>
                <div class="text-right">
                    <a href="{{ route('book.create') }}" class="btn btn-primary mb-2"><i class="fa-solid fa-pen"></i> Add Book </a>
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
            $('#book-table').on('click', '.toggle-availability', function() {
                var bookId = $(this).data('id');
                var button = $(this);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to change the availability status of this book.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('books.toggleAvailability') }}',
                            type: 'POST',
                            data: {
                                id: bookId,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    var isAvailable = response.is_available;
                                    var newStatus = isAvailable ? 'Available' : 'Not Available';
                                    var newClass = isAvailable ? 'btn-success' : 'btn-danger';

                                    button.removeClass('btn-success btn-danger').addClass(newClass).text(newStatus);

                                    Swal.fire(
                                        'Updated!',
                                        'The availability status book has been updated.',
                                        'success'
                                    );
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to toggle availability.',
                                        'error'
                                    );
                                }
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'Error occurred while toggling availability.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#book-table').on('click','.action', function() {
            let data = $(this).data()
            let id = data.id
            let jenis = data.jenis

            const modal = new bootstrap.Modal(document.getElementById('actionModal'))
            
            console.log(data);

            if(jenis == 'delete'){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to delte this book!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                    $.ajax({
                        method: 'DELETE',
                        url: `{{ url('/admin/book/delete') }}/${id}`,
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]'). attr('content')
                        },
                        success: function(res){
                        window.LaravelDataTables["book-table"].ajax.reload()
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
                url: `{{ url('/admin/book/edit') }}/${id}`,
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
                url: `{{ url('/admin/book/update') }}/${id}`,
                headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]'). attr('content')
                    },
                data: formData,
                processData: false,
                contentType: false,
                success: function(res){
                    window.LaravelDataTables["book-table"].ajax.reload()
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
