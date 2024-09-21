import { Category } from './../Category/category';
import { Account } from "../Account/account";
import { BaseModel } from "../Common/base-model";
import { Tag } from '../Tag/tag';

export interface Article extends BaseModel {
  title:string,
  content:string,
  created_at:Date,
  updated_at:Date,
  updated_by:string,
  approval:Approval,
  articleTags:Tag[],
  summary:string,
  category_id:string,
  category_name:string,
  created_by:string,
  avatar:string
}
export enum Approval {
  Pending = 'pending',
  Accepted = 'accepted',
  Rejected = 'rejected'
}


