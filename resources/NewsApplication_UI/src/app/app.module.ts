import { LOCALE_ID, NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { TemplateModule } from './Layout/template/template.module';
import { FormsModule } from '@angular/forms';
import {HttpClientModule } from '@angular/common/http';
import localeVi from '@angular/common/locales/vi';
import { registerLocaleData } from '@angular/common';

registerLocaleData(localeVi,'vi');
@NgModule({
  declarations: [
    AppComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    TemplateModule,
    FormsModule,
    HttpClientModule
  ],
  providers: [
    { provide: LOCALE_ID, useValue: 'vi' }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
