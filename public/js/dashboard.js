var drawPieChart = function (expenses) {
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(function () {
        var total = {};
        for (var i = 0; i < expenses.length; i++) {
            var category = expenses[i]['category'],
                money_spent = parseFloat(expenses[i]['money_spent']);
            if (category in total) {
                total[category] += money_spent;
            } else {
                total[category] = money_spent;
            }
        }
        var content = [
            ['Expenses', 'Spent per Month']
        ];
        var i = 1;
        for (category in total) {
            content[i++] = [category, total[category]];
        }
        var data = google.visualization.arrayToDataTable(content);
        var options = {
            'title': 'This Month',
            'width': 550,
            'height': 400
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
        drawGraph(total);
    });
};
var drawGraph = function (total) {
    var labels = Object.keys(total);
    var values = [];
    labels.forEach(function (key) {
        values.push(total[key]);
    });
    var canvas = document.getElementById("graph");
    var ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: '# of Money spent',
                data: values,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
};

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
            var expenses = res['expenses'];
            var code = "";
            for (var i = expenses.length - 1; i >= 0; i--) {
                var expense = expenses[i];
                code += '\
                <div class="col-lg-3 col-md-4 col-sm-12">\
                <div class="card border-primary" style="margin-top:10px;box-shadow: 7px 7px 5px #aaaaaa;">\
                    <div class="card-header">' + expense['category'] + '</div>\
                    <div class="card-body text-primary">\
                        <p class="card-text">\
                        Money Spent : ' + expense['money_spent'] + '\
                        </p>\
                    </div>\
                    <div class="card-footer">\
                        <small class="text-muted">\
                            Spent at : ' + expense['spent_at_date'] + " " + expense['spent_at_time'] + " " + expense['spent_at_merediem'] + '\
                        </small>\
                    </div>\
                </div>\
                </div>\
                ';
            }
            $("#expenses").html(code);
            drawPieChart(res['expenses']);
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
            var notes = res['notes'];
            var code = "";
            for (var i = notes.length - 1; i >= 0; i--) {
                var note = notes[i];
                code += '\
                <div class="col-lg-3 col-md-4 col-sm-12">\
                <div class="card border-primary" style="margin-top:10px;box-shadow: 7px 7px 5px #aaaaaa;">\
                    <div class="card-header">' + note['title'] + '</div>\
                    <div class="card-body text-primary">\
                        <p class="card-text">\
                        ' + note['description'] + '\
                        </p>\
                    </div>\
                </div>\
                </div>\
                ';
            }
            $("#notes").html(code);
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
    // console.log(JSON.stringify(data));
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