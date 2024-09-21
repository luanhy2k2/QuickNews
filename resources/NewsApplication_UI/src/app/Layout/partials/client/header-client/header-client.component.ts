import { AccountService } from 'src/app/Services/account.service';
import { Component } from '@angular/core';
import { Category } from 'src/app/Models/Category/category';
import { BasePaging } from 'src/app/Models/Common/base-paging';
import { BaseQuerieResponse } from 'src/app/Models/Common/base-querie-response';
import { CategoryService } from 'src/app/Services/category.service';
import { SummaryAccount } from 'src/app/Models/Account/account';

@Component({
  selector: 'app-header-client',
  templateUrl: './header-client.component.html',
  styleUrls: ['./header-client.component.scss']
})
export class HeaderClientComponent {
  constructor(private readonly CategoryService:CategoryService, private readonly AccountService:AccountService){}
  category:BaseQuerieResponse<Category> = {
    pageIndex:1,
    pageSize:10,
    item:[],
    total:0,
    keyword:""
  }
  currentDate: Date = new Date();
  currentUser:SummaryAccount = {
    name:"",
    id:"",
    avatar:""
  }
  ngOnInit(){
    this.loadCategory();
    const currentUserid = this.AccountService.getCurentUser().id;
    this.AccountService.getUserById(currentUserid).subscribe(res =>{
      this.currentUser = res;
    })
  }
  loadCategory(){
    var paging:BasePaging = {
      pageIndex:this.category.pageIndex,
      pageSize:this.category.pageSize,
      keyword:this.category.keyword
    };
    this.CategoryService.getCategory(paging).subscribe(res =>{
      this.category = res;
      console.log(res.item);
    })
  }
  logOut() {
    this.AccountService.logOut().subscribe(res =>{
      localStorage.removeItem('user');
      alert(res.message);
      this.currentUser.name = null;
      this.currentUser.id = null;
      this.currentUser.avatar = null;
    })
  }
}
