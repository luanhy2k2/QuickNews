import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { TemplateRoutingModule } from './template-routing.module';
import { PartialsModule } from '../partials/partials.module';
import { BrowserModule } from '@angular/platform-browser';
import { RouterModule } from '@angular/router';
import { ClientModule } from 'src/app/Modules/client/client.module';
import { FormsModule } from '@angular/forms';
import { AdminModule } from 'src/app/Modules/admin/admin.module';
import { ClientTemplateComponent } from './client-template/client-template.component';
import { AdminTemplateComponent } from './admin-template/admin-template.component';


@NgModule({
  declarations: [
    ClientTemplateComponent,
    AdminTemplateComponent
  ],
  imports: [
    TemplateRoutingModule,
    PartialsModule,
    CommonModule,
    BrowserModule,
    RouterModule,
    ClientModule,
    FormsModule,
    AdminModule,
  ]
})
export class TemplateModule { }
