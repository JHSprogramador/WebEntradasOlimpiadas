import { AuthService } from '@auth0/auth0-angular';
// import jquery from assets/jquery.min.js
import * as $ from 'jquery';
// User
export interface User {
  id: number;
  auth0Id: string;
  name: string;
  email: string;
}
const apiURL = 'http://localhost:8000';

export class ServiceService {
  auth0User = this.auth.user$;
  constructor(public auth: AuthService) {
   
  }

  // public pushUser() {
  //   const body = JSON.stringify({
  //     idAuth0: this.auth0User.subscribe((user) => {
  //       return user?.sub;
  //     }),
  //     name: this.auth0User.subscribe((user) => {
  //       return user?.name;
  //     }),
  //     mail: this.auth0User.subscribe((user) => {
  //       return user?.email;
  //     })
  //   });
  //   $.post(apiURL + "/usuario/register", body, (data: any) => {
  //     alert(data);
  //   });
  // }
}


