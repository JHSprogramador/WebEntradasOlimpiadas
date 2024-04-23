import { Injectable } from '@angular/core';
import { JwtHelperService } from '@auth0/angular-jwt';

@Injectable({
  providedIn: 'root'
})
export class Auth0TokenVerifierService {
  constructor(public jwtHelper: JwtHelperService) {}

  public isAuthenticated(): boolean {
    const token = localStorage.getItem('token');

    // Check whether the token is expired
    // If it is not expired, return true, otherwise, return false
    return !this.jwtHelper.isTokenExpired(token);
  }
}
