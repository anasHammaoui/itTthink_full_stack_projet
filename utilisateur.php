<?php
include "dataBase.php";
session_start();
if (isset($_SESSION["role"]) && $_SESSION["role"] !== "admin"){
    $sessionRole = $_SESSION["role"];
    $sessionID = $_SESSION["userId"];
    $userData = "SELECT nom_utilisateur FROM utilisateurs WHERE id_utilisateur = '{$sessionID}'";
    $getData = $connect -> query($userData);
    $getItAsArr = $getData->fetch_assoc();
} else{
    header("location: index.php");
    exit;
}


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
    <!-- add a project with php -->
 <?php
        if (isset($_POST["addProject"])) {
            $projectName = $_POST["pr-name"];
            $projectDesc = $_POST["pr-desc"];
            $projectCat = $_POST["projectCat"];
            $sousCat = $_POST["sousCat"];
            $projectDate = date("Y-m-d H:i:s");
            $query =$connect -> prepare("INSERT INTO projets (titre_projet, projet_description, id_categorie, id_sous_categorie, id_utilisateur, created_in) VALUES (?,?,?,?,?,?)");
            $query -> bind_param("ssssss",$projectName,$projectDesc,$projectCat,$sousCat,$sessionID,$projectDate);
           $query -> execute();
           echo "<div class='bg-green-500 text-white font-bold w-full py-4 text-center'>Project was added successfully</div>";
        }
 ?>
  <!-- EDIT PROJECT -->
   <?php
    if (isset($_POST["editProject"])){
        $editedName = $_POST["edit-name"];
        $editedDesc = $_POST["edit-desc"];
        $editCat = (int)$_POST["edit-cat"];
        $editSubCat = (int)$_POST["editSousCat"];
        $projetId = $_POST["projectId"];
        $editQuery = $connect -> prepare("UPDATE projets SET titre_projet = ?,projet_description = ?, id_categorie = ?, id_sous_categorie = ? WHERE id_projet = ?");
        $editQuery -> bind_param("sssss",$editedName, $editedDesc, $editCat, $editSubCat, $projetId );
        $editQuery -> execute();
        
    }
   ?>
   <!-- delete projet -->
    <?php
        if (isset($_GET["deletePr"])){
            $idDelete = (int)$_GET["deletePro"];
            $queryDel = $connect -> query("DELETE FROM projets WHERE id_projet = $idDelete");
        }
    ?>
     <!-- nav bar  -->
  <nav class="flex justify-between items-center px-4 md:px-6 py-4 bg-white shadow-md flex-wrap">
    <h2 class="text-cyan-600 font-semibold text-xl">itThink</h2>
    <ul class="flex justify-between items-center gap-6">
    <li ><a href="index.php" class="text-slate-900 font-bold text-lg hover:text-cyan-600 transition-all">Log Out</a></li>
      <li ><a href="signup.php" class="text-slate-900 font-bold text-lg hover:text-cyan-600 transition-all">Freelancer</a></li>
    </ul>
