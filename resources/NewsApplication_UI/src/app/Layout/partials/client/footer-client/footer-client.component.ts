import { Component } from '@angular/core';
import { Category } from 'src/app/Models/Category/category';
import { BasePaging } from 'src/app/Models/Common/base-paging';
import { BaseQuerieResponse } from 'src/app/Models/Common/base-querie-response';
import { CategoryService } from 'src/app/Services/category.service';

@Component({
  selector: 'app-footer-client',
  templateUrl: './footer-client.component.html',
  styleUrls: ['./footer-client.component.scss']
})
export class FooterClientComponent {
  constructor(private readonly CategoryService:CategoryService){}
  category:BaseQuerieResponse<Category> = {
    pageIndex:1,
    pageSize:10,
    item:[],
    total:0,
    keyword:""
  }
  ngOnInit(){
    this.loadCategory();
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
}
