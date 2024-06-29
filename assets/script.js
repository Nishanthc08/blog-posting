document.addEventListener('DOMContentLoaded', function() {
    const deleteLinks = document.querySelector('a[href^="delete_post.php"]');
    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            if(!confirm('Are you sure you want to delete this post?')) {
                event.preventDefault();
            }
        });
    });
});