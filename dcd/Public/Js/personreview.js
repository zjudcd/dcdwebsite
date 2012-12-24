function review(type)
{
	//判断教师、学生
	if(type == "teacher")
		var idtype = "工号"
	else
		var idtype = "学号"
	var ids = document.getElementsByName("id")
	var id = ids[0]
	var names = document.getElementsByName("name")
	var name = names[0]
	if(id.value == "")
	{
		alert(idtype + "不能为空")
		return false
	}
	if(name.value == "")
	{
		alert("姓名不能为空")
		return false
	}
	
	//控制入学年月日
	if(type == "student")
	{
		var y = document.getElementsByName("enyear")
		var m = document.getElementsByName("enmonth")
		var d = document.getElementsByName("enday")
		var year = y[0].value
		var month = m[0].value
		var day = d[0].value
		if(year == "" || month == "" || day == "")
		{
			alert("入学年月日不能为空")
			return false
		}
		if(isNaN(year) || isNaN(month) || isNaN(day))
		{
			alert("入学年月日必须为数字")
			return false
		}
		var entrancedate = document.getElementsByName("entrancedate")
		entrancedate[0].value = year + "/" + month + "/" + day
	}
	//控制介绍
	var introduction = document.getElementsByName("introduction")
	var intro = introduction[0].value
	intro = intro.replace(/ /g,"&nbsp;")
	intro = intro.replace(/\n/g,"<br/>")
	introduction[0].value = intro
	return true
}