export interface Register {
  name:string,
  username:string,
  password:string,
  email:string,
  phone_number:string,
  gender:Gender,
  address:string,
  birth:Date,
  confirmPassword:string,
  avatar:File
}
export enum Gender{
  male = 'male',
  female = 'female',
  other = 'other'
}
