import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderClientComponent } from './client/header-client/header-client.component';
import { FooterClientComponent } from './client/footer-client/footer-client.component';



@NgModule({
  declarations: [
    HeaderClientComponent,
    FooterClientComponent
  ],
  imports: [
    CommonModule
  ],
  exports:[
    HeaderClientComponent,
    FooterClientComponent
  ]
})
export class PartialsModule { }
