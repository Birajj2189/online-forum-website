<?php
session_start();


echo '
<header class="border text-gray-600 body-font h-[12vh] shadow-3xl">
<div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
  <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
    <span class="text-red-600 ml-3 text-2xl">CodeWave</span>
  </a>
  <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center">
    <a href="/forumapp" class="mr-5 hover:text-gray-900">
    <svg className="text-red-600" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22.02 11.46L12.63 2.45999C12.34 2.17999 11.89 2.17999 11.6 2.44999L1.99 11.45C1.77 11.66 1.69 11.99 1.8 12.27C1.91 12.56 2.19 12.74 2.5 12.74H5.25V20.49C5.25 20.9 5.59 21.24 6 21.24H9.62C10.03 21.24 10.37 20.9 10.37 20.49V16.36C10.37 15.43 11.09 14.67 12 14.62H12.12C13.08 14.62 13.87 15.4 13.87 16.37V20.5C13.87 20.91 14.21 21.25 14.62 21.25H18C18.41 21.25 18.75 20.91 18.75 20.5V12.75H21.5C21.81 12.75 22.08 12.56 22.2 12.28C22.32 12 22.24 11.67 22.02 11.46Z" fill="#e53935" class="icon_svg-fill_as_stroke"></path></svg>
    </a>
    <a href="about.php" class="mr-5 hover:text-gray-900">
    <svg className="bg-red-600" width="24" height="24" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><title>about</title><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="about-white" fill="#e53935" transform="translate(42.666667, 42.666667)"><path d="M213.333333,3.55271368e-14 C95.51296,3.55271368e-14 3.55271368e-14,95.51168 3.55271368e-14,213.333333 C3.55271368e-14,331.153707 95.51296,426.666667 213.333333,426.666667 C331.154987,426.666667 426.666667,331.153707 426.666667,213.333333 C426.666667,95.51168 331.154987,3.55271368e-14 213.333333,3.55271368e-14 Z M213.333333,384 C119.227947,384 42.6666667,307.43872 42.6666667,213.333333 C42.6666667,119.227947 119.227947,42.6666667 213.333333,42.6666667 C307.44,42.6666667 384,119.227947 384,213.333333 C384,307.43872 307.44,384 213.333333,384 Z M240.04672,128 C240.04672,143.46752 228.785067,154.666667 213.55008,154.666667 C197.698773,154.666667 186.713387,143.46752 186.713387,127.704107 C186.713387,112.5536 197.99616,101.333333 213.55008,101.333333 C228.785067,101.333333 240.04672,112.5536 240.04672,128 Z M192.04672,192 L234.713387,192 L234.713387,320 L192.04672,320 L192.04672,192 Z" id="Shape"></path></g></g></svg>
    </a>
    <a href="contactform.php" class="mr-5 hover:text-gray-900">
    <svg className="bg-red-600" width="30" height="30" viewBox="0 0 128 128" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#e53935"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{display:none;} .st1{display:inline;} .st2{fill:none;stroke:#e53935;stroke-width:8;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;} </style> <g class="st0" id="Layer_1"></g> <g id="Layer_2"> <path class="st2" d="M20.1,40l38.1,31.5c3.3,2.8,8.2,2.8,11.5,0L107.9,40"></path> <path class="st2" d="M107.9,85.6V36.1c0-2.1-1.7-3.7-3.7-3.7H23.9c-2.1,0-3.7,1.7-3.7,3.7v55.7c0,2.1,1.7,3.7,3.7,3.7h84"></path> </g> </g></svg>    </a>
    </nav>

    <form className="mx-2" method="GET" action="search.php">   
        <label for="default-search" class=" text-sm font-medium text-gray-900 sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" id="default-search" name="search" class="block w-96 p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-red-600 focus:border-red-600 " placeholder="Search on CodeWave" required>
            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 ">Search</button>
        </div>
    </form>';

if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
      echo '
      <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="mx-2 h-13 text-white bg-red-500 hover:bg-red-600  focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center " type="button">
      <img class="w-8 h-8 rounded-full" src="./public/avatar.png" alt="Rounded avatar">
    <div class="px-2">Hey '.$_SESSION['username'].'</div>
    <svg class="w-2.5 h-2.5 ml-2.5 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
  </svg>
</button>
<div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
    <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdownDefaultButton">
      <li>
        <a href="profile.php" class="w-full block px-4 py-2 hover:bg-gray-100 ">View Profile</a>
      </li>
      <li>
        <a href="partials/_logout.php" class="w-full block px-4 py-2 hover:bg-gray-100 ">Logout</a>
      </li>
    </ul>
</div>
</div>
</header>';
}else{
  echo '
  <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="mx-2 h-13 text-white bg-red-500 hover:bg-red-600  focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center " type="button">
  <img class="w-8 h-8 rounded-full" src="./public/avatar.png" alt="Rounded avatar">
<svg class="w-2.5 h-2.5 ml-2.5 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
</svg>
</button>
<div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
<ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdownDefaultButton">
  <li>
    <button data-modal-target="login-modal" data-modal-toggle="login-modal" class="w-full block px-4 py-2 hover:bg-gray-100 ">Login</button>
  </li>
  <li>
    <button data-modal-target="signup-modal" data-modal-toggle="signup-modal" class="w-full block px-4 py-2 hover:bg-gray-100 ">Sign up</button>
    </li>
</ul>
</div>
</div>
</header>';


}

include "partials/_loginModal.php";
include "partials/_signupModal.php";

if (isset($_GET['signupsuccess'])) {
  if ($_GET['signupsuccess'] == "true") {
  echo '<div id="alert-8" class="flex fixed w-full items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 " role="alert">
          <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
          </svg>
          <span class="sr-only">Info</span>
          <div class="ml-3 text-sm font-medium">
              <span class="font-bold">Signup Successfull :</span> You can now Login to your account.
          </div>
          <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8  " data-dismiss-target="#alert-8" aria-label="Close">
              <span class="sr-only">Close</span>
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
              </svg>
          </button>
          </div>
  ';
} elseif ($_GET['signupsuccess'] == "false" && isset($_GET['error'])) {
  $error = urldecode($_GET['error']);
    echo '<div id="alert-9" class="flex fixed w-full items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50  " role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
            <span class="font-bold">Signup Failed : </span>'.$error.' Try again.
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 " data-dismiss-target="#alert-9" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            </button>
          </div>';
        }
      }
if (isset($_GET['loginsuccess'])) {
  if ($_GET['loginsuccess'] == "true") {
  echo '<div id="alert-10" class="flex fixed w-full items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 " role="alert">
          <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
          </svg>
          <span class="sr-only">Info</span>
          <div class="ml-3 text-sm font-medium">
              <span class="font-bold">Login Successfull :</span> Welcome to your account.
          </div>
          <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8  " data-dismiss-target="#alert-10" aria-label="Close">
              <span class="sr-only">Close</span>
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
              </svg>
          </button>
          </div>
  ';
} elseif ($_GET['loginsuccess'] == "false" ) {
    echo '<div id="alert-11" class="flex fixed w-full items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50  " role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
            <span class="font-bold">Signup Failed : </span> Invalid email or password ! Try again.
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 " data-dismiss-target="#alert-11" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            </button>
          </div>';
        }
      }


?>