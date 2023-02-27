<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANTISOCIAL</title>
    <link rel ="shortcut icon" href ="images/network_icon.png" />
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/font-awesome.min.css"/>

    <template id ='post-template'>
        <article class ='post' data-post-id =''>
            <span class='about-user'><img src='images/profile_picture.png' alt='user-picture' class='user-picture'>
                <span class='status-info'><p class='status-user-name'></p></span>
            </span>
            <span class='content'>
                <span class='image-container'><img class='status-image' src='' alt=''></span>
                <span class='status-text'><p></p></span>
            </span>
            <span class='likes-book-number-area'>
                <span class='likes-area'><p>Sviđa mi se: </p><p class='likes-num'></p></span>
                <span class='bookmarks-area'><p>Spremljeno: </p><p class='bookmarks-num'></p></span>
            </span>
            <span class='like-com-book-btn-area'>
                <button class='like-btn'><i class='fa fa-thumbs-o-up thumbUp-icon' aria-hidden='true'></i><p>Sviđa mi se</p></button>
                <button class='comment-btn' post-comment-id=''><i class='fa fa-comment-o' aria-hidden='true'></i><p class='comment_post'>Komentiraj</p></button>
                <button class='bookmark-btn'><i class='fa fa-bookmark-o bookmark-icon' aria-hidden='true'></i><p>Spremi</p></button>
            </span>
        </article>
    </template>

    <template id='comment-template'>
        <article class='comment' data-comment-id=''>
            <span class='about-user'><img src='' alt='user-picture' class='comment-picture'><p class='comment-user-name'></p></span>
            <span><p class='comment-content'></p></span>
        </article>
    </template>

</head>
<body>
    <header>
        <label>ANTISOCIAL</label>
        <i class ="fa fa-users users-icon"></i>

    </header>
    <main>
        <div class ="column" id ="user-column">

            <div id ="user-info">
                <div id ="user-picture-and-name">
                    <img src="images/profile_picture.png" alt="profile-picture" id ="profile-picture">
                    <p> Jerko Curkovic </p>
                </div>
                
                <div id ="info">
                    <p class ="description-text">O korisniku</p>
                    <div class ="about-user">
                        <i class ="fa fa-home"></i>
                        <p>Sinj, Croatia</p>
                    </div>
                    <div class ="about-user">
                        <i class ="fa fa-university"></i>
                        <p>FESB, Split</p>
                    </div>
                    <div class ="about-user">
                        <i class ="fa fa-instagram"></i>
                        <p>jerkocurkovic</p>
                    </div>
                </div>
            </div>

        </div>

        <div class ="column" id ="news-feed">
            <div id ="new-status">
                <div class="about-user">
                    <img src="images/profile_picture.png" alt="user-picture" class ="user-picture">
                    <div class ="status-info">
                        <p class ="status-user-name">Jerko Curkovic</p>
                        <p class ="status-method">Public</p>
                    </div>
                </div>
                <div id ="status-input-fields">
                    <form action="">
                        <input type="text" class ="input-field" id ="status"  placeholder="O čemu razmišljate, Jerko?">
                        <input type="url" class ="input-field" id ="imageUrl"  placeholder="Url slike...">
                    </form>
                </div>
                <button type="submit" id ="submit-btn">Objavi</button>
            </div>

            <div id ="news">
                <?php 
                require_once("php/PostsFunctions.php");
                echo(generatePostsHtml());
                ?>
            </div>
        </div>


    </main>
    
    <script src="scripts/newComments.js"></script>
    <script src="scripts/posts.js"></script>
</body>
</html>