document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("fight").addEventListener('click', function(e) {
        let confirmation = confirm('Are you 100% sure that you are ready for this fight?');
        if (!confirmation) {
            e.preventDefault();
        }
    });
});