import { ApplicationConfig } from '@angular/core';
import { provideRouter } from '@angular/router';
import { provideAuth0 } from '@auth0/auth0-angular';

import { routes } from './app.routes';

export const appConfig: ApplicationConfig = {
  providers: [provideRouter(routes),  provideAuth0({
    domain: 'dev-vmmc04zcoyxqm1c2.us.auth0.com',
    clientId: 'blklvfY1Px003rJTtFWnSAHH6ZQ6ruCK',
    authorizationParams: {
      redirect_uri: window.location.origin
    }
  })],
  
};
