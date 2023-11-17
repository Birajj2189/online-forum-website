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

    <body >

    <?php 
    include 'partials/_header.php';

    echo '
    <div class="w-full flex-wrap flex bg-gray-300 h-[88vh] overflow-hidden">';

    include 'partials/_body.php';

    echo '
    <div class="right w-2/3 p-4 px-12 overflow-y-scroll h-full">
    <div class="post p-4 shadow bg-white rounded ">';

    $id = $_GET['threadId'];

    $method = $_SERVER['REQUEST_METHOD'];
    $showalert = false;
    if($method=='POST'){
        $com_title = $_POST['comment'];
        $com_title = str_replace('<','&lt;',$com_title);
        $com_title = str_replace('>','&gt;',$com_title);
        $sql = "INSERT INTO `comments` (`commentContent`, `threadId`, `commentUserid`, `commentTime`) VALUES ('$com_title', '$id', '" . $_SESSION['uid'] . "', current_timestamp())";
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
            <span class="font-semibold">Success !!!</span> Your comment has been successfully posted, and we appreciate your contribution to the discussion.
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



    $query = "SELECT * FROM `threads` WHERE `threadId` = $id ORDER BY timestamp DESC";
    $result = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($result)){
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

        if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
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
            <button data-modal-target="comment-modal" data-modal-toggle="comment-modal" class="inline-flex justify-center items-center py-2 px-3 text-sm font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100">
            Add comment
            <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
            </button>
            </div>      
            <div class="p-5 border border-gray-100 rounded-lg bg-gray-50 ">
            <ol class="mt-3 divide-y divider-gray-200 ">';
        }else{
            echo '      
            <div class="my-2 w-full bg-white border border-gray-200 rounded-lg shadow ">
                <div class=" p-6 bg-white border border-gray-200 rounded-lg shadow ">
                <div class="flex p-2">
                <img class="w-12 h-12 mb-3 mr-3 rounded-full sm:mb-0" src="public/avatar.png" alt="Jese Leos image"/>
                <div>
                    <div class="text-base font-normal"><span class="font-medium text-gray-900 ">Anonymus User</div>
                    <div class="text-sm text-gray-500"></span> • <span>'.$time_ago.'</span></div>
                </div>
                </div>
                <a href="">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">'.$title.'</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 ">'.$desc.'</p>
                <button data-modal-target="rlogin-modal" data-modal-toggle="rlogin-modal" class="inline-flex justify-center items-center py-2 px-3 text-sm font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100">
                Add comment
                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
                </button>
                </div>      
                <div class="p-5 border border-gray-100 rounded-lg bg-gray-50 ">
                <ol class="mt-3 divide-y divider-gray-200 ">';
            
                include 'partials\_requestlogin.php';	
        }






        $nocomment = true;
        $query1 = "SELECT * FROM `comments` WHERE `threadId` = $id ORDER BY commentTime DESC";
        $result2 = mysqli_query($connection,$query1);
        while($row = mysqli_fetch_assoc($result2)){
            $nocomment = false;
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
            <a href="#" class="items-center block p-3 sm:flex hover:bg-gray-100 ">
            <img class="w-12 h-12 mb-3 mr-3 rounded-full sm:mb-0" src="public/avatar.png" alt="Jese Leos image"/>
            <div class="text-gray-600">
            <div class="text-base font-normal"><span class="font-medium text-gray-900 ">'.$row3['username'].'</span> • <span>'.$time_ago2.'</span></div>
            <div class="text-sm font-normal">'.$content.'</div>
            <span class="inline-flex items-center text-xs font-normal text-gray-500 ">
            <svg class="w-2.5 h-2.5 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 0 19 9.5 9.5 0 0 0 0-19ZM8.374 17.4a7.6 7.6 0 0 1-5.9-7.4c0-.83.137-1.655.406-2.441l.239.019a3.887 3.887 0 0 1 2.082 2.5 4.1 4.1 0 0 0 2.441 2.8c1.148.522 1.389 2.007.732 4.522Zm3.6-8.829a.997.997 0 0 0-.027-.225 5.456 5.456 0 0 0-2.811-3.662c-.832-.527-1.347-.854-1.486-1.89a7.584 7.584 0 0 1 8.364 2.47c-1.387.208-2.14 2.237-2.14 3.307a1.187 1.187 0 0 1-1.9 0Zm1.626 8.053-.671-2.013a1.9 1.9 0 0 1 1.771-1.757l2.032.619a7.553 7.553 0 0 1-3.132 3.151Z"/>
            </svg>
            Public
            </span> 
            </div>
            </a>
            </li>';
        }
        if($nocomment){
            echo '                
            <blockquote class="p-4 text-xl italic font-semibold text-gray-400 ">
            <svg class="w-8 h-8 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
            <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z"/>
            </svg>
            <p>"No comment on this question, join the conversation by posting your comment on this question."</p>
            </blockquote>
            ';
        }
        
        echo '
        </ol>
        </div>
        </div>
        ';
    }

    echo '</div>';
    echo '</div>';


    echo '
    <!-- Main modal -->
    <div id="comment-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow ">
    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center  " data-modal-hide="comment-modal">
    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
    </svg>
    <span class="sr-only">Close modal</span>
    </button>
    <div class="px-6 py-6 lg:px-8">
    <h3 class="mb-4 text-xl font-medium text-gray-900 ">Add Comment</h3>
    <div class="text-xl font-semibold text-red-500 py-4">'.$title.'</div>
    <form class="space-y-6" action="/forumapp/thread.php?threadId='.$id.'" method="post">
    <div>
    <input type="text" name="comment" id="comment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5  " placeholder="Add your comment for the above question" required>
    </div>
    <button type="submit" class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Submit</button>

    </form>
    </div>
    </div>
    </div>
    </div> 
    ';
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    </body>
    </html>
