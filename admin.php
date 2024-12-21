<?php
  include "dataBase.php";
  session_start();
  if ($_SESSION["role"] == "admin"){
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
  } else {
    header("location: index.php");
    exit;
  }


  $showCats = $connect -> query("SELECT nom_categorie, id_categorie from categorie");
  $showAllCats = $showCats -> fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <style>
        /* Hide sections by default */
        .dashboard-section {
            display: none;
        }
        /* Show active section */
        .dashboard-section.active {
            display: block;
        }
        /* Active navigation state */
        .nav-link.active {
            background-color: #4B5563;
        }
    </style>
</head>
<body>
    <div class="flex h-screen bg-gray-100 relative">
        <div class="absolute top-4 right-3.5 berger block md:hidden" >
        <i class="fa-solid fa-bars text-3xl cursor-pointer"></i>
        </div>
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800  navbar hidden md:block">
            <div class="p-4 border-b border-gray-700">
                <h2 class="text-xl font-bold text-white">Admin Dashboard</h2>
            </div>
            
            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="#overview" onclick="showSection('overview')" class="nav-link block text-white hover:bg-gray-700 rounded p-2">
                            Overview
                        </a>
                    </li>
                    <li>
                        <a href="#project" onclick="showSection('project')" class="nav-link block text-white hover:bg-gray-700 rounded p-2">
                            Projects Manager
                        </a>
                    </li>
                    <li>
                        <a href="#Categories" onclick="showSection('Categories')" class="nav-link block text-white hover:bg-gray-700 rounded p-2">
                            Categories
                        </a>
                    </li>
                    <li>
                        <a href="index.php" class="nav-link block text-white hover:bg-gray-700 rounded p-2">
                            Sign Out
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-lg">
                <div class="p-4 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Welcome back!</h1>
                        <p class="text-gray-600">Role: <?= $_SESSION["role"] ?></p>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <!-- Overview Section -->
                <section id="overview" class="dashboard-section active">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-gray-700 text-lg font-semibold mb-2">Projects</h3>
                            <p class="text-3xl font-bold text-gray-900"><?=$projectsRowsArr["project_rows"] ?></p>
                        </div>
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-gray-700 text-lg font-semibold mb-2">Users</h3>
                            <p class="text-3xl font-bold text-gray-900"><?=$usersRowsAsArr["users_rows"]?></p>
                        </div>
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-gray-700 text-lg font-semibold mb-2">Freelancers</h3>
                            <p class="text-3xl font-bold text-gray-900"><?= $freelancesAsArr["count_freelance"]?></p>
                        </div>
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-gray-700 text-lg font-semibold mb-2">Offres</h3>
                            <p class="text-3xl font-bold text-gray-900"><?=$offresAsArr["offres_count"]?></p>
                        </div>
                    </div>
                </section>

                <!-- Project Management Section -->
                 <!-- php part-->
                  <?php
                     $projectsQuery = "SELECT id_projet, titre_projet, pr_status from projets";
                     $getProjects = $connect -> query($projectsQuery);
                     $projectsAsArr = $getProjects -> fetch_all(MYSQLI_ASSOC);
                  ?>
                <section id="project" class="dashboard-section overflow-scroll">
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="text-xl font-semibold text-gray-900">Projects Manager</h2>
                        </div>
                        <div class="p-4">
                            <table class="min-w-full     bg-white">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="text-left p-4">Id Project</th>
                                        <th class="text-left p-4">Project title</th>
                                        <th class="text-left p-4">Status</th>
                                        <th class="text-left p-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                      for ($i = 0; $i < count($projectsAsArr); $i++){ ?>
                                      <tr class="border-b">
                                        <td class="p-4 idProject"><?= $projectsAsArr[$i]["id_projet"] ?></td>
                                        <td class="p-4"><?= $projectsAsArr[$i]["titre_projet"] ?></td>
                                        <td class="p-4"><span class="px-2 py-1 bg-green-100 text-green-800 rounded"><?= $projectsAsArr[$i]["pr_status"] ?></span></td>
                                        <td class="p-4">
                                            <button class="text-rose-500 hover:text-rose-700 editStatus" data-modal-target='edit-status' data-modal-toggle='edit-status' type='i'>Edit Status</button>
                                        </td>
                                    </tr>
                                      <?php } ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- edit status menu -->
                    <div class="edit">
