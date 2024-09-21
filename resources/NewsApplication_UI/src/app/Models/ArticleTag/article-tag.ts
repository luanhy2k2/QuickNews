import { BaseModel } from "../Common/base-model";

export interface ArticleTag extends BaseModel {
  article_id:string,
  tag_id:string
}
