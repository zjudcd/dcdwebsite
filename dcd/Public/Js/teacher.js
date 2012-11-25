function review()
{
	var ids = document.getElementsByName("id")
	var id = ids[0]
	var names = document.getElementsByName("name")
	var name = names[0]
	alert("id=" + id.value)
	alert("name=" + name.value)
	return false
	if(id.value == "")
	{
		alert("工号不能为空")
		return false
	}
	if(name.value == "")
	{
		alert("姓名不能为空")
		return false
	}
	return true
}