import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CategoryComponent } from './category/category.component';
import { UserArticleComponent } from './user-article/user-article.component';
import { TagComponent } from './tag/tag.component';

const routes: Routes = [
  {
    path:'category',
    title:"Quản lý thể loại",
    component:CategoryComponent
  },
  {
    path:'tag',
    title:"Quản lý thẻ",
    component:TagComponent
  },
  {
    path:'article',
    title:"Quản lý tin tức",
    component:UserArticleComponent
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AdminRoutingModule { }
