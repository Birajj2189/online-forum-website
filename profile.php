<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible"
		content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
<title>CodeWave - Coding Forum App</title>
</head>
<style>
    *{
    
}
</style>
<body >

<?php 

include 'partials/dbconnect.php';
include 'partials/_header.php';
$tuserid = $_SESSION['uid'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $showalert1 = false;
    $showalert2 = false;

    if(isset($_POST["form1Submit"])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phno = $_POST['phno'];
        $email = $_POST['email'];
        $sql8 = "UPDATE `users` SET `firstname`='$fname', `lastname`='$lname', `email`='$email', `phno`='$phno' WHERE `userId`=".$_SESSION['uid'];
        $result8 = mysqli_query($connection,$sql8);
        $showalert1 = true;
        
        if($showalert1){
            echo '
            <div id="alert-3" class="fixed top-[12vh] left-0 right-0 flex items-center p-4 text-green-800 rounded-lg bg-green-50" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
                <span class="font-semibold">Success !!!</span> You have successfully edited your profile information
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
            ';
        }
    }elseif (isset($_POST["form2Submit"])) {
        $prevPass = $_POST['prevpass'];
        $newPass = $_POST['newpass'];

        $sql9 = "SELECT * FROM `users` WHERE `userId` = ?";
        $stmt = mysqli_prepare($connection, $sql9);
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['uid']);
        mysqli_stmt_execute($stmt);
        $result9 = mysqli_stmt_get_result($stmt);
        
        if ($row10 = mysqli_fetch_assoc($result9)) {
            if (password_verify($prevPass, $row10['userPass'])) {
                $hash = password_hash($newPass , PASSWORD_DEFAULT);
                $sql10 = "UPDATE `users` SET `userPass`='$hash' WHERE `userId`=".$_SESSION['uid'];
                $result10 = mysqli_query($connection,$sql10);
                if($result10){
                    $showalert2 = "true";
                }
            }
        }
        if($showalert2){
            echo '
            <div id="alert-10" class="fixed top-[12vh] left-0 right-0 flex items-center p-4 text-green-800 rounded-lg bg-green-50" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium">
                    <span class="font-semibold">Success !!!</span> Your Password has been changed successfully.
                </div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-10" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>';
        }else{
            echo '
            <div id="alert-11" class="fixed  w-full flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium">
                    <span class="font-semibold">Failed : </span> The previous Password doesnot match the actual password ! Try again.
                </div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-11" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>';
        }
    }
}


echo '
<div class="w-full flex-wrap flex bg-gray-300 h-[88vh] ">';

// Left section starts here ----------->
// Query to fetch categories from the database
$query5 = "SELECT COUNT(*) AS threadCount FROM threads WHERE threadUserId = $tuserid GROUP BY threadUserId";
$result5 = mysqli_query($connection, $query5);

if ($result5) {
    $row5 = mysqli_fetch_assoc($result5);

    // Now, you can access the count value
    $threadCount = isset($row5['threadCount']) ? $row5['threadCount'] : 0;

    // Use $threadCount as needed in your code
} else {
    // Handle the case where the query fails
    echo "Error executing query: " . mysqli_error($connection);
}

$query6 = "SELECT COUNT(*) AS TotalComments FROM comments WHERE commentUserId = $tuserid GROUP BY commentUserId";
$result6 = mysqli_query($connection, $query6);

if ($result6) {
    $row6 = mysqli_fetch_assoc($result6);

    // Now, you can access the count value
    $totalComments = isset($row6['TotalComments']) ? $row6['TotalComments'] : 0;

} else {
    // Handle the case where the query fails
    echo "Error executing query: " . mysqli_error($connection);
}

$query7 = "SELECT *  FROM users WHERE userId = $tuserid";
$result7 = mysqli_query($connection, $query7);
$row7 = mysqli_fetch_assoc($result7);


$timestamp = isset($row7['timestamp']) ? $row7['timestamp'] : ""; 
$dateFormat = date('jS F, Y', strtotime($timestamp));

