const commentButtons = document.querySelectorAll('.comment-btn');
for (let i = 0; i < commentButtons.length; i++) {
	const commentButton = commentButtons[i];
	commentButton.addEventListener('click', handleCommentButtonClick);
}

async function handleCommentButtonClick(e) {
	const commentButton = e.currentTarget;
	const postId = commentButton.getAttribute('post-comment-id');

    const commentText = prompt('Jerko, upišite novi komentar:', 'Komentiraj');
	if (!commentText) {
		return;
	}

	try {
		const serverResponse = await fetch(
			`API.php?action=newComment&text=${commentText}&postId=${postId}`
		);
		const responseData = await serverResponse.json();

		if (!responseData.success) {
			throw new Error(`Error while adding new comment: ${responseData.reason}`);
		}

        location.reload();

	} catch (error) {
		throw new Error(error.message || error);
	}
}