<?php
     include("dataBase.php");
     if (isset($_POST["submit"])){
        $fullname = $_POST["fullName"];
        $password = password_hash($_POST["password"],PASSWORD_DEFAULT);
        $email = $_POST["email"];
        // check if account is exist
        $searchBind = $connect -> prepare("SELECT COUNT(*) AS mailCount FROM utilisateurs WHERE email = ?");
        $searchBind ->  bind_param("s",$email);
        $searchBind -> execute();
        $searchResult = $searchBind-> get_result();
        $count = $searchResult->fetch_assoc();
        if (empty($fullname) || empty($password) || empty($email) || strlen($password) < 8 || $count["mailCount"] > 0){
            echo "<div class='bg-red-500 text-white font-bold w-full py-4 text-center'>Please check your info and try again</div>";
        } else {
           $countUsers = $connect -> query("SELECT count(*) as users FROM utilisateurs");
           $usersAsArr = $countUsers -> fetch_assoc();
           $coutUsersInt = (int)$usersAsArr["users"];

           if ($coutUsersInt == 0){
            $admin = "admin";
            $insertUserPrepare = $connect->prepare("INSERT INTO utilisateurs (nom_utilisateur, mot_de_passe, email, user_role)  VALUES (?,?,?,?)");
            $insertUserPrepare->bind_param("ssss", $fullname, $password, $email, $admin);
            $insertUserPrepare->execute();
            echo "<div class='bg-green-500 text-white font-bold w-full py-4 text-center'>Account created succesfully</div>";
           } else {
            $users = "client";
            $insertUserPrepare = $connect->prepare("INSERT INTO utilisateurs (nom_utilisateur, mot_de_passe, email, user_role)  VALUES (?,?,?,?)");
            $insertUserPrepare->bind_param("ssss", $fullname, $password, $email, $users);
            $insertUserPrepare->execute();
            echo "<div class='bg-green-500 text-white font-bold w-full py-4 text-center'>Account created succesfully</div>";
           }
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up itThink</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
     <!-- nav bar  -->
  <nav class="flex justify-between items-center px-4 md:px-6 py-4 bg-white shadow-md">
    <h2 class="text-cyan-600 font-semibold text-xl">itThink</h2>
    <ul class="flex justify-between items-center gap-6">
      <li ><a href="index.php" class="text-slate-900 font-bold text-lg hover:text-cyan-600 transition-all">Sign In</a></li>
    </ul>
  </nav>
  <!-- sign up -->
    <div class="signUp ">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="text-center text-3xl text-cyan-600 font-bold ">itThink</h2>
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Create your free account.</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="signup.php" method="POST">
      <div>
        <label for="fullName" class="block text-sm/6 font-medium text-gray-900">Full Name</label>
        <div class="mt-2">
          <input type="text" name="fullName" id="fullName" autocomplete="fullName" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>
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
        <input type="submit" name="submit" value="Sign Up" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 cursor-pointer">
      </div>
    </form>
  </div>
</div>
    </div>

</body>
</html>