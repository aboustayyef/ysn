<script type="text/javascript">
	
	// make sure jquery is loaded before loading
	$(document).ready(function(){


		// Update number of new posts available on the server and update state
		
		YouStinkApp.updateNewPostsAvailable = function(){
			$.get('/updateme/' + YouStinkApp.lastPostId , function (data){

				// update state
				YouStinkApp.newPostsAvailable = data.posts;

				// update interface
				$('#howmany').text(YouStinkApp.newPostsAvailable);
			});

			// if new posts are available, show the message if it is not visible 
			// and update the document's title to reflect count
			
			if (YouStinkApp.newPostsAvailable > 0) {
				if (! $('#newPostsAvailable').hasClass('active') ) {
					$('#newPostsAvailable').addClass('active')
				};
				document.title = '(' + YouStinkApp.newPostsAvailable + ')' + ' YouStink News';
			};
		}


		// Every minute, check if there are new posts
		
		YouStinkApp.intervalId = setInterval(YouStinkApp.updateNewPostsAvailable, 60 * 1000);

	})

</script>