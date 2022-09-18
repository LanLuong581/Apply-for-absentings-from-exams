src="//cdn.jsdelivr.net/npm/sweetalert2@11"
src="../jquery/jquery-3.6.0.min.js"

function getValue(id){
    return document.getElementById(id).value.trim();
}
function validate(){
    var flag = true;
    //password
    var PassWord = getValue('password');
    if(PassWord == "" || !/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{10,}$/.test(PassWord)){
        flag = false;
        Swal.fire({
            icon: 'error',
            title: 'Mật khẩu không hợp lệ',
            text: 'Mật khẩu phải ít nhất 10 ký tự bao gồm chữ hoa, chữ thường, số và ký hiệu'
        })
    }
    return flag;
   
}