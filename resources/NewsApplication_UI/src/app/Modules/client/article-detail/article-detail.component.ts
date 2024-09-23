import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Article } from 'src/app/Models/Article/article';
import { BasePaging } from 'src/app/Models/Common/base-paging';
import { BaseQuerieResponse } from 'src/app/Models/Common/base-querie-response';
import { ArticleService } from 'src/app/Services/article.service';

@Component({
  selector: 'app-article-detail',
  templateUrl: './article-detail.component.html',
  styleUrls: ['./article-detail.component.scss']
})
export class ArticleDetailComponent {
  articlesSameCategory:BaseQuerieResponse<Article> = {
    pageIndex:1,
    pageSize:10,
    keyword:"",
    item:[],
    total:0
  };
  articleDetail:Article | null = null;
  constructor(private readonly articleService:ArticleService, private route:ActivatedRoute){}
  loadData(){
    this.route.queryParams.subscribe(params => {
      var id = params['id'];
      this.articleService.getArticleById(id).subscribe(res =>{
        this.articleDetail = res
        const paging:BasePaging = {
          pageIndex:this.articlesSameCategory.pageIndex,
          pageSize:this.articlesSameCategory.pageSize,
          keyword:res.category_id
        }
        this.articleService.getArticlesByCategoryId(paging).subscribe(articleSameCate =>{
          this.articlesSameCategory = articleSameCate;
          console.log("same", articleSameCate)
        })
      })
    })

  }
  ngOnInit(){
    this.loadData();
  }
}
