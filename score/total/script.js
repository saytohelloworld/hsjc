let dateListDom = $('#dateList'),
    dormTypeDom = $('#dormType'),
	num = $('#num');

// 获取所有评分日期
function listDate(a) {
    $.ajax({
        type: 'GET',
        url: '/fn/listDate.php?dorm_type='+a,
        success: function (resp) {
            let str = '',arr = [];
    
            JSON.parse(resp).forEach(item => arr.push(item.date.split(' ')[0]));

            let aa = Array.from(new Set(arr)).reverse();
            aa.forEach(item => str += `<option>${item}</option>`);

            if (str == '') {
                dateListDom.attr('disabled','disabled')
                dateListDom.html('<option>没有日期可选</option>')
				$('#app, #rankApp').empty()
            } else {
                dateListDom.removeAttr('disabled')
                dateListDom.html(str);

                getScore(dormTypeDom.val(), aa[0]);
				listRank(dormTypeDom.val(), aa[0], num.val());
            }
        }
    })
}

// 获取指定评分数据
function getScore(dorm_type,date) {
    $.ajax({
        type: 'GET',
        url: '/fn/queryScore.php?dorm_type='+dorm_type+'&date='+date,
        success: function (resp) {
			$('#app').empty();

			JSON.parse(resp).forEach((item,index)=>{
				let dormNumArr = [],
					scoreNumArr = [];

				let hei = item.score.length;

				$('#app').append(`<div id="main${index}" class="mt-5" style="height:${(hei*35)+100}px;"></div>`);
				let myChart = echarts.init(document.getElementById(`main${index}`));

				myChart.hideLoading();
				myChart.setOption ({
					title: {
						text: `${item.dormType}生宿舍${item.floor}楼得分`,
						left: 'center',
						textStyle: {
							fontWeight: "normal"
						}
					},
					tooltip: {
						trigger: 'axis',
						axisPointer: {
							type: 'shadow'
						}
					}
				});

				item.score.reverse().forEach(item2=>{
					dormNumArr.push(item2.dormNum);
					scoreNumArr.push(item2.scoreNum);

					myChart.setOption ({
						xAxis: {
							type: 'value',
							boundaryGap: [0, 0.01]
						},
						yAxis: {
							name: '宿舍门牌号',
							type: 'category',
							data: dormNumArr
						},
						series: [
							{
								name: '宿舍得分',
								type: 'bar',
								label: {
									show: true,
									position: 'right'
								},
								data: scoreNumArr
							}
						]
					});

					window.addEventListener('resize', ()=>{myChart.resize});
				})
          	})
        }
    })
}

// 宿舍排名
function listRank(dorm_type,date,num) {
	$.ajax({
        type: 'GET',
        url: '/fn/listRank.php?dorm_type='+dorm_type+'&date='+date+'&num='+num,
        success: function (resp) {
			let tableTr = '';
	
            JSON.parse(resp).forEach((item,index) => tableTr += `<tr><td>${index+1}</td><td>${item.dormNum}</td><td>${item.scoreNum}</td></tr>`);

			$('#rankApp').html(tableTr)
        }
    })
}

// 执行一次，选择项控件事件
listDate('男');
dormTypeDom.change(function() {
    listDate($(this).val())
})
dateListDom.change(function() {
    getScore(dormTypeDom.val(), $(this).val())
	listRank(dormTypeDom.val(), $(this).val(), num.val())
})
num.on('input', function() {
	listRank(dormTypeDom.val(), dateListDom.val(), $(this).val())
})

// item.score.forEach(item2=>{
// 	console.log(item2)

	
// })