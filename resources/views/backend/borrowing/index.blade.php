@extends('backend.layout.app')

@section('title', 'Borrowing')

@section('content')
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div class="card">
            <div class="card-header text-center">Borrowing Table</div>
            <div class="card-body">
                <div class="text-left mb-2">
                    <a href="{{ route('borrow.export') }}" class="btn btn-success"><i class="fa-solid fa-file-export"></i> Export</a>
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
    function approveBorrowing(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to approve this borrowing?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/borrow/approve/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ _method: 'POST' })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Approved!', data.message, 'success');
                        $('#borrowing-table').DataTable().ajax.reload();
                    } else {
                        Swal.fire('Failed!', data.message, 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                });
            }
        });
    }

    function deleteBorrowing(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data ini akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        console.log('Deleting borrowing with ID:', id); 
        if (result.isConfirmed) {
            $.ajax({
                url: '/admin/borrow/delete/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $('#borrowing-table').DataTable().ajax.reload();
                        Swal.fire('Dihapus!', response.message, 'success');
                    } else {
                        Swal.fire('Gagal!', response.message, 'error');
                    }
                },
                error: function(xhr) {
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                }
            });
        }
    });
}

</script>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endpush