// Start the HTML content
echo '
	<div class="left w-1/3 p-4 px-12 h-full overflow-y-scroll">
        <div class="p-4 shadow bg-white rounded w-full">
            <div class="p-2 text-gray-500 w-full text-2xl font-semibold">Personal Information</div>
            
            <div class="flex-col w-full">
                <div class="w-full  my-2 bg-gray-100 p-2 rounded cursor-pointer hover:bg-gray-200 ">
                <div class="w-full flex items-center justify-between">
                    <span class="">FirstName : </span><span class="text-red-400">'.$row7['firstname'].'</span></div>
                </div>
                <div class="w-full  my-2 bg-gray-100 p-2 rounded cursor-pointer hover:bg-gray-200 ">
                <div class="w-full flex items-center justify-between">
                    <span class="">LastName : </span><span class="text-red-400">'.$row7['lastname'].'</span></div>
                </div>
                <div class="w-full  my-2 bg-gray-100 p-2 rounded cursor-pointer hover:bg-gray-200 ">
                <div class="w-full flex items-center justify-between">
                    <span class="">Email : </span><span class="text-red-400">'.$row7['email'].'</span></div>
                </div>
                <div class="w-full  my-2 bg-gray-100 p-2 rounded cursor-pointer hover:bg-gray-200 ">
                <div class="w-full flex items-center justify-between">
                    <span class="">Phone Number : </span><span class="text-red-400">'.$row7['phno'].'</span></div>
                </div>
                <div class="w-full  my-2 bg-gray-100 p-2 rounded cursor-pointer hover:bg-gray-200 ">
                <div class="w-full flex items-center justify-between">
                    <span class="">Questions : </span><span class="text-red-400">'.$threadCount.'</span></div>
                </div>
                <div class="w-full  my-2 bg-gray-100 p-2 rounded cursor-pointer hover:bg-gray-200 ">
                <div class="w-full flex justify-between items-center">
                    <span class="">Commments : </span><span class="text-red-400">'.$totalComments.'</span></div>
                </div>
                <div class="w-full  my-2 bg-gray-100 p-2 rounded cursor-pointer hover:bg-gray-200 ">
                <div class="w-full flex justify-between items-center">
                    <span class="">Date Joined : </span><span class="text-red-400">'.$dateFormat.'</span></div>
                </div>
            </div>
            <button type="submit" data-modal-target="edit-modal" data-modal-toggle="edit-modal" class="w-full my-2 flex justify-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit information
             <svg class="mx-2 " width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button type="submit" data-modal-target="passchange-modal" data-modal-toggle="passchange-modal" class="w-full flex justify-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Change Password
            <svg class="mx-2" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 8.5V6C21 4.89543 20.1046 4 19 4H5C3.89543 4 3 4.89543 3 6V11C3 12.1046 3.89543 13 5 13H10.875M19 14V12C19 10.8954 18.1046 10 17 10C15.8954 10 15 10.8954 15 12V14M14 20H20C20.5523 20 21 19.5523 21 19V15C21 14.4477 20.5523 14 20 14H14C13.4477 14 13 14.4477 13 15V19C13 19.5523 13.4477 20 14 20Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <circle cx="7.5" cy="8.5" r="1.5" fill="#ffffff"></circle> <circle cx="12" cy="8.5" r="1.5" fill="#ffffff"></circle> </g></svg>            </button>
        </div>
        <div class="p-4 my-2 shadow bg-white rounded w-full">
            <div class="flex-col w-full">
                <a class="cursor-pointer">◦ About</a>
                <a class="cursor-pointer">◦ Careers</a>
                <a class="cursor-pointer">◦ Terms</a>
                <a class="cursor-pointer">◦ Privacy</a>
                <a class="cursor-pointer">◦ Acceptable Use</a>
                <a class="cursor-pointer">◦ Business</a>
                <a class="cursor-pointer">◦ Press</a>
                <a class="cursor-pointer">◦ Your Ad Choice</a>
                <a class="cursor-pointer">◦ Grievance officer</a>
            </div>
        </div>
    </div>
