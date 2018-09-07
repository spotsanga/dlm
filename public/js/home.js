$("#signin").on("submit", function () {
    var data = {};
    data['email'] = $("#in-email").val();
    data['password'] = $("#in-password").val();
    data['_token'] = $("#_token").val();
    $.ajax({
        type: "POST",
        data: data,
        url: "signin"
    }).done(function (res) {
        console.log(JSON.stringify(res));
        if (res['data']['code'] == '0') {
            location.replace("/articles");
        } else {
            $("#alert").attr("class", "alert-danger");
            $("#alert").html(res['data']['msg']);
            $("#alert").show();
            setTimeout(function () {
                $("#alert").hide();
            }, 2000);
        }
    });
    return false;
});
$("#signup").on("submit", function () {
    var data = {};
    data['first_name'] = $("#first_name").val();
    data['last_name'] = $("#last_name").val();
    data['email'] = $("#up-email").val();
    data['password'] = $("#up-password").val();
    data['dob'] = $("#dob").val();
    data['mobile_no'] = $("#mobile_no").val();
    data['_token'] = $("#_token").val();
    $.ajax({
        type: "POST",
        data: data,
        url: "signup"
    }).done(function (res) {
        if (res['data']['code'] == '0') {
            $("#alert").attr("class", "alert-success");
        } else {
            $("#alert").attr("class", "alert-danger");
        }
        $("#alert").html(res['data']['msg']);
        $("#alert").show();
        setTimeout(function () {
            $("#alert").hide();
        }, 2000);
    });
    return false;
});