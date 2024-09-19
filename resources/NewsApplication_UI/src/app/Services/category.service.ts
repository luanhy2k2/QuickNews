import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from "@angular/common/http";
import { Observable } from 'rxjs';
import { BaseQuerieResponse } from '../Models/Common/base-querie-response';
import { Category } from '../Models/Category/category';
import { localhostApi } from '../Environments/env';
import { BaseCommandResponse } from '../Models/Common/base-command-response';
import { UpsertCategory } from '../Models/Category/upsert-category';
import { BasePaging } from '../Models/Common/base-paging';
@Injectable({
  providedIn: 'root'
})
export class CategoryService {
  constructor(private http: HttpClient) { }
  getCategory(paging:BasePaging): Observable<BaseQuerieResponse<Category>> {
    let params = new HttpParams()
      .set('pageIndex', paging.pageIndex.toString())
      .set('pageSize', paging.pageSize.toString());
    if (paging.keyword) {
      params = params.set('keyword', paging.keyword);
    }
    return this.http.get<BaseQuerieResponse<Category>>(`${localhostApi}/api/category`, { params });
  }
  getCategoryById(id: string): Observable<Category> {
    return this.http.get<Category>(`${localhostApi}/api/category/${id}`)
  }
  create(category: UpsertCategory): Observable<BaseCommandResponse> {
    return this.http.post<BaseCommandResponse>(`${localhostApi}/api/category/create`, category);
  }
  delete(id: string): Observable<BaseCommandResponse> {
    return this.http.delete<BaseCommandResponse>(`${localhostApi}/api/category/delete/${id}`);
  }
  update(category: UpsertCategory): Observable<BaseCommandResponse> {
    return this.http.put<BaseCommandResponse>(`${localhostApi}/api/category/update`, category)
  }
}
