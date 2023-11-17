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

$search = $_GET['search'];
$search = str_replace('<','&lt;',$search);
$search = str_replace('>','&gt;',$search);
$id = 1;

echo '
<div class="w-full flex-wrap flex bg-gray-300 h-[88vh] ">';

include 'partials/_body.php';

echo '
<div class="right w-2/3 p-4 px-12 h-full overflow-y-scroll">
    <div class="post p-4 shadow bg-white rounded ">
    <section class="bg-white ">
        <div class="py-4 px-4 mx-auto max-w-screen-xl text-center">
            <h1 class="mb-4 text-2xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-4xl ">Search result for : <em class="text-red-500">"'.$search.'"</em></h1>
        </div>
    </section>
    </div>

    <div id="post" class="post result my-2 p-4 shadow bg-white rounded ">
    ';
    $noques = true;
    $query = "SELECT * FROM `threads` WHERE match(threadTitle,threadDesc) against ('$search') ORDER BY timestamp DESC";
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
                    
                    $iteration++; 
                }
            
                if ($iteration >= 2) {
                    break; 
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
        <div class="text-center">
            <h1 class="mb-4 text-6xl font-semibold text-red-500">Sorry</h1>
            <p class="mb-4 text-lg text-gray-600">We couldnt find any result.</p>
            <div class="animate-bounce">
            <svg class="mx-auto h-16 w-16 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
            </svg>
            </div>
            <p class="mt-4 text-gray-600">Lets try again .</p>
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
