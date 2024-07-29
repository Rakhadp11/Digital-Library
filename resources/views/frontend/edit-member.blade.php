@extends('frontend.layout.app')

@section('title', 'Edit Member')

@push('css')
<style>
    body {
        background-color: #dcdcdc;
    }
    .profile-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(244, 226, 106, 0.542);
        width: 800px;
        margin: 50px auto;
        transition: transform 0.3s;
    }
    
    .profile-container:hover {
        transform: scale(1.02);
    }
    
    .profile-container h3 {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .profile-picture {
        text-align: center;
        margin-bottom: 20px;
    }
    
    .profile-picture img {
        border-radius: 50%;
        width: 130px;
        height: 130px;
        transition: transform 0.3s;
    }
    
    .profile-picture img:hover {
        transform: scale(1.1);
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .form-group {
        position: relative;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    
    .form-group input,
    .form-group select {
        width: calc(100% - 30px);
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        transition: border-color 0.3s;
    }
    
    .form-group input:focus,
    .form-group select:focus {
        border-color: #f57c00;
    }
    
    .form-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 80px;
    }

    .cancel-btn {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .cancel-btn:hover {
        background-color: #f1021a;
        color: #f3f3f3;
    }

    .save-btn {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .save-btn:hover {
        background-color: #00fd3b;
        color: #f3f3f3;
    }
    
    .profile-picture {
        text-align: center;
        margin-bottom: 20px;
        position: relative;
    }
    .profile-picture input[type="file"] {
        position: absolute;
        bottom: 0;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }
    
    @media (max-width: 800px) {
        .profile-container {
            width: 90%;
            margin: 20px auto;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="profile-container">
    <h3>Edit Profile Member</h3>
    <form id="profile-form" method="POST" action="{{ route('member.update', [$member->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-grid">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $member->name) }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $member->email) }}" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="{{ old('address', $member->address) }}" required>
            </div>
            <div class="form-group">
                <label for="phone">Contact Number</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $member->phone) }}" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" value="{{ old('city', $member->city) }}" required>
            </div>
            <div class="form-group">
                <label for="study">Study</label>
                <select id="study" name="study" required>
                    <option value="SD" {{ old('study', $member->study) == 'SD' ? 'selected' : '' }}>SD</option>
                    <option value="SMP" {{ old('study', $member->study) == 'SMP' ? 'selected' : '' }}>SMP</option>
                    <option value="SMA/SMK" {{ old('study', $member->study) == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                    <option value="Others" {{ old('study', $member->study) == 'Others' ? 'selected' : '' }}>Others</option>
                </select>
            </div>
        </div>
        <div class="form-buttons">
            <button type="button" class="cancel-btn" onclick="window.location.href='{{ route('frontend.index') }}'">Cancel</button>
            <button type="submit" class="save-btn">Save</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="scripts.js"></script>


<script>
    $(document).ready(function() {
        $('#profile-form').on('submit', function(e) {
            e.preventDefault(); // Prevent form submission

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Profile updated successfully.'
                    })
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update profile.'
                    });
                }
            });
        });
    });
</script>
@endpush
