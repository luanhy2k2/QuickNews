import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AccountService } from 'src/app/Services/account.service';

@Component({
  selector: 'app-leftbar-admin',
  templateUrl: './leftbar-admin.component.html',
  styleUrls: ['./leftbar-admin.component.scss']
})
export class LeftbarAdminComponent {
  constructor(private readonly accountService:AccountService, private router:Router){}
  logOut(){
    this.accountService.logOut().subscribe(res =>{
      localStorage.removeItem('user');
      alert(res.message);
      this.router.navigate(['/']);
    })
  }
}
