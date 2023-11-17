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

$id = $_GET['catid'];
$query = "SELECT * FROM `categories` WHERE `categoryId` = $id";
$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($result)){
    $catname = $row['categoryName'];
    $catdesc = $row['categoryDesc'];
}

$method = $_SERVER['REQUEST_METHOD'];
$showalert = false;
if($method=='POST'){
    $th_title = $_POST['Title'];
    $th_title = str_replace('<','&lt;',$th_title);
    $th_title = str_replace('>','&gt;',$th_title);
    $th_desc = $_POST['Desc'];
    $th_desc = str_replace('<','&lt;',$th_desc);
    $th_desc = str_replace('>','&gt;',$th_desc);
    $sql = "INSERT INTO `threads` ( `threadTitle`, `threadDesc`, `threadUserId`, `threadCatId`, `timestamp`) VALUES ( '$th_title', '$th_desc', '" . $_SESSION['uid'] . "' , '$id', current_timestamp())";
    $result = mysqli_query($connection,$sql);
    $showalert = true;
    if($showalert){
        echo '
        <div id="alert-3" class="fixed top-[12vh] left-0 right-0 flex items-center p-4 text-green-800 rounded-lg bg-green-50" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div class="ml-3 text-sm font-medium">
            <span class="font-semibold">Success !!!</span> Your Question has been submitted successfully, please wait until someone responds.
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
}

echo '
<div class="w-full flex-wrap flex bg-gray-300 h-[88vh] ">';

include 'partials/_body.php';

echo '
<div class="right w-2/3 p-4 px-12 h-full overflow-y-scroll">
    <div class="post p-4 shadow bg-white rounded ">
    <section class="bg-white ">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl ">Welcome to <span class="text-red-500">'.$catname.'</span> forum</h1>
            <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 ">'.$catdesc.'</p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                <a href="#post" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 ">
                    Get started
                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>';
                
if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
            echo'
                <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"  class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 ">
                    Ask Question
                </button>  ';
}else{
            echo'
                <button data-modal-target="rlogin-modal" data-modal-toggle="rlogin-modal"  class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 ">
                    Ask Question
                </button>  ';
                include 'partials\_requestlogin.php';
}

echo'
            </div>
        </div>
    </section>
    </div>

    <!-- Main modal -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow ">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center " data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 ">Ask a question</h3>
                    <form class="space-y-6" action="/forumapp/threadlist.php?catid='.$id.'" method="post">
                        <div>
                            <label for="Title" class="block mb-2 text-sm font-medium text-gray-900 ">Problem title</label>
                            <input type="text" name="Title" id="Title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 " placeholder="Write crisp and short title " required>
                        </div>
                        <div>
                            <label for="Desc" class="block mb-2 text-sm font-medium text-gray-900 ">Problem Description</label>
                            <input type="text" name="Desc" id="Desc" placeholder="Elaborate your problem title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 " required>
                        </div>
                        <button type="submit" class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div> 



    <div id="post" class="post my-2 p-4 shadow bg-white rounded ">
    ';
    $noques = true;
    $query = "SELECT * FROM `threads` WHERE `threadCatId` = $id ORDER BY timestamp DESC";
    $result = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($result)){
        $noques = false;
        $title = $row['threadTitle'];
        $desc = $row['threadDesc'];
        $tid = $row['threadId'];
        $tuserid = $row['threadUserId'];
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
        
        if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
            echo '                    
                <section class="bg-white ">
                <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
                    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-500 md:text-5xl lg:text-6xl ">No questions found</h1>
                    <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 ">Be the first one to ask a question</p>
                    <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                    <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"  class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 ">
                        Ask question
                    </button>  
                </div>
                </div>
                </section>';
            }else{
                echo '                    
                    <section class="bg-white ">
                    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
                        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-500 md:text-5xl lg:text-6xl ">No questions found</h1>
                        <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 ">Be the first one to ask a question</p>
                        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                        <button data-modal-target="rlogin-modal" data-modal-toggle="rlogin-modal"  class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 ">
                            Ask question
                        </button>  
                    </div>
                    </div>
                    </section>';
                include 'partials\_requestlogin.php';
            }

        echo '
            <!-- Main modal -->
            <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow ">
                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center " data-modal-hide="authentication-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="px-6 py-6 lg:px-8">
                            <h3 class="mb-4 text-xl font-medium text-gray-900 ">Ask a question</h3>
                            <form class="space-y-6" action="/forumapp/threadlist.php?catid='.$id.'" method="post">
                                <div>
                                    <label for="Title" class="block mb-2 text-sm font-medium text-gray-900 ">Problem title</label>
                                    <input type="text" name="Title" id="Title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 " placeholder="Write crisp and short title " required>
                                </div>
                                <div>
                                    <label for="Desc" class="block mb-2 text-sm font-medium text-gray-900 ">Problem Description</label>
                                    <input type="text" name="Desc" id="Desc" placeholder="Elaborate your problem title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 " required>
                                </div>
                                <button type="submit" class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        ';
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
