import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from "@angular/common/http";
import { Observable } from 'rxjs';
import { BaseQuerieResponse } from '../Models/Common/base-querie-response';
import { Tag } from '../Models/Tag/tag';
import { localhostApi } from '../Environments/env';
import { BaseCommandResponse } from '../Models/Common/base-command-response';
import { UpsertTag } from '../Models/Tag/upsert-tag';
import { BasePaging } from '../Models/Common/base-paging';
@Injectable({
  providedIn: 'root'
})
export class TagService {
  constructor(private http: HttpClient) { }
  getTag(paging:BasePaging): Observable<BaseQuerieResponse<Tag>> {
    let params = new HttpParams()
      .set('pageIndex', paging.pageIndex.toString())
      .set('pageSize', paging.pageSize.toString());
    if (paging.keyword) {
      params = params.set('keyword', paging.keyword);
    }
    return this.http.get<BaseQuerieResponse<Tag>>(`${localhostApi}/api/tag`, { params });
  }
  getAll(): Observable<Tag[]> {
    return this.http.get<Tag[]>(`${localhostApi}/api/tag/getAll`);
  }
  getTagById(id: string): Observable<Tag> {
    return this.http.get<Tag>(`${localhostApi}/api/tag/${id}`)
  }
  create(Tag: UpsertTag): Observable<BaseCommandResponse> {
    return this.http.post<BaseCommandResponse>(`${localhostApi}/api/tag/create`, Tag);
  }
  delete(id: string): Observable<BaseCommandResponse> {
    return this.http.delete<BaseCommandResponse>(`${localhostApi}/api/tag/delete/${id}`);
  }
  update(Tag: UpsertTag): Observable<BaseCommandResponse> {
    return this.http.put<BaseCommandResponse>(`${localhostApi}/api/tag/update`, Tag)
  }
}
