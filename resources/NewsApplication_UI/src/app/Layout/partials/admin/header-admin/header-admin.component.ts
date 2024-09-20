import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { SummaryAccount } from 'src/app/Models/Account/account';
import { AccountService } from 'src/app/Services/account.service';

@Component({
  selector: 'app-header-admin',
  templateUrl: './header-admin.component.html',
  styleUrls: ['./header-admin.component.scss']
})
export class HeaderAdminComponent {
  constructor(private readonly accountService:AccountService, private router:Router){}
  currentAccount:SummaryAccount = {
    id:"",
    name:"",
    avatar:"",
  }
  ngOnInit(){
    const id = this.accountService.getCurentUser().id;
    this.accountService.getUserById(id).subscribe(res =>{
      this.currentAccount = res;
    })
  }
  logOut(){
    this.accountService.logOut().subscribe(res =>{
      localStorage.removeItem('user');
      alert(res.message);
      this.router.navigate(['/']);
    })
  }
}
