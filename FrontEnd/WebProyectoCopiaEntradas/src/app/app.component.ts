import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterOutlet } from '@angular/router';
import { AuthService, User } from '@auth0/auth0-angular';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [CommonModule, RouterOutlet],
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  isLogged = false;
  user: User | null = null;

  constructor(public auth: AuthService) {
    this.initialize();
  }

  async initialize() {
    if (!(await this.auth.isAuthenticated$)) {
      this.openLoginPage();
    }
  }

  async openLoginPage() {
    this.auth.loginWithRedirect();
  }
}
