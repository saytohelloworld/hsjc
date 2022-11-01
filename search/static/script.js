var searchKey = $('#searchKey'),
    searchCorrelative = $('#searchCorrelative'),
    searchResult = $('#searchResult');
var correlativeHtml = '',
    resultHtml = '',
    count = 0;

function toSearch() {
    let key = searchKey.val();

    $.ajax({
        type: 'GET',
        url: '/api/v1/index.php?key=' + key,
        dataType: "JSON",
        success: function (resp) {
            let i;
            for (i = 0; i < resp.length; i++) {
                correlativeHtml += `<li class="list-group-item" onclick="fill(this)">${resp[i].keyTitle}</li>`
                resultHtml += `<div class="">
                                    <h4 class="title">
                                        <a href="${resp[i].url}">${resp[i].title}</a>
                                        <p>${resp[i].url}</p>
                                    </h4>
                                    <div class="desc">
                                        <p>${resp[i].description}</p>
                                    </div>
                                </div>`
            }

            if (count == 0) {
                searchCorrelative.html(correlativeHtml);
            } else {
                count--;
            }

            correlativeHtml = '';
            searchResult.html(resultHtml);
            resultHtml = '';

            if (resp.status != '' || resp.status != '0') {
                $('.container').css('max-width', '80em')
                $('.sidebar').css('display', 'block')
            } else {
                $('.container').css('max-width', '35em')
                $('.sidebar').css('display', 'none')
            }

            if (resp.status >= 0) {
                searchResult.html(resp.msg);
            }
        }
    });
}

function fill(e) {
    searchKey.val($(e).context.innerText)
    searchKey.focus()
    count++;
    $('#searchKey').blur();
    toSearch()
}

searchKey.on('input', ()=>toSearch());
$('#toSearch').on('click', ()=>{
    count++;
    toSearch()
});

searchKey.keydown((e) => {
    if (e.key == 'Enter') {
        count++;
        searchCorrelative.html('');
        $('#searchKey').blur();
        toSearch();
    }
})

$(document).click(()=>{
    searchCorrelative.html('');
})