<!-- Main modal -->
<div id="edit-status" tabindex="-1" aria-hidden="true" class="hidden  overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Edit Status
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-status">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4 edit-project" action="admin.php" method="POST">
                   
                    <div>
                      <label for="status">Enter New Status</label>
                      <select name="proState" id="status" class="px-4 py-2 rounded-lg ml-2">
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                        <option value="Canceled">Canceled</option>
                      </select>
                    </div>   
                        <input type="text" name="projectId" class="statusId hidden">
                    <input type="submit" value="Edit Status" name="editStatus" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                </form>
            </div>
            <!-- edit status in php -->
             <?php
              if (isset($_POST["editStatus"])){
                $editValue = $_POST["proState"];
                $editId = $_POST["projectId"];
                // die();
                $query = $connect -> prepare("UPDATE projets SET pr_status = ? WHERE id_projet = ?");
                $query -> bind_param("ss", $editValue, $editId );
                $query -> execute();
              }
             ?>
        </div>
    </div>
</div> 
        </div>
                </section>

                <!-- Categories Section -->
                <section id="Categories" class="dashboard-section">
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="text-xl font-semibold text-gray-900">Categories</h2>
                            <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Create Category</button>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                           
                              <?php
                                for ($i = 0; $i < count($showAllCats); $i++) { ?>
                                    <div class="border rounded p-4 mx-auto">
                                    <h3 class="cat-name font-semibold text-center" data-idCat=<?= "{$showAllCats[$i]["id_categorie"]}" ?>><?= $showAllCats[$i]["nom_categorie"] ?></h3>
                                    <div class="mt-2">
                                    <button class="edit-cat bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600" data-modal-target='edit-cat' data-modal-toggle='edit-cat' type='i'>Edit Categorie</button>
                                    <button class="bg-rose-500 text-white px-3 py-1 rounded hover:bg-rose-600">Delete Categorie</button>
                                    </div>
                                </div>
                                <?php } ?>
                               
                                <!-- Add more project cards as needed -->
                            </div>
                        </div>
                    </div>
                       <!-- edit status menu -->
                       <div class="edit">
<!-- Main modal -->
<div id="edit-cat" tabindex="-1" aria-hidden="true" class="hidden  overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Edit Category
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-cat">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4 edit-project" action="admin.php" method="POST">
                   
                    <div>
                      <label for="status">Enter New Category</label>
                      <input type="text" name="newCat" class="newCat rounded">
                    </div>   
                        <input type="text" name="catId" class="catId hidden">
                    <input type="submit" value="Edit Category" name="editCategory" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                </form>
            </div>
            <!-- edit status in php -->
             <?php
              if (isset($_POST["editCategory"])){
                $editValue = $_POST["newCat"];
                $editId = $_POST["catId"];
                // die();
                $query = $connect -> prepare("UPDATE categorie SET nom_categorie = ? WHERE id_categorie = ?");
                $query -> bind_param("ss", $editValue, $editId );
                $query -> execute();
              }
             ?>
        </div>
    </div>
</div> 
        </div>
                                </section>
            </main>
        </div>
    </div>
    <script>
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.dashboard-section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Show selected section
            document.getElementById(sectionId).classList.add('active');
            
            // Update active navigation state
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            document.querySelector(`a[href="#${sectionId}"]`).classList.add('active');
        }

        // Check URL hash on page load
        window.addEventListener('load', () => {
            const hash = window.location.hash.slice(1) || 'overview';
            showSection(hash);
        });
        // ***************************Admin****************
// edit status
document.querySelectorAll(".editStatus").forEach(edit => {
    edit.addEventListener("click", ()=>{
        let idAtt = edit.parentNode.parentNode.querySelector(".idProject").textContent;
        document.querySelector(".statusId").value = idAtt;
    })
})
// admin navbar
document.querySelector(".berger").addEventListener("click",()=>{
    document.querySelector(".navbar").classList.toggle("hidden");
    console.log("clicked");

})
// edit category
document.querySelectorAll(".edit-cat").forEach(edit => {
    edit.addEventListener("click", ()=>{
        let idAtt = edit.parentNode.parentNode.querySelector(".cat-name").getAttribute("data-idCat");
        document.querySelector(".newCat").value = edit.parentNode.parentNode.querySelector(".cat-name").textContent;
        document.querySelector(".catId").value = idAtt;
    })
})
    </script>
</body>
</html>