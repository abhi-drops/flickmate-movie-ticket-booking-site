<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link href="https://fonts.cdnfonts.com/css/helvetica-neue-55" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Login Page</title>
  <style>
    #myVideo {
      object-fit: cover;
      width: 100vw;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
    }
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      
      font-family: 'Poppins', sans-serif;
    }
    .card {
      background: rgba(255, 255, 255, 0.2);
      border-radius: 16px;
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(5px);
      -webkit-backdrop-filter: blur(5px);
      border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .card-header {
      background-color: transparent;
      border-bottom: none;
      padding-top: 50px;
    }
    .form-control {
      background-color: rgba(255, 255, 255, 1);
      border: none;
      border-radius: 5px;
      box-shadow: none;
      position: relative;
    }
    .form-control .toggle-password {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      cursor: pointer;
      color: #ccc;
    }
    .form-control .toggle-password:hover {
      color: #aaa;
    }
    .btn {
      color: white;
      font-size: 16px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      transition: background-color 0.3s ease;
      cursor: pointer;
      background: rgba(255, 255, 255, 0);
      border-radius: 5px;
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(5px);
      -webkit-backdrop-filter: blur(5px);
      border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .btn:hover {
      background-color: rgba(255, 255, 255, 0.3);
    }
  </style>
</head>
<body>

<video autoplay muted loop id="myVideo">
  <source src="videos/v (14).mp4" type="video/mp4">
  Your browser does not support HTML5 video.
</video>

  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="text-center text-white fw-light">Welcome Back !</h3>
          </div>
          <div class="card-body text-white p-5">
            <form action="validation.php" method="post">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" name="user" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
                  <div class="input-group-text toggle-password">
                    <i class="fas fa-eye"></i>
                  </div>
                </div>
              </div>
              <div class="text-center p-3 float-end">
                <button type="submit" class="btn btn-dark">Login</button>
              </div>
              <p class="text-center mt-5 pt-5" style="font-size: small;color:black;">Register now for Free by clicking <a href="signup.php"> Register Now</a> Button</p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
  <script>
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.querySelector('#password');
    
    togglePassword.addEventListener('click', function() {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      this.querySelector('i').classList.toggle('fa-eye');
      this.querySelector('i').classList.toggle('fa-eye-slash');
    });
  </script>
</body>
</html>