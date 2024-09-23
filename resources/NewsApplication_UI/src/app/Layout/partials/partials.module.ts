import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderClientComponent } from './client/header-client/header-client.component';
import { FooterClientComponent } from './client/footer-client/footer-client.component';
import { RouterModule } from '@angular/router';
import { HeaderAdminComponent } from './admin/header-admin/header-admin.component';
import { LeftbarAdminComponent } from './admin/leftbar-admin/leftbar-admin.component';
import { FadeInRightComponent } from './client/fade-in-right/fade-in-right.component';




@NgModule({
  declarations: [
    HeaderClientComponent,
    FooterClientComponent,
    HeaderAdminComponent,
    LeftbarAdminComponent,
    FadeInRightComponent,

  ],
  imports: [
    CommonModule,
    RouterModule
  ],
  exports:[
    HeaderClientComponent,
    FooterClientComponent,
    HeaderAdminComponent,
    LeftbarAdminComponent,
    FadeInRightComponent
  ]
})
export class PartialsModule { }
