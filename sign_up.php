<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
</head>

<body>
    <form action="process_sign_up.php" method="post">
        <span id="check-all"></span>
        <br>
        Tên
        <input type="text" name="name" id="name">
        <br>
        Email
        <input type="text" name="email" id="email" onkeyup="check_email();">
        <span id="msg-email"></span>
        <br>
        Mật khẩu
        <input type="password" name="password" onkeyup="check_password()" id="password">
        Hiện
        <input type="checkbox" onclick="showPassword();">
        <span id="msg-password"></span>
        <br>
        Nhập lại mật khẩu
        <input type="password"  id="confirm-password" onkeyup="check_password()">
        <span id="msg-confirm-password"></span>
        <br>
        Số điện thoại
        <input type="text" name="phone" id="phone" onkeyup="check_phone()">
        <span id="msg-phone"></span>
        <br>
        Địa chỉ
        <textarea name="address"  id="address"></textarea>
        <br>
        <button onclick="return check()">Đăng ký</button>
        <script type="text/javascript">
            let ok_mail = true;
            const check_email = () => {
                let rgx_email = /^[a-z][a-z 0-9 \_]+@[a-z]+\.com$/;
                let email = document.getElementById('email');
                let msg_email = document.getElementById('msg-email');
                if ( !rgx_email.test(email.value)){
                    msg_email.style.color = 'red';
                    msg_email.innerHTML = 'Email không hợp lệ';
                    ok_mail = false;
                }else {
                    msg_email.innerHTML = '';
                    ok_mail = true;
                }

            }
            const showPassword = () => {
                let password = document.getElementById('password');
                if (password.type === "password"){
                    password.type = "text";
                }else{
                    passord.type = "password";
                }
            }
            let ok_pw = true;
            let ok_confirm_pw = true;
            const check_password = () => {
                // Phải có ít nhất 8 kí tự chữ và số, có ít nhất 1 chữ 1 số 1 chữ in hoa, không có kí tự đặc biệt
                let rgx_password = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/; 
                if (!rgx_password.test(document.getElementById('password').value)){
                    document.getElementById('msg-password').style.color = 'red';
                    document.getElementById('msg-password').innerHTML = 'Mật khẩu phải nhiều hơn 8 kí tự, phải có ít nhất 1 chữ số, 1 chữ cái in hoa, không có ký tự đặc biệt';
                    ok_pw = false;
                }else {
                    document.getElementById('msg-password').innerHTML ='';
                    ok_pw = true;
                }
                if (document.getElementById('password').value != document.getElementById('confirm-password').value){
                    document.getElementById('msg-confirm-password').style.color = 'red';
                    document.getElementById('msg-confirm-password').innerHTML = 'Không giống mật khẩu đã nhập'
                    ok_confirm_pw = false;
                }else{
                    document.getElementById('msg-confirm-password').innerHTML = '';
                    ok_confirm_pw = true;
                }
            }
            let ok_phone = true;
            const check_phone = () => {
                let rgx_phone = /^(?:0|\+84)[1-9][0-9]{8,9}$/;
                if (!rgx_phone.test(document.getElementById('phone').value)){
                    document.getElementById('msg-phone').style.color = 'red';
                    document.getElementById('msg-phone').innerHTML = 'Số điện thoại không hợp lệ'
                    ok_phone = false;
                }else {
                    document.getElementById('msg-phone').innerHTML = '';
                    ok_phone = true;
                }
            }
            function check(){
                if (document.getElementById('name').value === ''|| document.getElementById('email').value === '' 
                || document.getElementById('password').value === '' || document.getElementById('phone').value === ''
                || document.getElementById('address').value === ''){
                    document.getElementById('check-all').style.color = 'red';
                    document.getElementById('check-all').innerHTML = 'Vui lòng điền đầy đủ thông tin'
                    return false;
                }else
                if (!ok_mail || !ok_phone || !ok_pw || !ok_confirm_pw){
                    document.getElementById('check-all').style.color = 'red';
                    document.getElementById('check-all').innerHTML = 'Vui lòng điền thông tin đúng theo yêu cầu'
                    return false;
                }else{
                    return true;
                }
            }
        </script>
    </form>
</body>

</html>