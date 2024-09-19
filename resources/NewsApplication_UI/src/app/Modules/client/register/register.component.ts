import { Component } from '@angular/core';
import { Gender, Register } from 'src/app/Models/Account/register';
import { AccountService } from 'src/app/Services/account.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent {
  constructor(private readonly accountService: AccountService) { }
  User:Register = {
    email: "",
    username:"",
    confirmPassword:"",
    password: "",
    phone_number: "",
    address: "",
    name: "",
    avatar:new File([""], ""),
    birth:new Date,
    gender:Gender.male
  }
  onFileChanged(event: any) {
    this.User.avatar = event.target.files[0];
  }
  register() {
    this.accountService.register(this.User).subscribe(res => {
      if(res.success == true){
      }
      alert(res.message);
    });
  }
}
