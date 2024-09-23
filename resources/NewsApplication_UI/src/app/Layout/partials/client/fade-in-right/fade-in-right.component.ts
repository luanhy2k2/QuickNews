import { BasePaging } from 'src/app/Models/Common/base-paging';
import { ArticleService } from 'src/app/Services/article.service';
import { Component } from '@angular/core';
import { TagService } from 'src/app/Services/tag.service';
import { Tag } from 'src/app/Models/Tag/tag';
import { Article } from 'src/app/Models/Article/article';
import { BaseQuerieResponse } from 'src/app/Models/Common/base-querie-response';

@Component({
  selector: 'app-fade-in-right',
  templateUrl: './fade-in-right.component.html',
  styleUrls: ['./fade-in-right.component.scss']
})
export class FadeInRightComponent {
  constructor(private readonly tagService:TagService, private readonly articleService: ArticleService){
    this.mostInteraction = this.initializeBaseQueryResponse<Article>();
  }
  tag:Tag[] = [];
  mostInteraction: BaseQuerieResponse<Article>;
  initializeBaseQueryResponse<T>(): BaseQuerieResponse<T> {
    return {
      pageIndex: 1,
      pageSize: 10,
      keyword: "",
      item: [],
      total: 0
    };
  }
  ngOnInit(){
    this.tagService.getAll().subscribe(res =>{
      this.tag = res;
    })
    this.loadMostInteraction();
  }
  loadMostInteraction(){
    const paging:BasePaging = {
      pageIndex:this.mostInteraction.pageIndex,
      pageSize:this.mostInteraction.pageSize,
      keyword:this.mostInteraction.keyword
    };
    this.articleService.getMostInteractionArticles(paging).subscribe(res =>{
      this.mostInteraction = res;
    })
  }
}
