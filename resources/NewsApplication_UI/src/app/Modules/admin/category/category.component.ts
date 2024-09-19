import { BaseQuerieResponse } from 'src/app/Models/Common/base-querie-response';
import { CategoryService } from './../../../Services/category.service';
import { Component } from '@angular/core';
import { Category } from 'src/app/Models/Category/category';
import { BasePaging } from 'src/app/Models/Common/base-paging';
import { UpsertCategory } from 'src/app/Models/Category/upsert-category';

@Component({
  selector: 'app-category',
  templateUrl: './category.component.html',
  styleUrls: ['./category.component.scss']
})
export class CategoryComponent {
  constructor(private readonly CategoryService:CategoryService){}
  category:BaseQuerieResponse<Category> = {
    pageIndex:1,
    pageSize:10,
    keyword:"",
    item:[],
    total:0
  };
  tottalPageArray:number[] = [];
  upsertCategoryReq:UpsertCategory = {
    id:"",
    name:"",
    describe:""
  }
  isModalCreate:boolean = true;
  ngOnInit(){
    this.loadCategory();
  }
  loadCategory(){
    const paging:BasePaging = {
      pageIndex:this.category.pageIndex,
      pageSize:this.category.pageSize,
      keyword:this.category.keyword
    };
    this.CategoryService.getCategory(paging).subscribe(res =>{
      var toatlPage = Math.ceil(res.total/res.pageSize);
      this.tottalPageArray = Array.from({ length: toatlPage }, (_, index) => index + 1);
      this.category = res;
    })
  }
  nextPage() {
    this.category.pageIndex++;
    if(this.category.pageIndex > this.tottalPageArray.length + 1){
      this.category.pageIndex = this.tottalPageArray.length + 1;
    }
    this.loadCategory();
  }
  previousPage() {
    this.category.pageIndex--;
    if(this.category.pageIndex == 0){
      this.category.pageIndex = 1;
    }
  }
  setPage(pageInDex: number) {
    this.category.pageIndex = pageInDex;
    this.loadCategory();
  }
  getCategoryById(id:string){
    this.isModalCreate = false;
    this.CategoryService.getCategoryById(id).subscribe(res =>{
      this.upsertCategoryReq = res;
    })
  }
  delete(id:string){
    const isConfirmed = confirm('Bạn có chắc muốn xoá không?');
    if (isConfirmed) {
      this.CategoryService.delete(id).subscribe(res =>{
        if(res.success == true){
          const index = this.category.item.findIndex(c =>c.id == res.object);
          if(index !== -1){
            this.category.item.splice(index, 1);
          }
        }
        alert(res.message);
      })
    }
  }
  save(){
    if(this.isModalCreate){
      this.CategoryService.create(this.upsertCategoryReq).subscribe(res =>{
        if(res.success == true){
          this.category.item.unshift(res.object);
        }
        alert(res.message);
      })
    }
    else{
      this.CategoryService.update(this.upsertCategoryReq).subscribe(res => {
        if(res.success == true && res.object) {
          const index = this.category.item.findIndex(c => c.id === res.object.id);
          if(index !== -1) {
            this.category.item[index] = res.object;
          }
        }
        alert(res.message);
      });
      this.isModalCreate = true;
    }
  }
}
