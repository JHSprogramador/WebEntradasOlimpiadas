import { AuthService } from '@auth0/auth0-angular';
import { Component, Inject, OnInit } from '@angular/core';
import { IonButton } from '@ionic/angular/standalone';
import { CommonModule, DOCUMENT } from '@angular/common';

@Component({
  selector: 'app-auth-button',
  templateUrl: './auth-button.component.html',
  styleUrls: ['./auth-button.component.scss'],
  standalone: true,
  imports:[IonButton, CommonModule]
})
export class AuthButtonComponent  implements OnInit {
  isAuthenticated$ = this.auth.isAuthenticated$

  constructor(@Inject(DOCUMENT) public document: Document, public auth: AuthService) { }

  // eslint-disable-next-line @angular-eslint/no-empty-lifecycle-method
  ngOnInit() {}

}
