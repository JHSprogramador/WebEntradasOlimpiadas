import { AuthService } from '@auth0/auth0-angular';
// import jquery from assets/jquery.min.js
import * as $ from 'jquery';
import { take } from 'rxjs';
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

  public async pushUser() {
    const body = JSON.stringify({
      idAuth0: await this.auth0User.subscribe((user) => {
        return user?.sub;
      }),
      name: await this.auth0User.subscribe((user) => {
        return user?.name;
      }),
      email: await this.auth0User.subscribe((user) => {
        return user?.email;
      }),
    });

    try {
      await $.post(apiURL + '/usuario/register', body);
      alert("User registered successfully!");
    } catch (error: any) {
      // if (error.status === 200) {
      //   console.log("User already registered!");
      // }
      if (error.status === 400) {
        console.error("An error occurred while registering the user.");
      } else if (error.status === 409) {
        console.error("User already registered!");
      }
    }
  }
}


