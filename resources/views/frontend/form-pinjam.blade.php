<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Buku</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="content">
        <h1>Form Peminjaman Buku</h1>
        <div class="form-container">
            <form id="loanForm">
                <div class="form-step active" id="step1">
                    <h2>Step 1: Informasi Peminjam</h2>
                    <div class="form-row">
                        <div class="form-column">
                            <label for="name">Nama:</label>
                            <input type="text" id="name" name="name" value="{{ $user->name }}" required readonly>
                        </div>
                        <div class="form-column">
                            <label for="email">Email:</label>
                            <input type="text" id="email" name="email" value="{{ $user->email }}" required readonly>
                        </div>
                        <div class="form-column">
                            <label for="phone">No Telp:</label>
                            <input type="text" id="phone" name="phone" value="{{ $member ? $member->phone : '' }}" required readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-column">
                            <label for="city">City:</label>
                            <input type="text" id="city" name="city" value="{{ $member ? $member->city : '' }}" required readonly>
                        </div>
                        <div class="form-column">
                            <label for="address">Alamat:</label>
                            <input type="text" id="address" name="address" value="{{ $member ? $member->address : '' }}" required readonly>
                        </div>
                        <div class="form-column">
                            <label for="study">Study:</label>
                            <input type="text" id="study" name="study" value="{{ $member ? $member->study : '' }}" required readonly>
                        </div>
                    </div>
                    <div class="form-navigation">
                        <button type="button" onclick="nextStep()">Next</button>
                    </div>
                </div>
                <div class="form-step" id="step2">
                    <h2>Step 2: Informasi Buku</h2>
                    <input type="hidden" id="book_id" name="book_id" value="{{ $book->id }}">
                    <div class="book-cover">
                        <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : asset('images/default-image.png') }}" alt="Book Cover">
                    </div>
                    <label for="title">Judul Buku:</label>
                    <input type="text" id="title" name="title" value="{{ $book->title }}" required readonly>
                    <label for="category">Kategori:</label>
                    <input type="text" id="category" name="category" value="{{ $book->category }}" required readonly>
                    <label for="author">Pengarang:</label>
                    <input type="text" id="author" name="author" value="{{ $book->author }}" required readonly>
                    <label for="publisher">Penerbit:</label>
                    <input type="text" id="publisher" name="publisher" value="{{ $book->publisher }}" required readonly>
                    <label for="year">Tahun Terbit:</label>
                    <input type="text" id="year" name="year" value="{{ $book->year }}" required readonly>
                    <button type="button" onclick="prevStep()">Previous</button>
                    <button type="button" onclick="nextStep()">Next</button>
                </div>
                <div class="form-step" id="step3">
                    <h2>Step 3: Tanggal Peminjaman</h2>
                    <label for="borrowed_at">Tanggal Pinjam:</label>
                    <input type="date" id="borrowed_at" name="borrowed_at" required>
                    <label for="returned_at">Tanggal Kembali:</label>
                    <input type="date" id="returned_at" name="returned_at" required>
                    <button type="button" onclick="prevStep()">Previous</button>
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #e7e7e7;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content h1 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #ffeb3b;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .form-step {
            display: none;
            transition: opacity 0.5s ease;
        }
        .form-step.active {
            display: block;
            opacity: 1;
        }
        .form-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 10px;
        }
        .form-column {
            width: 48%;
            padding: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #555;
            font-weight: 100;
        }
        input[type="text"], input[type="number"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-navigation {
            text-align: center;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #ffeb3b;
            cursor: pointer;
            margin: 5px;
            font-size: 16px;
            font-weight: bold;
            color: #333;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #fdd835;
        }
        button:focus {
            outline: none;
            box-shadow: 0 0 5px #ffeb3b;
        }
        button[disabled] {
            background-color: #ccc;
            cursor: not-allowed;
        }
        @media (min-width: 600px) {
            .form-column {
                width: 48%;
            }
        }
        .book-cover img {
            width: 130px; 
            height: 210px; 
            object-fit: cover; 
            border: 1px solid #ccc; 
            border-radius: 5px;
            margin-bottom: 20px; 
        }
    </style>

    <script>
        let currentStep = 0;

        function showStep(step) {
            const steps = document.querySelectorAll('.form-step');
            steps.forEach((stepElement, index) => {
                stepElement.classList.toggle('active', index === step);
            });
        }

        function nextStep() {
            const steps = document.querySelectorAll('.form-step');
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        }

        function prevStep() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        }

        showStep(currentStep);

        document.getElementById('loanForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const borrowedAt = new Date(document.getElementById('borrowed_at').value);
            const returnedAt = new Date(document.getElementById('returned_at').value);
            const today = new Date();

            // Validasi tanggal peminjaman dan pengembalian
            if (borrowedAt < today) {
                alert('Tanggal peminjaman tidak bisa kurang dari tanggal hari ini.');
                return;
            }

            if (returnedAt <= borrowedAt) {
                alert('Tanggal pengembalian harus setelah tanggal peminjaman.');
                return;
            }

            const formData = new FormData(this);
            const submitButton = event.target.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.textContent = 'Loading...';

            fetch('/borrow', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.indexOf('application/json') !== -1) {
                    return response.json();
                } else {
                    return response.text().then(text => { throw new Error(text); });
                }
            })
            .then(data => {
                if (data.success) {
                    alert(data.message || 'Peminjaman berhasil disimpan!');
                    window.location.href = data.redirect_url;
                } else {
                    alert('Terjadi kesalahan: ' + (data.message || 'Silakan coba lagi.'));
                    console.error(data.errors);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim data: ' + error.message);
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.textContent = 'Submit';
            });
        });
    </script>
</body>
</html>
