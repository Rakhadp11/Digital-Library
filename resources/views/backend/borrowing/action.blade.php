<div class="btn-group">
    @if (!$borrowing->approved)
        <button class="btn btn-success btn-sm ml-2" title="Approve" onclick="approveBorrowing({{ $borrowing->id }})">
            <i class="fa-solid fa-circle-check"></i>
        </button>
    @else
    <button class="btn btn-success btn-sm ml-2" title="Approve" disabled onclick="approveBorrowing({{ $borrowing->id }})">
        <i class="fa-solid fa-circle-check"></i>
    </button>
    @endif
    <button class="btn btn-danger ml-2" onclick="deleteBorrowing({{ $borrowing->id }})">
        <i class="fa-solid fa-trash"></i>
    </button>
</div>