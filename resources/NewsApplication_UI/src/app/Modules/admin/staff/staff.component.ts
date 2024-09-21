import { AccountService } from 'src/app/Services/account.service';
import { Component } from '@angular/core';
import { BasePaging } from 'src/app/Models/Common/base-paging';
import { Account, Role } from 'src/app/Models/Account/account';
import { BaseQuerieResponse } from 'src/app/Models/Common/base-querie-response';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-staff',
  templateUrl: './staff.component.html',
  styleUrls: ['./staff.component.scss']
})
export class StaffComponent {
  constructor(private readonly AccountService:AccountService, private route:ActivatedRoute){}
  Account:BaseQuerieResponse<Account> = {
    pageIndex:1,
    pageSize:10,
    keyword:"",
    item:[],
    total:0
  };
  AccountOption:BaseQuerieResponse<Account> = {
    pageIndex:1,
    pageSize:20,
    keyword:"",
    item:[],
    total:0
  };
  selectedAccountId:string = "";
  role: Role = Role.Client;
  tottalPageArray:number[] = [];
  ngOnInit(){
    this.loadAccountByRole();
    this.loadAllAccount();
  }
  assignRoleToStaff(){
    this.AccountService.assignRoleToStaff(this.selectedAccountId, this.role).subscribe(res =>{
      alert(res.message);
      this.loadAccountByRole();
    })
  }
  revokeRole(accountId:string){
    const isComfirmed = confirm("Bạn có chắc muốn thu hồi quyền hạn của tài khoản này không");
    if(isComfirmed){
      this.AccountService.revokeRole(accountId).subscribe(res =>{
        alert(res.message);
        const index = this.Account.item.findIndex(a =>a.id == accountId);
        if(index !== -1){
          this.Account.item.splice(index, 1);
        }
      })
    }
  }
  loadAccountByRole(){
    this.route.queryParams.subscribe(params => {
      var param = params['role'];
      this.role = param;
      const paging:BasePaging = {
        pageIndex:this.Account.pageIndex,
        pageSize:this.Account.pageSize,
        keyword:this.Account.keyword
      };
      this.AccountService.getAccountByRole(paging,this.role).subscribe(res =>{
        var toatlPage = Math.ceil(res.total/res.pageSize);
        this.tottalPageArray = Array.from({ length: toatlPage }, (_, index) => index + 1);
        this.Account = res;
      })
    })


  }
  loadAllAccount(){
    const paging:BasePaging = {
      pageIndex:this.AccountOption.pageIndex,
      pageSize:this.AccountOption.pageSize,
      keyword:this.AccountOption.keyword
    };
    this.AccountService.getAccount(paging).subscribe(res =>{
      this.AccountOption = res;
    })
  }
  nextPage() {
    this.Account.pageIndex++;
    if(this.Account.pageIndex > this.tottalPageArray.length){
      this.Account.pageIndex = this.tottalPageArray.length;
    }
    this.loadAccountByRole();
  }
  previousPage() {
    this.Account.pageIndex--;
    if(this.Account.pageIndex == 0){
      this.Account.pageIndex = 1;
    }
  }
  setPage(pageInDex: number) {
    this.Account.pageIndex = pageInDex;
    this.loadAccountByRole();
  }

}
