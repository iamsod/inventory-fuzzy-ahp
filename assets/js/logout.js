$("#logout").click(function(e) {
    e.preventDefault();
    $.ajax({
        url: "./applications/modul/Logout.php",
        method: "POST",
        data: {
            logout: true
        },
        success: function(res) {
            if (res == 1) {
                location.reload();
            } else {
                alert(res);
            }
        }
    });
});
