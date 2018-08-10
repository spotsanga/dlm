function getArticles() {
    var data = {};
    data['id'] = $("#id").val();
    $.ajax({
        type: 'GET',
        data:data,
        url: 'feeds',
    }).done(function (res) {
        var articles = res['data']['articles'];
        if (!articles.length){
            return;
        }
        move();
        var code = '<thead><th>Title</th><th>Description</th><th></th></thead>';
        for (var i = 0; i < articles.length; i++) {
            code += '<tr>';
            code += '<td>' + articles[i]['title'] + '</td>';
            code += '<td>' + (articles[i]['description'] || "") + '</td>';
            code += '<td><a target="_blank" href="' + articles[i]['url'] + '"><i class="fas fa-external-link-alt"></i></td>';
            code += '</tr>';
        }
        $("#content").html(code);
    });
    $("#myBar").attr('width', '1');
}
getArticles();

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
