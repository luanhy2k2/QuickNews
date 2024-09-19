import { AccountService } from 'src/app/Services/account.service';
import { Component } from '@angular/core';
import { Category } from 'src/app/Models/Category/category';
import { BasePaging } from 'src/app/Models/Common/base-paging';
import { BaseQuerieResponse } from 'src/app/Models/Common/base-querie-response';
import { CategoryService } from 'src/app/Services/category.service';

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
  currentUserName:string = "";
  ngOnInit(){
    this.loadCategory();
    this.currentUserName = this.AccountService.getCurentUser().name;
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
    localStorage.removeItem('user');
    alert("Đăng xuất thành công");
    this.currentUserName = "";
  }
}
