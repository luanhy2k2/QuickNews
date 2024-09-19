export interface BaseQuerieResponse<T> {
  pageIndex:number,
  pageSize:number,
  item:T[],
  total:number,
  keyword:string
}
