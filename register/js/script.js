window.addEventListener('load', init);


function init() {
    document.getElementById('fl').addEventListener('click', function (e) {
        let forgetForm = document.getElementById('forget');

        if (forgetForm.style.display === "none") {
            forgetForm.style.display = "block";
        } else {
            forgetForm.style.display = "none";
        }

        e.preventDefault();
    });

}
