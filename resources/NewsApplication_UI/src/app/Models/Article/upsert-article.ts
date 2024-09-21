import { Tag } from "../Tag/tag";
import { Approval } from "./article";

export interface UpsertArticle {
  id:string,
  title:string,
  summary:string,
  articleTags:Tag[],
  content:string,
  approval:Approval,
  category_id:string,
  avatar:string,
}
