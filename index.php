<?php
  include "dataBase.php";
  //get numbber of projects
  $sqlProjects = "SELECT COUNT(*) AS project_rows FROM projets";
  $resultProject = $connect->query($sqlProjects);
  $projectsRowsArr = $resultProject->fetch_assoc();
  //get number of users
  $sqlUsers = "SELECT COUNT(*) AS users_rows FROM utilisateurs";
  $resultUsers = $connect->query($sqlUsers);
  $usersRowsAsArr = $resultUsers->fetch_assoc();
  // get number of freelancers
  $sqlFreelancers = "SELECT COUNT(*) AS count_freelance FROM freelances";
  $freelancesResult = $connect->query($sqlFreelancers);
  $freelancesAsArr = $freelancesResult-> fetch_assoc();
  // show number of offres
  $sqlOffresCount = "SELECT COUNT(*) AS offres_count FROM offres";
  $offresResult = $connect -> query($sqlOffresCount);
  $offresAsArr = $offresResult->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>itThink Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
    <style>
        main{
            height: calc(100vh - 100px);
        }
    </style>
</head>
<body class="bg-gray-100 h-full">

  <!-- nav bar  -->
  <nav class="flex justify-between items-center px-4 md:px-6 py-4 bg-white shadow-md">
    <h2 class="text-cyan-600 font-semibold text-xl">itThink</h2>
    <ul class="flex justify-between items-center gap-6">
      <li ><a href="login.php" class="text-slate-900 font-bold text-lg hover:text-cyan-600 transition-all">Login</a></li>
      <li ><a href="signup.php" class="text-slate-900 font-bold text-lg hover:text-cyan-600 transition-all">Sign Up</a></li>
    </ul>
  </nav>

  <!-- dashboard  -->
  <main class="dashboard grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4 px-4 md:px-6 py-6">
    <div class="bg-sky-500 py-7 px-5 flex items-center flex-col justify-center font-bold text-white text-lg rounded-lg shadow-lg">
      <h2 class="text-current text-2xl mb-2">Projects</h2>
        <h1 class="text-4xl ">
          <?php
            echo $projectsRowsArr["project_rows"];  
        ?>
        </h1>
    </div>
    <div class="bg-emerald-600 py-7 px-5 flex items-center flex-col justify-center font-bold text-white text-lg rounded-lg shadow-lg ">
    <h2 class="text-current text-2xl mb-2">Users</h2>
        <h1 class="text-4xl ">
          <?php
            echo $usersRowsAsArr["users_rows"];  
        ?>
        </h1>
    </div>
    <div class="bg-rose-600 py-7 px-5 flex items-center flex-col justify-center font-bold text-white text-lg rounded-lg shadow-lg ">
    <h2 class="text-current text-2xl mb-2">Freelancers</h2>
    <h1 class="text-4xl ">
          <?php
            echo $freelancesAsArr["count_freelance"];  
        ?>
        </h1>
    </div>
    <div class="bg-yellow-500 py-7 px-5 flex items-center flex-col justify-center font-bold text-white text-lg rounded-lg shadow-lg ">
    <h2 class="text-current text-2xl mb-2">Offres</h2>
        <h1 class="text-4xl ">
          <?php
            echo $offresAsArr["offres_count"]; 
        ?>
        </h1>
    </div>
  </main>

</body>
</html>
