const likeButtons = document.querySelectorAll('.like-btn');
for (let i = 0; i < likeButtons.length; i++) {
	const likeButton = likeButtons[i];
	likeButton.addEventListener('click', handleLikeButtonClick);
}

async function handleLikeButtonClick(e) {


	const likeBtn = e.currentTarget;
    const btnsArea = likeBtn.parentElement;

    const thumbUpIcon = likeBtn.querySelector('.thumbUp-icon')
    
	const post = btnsArea.parentElement;
	const id = post.getAttribute('data-post-id');
    const likeContainer = post.querySelector('.likes-num');
    const likesNum = likeContainer.textContent;
    
	const isCurrentlyLiked = thumbUpIcon.classList.contains('fa-thumbs-up');
    if(!isCurrentlyLiked) {
        likesNum = parseInt(likesNum, 10)+1;
    } else {
        likesNum = parseInt(likesNum, 10)-1;
    }

	try {
		const serverResponse = await fetch(
			`API.php?action=togglePostLike&id=${id}&liked=${isCurrentlyLiked ? 0 : 1}&likesNum=${likesNum}`
		);
		const responseData = await serverResponse.json();

		if (!responseData.success) {
			throw new Error(`Error while liking post: ${responseData.reason}`);
		}

		if (!isCurrentlyLiked) {
			thumbUpIcon.classList.remove('fa-thumbs-o-up');
			thumbUpIcon.classList.add('fa-thumbs-up');
            likeContainer.innerHTML = likesNum;
		} else {
			thumbUpIcon.classList.remove('fa-thumbs-up');
			thumbUpIcon.classList.add('fa-thumbs-o-up');
            likeContainer.innerHTML = likesNum;
		}

	} catch (error) {
		throw new Error(error.message || error);
	}
}


const bookmarkButtons = document.querySelectorAll('.bookmark-btn');
for (let i = 0; i < bookmarkButtons.length; i++) {
	const bookmarkButton = bookmarkButtons[i];
	bookmarkButton.addEventListener('click', handleBookmarkButtonClick);
}

async function handleBookmarkButtonClick(e) {


    const bookmarkBtn = e.currentTarget;
    const btnsArea = bookmarkBtn.parentElement;

    const bookmarkIcon = bookmarkBtn.querySelector('.bookmark-icon')
    
	const post = btnsArea.parentElement;
	const id = post.getAttribute('data-post-id');
    const bookmarksContainer = post.querySelector('.bookmarks-num');
    const bookmarksNum = bookmarksContainer.textContent;
    
	const isCurrentlyBookmarked = bookmarkIcon.classList.contains('fa-bookmark');
    if(!isCurrentlyBookmarked) {
        bookmarksNum = parseInt(bookmarksNum, 10)+1;
    } else {
        bookmarksNum = parseInt(bookmarksNum, 10)-1;
    }

	try {
		const serverResponse = await fetch(
			`API.php?action=togglePostBookmark&id=${id}&bookmarked=${isCurrentlyBookmarked ? 0 : 1}&bookmarksNum=${bookmarksNum}`
		);
		const responseData = await serverResponse.json();

		if (!responseData.success) {
			throw new Error(`Error while bookmarking post: ${responseData.reason}`);
		}

		if (!isCurrentlyBookmarked) {
			bookmarkIcon.classList.remove('fa-bookmark-o');
			bookmarkIcon.classList.add('fa-bookmark');
			bookmarksContainer.innerHTML = bookmarksNum;
		} else {
			bookmarkIcon.classList.remove('fa-bookmark');
			bookmarkIcon.classList.add('fa-bookmark-o');
			bookmarksContainer.innerHTML = bookmarksNum;
		}
	} catch (error) {
		throw new Error(error.message || error);
	}
}


const postButton = document.querySelector('#submit-btn');

postButton.addEventListener('click', handlePostButtonClick);

async function handlePostButtonClick(e){


    const imageUrl = document.querySelector('#imageUrl').value;
    const status = document.querySelector('#status').value;

    try{
        const serverResponse = await fetch(`API.php?action=newPost&status=${status}&imageUrl=${imageUrl}`);
        const responseData = await serverResponse.json();
        
        if(!responseData.success){
            
            throw new Error(`Error while adding post: ${responseData.reason}`);
        }

        const postTemplate = document.querySelector('#post-template');
        const postElement = document.importNode(postTemplate.content, true);

 
        postElement.querySelector('.status-image').src = imageUrl;
        postElement.querySelector('.status-text').firstChild.textContent = status;
        postElement.querySelector('.likes-num').textContent = "0";
        postElement.querySelector('.bookmarks-num').textContent = "0";

        
        postElement.querySelector('.like-btn').addEventListener('click', handleLikeButtonClick);
        postElement.querySelector('.bookmark-btn').addEventListener('click', handleBookmarkButtonClick);
        postElement.querySelector('.comment-btn').addEventListener('click', handleCommentButtonClick);

        const postsContainer = document.querySelector('#news');
        
        //postsContainer.insertBefore(postElement, postsContainer.firstChild);
        postsContainer.appendChild(postElement);

        location.reload();
    }
    catch(error){
        throw new Error(error.message || error);
    }

}
