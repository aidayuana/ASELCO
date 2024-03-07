<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin-top: 50px;
        }
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #fff;
            border-bottom: none;
            color: #333;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            padding: 20px;
        }
        .form-control {
            border-radius: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 20px;
            padding: 10px 30px;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .card-body {
            padding: 40px;
        }
        .form-group row {
            margin-bottom: 20px;
        }
        .text-md-right {
            text-align: left;
        }
        label {
            font-weight: bold;
            color: #333;
        }
        .card-footer {
            padding: 8px 20px; /* Padding for footer */
            font-size: 14px; /* Font size for footer text */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">REGISTER YOUR ACCOUNT</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            <div class="form-group">
                                <label for="name">Username</label>
                                <input id="name" type="text" class="form-control" name="fullname" required autocomplete="fullname" placeholder="euphoria">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" required autocomplete="email" placeholder="euphoria@gmail.com">
                            </div>
    
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" placeholder="********">
                            </div>
    
                            <div class="form-group">
                                <label for="school">Asal Sekolah</label>
                                <select id="school" class="form-control" name="school_id"> <!-- Pastikan nama field sesuai dengan yang di controller -->
                                    <option value="">Pilih Sekolah</option>
                                    @foreach ($schools as $school)
                                        <option value="{{ $school->id }}">{{ $school->school_name }}</option> <!-- Pastikan properti id dan name sesuai dengan kolom di tabel sekolah -->
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="form-group">
                                <label for="class">Kelas</label>
                                <select id="class" class="form-control" name="class_id">
                                    <option>Pilih Kelas</option>
                                    
                                </select>
                            </div>
    
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-block">REGISTER</button>
                                <p class="mt-3">Account Already? <a href="{{ route('login') }}" class="text-primary">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery and other required scripts -->
	<script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const schoolDropdown = document.getElementById('school');
            const classDropdown = document.getElementById('class');
    
            // Pastikan dropdown kelas dinonaktifkan secara default
            classDropdown.disabled = true;
    
            schoolDropdown.addEventListener('change', function() {
                const schoolId = this.value;
                classDropdown.innerHTML = '<option value="">Pilih Kelas</option>';
                classDropdown.disabled = true; // Nonaktifkan dropdown kelas sementara
    
                if (schoolId) {
                    fetch(`/get-classes/${schoolId}`)
                        .then(response => response.json())
                        .then(data => {
                            classDropdown.disabled = false; // Aktifkan dropdown kelas kembali
                            data.forEach(kelas => {
                                const option = new Option(kelas.class_name, kelas.id);
                                classDropdown.add(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching classes:', error);
                            classDropdown.disabled = true; // Nonaktifkan dropdown kelas jika terjadi error
                        });
                }
            });
        });
    </script>
    
    
</body>
</html>
