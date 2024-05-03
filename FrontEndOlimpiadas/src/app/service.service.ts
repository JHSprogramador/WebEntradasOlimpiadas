import { Injectable } from '@angular/core';
import { AuthService } from '@auth0/auth0-angular';
// import jquery from assets/jquery.min.js
import * as $ from 'jquery';
import { firstValueFrom, map } from 'rxjs';
const apiURL = 'http://localhost:8000/api';

export interface User {
  idAuth0: string;
  name: string;
  email: string;
  mes1: number;
  mes2: number;
}

@Injectable({
  providedIn: 'root',
})
export class ServiceService {
  constructor(public auth: AuthService) {}

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

  async getUser(): Promise<User | undefined> {
    // Verificar si el usuario está autenticado
    if (!this.auth.isAuthenticated$) {
      console.error('El usuario no está autenticado.');
      return undefined;
    }

    try {
      // Obtener el idAuth0 del usuario autenticado
      const idAuth0 = await firstValueFrom(
        this.auth.user$.pipe(map((user) => user?.sub))
      );

      // Realizar la solicitud a la API para obtener el usuario completo
      const response = await $.get(apiURL + '/usuario/auth0/' + idAuth0);

      // Manejar el caso en que el usuario no se encuentra
      if (response.status === 404) {
        console.error('Usuario no encontrado.');
        return undefined;
      }

      // Devolver el usuario obtenido de la API
      const user: User = response as User;
      return user;
    } catch (error: any) {
      console.error('Error al obtener el usuario:', error);
      return undefined;
    }
  }
  async getDeportes() {
    try {
      const response = await $.get(apiURL + '/olimpiadas/deporte');
      console.log(response);
      return response;
    } catch (error) {
      console.error('Error al obtener los deportes:', error);
      throw error;
    }
  }
  async getEventosPorIdDeporte(id: string) {
    try {
      const response = await $.get(
        apiURL + '/olimpiadas/eventosPorIdDeporte/' + id
      );
      console.log(response);
      return response;
    } catch (error) {
      console.error('Error al obtener los eventos:', error);
      throw error;
    }
  }

  async getSecciones(id_deporte: string, id_evento: string) {
    try {
      const response = await $.get(
        apiURL + '/olimpiadas/secciones/' + id_deporte + '/' + id_evento
      );
      console.log(response);
      return response;
    } catch (error) {
      console.error('Error al obtener los eventos:', error);
      throw error;
    }
  }
  async pushEntrada(
    idDeporte: string,
    idEvento: string,
    idSeccion: string,
    cantidad: string
  ) {
    // const idAuth0 = await firstValueFrom(
    //   this.auth.user$.pipe(map((user) => user?.sub))
    // );
    // const idAuth0 = this.auth.user$.subscribe((user)=>{user?.sub});
    let idAuth0 = 1;
    const body = JSON.stringify({
      idDeporte,
      idEvento,
      idSeccion,
      idAuth0,
      cantidad,
    });
    try {
      await $.post(apiURL + '/gestion/ventas/compras', body);
    } catch (error: any) {
      if (error.status === 400) {
        console.error('An error occurred while pushing.');
      } else if (error.status === 409) {
        console.info('error');
      }
    }
  }
  // Llamada a la función getDeportes
}