</nav>
<div class="page-header flex flex-col gap-4 md:flex-row py-4 bg-slate-300 md:justify-between px-4 md:px-6 md:items-center">
    <!-- user name -->
    <div class="userName  text-black  py-2 px-4 grow">
        Good morning: 
        <span class="font-bold"><?php
            echo $getItAsArr["nom_utilisateur"];
            ?></span>
    </div>
    <!-- ajouter -->
     <!-- Ajouter -->
    <div class="ajouter ml-2">
    
    
    <!-- Modal toggle -->
    <button data-modal-target="add-projet" data-modal-toggle="add-projet" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
    Add Project
    </button>
    
    <!-- Main modal -->
    <div id="add-projet" tabindex="-1" aria-hidden="true" class="hidden  overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Add a project
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="add-projet">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="utilisateur.php" method="POST">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project name</label>
                        <input type="text" name="pr-name" id="pr-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Enter a name" required />
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project description</label>
                        <textarea type="text" name="pr-desc" id="pr-desc" placeholder="Enter a description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required ></textarea>
                    </div>
                    <!-- categorie -->
                    <div class="flex justify-between items-center">
                <label for="selectCat" class="block  mr-7 font-medium text-gray-900 ">Category</label>
        <select id="selectCat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 " name="projectCat">
           <?php
            $getCats = "SELECT * FROM categorie";
            $catQuery = $connect -> query($getCats);
            $getCatsAsArr = $catQuery -> fetch_all(MYSQLI_ASSOC);
            for ($i=0; $i < count($getCatsAsArr);$i++) {
                $catId = $getCatsAsArr[$i]["id_categorie"];
                $catName = $getCatsAsArr[$i]["nom_categorie"];
                echo "<option value='$catId'>$catName</option>";
            }
    
           ?>
        </select>
                    </div>
                    <!-- categorie -->
                    <div class="flex justify-between items-center">
                <label for="souCat" class="block  mr-7 font-medium text-gray-900 ">Sub category</label>
        <select id="souCat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 " name="sousCat">
           <?php
            $getCats = "SELECT * FROM sous_categorie";
            $catQuery = $connect -> query($getCats);
            $getCatsAsArr = $catQuery -> fetch_all(MYSQLI_ASSOC);
            for ($i=0; $i < count($getCatsAsArr);$i++) {
                $catId = $getCatsAsArr[$i]["id_sous_categorie"];
                $catName = $getCatsAsArr[$i]["nom_sous_categorie"];
                echo "<option value='$catId'>$catName</option>";
            }
    
           ?>
        </select>
                    </div>
                    <input type="submit" value="Add Project" name="addProject" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                </form>
            </div>
        </div>
    </div>
    </div> 
    
    </div>
    <!-- filter -->
    <div class="filter  " >
 <form action="utilisateur.php" method="POST" class="flex  items-center mr-7                 ">
 <label for="category" class="block mr-7 font-medium text-gray-900 ">Filter</label>
  <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 " name="catFilter">
  <option value='*'>All</option>
  <?php
            #filtring by cattegorie
            
            $catQuery = "SELECT nom_categorie, id_categorie FROM categorie";
            $applyQuery = $connect-> query($catQuery);
            $catsAsValurs = $applyQuery -> fetch_all(MYSQLI_ASSOC);

            for ($i =0; $i < count($catsAsValurs); $i++){
                $catId = $catsAsValurs[$i]["id_categorie"];
                $catName = $catsAsValurs[$i]["nom_categorie"];
                echo "<option value='$catId'>$catName</option>";
             }
           ?>

  </select>
  <input type="submit" name="filterCat" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
 </form>
