import { Component } from '@angular/core';
import { Article } from 'src/app/Models/Article/article';
import { BasePaging } from 'src/app/Models/Common/base-paging';
import { BaseQuerieResponse } from 'src/app/Models/Common/base-querie-response';
import { Tag } from 'src/app/Models/Tag/tag';
import { ArticleService } from 'src/app/Services/article.service';
import { TagService } from 'src/app/Services/tag.service';

@Component({
  selector: 'app-index',
  templateUrl: './index.component.html',
  styleUrls: ['./index.component.scss']
})

export class IndexComponent {
  newArticle:BaseQuerieResponse<Article>;
  trending: BaseQuerieResponse<Article>;
  mostPopular: BaseQuerieResponse<Article>;
  mostInteraction: BaseQuerieResponse<Article>;
  tag:BaseQuerieResponse<Tag>;
  constructor(private readonly articleService:ArticleService, private readonly tagService:TagService){
    this.mostPopular = this.initializeBaseQueryResponse<Article>();
    this.trending = this.initializeBaseQueryResponse<Article>();
    this.tag = this.initializeBaseQueryResponse<Tag>();
    this.mostInteraction = this.initializeBaseQueryResponse<Article>();
    this.newArticle = this.initializeBaseQueryResponse<Article>();
  }
  ngOnInit(){
    this.loadMostInteraction();
    this.loadMostPopular();
    this.loadTrending();
    this.loadNewArticle();
    this.loadTag();
  }
  initializeBaseQueryResponse<T>(): BaseQuerieResponse<T> {
    return {
      pageIndex: 1,
      pageSize: 4,
      keyword: "",
      item: [],
      total: 0
    };
  }
  loadTrending(){
    const paging:BasePaging = {
      pageIndex:this.trending.pageIndex,
      pageSize:this.trending.pageSize,
      keyword:this.trending.keyword
    }
    this.articleService.getTrendingArticles(paging).subscribe(res =>{
      this.trending = res;
    })
  }
  loadMostPopular(){
    const paging:BasePaging = {
      pageIndex:this.mostPopular.pageIndex,
      pageSize:this.mostPopular.pageSize,
      keyword:this.mostPopular.keyword
    }
    this.articleService.getMostPopularArticles(paging).subscribe(res =>{
      this.mostPopular = res;
    })
  }
  loadMostInteraction(){
    const paging:BasePaging = {
      pageIndex:this.mostInteraction.pageIndex,
      pageSize:this.mostInteraction.pageSize,
      keyword:this.mostInteraction.keyword
    }
    this.articleService.getMostInteractionArticles(paging).subscribe(res =>{
      this.mostInteraction = res;
    })
  }
  loadNewArticle(){
    const paging:BasePaging = {
      pageIndex:this.newArticle.pageIndex,
      pageSize:this.newArticle.pageSize,
      keyword:this.newArticle.keyword
    }
    this.articleService.getArticles(paging).subscribe(res =>{
      this.newArticle = res;
    })
  }
  loadTag(){
    const paging:BasePaging = {
      pageIndex:this.tag.pageIndex,
      pageSize:this.tag.pageSize,
      keyword:this.tag.keyword
    }
    this.tagService.getTag(paging).subscribe(res =>{
      this.tag = res;
    })
  }
}
