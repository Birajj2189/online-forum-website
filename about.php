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
<div class="right w-2/3 p-4 px-12">
<div class="post p-4 shadow bg-white rounded ">

    
    <h1 class="font-semibold text-gray-500 text-xl my-2">About CodeWave</h1>
    
    <p class="text-sm my-1 text-gray-900 leading-6">Welcome to CodeWave, your ultimate destination for all things coding and software development! Whether youre a seasoned programmer or just dipping your toes into the world of coding, we have created this community with you in mind.</p>
    
    <p class="text-sm my-1 text-gray-900 leading-6">At CodeWave, we are passionate about fostering a collaborative environment where developers of all skill levels can come together to share knowledge, ask questions, and explore the latest trends and technologies in the coding world. Whether you are seeking help with a specific coding problem, looking to discuss the latest programming languages, or simply want to connect with like-minded individuals, you will find a home here.</p>
    
    <p class="text-sm my-1 text-gray-900 leading-6">Join us in riding the CodeWave, as we dive into the depths of programming, surf the latest tech trends, and build a supportive community dedicated to advancing our coding skills and knowledge. Get ready to catch the CodeWave and start your journey today!</p>
    
        
    <h1 class="font-semibold my-2 text-gray-500 text-xl">Our Commitment</h1>
    
    <p class="text-sm my-1 text-gray-900 leading-6">At CodeWave, we are committed to providing a platform that fosters collaboration, innovation, and continuous learning. Here is what you can expect:</p>
    
    <p class="text-sm my-1 text-gray-900 leading-6"><span class="font-medium">1. Knowledge Sharing:</span> Our forums are brimming with discussions on programming languages, frameworks, tools, and best practices. Ask questions, share your expertise, and learn from a global network of coding enthusiasts.</p>
    
    <p class="text-sm my-1 text-gray-900 leading-6"><span class="font-medium">2. Problem Solving:</span> Stuck on a coding conundrum? Post your questions, and let our community of experts help you find solutions. You will be amazed at how quickly challenges can turn into breakthroughs.</p>
    
    <p class="text-sm my-1 text-gray-900 leading-6"><span class="font-medium">3. Inspiration:</span> Explore the latest tech trends, discover coding projects that push the boundaries, and get inspired to create your own waves of innovation.</p>
    
    <p class="text-sm my-1 text-gray-900 leading-6"><span class="font-medium">4. Community:</span> Beyond coding, CodeWave is about building connections. Connect with like-minded individuals, form study groups, or just chat with fellow coders who share your interests and ambitions.</p>
    
    <p class="text-sm my-1 text-gray-900 leading-6"><span class="font-medium">5. Coding Challenges:</span> For those who love a good challenge, we regularly host coding competitions and challenges that will test your skills and push you to new heights.</p>
</div>
</div>

';

echo '</div>';
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
