<?php
include "dataBase.php";
if (isset($_SESSION["role"])){
  session_destroy();
}
session_start();
if (isset($_POST["submit"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $checkEmail = $connect->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $checkEmail -> bind_param("s",$email);
    $checkEmail -> execute();
    $checkResult = $checkEmail -> get_result();
    $rowCheck = $checkResult-> fetch_assoc();
  
    if ($checkResult->num_rows > 0){ 

      if (password_verify($password,$rowCheck["mot_de_passe"])){
       
        echo "mot pass correct";
        $_SESSION["role"] = $rowCheck["user_role"];
        $_SESSION["userId"] = $rowCheck["id_utilisateur"];
        echo "connected successfully";
        if ($_SESSION["role"] == "admin") {
          header("Location: admin.php");
        exit;
        } else {
          header("Location: utilisateur.php");
        exit;
        }
      } else {
        echo "password incorrect";
      }
      
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login itThink</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
     <!-- nav bar  -->
  <nav class="flex justify-between items-center px-4 md:px-6 py-4 bg-white shadow-md">
    <h2 class="text-cyan-600 font-semibold text-xl">itThink</h2>
    <ul class="flex justify-between items-center gap-6">
      <li ><a href="signup.php" class="text-slate-900 font-bold text-lg hover:text-cyan-600 transition-all">Sign Up</a></li>
    </ul>
  </nav>
  <!-- sign in -->
    <div class="signIn ">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="text-center text-3xl text-cyan-600 font-bold ">itThink</h2>
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Login to your account.</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="index.php" method="POST">
      <div>
        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
        <div class="mt-2">
          <input type="email" name="email" id="email" autocomplete="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 ">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
        
        </div>
        <div class="mt-2">
          <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <div>
        <input type="submit" name="submit" value="Sign in" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 cursor-pointer">
      </div>
    </form>
  </div>
</div>
    </div>
</body>
</html>