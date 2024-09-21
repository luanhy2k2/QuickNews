import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AdminRoutingModule } from './admin-routing.module';
import { CategoryComponent } from './category/category.component';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';
import { UserArticleComponent } from './user-article/user-article.component';
import { CKEditorModule } from '@ckeditor/ckeditor5-angular';
import { TagComponent } from './tag/tag.component';

@NgModule({
  declarations: [
    CategoryComponent,
    UserArticleComponent,
    TagComponent
  ],
  imports: [
    CommonModule,
    FormsModule,
    CKEditorModule,
    HttpClientModule,
    AdminRoutingModule
  ]
})
export class AdminModule { }
