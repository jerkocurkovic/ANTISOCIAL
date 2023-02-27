<?php
require_once("DatabaseAccess.php");

function getPostsFromDb(){
	 return getDbAccess()->executeQuery("SELECT * FROM Posts ORDER BY id DESC;");
}

function loadComments($postId){
    return getDbAccess()->executeQuery("SELECT * FROM comments WHERE PostID = '$postId'");
}


function generatePostsHtml(){
    $html = "";

    $posts = getPostsFromDb();

    foreach($posts as $post){
        $id = $post[0];
        $user = $post[1];
        $status = $post[2];
        $imageUrl = $post[3];
        $liked = $post[4];
        $likesNum = $post[5];
        $bookmarked = $post[6];
        $bookmarksNum = $post[7];

        $thumbsUpClass = $liked == '1' ? "fa-thumbs-up" : "fa-thumbs-o-up";
        $bookmarkClass = $bookmarked == '1' ? "fa-bookmark" : "fa-bookmark-o";

        $comments = loadComments($id);

        $html .= "<article class='post' data-post-id='$id'>
                    <span class='about-user'><img src='images/profile_picture.png' alt='user-picture' class='user-picture'>
                        <span class='status-info'><p class='status-user-name'>$user</p></span>
                    </span>
                    <span class='content'>
                        <span class='image-container'><img class='status-image' src='$imageUrl' alt=''></span>
                        <span class='status-text'><p>$status</p></span>
                    </span>
                    <span class='likes-book-number-area'>
                        <span class='likes-area'><p>Sviđa mi se: </p><p class='likes-num'>$likesNum</p></span>
                        <span class='bookmarks-area'><p>Spremljeno: </p><p class='bookmarks-num'>$bookmarksNum</p></span>
                    </span>
                    <span class='like-com-book-btn-area'>
                        <button class='like-btn'><i class='fa $thumbsUpClass thumbUp-icon' aria-hidden='true'></i><p>Sviđa mi se</p></button>
                        <button class='comment-btn' post-comment-id='$id'><i class='fa fa-comment-o' aria-hidden='true'></i><p class='comment_post'>Komentiraj</p></button>
                        <button class='bookmark-btn'><i class='fa $bookmarkClass bookmark-icon' aria-hidden='true'></i><p>Spremi</p></button>
                    </span>";

        foreach($comments as $comment) {
            $commentId = $comment[0];
            $commentUser = $comment[1];
            $commentUserPicture = $comment[2];
            $commentText = $comment[3];
            $commentPostId = $comment[4];

            $html .= "<article class='comment' data-comment-id='$commentId'>
                        <span class='about-user'><img src='$commentUserPicture' alt='user-picture' class='comment-picture'><p class='comment-user-name'>$commentUser</p></span>
                        <span><p class='comment-content'>$commentText</p></span>
                    </article>";
        }
                    
        
        $html .= "</article>";
    }

    return $html;
}

function togglePostLike($id, $liked, $likesNum){
    getDbAccess()->executeQuery("UPDATE Posts SET liked='$liked', likesNum='$likesNum' WHERE id='$id';");
}

function togglePostBookmark($id, $bookmarked, $bookmarksNum){
    getDbAccess()->executeQuery("UPDATE Posts SET bookmarked='$bookmarked', bookmarksNum='$bookmarksNum' WHERE id='$id';");

}

function newPost($imageUrl, $status){
    getDbAccess()->executeInsertQuery("INSERT INTO Posts VALUES ('0', 'Jerko Curkovic', '$status','$imageUrl', '0', '0', '0', '0');");
}

function newComment($commentText, $commentPostId){
    getDbAccess()->executeInsertQuery("INSERT INTO comments VALUES ('0', 'Jerko Curkovic','images/profile_picture.png', '$commentText', '$commentPostId');");
}