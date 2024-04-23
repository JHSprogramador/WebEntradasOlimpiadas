import { AuthService } from '@auth0/auth0-angular';
// import jquery from assets/jquery.min.js
import * as $ from 'jquery';
import { firstValueFrom, map } from 'rxjs';
// User
export interface User {
  id: number;
  auth0Id: string;
  name: string;
  email: string;
}
const apiURL = 'http://localhost:8000/api';

export class ServiceService {
  auth0User = this.auth.user$;
  constructor(public auth: AuthService) {
  }

  async pushUser() {
    const idAuth0 = await firstValueFrom(this.auth0User.pipe(map(user => user?.sub)));
    const name = await firstValueFrom(this.auth0User.pipe(map(user => user?.name)));
    const email = await firstValueFrom(this.auth0User.pipe(map(user => user?.email)));

    const body = JSON.stringify({
      idAuth0,
      name,
      email
    });

    try {
      await $.post(apiURL + '/usuario/register', body);
      alert("User registered successfully!");
    } catch (error: any) {
      if (error.status === 400) {
        console.error("An error occurred while registering the user.");
      } else if (error.status === 409) {
        console.error("User already registered!");
      }
    }
  }
}


