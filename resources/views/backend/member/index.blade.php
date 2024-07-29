@extends('backend.layout.app')

@section('title', 'Member')

@section('content')
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div class="card">
            <div class="card-header text-center">Member Table</div>
            <div class="card-body">
                <div class="text-left mb-2">
                    <a href="{{ route('member.export') }}" class="btn btn-success"><i class="fa-solid fa-file-export"></i> Export</a>
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
            $('#member-table').on('click','.action', function() {
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
                        url: `{{ url('/admin/member/delete') }}/${id}`,
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]'). attr('content')
                        },
                        success: function(res){
                        window.LaravelDataTables["member-table"].ajax.reload()
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
        });
    });
</script>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endpush
