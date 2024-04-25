import { HttpClient } from '@angular/common/http';
import { AuthService } from '@auth0/auth0-angular';
// import jquery from assets/jquery.min.js
import * as $ from 'jquery';
import { firstValueFrom, map } from 'rxjs';
const apiURL = 'http://localhost:8000/api';

export class ServiceService {
  public getJsonValue: any;
  constructor(
    public auth: AuthService,
    private http: HttpClient,
    public service: ServiceService
  ) {}

  async pushUser() {
    const idAuth0 = await firstValueFrom(
      this.auth.user$.pipe(map((user) => user?.sub))
    );
    const name = await firstValueFrom(
      this.auth.user$.pipe(map((user) => user?.name))
    );
    const mail = await firstValueFrom(
      this.auth.user$.pipe(map((user) => user?.email))
    );

    const body = JSON.stringify({
      idAuth0,
      name,
      mail,
    });

    try {
      await $.post(apiURL + '/usuario/register', body);
    } catch (error: any) {
      if (error.status === 400) {
        console.error('An error occurred while registering the user.');
      } else if (error.status === 409) {
        console.info('User already registered!');
      }
    }
  }

  async getDeportes() {
    try {
      const response = await $.get(apiURL + '/deporte');
      return response;
    } catch (error: any) {}
  }
}
