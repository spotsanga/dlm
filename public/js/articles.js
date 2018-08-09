var url = 'https://newsapi.org/v2/everything?sources=the-hindu&apiKey=4b4233b0e7c243ea8bdd9abf5a19bbbd';

function getArticles() {
    $.ajax({
        type: 'GET',
        url: url,
    }).done(function (res) {
        var articles = res['articles'];
        var code = '<thead><th>#</th><th>Title</th><th>Description</th><th>Published At</th><th></th></thead>';
        for (var i = 0; i < 20; i++) {
            code += '<tr>';
            code += '<td><img class="rounded" src=' + articles[i]['urlToImage'] + ' height="100px" width="100px"></td>';
            code += '<td>' + articles[i]['title'] + '</td>';
            code += '<td>' + (articles[i]['description'] || "") + '</td>';
            var date = new Date(articles[i]['publishedAt']);
            code += '<td>' + date.toDateString() + "</td>";
            code += '<td><a target="_blank" href="' + articles[i]['url'] + '"><i class="fas fa-external-link-alt"></i></td>';
            code += '</tr>';
        }
        $("#content").html(code);
    });
    $("#myBar").show();
    move();
}
getArticles();
$("#source").on("change", function () {
    url = 'https://newsapi.org/v2/everything?sources=' + $(this).val() + '&apiKey=4b4233b0e7c243ea8bdd9abf5a19bbbd';
    getArticles();
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