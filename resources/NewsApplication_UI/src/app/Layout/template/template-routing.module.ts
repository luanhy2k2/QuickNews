import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ClientTemplateComponent } from './client-template/client-template.component';
import { AdminTemplateComponent } from './admin-template/admin-template.component';

const routes: Routes = [
  {
    path: '',
    component: ClientTemplateComponent,
    loadChildren: () =>
      import('../../Modules/client/client.module').then((x) => x.ClientModule),
  },
  {
    path: 'admin',
    component: AdminTemplateComponent,
    loadChildren: () =>
      import('../../Modules/admin/admin.module').then((x) => x.AdminModule),
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class TemplateRoutingModule {}
