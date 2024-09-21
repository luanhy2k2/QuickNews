import { Component } from '@angular/core';
import { BasePaging } from 'src/app/Models/Common/base-paging';
import { BaseQuerieResponse } from 'src/app/Models/Common/base-querie-response';
import { Tag } from 'src/app/Models/Tag/tag';
import { UpsertTag } from 'src/app/Models/Tag/upsert-tag';
import { TagService } from 'src/app/Services/tag.service';

@Component({
  selector: 'app-tag',
  templateUrl: './tag.component.html',
  styleUrls: ['./tag.component.scss']
})
export class TagComponent {
  constructor(private readonly TagService:TagService){}
  Tag:BaseQuerieResponse<Tag> = {
    pageIndex:1,
    pageSize:10,
    keyword:"",
    item:[],
    total:0
  };
  tottalPageArray:number[] = [];
  upsertTagReq:UpsertTag = {
    id:"",
    name:"",
    describe:""
  }
  isModalCreate:boolean = true;
  ngOnInit(){
    this.loadTag();
  }
  loadTag(){
    const paging:BasePaging = {
      pageIndex:this.Tag.pageIndex,
      pageSize:this.Tag.pageSize,
      keyword:this.Tag.keyword
    };
    this.TagService.getTag(paging).subscribe(res =>{
      var toatlPage = Math.ceil(res.total/res.pageSize);
      this.tottalPageArray = Array.from({ length: toatlPage }, (_, index) => index + 1);
      this.Tag = res;
    })
  }
  nextPage() {
    this.Tag.pageIndex++;
    if(this.Tag.pageIndex > this.tottalPageArray.length + 1){
      this.Tag.pageIndex = this.tottalPageArray.length + 1;
    }
    this.loadTag();
  }
  previousPage() {
    this.Tag.pageIndex--;
    if(this.Tag.pageIndex == 0){
      this.Tag.pageIndex = 1;
    }
  }
  setPage(pageInDex: number) {
    this.Tag.pageIndex = pageInDex;
    this.loadTag();
  }
  getTagById(id:string){
    this.isModalCreate = false;
    this.TagService.getTagById(id).subscribe(res =>{
      this.upsertTagReq = res;
    })
  }
  delete(id:string){
    const isConfirmed = confirm('Bạn có chắc muốn xoá không?');
    if (isConfirmed) {
      this.TagService.delete(id).subscribe(res =>{
        if(res.success == true){
          const index = this.Tag.item.findIndex(c =>c.id == res.object);
          if(index !== -1){
            this.Tag.item.splice(index, 1);
          }
        }
        alert(res.message);
      })
    }
  }
  save(){
    if(this.isModalCreate){
      this.TagService.create(this.upsertTagReq).subscribe(res =>{
        if(res.success == true){
          this.Tag.item.unshift(res.object);
        }
        alert(res.message);
      })
    }
    else{
      this.TagService.update(this.upsertTagReq).subscribe(res => {
        if(res.success == true && res.object) {
          const index = this.Tag.item.findIndex(c => c.id === res.object.id);
          if(index !== -1) {
            this.Tag.item[index] = res.object;
          }
        }
        alert(res.message);
      });
      this.isModalCreate = true;
    }
  }
}
