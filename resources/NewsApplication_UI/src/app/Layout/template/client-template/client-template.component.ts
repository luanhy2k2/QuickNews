import { Component } from '@angular/core';

@Component({
  selector: 'app-client-template',
  templateUrl: './client-template.component.html',
  styleUrls: ['./client-template.component.scss']
})
export class ClientTemplateComponent {
  ngOnInit() {
    this.loadClientScripts();
    this.loadClientStyles();
  }
  public loadClientStyles() {
    const styles = [
      './assets/css/media_query.css',
      './assets/css/bootstrap.css',
      'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
      './assets/css/animate.css',
      'https://fonts.googleapis.com/css?family=Poppins',
      './assets/css/owl.carousel.css',
      './assets/css/owl.theme.default.css',
      './assets/css/style_1.css'
    ];

    styles.forEach(styleHref => {
      const linkElement = document.createElement('link');
      linkElement.rel = 'stylesheet';
      linkElement.href = styleHref;
      linkElement.type = 'text/css';
      linkElement.crossOrigin = 'anonymous';
      document.head.appendChild(linkElement);
    });
  }
  public loadClientScripts() {
    const scripts = [
      './assets/js/modernizr-3.5.0.min.js',
      'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js',
      './assets/js/owl.carousel.min.js',
      'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js',
      'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js',
      './assets/js/jquery.waypoints.min.js',
      './assets/js/main.js'
    ];

    scripts.forEach(scriptSrc => {
      const scriptElement = document.createElement('script');
      scriptElement.src = scriptSrc;
      scriptElement.async = false; // Ensure scripts are loaded in order
      scriptElement.crossOrigin = 'anonymous'; // Set crossOrigin for external scripts
      document.body.appendChild(scriptElement);
    });
  }


}
