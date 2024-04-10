<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Page</title>
<!-- Stilurile tale existente aici -->
</head>
<body>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Datele de conectare la baza de date
    $servername = "localhost";
    $username = "root"; // înlocuiește cu numele tău de utilizator pentru MySQL
    $password = ""; // înlocuiește cu parola ta pentru MySQL
    $dbname = "studenti"; // Numele bazei de date

    // Crearea unei noi conexiuni
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificarea conexiunii
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Escaparea datelor de intrare pentru a preveni SQL injection
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Hashing-ul parolei
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Interogarea SQL pentru a insera datele în baza de date
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password_hash')";

    // Executarea interogării
    if ($conn->query($sql) === TRUE) {
      echo "Utilizator nou înregistrat cu succes!";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Închiderea conexiunii
    $conn->close();
  }
  ?>

  <div class="login-container">
    <h2>Register</h2>
    <form method="post" action="index.php">
      <input type="text" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Register</button>
    </form>
  </div>

</body>
</html>
