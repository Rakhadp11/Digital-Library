@extends('frontend.layout.app')

@section('title', 'Pengembalian Buku')

@push('css')
<style>
    .btn-success {
        background-color: #12e844;
        border-color: #00ce30;
    }
    .btn-info {
        background-color: #004af7;
        border-color: #2a38ff;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="alert alert-warning mt-3" role="alert">
        <p><strong><i class="fa-solid fa-circle-info"></i> Informasi</strong></p>
        <p>Kembalikan buku sesuai dengan tanggal pengembalian peminjaman</p>
    </div>
    <table id="borrowing-table" class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Cover Image</th>
                <th>Judul Buku</th>
                <th>Nama</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div class="modal fade" id="bookDetailModal" tabindex="-1" role="dialog" aria-labelledby="bookDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookDetailModalLabel">Detail Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="book-cover_image"></p>
                <p id="user-name"></p>
                <p id="user-email"></p>
                <p id="book-title"></p>
                <p id="book-category"></p>
                <p id="book-author"></p>
                <p id="book-publisher"></p>
                <p id="book-year"></p>
                <p id="book-pages"></p>
                <p id="book-description"></p>
                <p id="book-borrow_at"></p>
                <p id="book-return_at"></p>
            </div>
            <div class="modal-footer">
                <button id="return-book-button" class="btn btn-success">Kembalikan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('#borrowing-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("borrow.data") }}',
            columns: [
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + 1; 
                    }
                },
                { data: 'book.cover_image', name: 'book.cover_image', orderable: false, searchable: false },
                { data: 'book.title', name: 'book.title' },
                { data: 'user.name', name: 'user.name' },
                { data: 'borrowed_at', name: 'borrowed_at' },
                { data: 'returned_at', name: 'returned_at', render: function(data) {
                    return data ? data : 'Belum Dikembalikan';
                }},
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });

    function showDetails(id) {
        $.get('{{ url("/borrow") }}/' + id, function(data) {
            $('#book-cover_image').html('<img src="' + '{{ asset('storage/') }}' + '/' + data.book.cover_image + '" alt="Cover Image" width="100">');
            $('#user-name').text('Nama User: ' + data.user.name);
            $('#user-email').text('Email User: ' + data.user.email);
            $('#book-title').text('Judul Buku: ' + data.book.title);
            $('#book-category').text('Kategori Buku: ' + data.book.category);
            $('#book-author').text('Pengarang: ' + data.book.author);
            $('#book-publisher').text('Penerbit: ' + data.book.publisher);
            $('#book-year').text('Tahun Buku: ' + data.book.year);
            $('#book-pages').text('Halaman Buku: ' + data.book.pages);
            $('#book-description').text('Deskripsi: ' + data.book.description);
            $('#book-borrow_at').text('Tanggal Pinjam: ' + data.borrowed_at);
            $('#book-return_at').text('Tanggal Kembali: ' + data.returned_at);
            $('#return-book-button').attr('onclick', 'returnBook(' + data.id + ')');
            $('#bookDetailModal').modal('show');
        });
    }

    function returnBook(id) {
        Swal.fire({
            title: 'Konfirmasi Pengembalian',
            text: 'Anda yakin ingin mengembalikan buku ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, kembalikan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('{{ url("/borrow/return") }}/' + id, {
                    _token: '{{ csrf_token() }}'
                }, function(data) {
                    if (data.success) {
                        Swal.fire(
                            'Dikembalikan!',
                            'Buku telah berhasil dikembalikan.',
                            'success'
                        );
                        $('#bookDetailModal').modal('hide');
                        $('#borrowing-table').DataTable().ajax.reload();
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat mengembalikan buku.',
                            'error'
                        );
                    }
                }).fail(function(xhr) {
                    Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan: ' + xhr.responseText,
                        'error'
                    );
                });
            }
        });
    }
</script>
@endpush