';


echo '
<!-- Edit INformation modal -->
<div id="edit-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow ">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center " data-modal-hide="edit-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 ">Edit Personal Information</h3>
                <form class="space-y-6" method="POST" action="/forumapp/profile.php">
                    <div>
                        <label for="firstName" class="block mb-2 text-sm font-medium text-gray-900 ">First Name</label>
                        <input type="text" name="fname" id="fname" value="'.$row7['firstname'].'" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="lastName" class="block mb-2 text-sm font-medium text-gray-900 ">Last Name</label>
                        <input type="text" name="lname" id="lname" value="'.$row7['lastname'].'" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"  required>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email Address</label>
                        <input type="email" name="email" id="email" value="'.$row7['email'].'"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="phno" class="block mb-2 text-sm font-medium text-gray-900 ">Phone number</label>
                        <input type="phone" name="phno" id="phno" value="'.$row7['phno'].'"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required>
                    </div>
                    <button type="submit" name="form1Submit" class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div> 
';
echo '

<!-- PassWord Change modal -->
<div id="passchange-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow ">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center " data-modal-hide="passchange-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 ">Edit Password</h3>
                <form class="space-y-6" method="POST" action="/forumapp/profile.php">
                    <div>
                        <label for="prevpass" class="block mb-2 text-sm font-medium text-gray-900 ">Previous Password</label>
                        <input type="password" name="prevpass" id="prevpass"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" placeholder="•••••••••" required>
                    </div>
                    <div>
                        <label for="newpass" class="block mb-2 text-sm font-medium text-gray-900 ">New Password</label>
                        <input type="password" name="newpass" id="newpass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" placeholder="•••••••••" required>
                    </div>
                    <button type="submit" name="form2Submit" class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Change your password</button>
                </form>
            </div>
        </div>
    </div>
</div> 
';




