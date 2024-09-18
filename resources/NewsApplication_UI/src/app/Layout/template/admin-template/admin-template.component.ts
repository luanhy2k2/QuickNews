import { Component } from '@angular/core';

@Component({
  selector: 'app-admin-template',
  templateUrl: './admin-template.component.html',
  styleUrls: ['./admin-template.component.scss']
})
export class AdminTemplateComponent {
  ngOnInit() {
    this.loadScript();
    this.loadAdminStyles();
  }
  public loadScript() {
    const scripts = [
      './assets/admin/vendors/js/vendor.bundle.base.js',
      './assets/admin/js/jquery.cookie.js',
      './assets/admin/js/admin-custom.js',
      './assets/admin/js/off-canvas.js',
      './assets/admin/js/hoverable-collapse.js',
      './assets/admin/js/misc.js',
      './assets/admin/js/settings.js',
      './assets/admin/js/dashboard.js'
    ];
    scripts.forEach(scriptSrc => {
      const scriptElement = document.createElement('script');
      scriptElement.src = scriptSrc;
      scriptElement.async = false;
      document.body.appendChild(scriptElement);
    });
  }
  public loadAdminStyles() {
    const styles = [
      './assets/admin/vendors/mdi/css/materialdesignicons.min.css',
      './assets/admin/vendors/flag-icon-css/css/flag-icons.min.css',
      './assets/admin/vendors/css/vendor.bundle.base.css',
      './assets/admin/vendors/font-awesome/css/font-awesome.min.css',
      './assets/admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css',
      './assets/admin/css/vertical-light-layout/style.css'
    ];

    styles.forEach(styleHref => {
      const linkElement = document.createElement('link');
      linkElement.rel = 'stylesheet';
      linkElement.href = styleHref;
      document.head.appendChild(linkElement);
    });
  }
}
