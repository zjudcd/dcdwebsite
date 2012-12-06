function confirmDel(value) {
						if (!confirm("确认要删除："+value+" ?")) {
							window.event.returnValue = false;
						}
					}

function validate_form(){
	var fields= {"title":"标题","authors":"作者列表","abstract":"摘要",
						"image1":"代表图像","journalname":"期刊名称","publishdate":"发布日期",
						"volumenum":"卷号","pagenum":"页码","issuenum":"期刊号",
						"IF":"影响因子","official":"论文电子文档","conferencename":"会议名称",
						"application":"专利申请书","status":"状态","acceptnum":"专利受理号","acceptdate":"专利受理日期","authorizationnum":"授权号",
						"authorizationcertificate":"授权证书","code":"源代码","attachment":"报告附件","public":"是否公开","personid":"作者或者负责人","number":"项目编号"};
	for(fn in fields)
	{
		var tmp=document.getElementsByName(fn)
		if(tmp != null && tmp.length>0)
		{
			var field=tmp[0]
			if(field.value =="")
			{
				alert(fields[fn]+" 不能为空！")
				return false
			}
		}
	}
	return true
}

function validate_edit(){
	var fields= {"title":"标题","authors":"作者列表","abstract":"摘要",
				"journalname":"期刊名称","publishdate":"发布日期",
				"volumenum":"卷号","pagenum":"页码","issuenum":"期刊号",
				"IF":"影响因子","conferencename":"会议名称",
				"application":"专利申请书","status":"状态","acceptnum":"专利受理号","acceptdate":"专利受理日期","authorizationnum":"授权号",
				"code":"源代码","public":"是否公开","personid":"作者或者负责人","number":"项目编号"};
	for(fn in fields)
	{
		var tmp=document.getElementsByName(fn)
		if(tmp != null && tmp.length>0)
		{
			var field=tmp[0]
			if(field.value =="")
			{
				alert(fields[fn]+" 不能为空！")
				return false
			}
		}
	}
	return true
}