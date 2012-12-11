function review()
{
	var ids = document.getElementsByName("id")
	var id = ids[0]
	var names = document.getElementsByName("name")
	var name = names[0]
	if(id.value == "")
	{
		alert("学号不能为空")
		return false
	}
	if(name.value == "")
	{
		alert("姓名不能为空")
		return false
	}
	return true
}