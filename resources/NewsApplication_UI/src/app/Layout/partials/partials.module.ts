import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderClientComponent } from './client/header-client/header-client.component';
import { FooterClientComponent } from './client/footer-client/footer-client.component';
import { RouterModule } from '@angular/router';
import { HeaderAdminComponent } from './admin/header-admin/header-admin.component';
import { LeftbarAdminComponent } from './admin/leftbar-admin/leftbar-admin.component';



@NgModule({
  declarations: [
    HeaderClientComponent,
    FooterClientComponent,
    HeaderAdminComponent,
    LeftbarAdminComponent
  ],
  imports: [
    CommonModule,
    RouterModule
  ],
  exports:[
    HeaderClientComponent,
    FooterClientComponent,
    HeaderAdminComponent,
    LeftbarAdminComponent
  ]
})
export class PartialsModule { }
