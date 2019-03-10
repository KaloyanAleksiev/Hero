document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("fight").addEventListener('click', function(e) {
        let confirmation = confirm('Are you sure ... are you ready for this fight?');
        if (!confirmation) {
            e.preventDefault();
        }
    });
});