import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ClientRoutingModule } from './client-routing.module';
import { IndexComponent } from './index/index.component';
import { LoginComponent } from './login/login.component';
import { FormsModule } from '@angular/forms';
import { RegisterComponent } from './register/register.component';
import { ArticleDetailComponent } from './article-detail/article-detail.component';
import { PartialsModule } from "../../Layout/partials/partials.module";


@NgModule({
  declarations: [
    IndexComponent,
    LoginComponent,
    RegisterComponent,
    ArticleDetailComponent
  ],
  imports: [
    CommonModule,
    FormsModule,
    ClientRoutingModule,
    PartialsModule
]
})
export class ClientModule { }
