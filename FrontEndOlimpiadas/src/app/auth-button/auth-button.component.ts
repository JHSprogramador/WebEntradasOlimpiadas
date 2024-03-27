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

  constructor(public auth: AuthService, @Inject(DOCUMENT) public document: Document) { }

  ngOnInit() {}

}
