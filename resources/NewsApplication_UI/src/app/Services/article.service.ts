import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from "@angular/common/http";
import { Observable } from 'rxjs';
import { BaseQuerieResponse } from '../Models/Common/base-querie-response';
import { localhostApi } from '../Environments/env';
import { BaseCommandResponse } from '../Models/Common/base-command-response';
import { BasePaging } from '../Models/Common/base-paging';
import { Article } from '../Models/Article/article';
import { UpsertArticle } from '../Models/Article/upsert-article';
@Injectable({
  providedIn: 'root'
})
export class ArticleService {
  constructor(private http: HttpClient) { }
  getArticles(paging:BasePaging): Observable<BaseQuerieResponse<Article>> {
    let params = new HttpParams()
      .set('pageIndex', paging.pageIndex.toString())
      .set('pageSize', paging.pageSize.toString());
    if (paging.keyword) {
      params = params.set('keyword', paging.keyword);
    }
    return this.http.get<BaseQuerieResponse<Article>>(`${localhostApi}/api/article`, { params });
  }
  getMostPopularArticles(paging:BasePaging): Observable<BaseQuerieResponse<Article>> {
    let params = new HttpParams()
      .set('pageIndex', paging.pageIndex.toString())
      .set('pageSize', paging.pageSize.toString());
    return this.http.get<BaseQuerieResponse<Article>>(`${localhostApi}/api/article/most-popular`, { params });
  }
  getTrendingArticles(paging:BasePaging): Observable<BaseQuerieResponse<Article>> {
    let params = new HttpParams()
      .set('pageIndex', paging.pageIndex.toString())
      .set('pageSize', paging.pageSize.toString());
    return this.http.get<BaseQuerieResponse<Article>>(`${localhostApi}/api/article/trending`, { params });
  }
  getMostInteractionArticles(paging:BasePaging): Observable<BaseQuerieResponse<Article>> {
    let params = new HttpParams()
      .set('pageIndex', paging.pageIndex.toString())
      .set('pageSize', paging.pageSize.toString());
    return this.http.get<BaseQuerieResponse<Article>>(`${localhostApi}/api/article/most-interaction`, { params });
  }
  getArticlesByCategoryId(paging:BasePaging): Observable<BaseQuerieResponse<Article>> {
    let params = new HttpParams()
      .set('pageIndex', paging.pageIndex.toString())
      .set('pageSize', paging.pageSize.toString());
    if (paging.keyword) {
      params = params.set('keyword', paging.keyword);
    }
    return this.http.get<BaseQuerieResponse<Article>>(`${localhostApi}/api/article/getByCategoryId`, { params });
  }
  getArticleById(id: string): Observable<Article> {
    return this.http.get<Article>(`${localhostApi}/api/article/${id}`)
  }
  create(Article: UpsertArticle): Observable<BaseCommandResponse> {
    return this.http.post<BaseCommandResponse>(`${localhostApi}/api/article/create`, Article);
  }
  delete(id: string): Observable<BaseCommandResponse> {
    return this.http.delete<BaseCommandResponse>(`${localhostApi}/api/article/delete/${id}`);
  }
  UploadFileArticle(File: File): Observable<BaseCommandResponse> {
    const formData: FormData = new FormData();
    formData.append('file', File, File.name);
    return this.http.post<BaseCommandResponse>(`${localhostApi}/api/article/upload`, formData);
  }
  update(id:string, Article: UpsertArticle): Observable<BaseCommandResponse> {
    return this.http.put<BaseCommandResponse>(`${localhostApi}/api/article/update/${id}`, Article)
  }
}
