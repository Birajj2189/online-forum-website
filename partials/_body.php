<?php
include "partials/dbconnect.php";

// Query to fetch categories from the database
$query = "SELECT categoryName,pictureName,categoryId FROM categories";
$result = mysqli_query($connection, $query);

// Start the HTML content
echo '
	<div class="left w-1/3 p-4 px-12 h-full overflow-y-scroll">
        <div class="p-4 shadow bg-white rounded w-full">
            <div class="p-2 text-gray-500 w-full text-2xl font-semibold">Categories</div>
            
            <div class="flex-col w-full">'; 

// Loop through the categories and generate the HTML
while ($row = mysqli_fetch_assoc($result)) {
    $categoryName = $row['categoryName'];
    $categoryId = $row['categoryId'];   
    $pictureName = $row['pictureName'];
    echo '
    <div class="w-full  my-2 bg-gray-100 p-2 rounded cursor-pointer hover:bg-gray-200 ">
    <a class="w-full flex items-center" href="threadlist.php?catid='.$categoryId.'">
    <img class="h-8 w-8 mr-2" src="./public/'.$pictureName.'"/>
    <span class="w-full">' . $categoryName . '</span></a>
    </div>';
}

// Continue with the rest of your HTML
echo '
            </div>
            
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
?>

