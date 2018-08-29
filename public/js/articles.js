function getArticles() {
    var data = {};
    data['id'] = $("#id").val();
    $.ajax({
        type: 'GET',
        data: data,
        url: 'feeds',
    }).done(function (res) {
        var articles = res['data']['articles'];
        if (!articles.length) {
            return;
        }
        move();
        var code = '';
        for (var i = 0; i < articles.length; i++) {
            code += '\
            <div class="col-lg-3 col-md-4 col-sm-12">\
                <div class="card" style="margin-top:10px;box-shadow: 7px 7px 5px #aaaaaa;">\
                    <img class="card-img-top" height="100px" width="100px" src=' + articles[i]['urlToImage'] + ' onerror=this.src="images/news.png">\
                    <div class="card-body">\
                        <h5 class="card-title">' + articles[i]['title'] + '</h5>\
                        <p class="card-text">' + articles[i]['description'] + '</p>\
                    </div>\
                    <div class="card-footer">\
                        <small class="text-muted">Published at : \
                            ' + (date = new Date(articles[i]['publishedAt'])).toDateString() + '\
                            <a style="float:right; color:black;" target="_blank" href="' + articles[i]['url'] + '"><i class="fas fa-external-link-alt"></i></a>\
                        </small>\
                    </div>\
                </div>\
            </div>\
            ';
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