import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { Login } from 'src/app/Models/Account/login';
import { AccountService } from 'src/app/Services/account.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent {
  constructor(private accountService: AccountService, private router: Router) { }
  loginReq:Login = {
    username:"",
    password:""
  }
  emailRecovery: string = "";
  login() {
    this.accountService.login(this.loginReq).subscribe(
      (res) => {
        if (res.original.message === "Tài khoản hoặc mật khẩu không đúng") {
          alert('Tài khoản hoặc mật khẩu không đúng');
        }
         else {
          localStorage.setItem("user", JSON.stringify(res.original));
          if (res.role == "client") {
            window.location.href = "http://localhost:4200/";
          } else {
            window.location.href = "http://localhost:4200/category";
          }
        }
      }
    );
  }
  PasswordRecovery(){
    // this.userService.GenerateTokenResetPassword(this.emailRecovery).subscribe(
    //   (res) =>{
    //     alert("Vui lòng check email của bạn!");
    //   },
    //   (err) =>{
    //     alert("Đã có lỗi xảy ra!");
    //   }
    // )
  }
}
