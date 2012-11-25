function review()
{
	var passwords = document.getElementsByName("password1")
	var p1 = passwords[0]
	passwords = document.getElementsByName("password2")
	var p2 = passwords[0]
	if(p1.value != p2.value)
	{
		alert("两次输入的密码不一致！")
		return false
	}
	return true
}