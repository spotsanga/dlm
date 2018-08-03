var shown;
$("#show-expense").on("click", function () {
    if (shown != 0) {
        $(".form").hide();
        shown = 0;
    }
    $("#expense").toggle();
});
$("#show-note").on("click", function () {
    if (shown != 1) {
        $(".form").hide();
        shown = 1;
    }
    $("#note").toggle();
});

function getExpenses() {
    var data = {};
    data['id'] = $("#id").val();
    $.ajax({
        type: "GET",
        data: data,
        url: "expenses",
    }).done(function (res) {
        // console.log(JSON.stringify(res));
        var res = res['data'];
        if (res['code'] == "0") {
            var html = '<thead class="thead-light">';
            html += "<tr><th>#</th><th>Category</th><th>Money Spent</th><th>Spent at</th></tr>";
            html += "</thead>";
            $("#expenses").html(html);
            var expenses = res['expenses'];
            var code = "<tbody>";
            for (var i = expenses.length - 1; i >= 0; i--) {
                var expense = expenses[i];
                code += "<tr>"
                code += "<td>" + expense['id'] + "</td>";
                code += "<td>" + expense['category'] + "</td>";
                code += "<td>" + expense['money_spent'] + "</td>";
                code += "<td>" + expense['spent_at_date'] + " " + expense['spent_at_time'] + " " + expense['spent_at_merediem'] + "</td>";
                code += "</tr>";
            }
            code += "<tbody>";
            $("#expenses").append(code);
        } else {
            location.replace("/");
        }
    });
}
getExpenses();

function getNotes() {
    var data = {};
    data['id'] = $("#id").val();
    $.ajax({
        type: "GET",
        data: data,
        url: "notes",
    }).done(function (res) {
        // console.log(JSON.stringify(res));
        var res = res['data'];
        if (res['code'] == "0") {
            var html = '<thead class="thead-light">';
            html += "<tr><th>#</th><th>Title</th><th>Description</th><th>Created at</th></tr>";
            html += "</thead>";
            $("#notes").html(html);
            var notes = res['notes'];
            var code = "<tbody>";
            for (var i = notes.length - 1; i >= 0; i--) {
                code += "<tr>"
                for (key in notes[i]) {
                    code += "<td>" + notes[i][key] + "</td>";
                }
                code += "</tr>";
            }
            code += "</tbody>";
            $("#notes").append(code);
        } else {
            location.replace("/");
        }
    });
}
getNotes();
$("#note").on("submit", function () {
    var data = {};
    data['id'] = $("#id").val();
    data['title'] = $("#title").val();
    data['description'] = $("#description").val();
    data['_token'] = $("#_token").val();
    // console.log(JSON.stringify(data));
    $.ajax({
        type: "POST",
        data: data,
        url: "note"
    }).done(function (res) {
        // console.log(JSON.stringify(res))
        if (res['data']['code'] == '0') {
            $("#alert").attr("class", "alert-success");
        } else {
            $("#alert").attr("class", "alert-danger");
        }
        $("#alert").html(res['data']['msg']);
        $("#alert").show();
        getNotes();
        setTimeout(function () {
            $("#alert").hide();
        }, 2000);
    });
    return false;
});
$("#expense").on("submit", function () {
    var data = {};
    data['id'] = $("#id").val();
    data['category'] = $("#category").val();
    data['money_spent'] = $("#money_spent").val();
    data['spent_at_date'] = $("#spent_at_date").val();
    data['spent_at_time'] = $("#spent_at_time").val();
    data['spent_at_merediem'] = $("#spent_at_merediem").val();
    data['items'] = [{
        'item_name': 'cake',
        'item_cost': 15
    }, {
        'item_name': 'lays',
        'item_cost': 10
    }];
    data['_token'] = $("#_token").val();
    console.log(JSON.stringify(data));
    $.ajax({
        type: "POST",
        data: data,
        url: "expense"
    }).done(function (res) {
        // console.log(JSON.stringify(res))
        if (res['data']['code'] == '0') {
            $("#alert").attr("class", "alert-success");
        } else {
            $("#alert").attr("class", "alert-danger");
        }
        getExpenses();
        $("#alert").html(res['data']['msg']);
        $("#alert").show();
        setTimeout(function () {
            $("#alert").hide();
        }, 2000);
    });
    return false;
});

function signout() {
    var data = {};
    data['_token'] = $("#_token").val();
    $.ajax({
        type: "POST",
        url: "signout",
        data: data,
    }).done(function (res) {
        location.replace("/");
    });
}