var left = 1,
    page = 1,
    right = 3;
var getArticlesByPage = function (pageNo) {
    $('html, body').animate({
        scrollTop: $("#myBar").offset().top
    }, 500);
    page = pageNo;
    getArticles();
    $(".pages").attr("class", "pages page-item");
    $("#item-" + (page - left + 1)).parent().attr("class", "pages page-item active");
    checkForDisable();
};
var pagesInc = function () {
    if (page == right) {
        left = page + 1;
        right = page + 3;
        $("#item-1").text(page + 1);
        $("#item-1").attr("href", "javascript:getArticlesByPage(" + (page + 1) + ");");
        $("#item-2").text(page + 2);
        $("#item-2").attr("href", "javascript:getArticlesByPage(" + (page + 2) + ");");
        $("#item-3").text(page + 3);
        $("#item-3").attr("href", "javascript:getArticlesByPage(" + (page + 3) + ");");
    }
    getArticlesByPage(page + 1);
};
var pagesDec = function () {
    if (page == left) {
        left = page - 3;
        right = page - 1;
        $("#item-1").text(page - 3);
        $("#item-1").attr("href", "javascript:getArticlesByPage(" + (page - 3) + ");");
        $("#item-2").text(page - 2);
        $("#item-2").attr("href", "javascript:getArticlesByPage(" + (page - 2) + ");");
        $("#item-3").text(page - 1);
        $("#item-3").attr("href", "javascript:getArticlesByPage(" + (page - 1) + ");");
    }
    checkForDisable();
    getArticlesByPage(page - 1);
};
var checkForDisable = function () {
    if (page == 1) {
        $("#prev-li").attr("class", "page-item disabled");
    } else {
        $("#prev-li").attr("class", "page-item");
    }
};

function getArticles() {
    var data = {};
    data['id'] = $("#id").val();
    data['page'] = page;
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
            <div class="">\
                <div class="card" style="margin-top:10px;box-shadow: 7px 7px 5px #aaaaaa;">\
                    <img class="card-img-top" height="200px" width="100px" src=' + articles[i]['urlToImage'] + ' onerror=this.src="images/news.png">\
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