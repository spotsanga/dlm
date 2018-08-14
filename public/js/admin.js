function fetch(query = null, operation = null) {
    var data = {};
    data['_token'] = $("#_token").val();
    data['query'] = query || $("#query").val();
    data['operation'] = operation || $("#operation").val();
    $.ajax({
        type: 'POST',
        data: data,
        url: 'fetch',
    }).done(function (res) {
        console.log(res);
        var results = res['data']['results'];
        move();
        var code = '<thead style="text-transform:capitalize;">';
        for (attr in results[0]) {
            code += '<th>' + attr + '</th>';
        }
        code += '</thead>';
        for (var i = 0; i < results.length; i++) {
            code += '<tr>';
            for (attr in results[i]) {
                code += '<td>' + results[i][attr] + '</td>';
            }
            code += '</tr>';
        }
        $("#content").html(code);
    });
    $("#myBar").attr('width', '1');
}

function fetchTables() {
    var data = {};
    data['_token'] = $("#_token").val();
    data['query'] = 'show tables';
    data['operation'] = 'select';
    $.ajax({
        type: 'POST',
        data: data,
        url: 'fetch',
    }).done(function (res) {
        console.log(res);
        var results = res['data']['results'];
        var code = '';
        for (var i = 0; i < results.length; i++) {
            code += '<list class="list-group-item">';
            code += '<a href=javascript:fetchResults("'+results[i]['Tables_in_dlm']+'");>';
            code += results[i]['Tables_in_dlm'];
            code += '</a>';
            code += '</list>';
        }
        $("#tables").html(code);
    });
}
fetchTables();
function fetchResults(table){
    fetch("select * from "+table,"select");
}
function move() {
    var elem = document.getElementById("myBar");
    var width = 1;
    var id = setInterval(frame, 10);

    function frame() {
        if (width >= 100) {
            clearInterval(id);
        } else {
            width++;
            elem.style.width = width + '%';
        }
    }
}