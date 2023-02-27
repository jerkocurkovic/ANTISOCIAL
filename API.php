<?php
require_once("php/PostsFunctions.php");


function processRequest(){
  $action = getRequestParameter("action");

    switch ($action) {
      case 'togglePostLike':
        processTogglePostLike();
        break;
      case 'togglePostBookmark':
        processTogglePostBookmark();
        break;
      case 'newPost':
        processNewPost();
        break;
      case 'newComment':
        processNewComment();
        break;
      default:
      echo(json_encode(array(
         "success" => false,
         "reason" => "Unknown action: $action"
      )));
      break;
    }
}

function getRequestParameter($key) {
   return isset($_REQUEST[$key]) ? $_REQUEST[$key] : "";
}

//API.php?action=togglePostLike&id=100123&liked=1&likesNum=20
function processTogglePostLike(){
  $success = false;
  $reason = "";

  $id = getRequestParameter("id");
  $liked = getRequestParameter("liked");
  $likesNum = getRequestParameter("likesNum");

  if (is_numeric($id) && is_numeric($liked) && is_numeric($likesNum)) {
    togglePostLike($id, $liked, $likesNum);
    $success = true;
  } 
  else {
    $success = false;
    $reason = "Needs id:number; liked:number; likesNum:number";
  }

  echo(json_encode(array(
  "success" => $success,
  "reason" => $reason
  )));
}

//API.php?action=togglePostBookmark&id=100123&bookmarked=1&bookmarksNum=9
function processTogglePostBookmark(){
  $success = false;
  $reason = "";

  $id = getRequestParameter("id");
  $bookmarked = getRequestParameter("bookmarked");
  $bookmarksNum = getRequestParameter("bookmarksNum");

  if (is_numeric($id) && is_numeric($bookmarked)&& is_numeric($bookmarksNum)) {
    togglePostBookmark($id, $bookmarked, $bookmarksNum);
    $success = true;
  } 
  else {
    $success = false;
    $reason = "Needs id:number; bookmarked:number; bookmarksNum:number";
  }

  echo(json_encode(array(
  "success" => $success,
  "reason" => $reason
  )));
}

//API.php?action=newPost&imageUrl=abcdef&status=ghijkl
function processNewPost(){
  $success =false;
  $reason = "";
  $id = 0;

  $imageUrl = getRequestParameter('imageUrl');
  $status = getRequestParameter('status');

  if($status != "" || $imageUrl != ""){
    $id = newPost($imageUrl, $status);
    $success = true;
  }
  else{
    $success = false;
    $reason = "Needs imageUrl and status";
  }

  echo(json_encode(array(
    "success" => $success,
    "reason" => $reason,
    "id" => $id
    )));
}

//API.php?action=newComment&text=abcdef&postId=100123
function processNewComment(){
  $success =false;
  $reason = "";
  $id = 0;

  $commentText = getRequestParameter('text');
  $postId = getRequestParameter('postId');

  if($commentText != "" && $postId != ""){
    $id = newComment($commentText, $postId);
    $success = true;
  }
  else{
    $success = false;
    $reason = "Needs text";
  }

  echo(json_encode(array(
    "success" => $success,
    "reason" => $reason,
    "id" => $id
    )));
}


processRequest();