</div>
<!-- search -->
<!-- search -->
    <div class="search">
        <form action="utilisateur.php" method="POST" class="flex justify-between">
            <input type="search" name="search" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 mr-2" placeholder="Search">
            <input type="submit" value="Search" name="submit_search" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 cursor-pointer" >
        </form>
    </div>
  </div>

    <!-- dashboard projects  -->
  <main class="dashboard mx-auto container px-4 py-10">
  <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
  <!--  -->
      <?php
    
   if (isset($_POST["submit_search"])){ // search by project name
    $search = $_POST["search"];
    $requet = $connect -> prepare("SELECT id_projet, titre_projet, projet_description, id_categorie, id_sous_categorie, created_in FROM projets where  titre_projet = ?");
    $requet -> bind_param("s",$search);
    $requet -> execute();
    $result = $requet -> get_result();
    $projectsAsArr = $result -> fetch_all(MYSQLI_ASSOC);

   } elseif (isset($_POST["filterCat"]) && $_POST["catFilter"] !== "*") { // filter by categorie

        $selectedCat =(int)$_POST["catFilter"];
        $requet = $connect -> prepare("SELECT id_projet, titre_projet, projet_description, id_categorie, id_sous_categorie, created_in FROM projets where  id_categorie = ?");
        $requet -> bind_param("s",$selectedCat);
        $requet -> execute();
        $result = $requet -> get_result();
        $projectsAsArr = $result -> fetch_all(MYSQLI_ASSOC);
   } else{ // normal case show everything
        $projectsQuery = "SELECT id_projet, titre_projet, projet_description, id_categorie, id_sous_categorie, created_in from projets where id_utilisateur = $sessionID";
        $getProjects = $connect -> query($projectsQuery);
        $projectsAsArr = $getProjects -> fetch_all(MYSQLI_ASSOC);
   }

    for ($i = 0; $i < count($projectsAsArr); $i++){
        // categorie
        $getCat = $connect -> query("SELECT nom_categorie from categorie where id_categorie = {$projectsAsArr[$i]['id_categorie']}");
        $catPrint = $getCat -> fetch_assoc();
        // sub categorie
        $getSousCat = $connect -> query("SELECT nom_sous_categorie from sous_categorie where id_sous_categorie = {$projectsAsArr[$i]['id_sous_categorie']}");
        $sousCatPrint = $getSousCat -> fetch_assoc();
        echo "
        <div class='bg-gray-100 shadow-md rounded-lg p-6 relative'>
        <div class='absolute top-0 right-0 flex'>
                        <!-- Modal toggle -->
        <i data-modal-target='edit-projet' data-modal-toggle='edit-projet' class='fa-solid edit-pro fa-pen-to-square text-white bg-green-500 p-3 font-bold text-lg cursor-pointer hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-3 py-2 text-center mr-2' type='i'>
        </i>
        <form action='utilisateur.php' method='GET'>
            <input type='text' value='{$projectsAsArr[$i]['id_projet']}'  name='deletePro' class='hidden'>
            <button type='submit' value='delete' name='deletePr' class='fa-solid fa-x text-white bg-rose-500 p-3 font-bold text-lg cursor-pointer hover:bg-rose-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-3 py-2 text-center '>
            
            </button>
        </form>
        </div>
        <h2 class='project-title text-lg font-semibold text-gray-800 mb-2' data-id='{$projectsAsArr[$i]['id_projet']}'>{$projectsAsArr[$i]['titre_projet']}</h2>
        <p class='text-gray-600 text-sm mb-4'>
         {$projectsAsArr[$i]['projet_description']}
        </p>
        <div class='text-sm text-gray-500'>
          <p><strong>Category:</strong> {$catPrint['nom_categorie']}</p>
          <p><strong>Subcategory:</strong> {$sousCatPrint['nom_sous_categorie']}</p>
          <p><strong>Date:</strong> {$projectsAsArr[$i]['created_in']}</p>
        </div>
      </div>
        ";
    }

    ?>
    </div>
  </main>

        
         <div class="edit">
<!-- Main modal -->
<div id="edit-projet" tabindex="-1" aria-hidden="true" class="hidden  overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    edit a project
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-projet">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4 edit-project" action="utilisateur.php" method="POST">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project name</label>
                        <input type="text" name="edit-name" id="edit-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Enter a name" required />
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project description</label>
                        <textarea type="text" name="edit-desc" id="edit-desc" placeholder="Enter a description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required ></textarea>
                    </div>
                    <div class="flex justify-between items-center">
                       
                <label for="selectCat" class="block  mr-7 font-medium text-gray-900 ">Category</label>
        <select id="selectCat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 " name="edit-cat">
           <?php
            $getCats = "SELECT * FROM categorie";
            $catQuery = $connect -> query($getCats);
            $getCatsAsArr = $catQuery -> fetch_all(MYSQLI_ASSOC);
            for ($i=0; $i < count($getCatsAsArr);$i++) {
                $catId = $getCatsAsArr[$i]["id_categorie"];
                $catName = $getCatsAsArr[$i]["nom_categorie"];
                echo "<option value='$catId'>$catName</option>";
            }

           ?>
        </select>
                    </div>
                      <!-- sub categorie -->
                      <div class="flex justify-between items-center">
                <label for="souCat" class="block  mr-7 font-medium text-gray-900 ">Sub category</label>
        <select id="souCat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 " name="editSousCat">
           <?php
            $getCats = "SELECT * FROM sous_categorie";
            $catQuery = $connect -> query($getCats);
            $getCatsAsArr = $catQuery -> fetch_all(MYSQLI_ASSOC);
            for ($i=0; $i < count($getCatsAsArr);$i++) {
                $catId = $getCatsAsArr[$i]["id_sous_categorie"];
                $catName = $getCatsAsArr[$i]["nom_sous_categorie"];
                echo "<option value='$catId'>$catName</option>";
            }

           ?>
        </select>
                    </div>
                        <input type="text" name="projectId" class=" putId">
                    <input type="submit" value="Edit Project" name="editProject" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                </form>
            </div>
        </div>
    </div>
</div> 
        </div>
        <!-- js files -->
        <script src="js/script.js"></script>
</body>
</html>