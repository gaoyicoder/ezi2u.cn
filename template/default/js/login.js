function submitForm(){if(document.formLogin.userid.value==""){alert('请填写您的用户名!');document.formLogin.userid.focus();return false}if(document.formLogin.userpwd.value==""){alert('请输入登录密码！');document.formLogin.userpwd.focus();return false}return true}