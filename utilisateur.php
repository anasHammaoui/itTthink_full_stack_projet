<?php
include "dataBase.php";
session_start();
$sessionId = $_SESSION["userId"];
$userData = "SELECT nom_utilisateur FROM utilisateurs WHERE id_utilisateur = $sessionId";
$getData = $connect -> query($userData);
$getItAsArr = $getData->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateur</title>
    <meta name="keywords" content="freelance, user, offer">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</head>
<body>
     <!-- nav bar  -->
  <nav class="flex justify-between items-center px-4 md:px-6 py-4 bg-white shadow-md">
    <h2 class="text-cyan-600 font-semibold text-xl">itThink</h2>
    <ul class="flex justify-between items-center gap-6">
    <li ><a href="index.php" class="text-slate-900 font-bold text-lg hover:text-cyan-600 transition-all">Log Out</a></li>
      <li ><a href="signup.php" class="text-slate-900 font-bold text-lg hover:text-cyan-600 transition-all">Freelancer</a></li>
    </ul>
  </nav>
  <div class="page-header flex py-4 bg-slate-300 justify-between px-4 md:px-6 items-center">
    <!-- user name -->
  <div class="userName  text-black  py-2 px-4 grow">
        Good morning: 
        <span class="font-bold"><?php
            echo $getItAsArr["nom_utilisateur"];
        ?></span>
    </div>
    <!-- filter -->
    <div class="filter flex  items-center mr-7" >
  <label for="countries" class="block mb-2 mr-7 font-medium text-gray-900 ">Filter</label>
  <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 " name="filter">
    <option selected>Choose a country</option>
    <option value="cat">category</option>
    <option value="status">status</option>
    <option value="date">date</option>
  </select>
</div>
<!-- search -->
    <div class="search">
        <form action="utilisateur.php" method="POST" class="flex justify-between">
            <input type="search" name="search" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 mr-2" placeholder="Search">
            <input type="submit" value="Search" name="submit_search" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 cursor-pointer" >
        </form>
    </div>
    <!-- ajouter -->
     <!-- Ajouter -->
 <div class="ajouter ml-7">
   

<!-- Modal toggle -->
<button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Add Project
</button>

<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden  overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Sign in to our platform
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="#">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required />
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <div class="flex justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required />
                            </div>
                            <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
                        </div>
                        <a href="#" class="text-sm text-blue-700 hover:underline dark:text-blue-500">Lost Password?</a>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        Not registered? <a href="#" class="text-blue-700 hover:underline dark:text-blue-500">Create account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 

 </div>
  </div>

    <!-- dashboard projects  -->
  <main class="dashboard grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4 px-4 md:px-6 py-6">
    <div class="bg-sky-500 py-7 px-5 flex items-center flex-col justify-center  text-white text-lg rounded-lg shadow-lg relative">
        <div class="absolute top-0 right-0">
        <i class="fa-solid fa-star "></i>
        <i class="fa-solid fa-pen-to-square"></i>
        </div>
      <h2 class="text-current text-2xl mb-2 font-bold">Project title</h2>
       <p class="my-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum numquam, repudiandae amet a distinctio error impedit quae quis nemo, dignissimos laudantium saepe cum optio.</p>
      <div class="flex justify-between w-full">
      <h2 class=" text-white font-bold">Category</h2>
      <h2 class=" text-white font-bold">Sub Category</h2>
      </div>
    </div>
  </main>
</body>
</html>