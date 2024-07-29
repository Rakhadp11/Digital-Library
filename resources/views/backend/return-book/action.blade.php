<div class="text-center">
    <button class="btn btn-danger btn-sm" onclick="deleteReturnBook({{ $id }})">
        <i class="fa fa-trash"></i>
    </button>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function deleteReturnBook(id) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('returnbook.delete', '') }}/' + id,
                    type: 'DELETE',
                    success: function(result) {
                        Swal.fire(
                            'Terhapus!',
                            'Data telah dihapus.',
                            'success'
                        );
                        $('#returnbook-table').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan: ' + xhr.responseText,
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>
