function review(type)
{
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
	var introduction = document.getElementsByName("introduction")
	var intro = introduction[0].value
	intro = intro.replace(/ /g,"&nbsp;")
	intro = intro.replace(/\n/g,"<br/>")
	introduction[0].value = intro
	return true
}