echo '
<div class="right w-2/3 p-4 px-12 h-full overflow-y-scroll">
    <div class="post p-4 shadow bg-white rounded ">
    <section class="bg-white ">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl ">Hey <span class="text-red-500">'.$_SESSION['username'].'</span> , Welcome to your forum.</h1>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                <a href="#post" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 ">
                    Get started
                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    </div>

    <div id="post" class="post my-2 p-4 shadow bg-white rounded ">
    ';
    $noques = true;
    $query = "SELECT * FROM `threads` WHERE `threadUserId` = $tuserid ORDER BY timestamp DESC";
    $result = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($result)){
        $noques = false;
        $title = $row['threadTitle'];
        $desc = $row['threadDesc'];
        $tid = $row['threadId'];
        $qtime = $row['timestamp'];

        $timestamp1 = new DateTime($qtime, new DateTimeZone('Asia/Kolkata')); // Set the time zone for India
        $current_time = new DateTime(null, new DateTimeZone('Asia/Kolkata')); // Set the time zone for India
    
        $interval1 = $current_time->diff($timestamp1);
        $minutes1 = $interval1->i + ($interval1->h * 60);
        $hours1 = $interval1->h + ($interval1->d * 24);
        $days1 = $interval1->d;
    
        if ($days1 == 0) {
            if ($hours1 == 0) {
                if ($minutes1 == 0) {
                    $time_ago = "Just now";
                } elseif ($minutes1 == 1) {
                    $time_ago = "1 min ago";
                } else {
                    $time_ago = $minutes1 . " mins ago";
                }
            } elseif ($hours1 == 1) {
                $time_ago = "1 hr ago";
            } else {
                $time_ago = $hours1 . " hrs ago";
            }
        } elseif ($days1 == 1) {
            $time_ago = "1 day ago";
        } else {
            $time_ago = $days1 . " days ago";
        }

        $sql2 = "SELECT * FROM `users` WHERE userId = $tuserid";
        $result3 = mysqli_query($connection,$sql2);
        $row2 = mysqli_fetch_assoc($result3);



        echo '      
            <div class="my-2 w-full bg-white border border-gray-200 rounded-lg shadow ">
                <div class=" p-6 bg-white border border-gray-200 rounded-lg shadow ">
                <div class="flex p-2">
                <img class="w-12 h-12 mb-3 mr-3 rounded-full sm:mb-0" src="public/avatar.png" alt="Jese Leos image"/>
                <div>
                    <div class="text-base font-normal"><span class="font-medium text-gray-900 ">'.$row2['username'].'</div>
                    <div class="text-sm text-gray-500"></span> • <span>'.$time_ago.'</span></div>
                </div>
                </div>
                <a href="">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">'.$title.'</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 ">'.$desc.'</p>
                <a href="thread.php?threadId='.$tid.'" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 ">
                    Read more
                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
                </div>

                            
                <div class="p-5 border border-gray-100 rounded-lg bg-gray-50 ">
                <ol class="mt-3 divide-y divider-gray-200 ">';

                $nocomment = true;
                $query1 = "SELECT * FROM `comments` WHERE `threadId` = $tid ORDER BY commentTime DESC";
                $result2 = mysqli_query($connection, $query1);
                $iteration = 0; // Initialize the iteration counter
                
                while ($row = mysqli_fetch_assoc($result2)) {
                    $nocomment = false;
                    if (isset($row['commentContent'])) {
                        $content = $row['commentContent'];
                        $ctime = $row['commentTime'];
                        $cuserid = $row['commentUserid'];

                        $timestamp2 = new DateTime($ctime,new DateTimeZone('Asia/Kolkata'));
                        $interval2 = $current_time->diff($timestamp2);
                        $minutes2 = $interval2->i + ($interval2->h * 60);
                        $hours2 = $interval2->h + ($interval2->d * 24);
                        $days2 = $interval2->d;
                    
                        if ($days2 == 0) {
                            if ($hours2 == 0) {
                                if ($minutes2 == 0) {
                                    $time_ago2 = "Just now";
                                } elseif ($minutes2 == 1) {
                                    $time_ago2 = "1 min ago";
                                } else {
                                    $time_ago2 = $minutes2 . " mins ago";
                                }
                            } elseif ($hours2 == 1) {
                                $time_ago2 = "1 hr ago";
                            } else {
                                $time_ago2 = $hours2 . " hrs ago";
                            }
                        } elseif ($days2 == 1) {
                            $time_ago2 = "1 day ago";
                        } else {
                            $time_ago2 = $days2 . " days ago";
                        }
                        
                        $sql3 = "SELECT * FROM `users` WHERE userId = $cuserid";
                        $result4 = mysqli_query($connection,$sql3);
                        $row3 = mysqli_fetch_assoc($result4);
                                


                    echo '
                    <li>
                        <a href="#" class="items-center block p-2 sm:flex hover:bg-gray-100 ">
                            <img class="w-12 h-12 mr-3 rounded-full sm:mb-0" src="public/avatar.png" alt="Jese Leos image"/>
                            <div class="text-gray-600">
                                <div class="text-base text-sm"><span class="font-medium text-gray-900 ">'.$row2['username'].'</span> • <span>'.$time_ago2.'</span></div>
                                <div class="text-sm font-normal">' . $content . '</div>
                            </div>
                        </a>
                    </li>';
                    
                    $iteration++; // Increment the iteration counter
                }
            
                if ($iteration >= 2) {
                    break; // Exit the loop after reaching 2 iterations
                }
            }
            if($nocomment){
                echo '                
                    <blockquote class="p-2 text-md italic font-semibold text-gray-400 ">
                    <svg class="w-6 h-6 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                        <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z"/>
                    </svg>
                    <p>"No comment on this question, join the conversation by posting your comment on this question."</p>
                    </blockquote>
                ';
            }
                
echo '
                </ol>
                </div>
            </div>';
    }
    if($noques){  
            echo '                    
            <blockquote class="p-2 text-md italic font-semibold text-gray-400 ">
            <svg class="w-6 h-6 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z"/>
            </svg>
            <p>"You donot have any question"</p>
            </blockquote>';
    }

echo'
    </div>
</div>

';

echo '</div>';
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
