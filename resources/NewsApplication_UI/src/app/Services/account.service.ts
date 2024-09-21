import { Role } from './../Models/Account/account';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { localhostApi } from '../Environments/env';
import { Gender, Register } from '../Models/Account/register';
import { BaseCommandResponse } from '../Models/Common/base-command-response';
import { Account, Auth } from '../Models/Account/account';
import { Login } from '../Models/Account/login';
import { BasePaging } from '../Models/Common/base-paging';
import { BaseQuerieResponse } from '../Models/Common/base-querie-response';
import { AssignRoleToStaff } from '../Models/Account/assign-role-to-staff';

@Injectable({
  providedIn: 'root'
})
export class AccountService {
  constructor(private httpClient:HttpClient) { }
  getAccountByRole(paging:BasePaging, role:Role): Observable<BaseQuerieResponse<Account>> {
    let params = new HttpParams()
      .set('pageIndex', paging.pageIndex.toString())
      .set('pageSize', paging.pageSize.toString());
    if (paging.keyword) {
      params = params.set('keyword', paging.keyword);
    }
    return this.httpClient.get<BaseQuerieResponse<Account>>(`${localhostApi}/api/user/getUserByRole/${role}`, { params });
  }
  getAccount(paging:BasePaging): Observable<BaseQuerieResponse<Account>> {
    let params = new HttpParams()
      .set('pageIndex', paging.pageIndex.toString())
      .set('pageSize', paging.pageSize.toString());
    if (paging.keyword) {
      params = params.set('keyword', paging.keyword);
    }
    return this.httpClient.get<BaseQuerieResponse<Account>>(`${localhostApi}/api/user`, { params });
  }
  login(loginReq:Login): Observable<any> {
    return this.httpClient.post<any>(`${localhostApi}/api/user/login`, loginReq)
  }
  logOut(): Observable<any> {
    return this.httpClient.post<any>(`${localhostApi}/api/user/logout`, {})
  }
  getUserById(id:string):Observable<Account>{
    return this.httpClient.get<Account>(`${localhostApi}/api/user/${id}`)
  }
  assignRoleToStaff(accountId:string, role:Role): Observable<BaseCommandResponse> {
    return this.httpClient.patch<BaseCommandResponse>(`${localhostApi}/api/user/assignRoleToStaff/${accountId}`, {role})
  }
  revokeRole(accountId:string): Observable<BaseCommandResponse> {
    return this.httpClient.patch<BaseCommandResponse>(`${localhostApi}/api/user/revokeRole/${accountId}`, {})
  }
  register(account: Register): Observable<BaseCommandResponse> {
    const formData: FormData = new FormData();
        formData.append('name', account.name);
        formData.append('username', account.username);
        formData.append('password', account.password);
        formData.append('confirmPassword', account.confirmPassword);
        formData.append('address', account.address);
        formData.append('email', account.email);
        formData.append('gender', account.gender);
        formData.append('phone_number', account.phone_number);
        formData.append('birth', account.birth.toString());
        formData.append('avatar', account.avatar, account.avatar.name);
    return this.httpClient.post<BaseCommandResponse>(`${localhostApi}/api/user/register`, formData)
  }
  getCurentUser(): Auth {
    const userString = localStorage.getItem('user');
    if (userString) {
        return JSON.parse(userString) as Auth;
    } else {
        return {
            token: '',
            id: '',
            role: ''
        };
    }
  }
}
