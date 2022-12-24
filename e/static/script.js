var thisUrl = '';
var enkey = '';
let fileName = '';


const initVditor = () => {
    window.vditor = new Vditor("vditor", {
        cdn: "",
        mode: "ir",
        width: '',
        height:  '',
        toolbar: [],
        placeholder: " Hello, wrold : )",
        outline: {
            enable: true,
            position: 'right'
        },
        cache: {
            enable: false
        },
        focus: () => {
            $(this).on('keydown', (e) => {
                if (e.ctrlKey && e.key === 's') {
                    save()
                    return false;
                }
            })
        },
        blur: () => $(this).off('keydown')
    })
}
initVditor();


function save() {
    let now = new Date();
	let y = now.getFullYear(),
        m = now.getMonth() + 1,
        d = now.getDate();

    if (window.location.search != '?e') {
        TGTool().warning('当前为阅览模式')
        return false;
    }

    if (enkey == '') {
        do enkey = prompt('用于保存文件的 key'); while (enkey == '')
    }

    if (enkey != null && thisUrl == '') {
        // 新文件操作
        if (fileName == '') {
            do fileName = prompt('文件名'); while (fileName == '')
        }


        $.ajax({
            type: 'POST',
            url: 'save',
            data: {
                key: enkey,
                file: `md/${y}${m}${d}.${fileName}.md`,
                mdBody: vditor.getValue()
            },
            success: (a)=> {
                if (JSON.parse(a).status === 1) {
                    enkey = ''
                    TGTool().warning('密钥错误')
                } else {
                    thisUrl = `md/${y}${m}${d}.${fileName}.md`
                    TGTool().success('保存成功')

                    fetch(`get?type=mdList`)
                        .then(Resp => Resp.text())
                        .then(text => $('#mdList').html(text))
                }
            }
        })
    } else {
        // 已存在文件操作
        $.ajax({
            type: 'POST',
            url: 'save',
            data: {
                key: enkey,
                file: thisUrl,
                mdBody: vditor.getValue()
            },
            success: (a)=>{
                if (JSON.parse(a).status === 1) {
                    enkey = ''
                    TGTool().warning('密钥错误')
                } else {
                    TGTool().success('保存成功')
                }
            }
        })
    }
};

$('.menu').on('click', 'a.file', function() {
    let thisClass = $(this).attr('class');

    switch (thisClass) {
        case 'file':
            fetch(`get?type=md&file=${$(this).attr('href')}`)
                .then(Resp => Resp.text())
                .then(md => {
                    if (window.location.search === '?e') {
                        vditor.setValue(md)
                    } else {
                        $('#vditor').css('padding', '10px 35px')
                        Vditor.preview(document.getElementById('vditor'), md, {
                            cdn: "",
                            markdown: {
                                toc: true
                            },
                            mode: "light",
                            theme: {
                              path: "/dist/css/content-theme",
                            }
                        })
                    }
                })
            break;
        case 'file new':
            if (window.location.search != '?e') {
                TGTool().warning('当前为阅览模式')
                return false;
            }

            vditor.setValue("")
            break;
        case 'file save':
            save()
            break;
    }

    thisUrl = $(this).attr('href')
    return false;
});

$('#vditor').on('click', '.vditor-toc span', function() {
    document.getElementById($(this).attr('data-target-id')).scrollIntoView();
});