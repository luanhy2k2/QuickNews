import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { Role } from 'src/app/Models/Account/account';
import { AccountService } from 'src/app/Services/account.service';

@Component({
  selector: 'app-leftbar-admin',
  templateUrl: './leftbar-admin.component.html',
  styleUrls: ['./leftbar-admin.component.scss']
})
export class LeftbarAdminComponent {
  constructor(private readonly accountService:AccountService, private router:Router){}
  public role = Role;
  logOut(){
    this.accountService.logOut().subscribe(res =>{
      localStorage.removeItem('user');
      alert(res.message);
      this.router.navigate(['/']);
    })
  }
}
