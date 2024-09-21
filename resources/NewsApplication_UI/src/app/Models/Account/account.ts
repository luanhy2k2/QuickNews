import { BaseModel } from '../Common/base-model';
import { Gender } from './register';
export interface Account extends BaseModel {
  name:string,
  username:string,
  email:string,
  birth:Date,
  avatar:string,
  gender:Gender,
  address:string,
  phone_number:string,
  role:Role
}
export enum Role{
  Admin = 'Admin',
  Editor = 'Editor',
  SupportStaff = 'SupportStaff',
  Author = 'Author',
  Client = 'Client'
}
export interface SummaryAccount {
  id:string | null,
  name:string |null,
  avatar:string | null
}
export interface Auth {
  token:string,
  id:string,
  role:string
}
