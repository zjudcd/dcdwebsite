function review()
{
	var ids = document.getElementsByName("id")
	var id = ids[0]
	var names = document.getElementsByName("name")
	var name = names[0]
	alert("id=" + id.value)
	alert("name=" + name.value)
	return false
}